<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\FrontendPage;
use Illuminate\Http\Request;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PageManagement extends Component
{
    use LivewireAlert;
    #[Title('Frontend Pages')]
    public function delete(FrontendPage $frontendPage)
    {
        Gate::authorize('app.pages.index');
        $frontendPage->delete();
        $this->alert('success', 'Page deleted');
    }
    public function uploadImage(Request $request)
    {
        Gate::authorize('app.pages.create');
        $newImageName = time() . '_' . $request->file('upload')->getClientOriginalName();
        $flu = $request->file('upload')->storeAs('frontend/images', $newImageName, 'public');
        return response()->json(['fileName' => $newImageName, 'uploaded' => 1, 'url' => '/storage/' . $flu]);
    }
    public function render()
    {
        Gate::authorize('app.pages.index');
        $pages = FrontendPage::all();
        return view('livewire.backend.page-management', ['pages' => $pages]);
    }
}
