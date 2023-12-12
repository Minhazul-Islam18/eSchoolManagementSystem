<?php

namespace App\Livewire\Backend\School;

use App\Models\School;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class GeneralInformation extends Component
{
    use LivewireAlert;
    #[Title('General information')]
    public $institute_name;
    public $institute_address;
    public $thana_or_upazilla;
    public $district;
    public $eiin_no;
    public $headteacher_number;
    public $mobile_no;
    public $alt_mobile_no;
    public $web_address;
    public function SaveGeneralSettings()
    {
        Gate::authorize('school.settings.update');
        $this->validate([
            'institute_name' => 'nullable|max:100',
            'institute_address' => 'nullable|max:255',
            'thana_or_upazilla' => 'nullable|max:100',
            'district' => 'nullable|max:100',
            'eiin_no' => 'nullable|max:100',
            'headteacher_number' => 'nullable|max:20',
            'mobile_no' => 'nullable|max:20',
            'alt_mobile_no' => 'nullable|max:20',
            'web_address' => 'nullable|max:50',
        ]);
        $e = School::where('user_id', auth()->user()->id)->first();

        $e->update([
            'institute_name' => $this->institute_name,
            'institute_address' => $this->institute_address,
            'thana_or_upazilla' => $this->thana_or_upazilla,
            'district' => $this->district,
            'eiin_no' => $this->eiin_no,
            'headteacher_number' => $this->headteacher_number,
            'mobile_no' => $this->mobile_no,
            'alt_mobile_no' => $this->alt_mobile_no,
            'web_address' => $this->web_address,
        ]);
        $this->alert('success', 'Information updated');
    }
    public function mount()
    {
        Gate::authorize('school.settings.index');
        $e = School::allInformations();
        $this->institute_name  = $e->institute_name;
        $this->institute_address  = $e->institute_address;
        $this->thana_or_upazilla  = $e->thana_or_upazilla;
        $this->district  = $e->district;
        $this->eiin_no  = $e->eiin_no;
        $this->headteacher_number  = $e->headteacher_number;
        $this->mobile_no  = $e->mobile_no;
        $this->alt_mobile_no  = $e->alt_mobile_no;
        $this->web_address  = $e->web_address;
    }
    public function render()
    {
        return view('livewire.backend.school.general-information');
    }
}
