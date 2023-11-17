<?php

namespace App\Livewire\Backend\School;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\SchoolStaff;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StaffManagement extends Component
{
    use LivewireAlert, WithFileUploads;
    #[Title('Staff management')]
    public $openCEmodal = false;
    public $editable_item = null;
    public $selectedStatus = null;
    public $name;
    public $status;
    public $educational_qualification;
    public $image;
    public $preview_image;
    public $address;
    public $gender;
    public $joined_at;
    public $resigned_at;
    public $type;
    public $facebook;
    public $email;
    public $phone;
    public $website;
    public function store()
    {
        $this->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg',
            'type' => 'required',
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'educational_qualification' => 'required',
            'status' => 'required',
        ]);
        $others_info = array(
            'facebook' => $this->facebook,
            'email' => $this->email,
            'phone' => $this->phone,
            'website' => $this->website,
        );
        if ($this->image != null) {
            $this->image = $this->image->storeAs('school-staffs', $this->image->hashName(), 'public');
        }
        school()->staffs()->create([
            'others_info' => json_encode($others_info),
            'type' => $this->type,
            'image' => $this->image,
            'name' => $this->name,
            'address' => $this->address,
            'gender' => $this->gender,
            'educational_qualification' => $this->educational_qualification,
            'status' => $this->status,
            'joined_at' => $this->joined_at,
            'resigned_at' => $this->resigned_at,
        ]);
        $this->alert('success', Str::ucfirst($this->type) . ' ' . 'created');
        $this->resetFields();
        $this->dispatch('closeModal');
        $this->dispatch('reload');
    }
    public function view(SchoolStaff $schoolStaff)
    {
        abort_action($schoolStaff->school->user_id);
        $schoolStaff->others_info = json_decode($schoolStaff->others_info);
        $this->name = $schoolStaff->name;
        $this->status = $schoolStaff->status;
        $this->educational_qualification = $schoolStaff->educational_qualification;
        $this->preview_image = $schoolStaff->image;
        $this->address = $schoolStaff->address;
        $this->gender = $schoolStaff->gender;
        $this->joined_at =
            Carbon::parse($schoolStaff->joined_at)->format('Y-m-d');
        $this->resigned_at = Carbon::parse($schoolStaff->resigned_at)->format('Y-m-d');
        $this->type = $schoolStaff->type;
        $this->facebook = $schoolStaff->others_info->facebook;
        $this->email = $schoolStaff->others_info->email ?? '';
        $this->phone = $schoolStaff->others_info->phone ?? '';
        $this->website = $schoolStaff->others_info->website ?? '';
    }
    public function edit(SchoolStaff $schoolStaff)
    {
        abort_action($schoolStaff->school->user_id);
        $this->editable_item = $schoolStaff;
        $this->selectedStatus = $schoolStaff->status;
        $this->view($this->editable_item);
    }
    public function delete(SchoolStaff $schoolStaff)
    {
        abort_action($schoolStaff->school->user_id);
        if ($schoolStaff->image != null) {
            Storage::disk('public')->delete($schoolStaff->image);
        }
        $schoolStaff->delete();
    }
    public function update()
    {
        $this->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg',
            'type' => 'required',
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'educational_qualification' => 'required',
            'status' => 'required',
        ]);
        $others_info = array(
            'facebook' => $this->facebook,
            'email' => $this->email,
            'phone' => $this->phone,
            'website' => $this->website,
        );
        if ($this->image != null) {
            Storage::disk('public')->delete($this->preview_image);
            $this->image = $this->image->storeAs(auth()->user()->id . '/school-staffs', $this->image->hashName(), 'public');
        }

        $this->editable_item->update([
            'others_info' => json_encode($others_info),
            'type' => $this->type,
            'image' => $this->image ?? $this->preview_image,
            'name' => $this->name,
            'address' => $this->address,
            'gender' => $this->gender,
            'educational_qualification' => $this->educational_qualification,
            'status' => $this->status,
            'joined_at' => $this->joined_at,
            'resigned_at' => $this->resigned_at,
        ]);
        $this->alert('success', Str::ucfirst($this->type) . ' ' . 'created');
        $this->resetFields();
        $this->dispatch('closeModal');
        $this->dispatch('reload');
    }
    public function resetFields()
    {
        $this->openCEmodal = false;
        $this->editable_item = null;
        $this->selectedStatus = null;
        $this->name = '';
        $this->preview_image = '';
        $this->status = '';
        $this->educational_qualification = '';
        $this->image = '';
        $this->address = '';
        $this->gender = '';
        $this->joined_at = '';
        $this->resigned_at = '';
        $this->type = '';
        $this->facebook = '';
        $this->email = '';
        $this->phone = '';
    }
    public function render()
    {
        $staffs = SchoolStaff::allStaffs();
        return view('livewire.backend.school.staff-management')->with(['staffs' => $staffs]);
    }
}
