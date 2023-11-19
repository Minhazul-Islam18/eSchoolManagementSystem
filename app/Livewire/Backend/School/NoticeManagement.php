<?php

namespace App\Livewire\Backend\School;

use App\Models\School;
use Livewire\Component;
use App\Models\SchoolClass;
use Illuminate\Support\Str;
use App\Models\SchoolNotice;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class NoticeManagement extends Component
{
    use LivewireAlert, WithFileUploads;
    #[Title('Notice management')]
    public
        $title,
        $description,
        $files = [],
        $class = [],
        $editable_item,
        $openCEmodal = false;

    public function store()
    {
        $fs = [];
        foreach ($this->files as $file) {
            $name = $file->hashName();
            $fs[] = $file->storeAs(school()->id . '/notice', $name, 'public');
        }
        $notice = school()->notices()->create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'description' => $this->description,
            'files' => json_encode($fs),
        ]);
        $notice->schoolClasses()->attach($this->class);
        $this->alert('success', 'Notice created');
        $this->resetFields();
    }

    public function destroy(SchoolNotice $schoolNotice)
    {
        abort_action($schoolNotice->school->user_id);

        if (null !== $schoolNotice->files) {
            Storage::disk('public')->delete(json_decode($schoolNotice->files));
        }
        $schoolNotice->delete();
        $this->alert('success', 'Notice deleted');
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->title;
        $this->description;
        $this->files = [];
        $this->class = [];
        $this->editable_item;
        $this->openCEmodal = false;
    }

    public function render()
    {
        $allClass = SchoolClass::allClasses();
        $notices = school()->notices()->get();
        return view('livewire.backend.school.notice-management', ['allClass' => $allClass, 'notices' => $notices]);
    }
}
