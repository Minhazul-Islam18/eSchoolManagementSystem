<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use App\Models\SchoolClass;
use Illuminate\Support\Str;
use App\Models\SchoolNotice;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

class NoticeEdit extends Component
{
    public $title,
        $description,
        $files = [],
        $class = [],
        $editable_item;
    public function mount($slug)
    {
        $this->editable_item =  SchoolNotice::where('slug', $slug)->firstOrFail();
        abort_action($this->editable_item->school->user_id);
        $this->title = $this->editable_item->title;
        $this->description = $this->editable_item->description;
        foreach ($this->editable_item->schoolClasses as $class) {
            $this->class[] = $class->id;
        }
    }

    public function update()
    {
        $fs = [];
        if (null !== $this->files) {
            Storage::disk('public')->delete(json_decode($this->editable_item->files));
            foreach ($this->files as $file) {
                $name = $file->hashName();
                $fs[] = $file->storeAs(school()->id . '/notice', $name, 'public');
            }
        } else {
            $fs = json_decode($this->editable_item->files);
        }


        $this->editable_item->update([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'description' => $this->description,
            'files' => json_encode($fs),
        ]);
        $this->editable_item->schoolClasses()->sync($this->class);
        return to_route('school.notices');
    }

    public function render()
    {
        $allClass = SchoolClass::allClasses();
        return view('livewire.backend.school.notice-edit', ['allClass' => $allClass])->title('Edit notice: ' . $this->title);
    }
}
