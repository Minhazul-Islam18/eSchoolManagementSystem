<?php

namespace App\Livewire\Backend\School;

use App\Models\StudentIdCard;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StudentIdCardCreateEditForm extends Component
{
    use WithFileUploads, LivewireAlert;
    public $id_card_title;
    public $id_card_expire_date;
    public $id_card_frontside_background_image;
    public $id_card_backside_background_image;
    public $id_card_signature;
    public $id_card_qr_code;
    public $id_card_backside_description;
    public $editable_card;
    public $trixId;
    public function create(Request $request)
    {
        $validated = $this->validate([
            'id_card_title' => 'required',
            'id_card_expire_date' => 'required',
            'id_card_frontside_background_image' => 'required',
            'id_card_backside_background_image' => 'required',
            'id_card_signature' => 'required',
            'id_card_qr_code' => 'required',
            'id_card_backside_description' => 'required',
        ]);

        $this->store($validated);
    }

    public function store($validated)
    {
        if ($this->id_card_frontside_background_image != null) {
            $this->id_card_frontside_background_image = $this->id_card_frontside_background_image->storeAs('id-cards', $this->id_card_frontside_background_image->hashName(), 'public');
        }

        if ($this->id_card_backside_background_image != null) {
            $this->id_card_backside_background_image = $this->id_card_backside_background_image->storeAs('id-cards', $this->id_card_backside_background_image->hashName(), 'public');
        }

        if ($this->id_card_qr_code != null) {
            $this->id_card_qr_code = $this->id_card_qr_code->storeAs('id-cards', $this->id_card_qr_code->hashName(), 'public');
        }

        if ($this->id_card_signature != null) {
            $this->id_card_signature = $this->id_card_signature->storeAs('id-cards', $this->id_card_signature->hashName(), 'public');
        }
        school()->studentIdCards()->create([
            'title' => $validated['id_card_title'],
            'expire_date' => $validated['id_card_expire_date'],
            'frontside_background_image' => $this->id_card_frontside_background_image,
            'backside_background_image' => $this->id_card_backside_background_image,
            'signature' => $this->id_card_signature,
            'qr_code' => $this->id_card_qr_code,
            'backside_description' => $validated['id_card_backside_description'],
        ]);

        $this->alert('success', 'ID Card created');
        return to_route('school.student-id-cards');
        $this->resetFields();
    }

    public function update()
    {
        if ($this->id_card_frontside_background_image != null) {
            Storage::disk('public')->delete($this->id_card_frontside_background_image);
            $this->id_card_frontside_background_image = $this->id_card_frontside_background_image->storeAs('id-cards', $this->id_card_frontside_background_image->hashName(), 'public');
        }

        if ($this->id_card_backside_background_image != null) {
            Storage::disk('public')->delete($this->id_card_backside_background_image);
            $this->id_card_backside_background_image = $this->id_card_backside_background_image->storeAs('id-cards', $this->id_card_backside_background_image->hashName(), 'public');
        }

        if ($this->id_card_qr_code != null) {
            Storage::disk('public')->delete($this->id_card_qr_code);
            $this->id_card_qr_code = $this->id_card_qr_code->storeAs('id-cards', $this->id_card_qr_code->hashName(), 'public');
        }

        if ($this->id_card_signature != null) {
            Storage::disk('public')->delete($this->id_card_signature);
            $this->id_card_signature = $this->id_card_signature->storeAs('id-cards', $this->id_card_signature->hashName(), 'public');
        }

        $this->editable_card->update([
            'title' => $this->id_card_title ?: $this->editable_card->title,
            'expire_date' => $this->id_card_expire_date ?: $this->editable_card->expire_date,
            'frontside_background_image' => $this->id_card_frontside_background_image ?: $this->editable_card->frontside_background_image,
            'backside_background_image' => $this->id_card_backside_background_image ?? $this->editable_card->backside_background_image,
            'signature' => $this->id_card_signature ?? $this->editable_card->signature,
            'qr_code' => $this->id_card_qr_code ?: $this->editable_card->qr_code,
            'backside_description' => $this->id_card_backside_description ?? $this->editable_card->backside_description,
        ]);

        $this->alert('success', 'Id Card updated');
        return to_route('school.student-id-cards');
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->id_card_title = null;
        $this->id_card_expire_date = null;
        $this->id_card_frontside_background_image = null;
        $this->id_card_backside_background_image = null;
        $this->id_card_signature = null;
        $this->id_card_qr_code = null;
        $this->id_card_backside_description = null;
        $this->editable_card = null;
    }

    public function mount($id = null)
    {
        $this->editable_card = school()->studentIdCards()->find($id);
        $this->id_card_backside_description = $this->editable_card?->backside_description;
        $this->id_card_title = $this->editable_card?->title;
        $this->id_card_expire_date = $this->editable_card?->expire_date;
        $this->trixId = 'trix-' . uniqid();
    }
    public function render()
    {
        return view('livewire.backend.school.student-id-card-create-edit-form');
    }
}
