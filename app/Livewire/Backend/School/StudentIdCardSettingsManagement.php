<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use App\Models\StudentIdCard;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StudentIdCardSettingsManagement extends Component
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


    public function edit(StudentIdCard $studentIdCard)
    {
        abort_action($studentIdCard->school->user_id);

        $this->editable_card = $studentIdCard;
    }

    public function destroy(StudentIdCard $studentIdCard)
    {
        // Gate::authorize('school.staffs.destroy');
        abort_action($studentIdCard->school->user_id);
        if ($this->id_card_frontside_background_image != null) {
            Storage::disk('public')->delete($this->id_card_frontside_background_image);
        }

        if ($this->id_card_backside_background_image != null) {
            Storage::disk('public')->delete($this->id_card_backside_background_image);
        }

        if ($this->id_card_qr_code != null) {
            Storage::disk('public')->delete($this->id_card_qr_code);
        }

        if ($this->id_card_signature != null) {
            Storage::disk('public')->delete($this->id_card_signature);
        }
        $studentIdCard->delete();

        $this->alert('success', 'Deleted successfully');
    }
    public function render()
    {
        $idCards = StudentIdCard::where('school_id', school()->id)->get();
        return view('livewire.backend.school.student-id-card-settings-management', [
            'idCards' => $idCards,
        ]);
    }
}
