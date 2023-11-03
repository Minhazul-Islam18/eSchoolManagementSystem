<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\FrontendPage;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ConfigurePage extends Component
{
    use LivewireAlert;
    public $editable_page;
    #[Title('Configure Page')]
    public $page = [
        'id' => '',
        'title' => '',
        'slug' => '',
        'excerpt' => '',
        'content' => '',
        'status' => false,
        'meta_description' => '',
        'meta_keywords' => '',
    ];
    public function rules()
    {
        return [
            'page.title' => 'required|unique:frontend_pages,title',
        ];
    }
    public function update()
    {
        Gate::authorize('app.pages.create');
        $this->validate();
        $f = FrontendPage::findOrFail($this->page['id']);
        $f->update([
            'title' => $this->page['title'],
            'slug' => Str::slug($this->page['title']),
            'excerpt' => $this->page['excerpt'],
            'body' => $this->page['content'],
            'status' => (bool)$this->page['status'],
            'meta_description' => $this->page['meta_description'],
            'meta_keywords' => $this->page['meta_keywords'],
        ]);
        $this->ResetFields();
        $this->alert('success', 'Page updated');
        $this->redirect(PageManagement::class);
    }
    public function store()
    {
        Gate::authorize('app.pages.edit');
        $this->validate([
            'page.title' => 'required|unique:frontend_pages,title,' . $this->page['id'],
        ]);
        FrontendPage::create([
            'title' => $this->page['title'],
            'slug' => Str::slug($this->page['title']),
            'excerpt' => $this->page['excerpt'],
            'body' => $this->page['content'],
            'status' => (bool)$this->page['status'],
            'meta_description' => $this->page['meta_description'],
            'meta_keywords' => $this->page['meta_keywords'],
        ]);
        $this->ResetFields();
        $this->alert('success', 'Page created');
    }

    public function mount($id = null)
    {
        if ($id != null) {
            $frontendPage = FrontendPage::findOrFail($id);
            $this->editable_page = true;
            if ($this->editable_page) {
                $this->page =
                    [
                        'id' => $frontendPage->id,
                        'title' => $frontendPage->title,
                        'slug' => $frontendPage->slug,
                        'excerpt' => $frontendPage->excerpt,
                        'content' => $frontendPage->body,
                        'status' => $frontendPage->status ? true : false,
                        'meta_description' => $frontendPage->meta_description,
                        'meta_keywords' => $frontendPage->meta_keywords,
                    ];
            }
        }
        Gate::authorize('app.pages.index');
    }
    public function ResetFields()
    {
        $this->page =
            [
                'id' => '',
                'title' => '',
                'slug' => '',
                'excerpt' => '',
                'content' => '',
                'status' => false,
                'meta_description' => '',
                'meta_keywords' => '',
            ];
    }
    public function render()
    {
        return view('livewire.backend.configure-page');
    }
}
