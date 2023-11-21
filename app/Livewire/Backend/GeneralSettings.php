<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\SiteSetting;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\Dotenv\Dotenv;
use Brotzka\DotenvEditor\DotenvEditor;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class GeneralSettings extends Component
{
    use LivewireAlert, WithFileUploads;
    #[Title('General Settings')]
    public $site_title;
    public $site_description;
    public $address;
    public $logo;
    public $favicon;
    public $primary_color;
    public $secondary_color;
    public $mail_mailer;
    public $mail_host;
    public $mail_port;
    public $mail_username;
    public $mail_password;
    public $mail_encryption;
    public $mail_from_name;
    public $mail_from_address;
    public $google_client_id;
    public $google_client_secret;
    public function SaveGeneralSettings()
    {
        Gate::authorize('app.settings.update');
        $this->validate([
            'site_title' => 'nullable|string|min:5|max:255',
            'site_description' => 'nullable|string|min:5|max:255',
            'address' => 'nullable|string|min:5|max:255',
        ]);
        SiteSetting::updateOrCreate(['key' => 'site_title'], ['value' => $this->site_title]);
        SiteSetting::updateOrCreate(['key' => 'site_description'], ['value' => $this->site_description]);
        SiteSetting::updateOrCreate(['key' => 'address'], ['value' => $this->address]);


        $env = new DotenvEditor();
        $env->changeEnv([
            'APP_NAME' => '"' . $this->site_title . '"',
        ]);

        $this->alert('success', 'Settings updated.');
    }
    public function SaveAppearanceSettings()
    {
        Gate::authorize('app.settings.update');
        $this->validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg',
            'favicon' => 'nullable|image|mimes:png,jpg,jpeg,svg',
        ]);
        if (null != $this->logo) {
            if (null != setting('logo')) {
                $this->deleteOldImage(setting('logo'));
            }
            $logo = $this->logo->storeAs('settings', $this->logo->hashName(), 'public');
        }
        if (null != $this->favicon) {
            if (null != setting('favicon')) {
                $this->deleteOldImage(setting('favicon'));
            }
            $favicon = $this->favicon->storeAs('settings', $this->favicon->hashName(), 'public');
        }
        SiteSetting::updateOrCreate(['key' => 'logo'], ['value' => $logo ?? setting('logo')]);
        SiteSetting::updateOrCreate(['key' => 'favicon'], ['value' => $favicon ?? setting('favicon')]);
        SiteSetting::updateOrCreate(['key' => 'primary_color'], ['value' => $this->primary_color]);
        SiteSetting::updateOrCreate(['key' => 'secondary_color'], ['value' => $this->secondary_color]);
        $this->alert('success', 'Settings updated.');
    }
    public function SaveMailSettings()
    {
        Gate::authorize('app.settings.update');
        $this->validate([
            'mail_mailer' => 'nullable|string|max:255',
            'mail_host' => 'nullable|string|max:255',
            'mail_port' => 'nullable|string|max:255',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_encryption' => 'nullable|string|max:255',
            'mail_from_name' => 'nullable|string|max:255',
            'mail_from_address' => 'nullable|email|max:255',
        ]);
        SiteSetting::updateOrCreate(['key' => 'mail_mailer'], ['value' => $this->mail_mailer]);
        SiteSetting::updateOrCreate(['key' => 'mail_host'], ['value' => $this->mail_host]);
        SiteSetting::updateOrCreate(['key' => 'mail_port'], ['value' => $this->mail_port]);
        SiteSetting::updateOrCreate(['key' => 'mail_username'], ['value' => $this->mail_username]);
        SiteSetting::updateOrCreate(['key' => 'mail_password'], ['value' => $this->mail_password]);
        SiteSetting::updateOrCreate(['key' => 'mail_encryption'], ['value' => $this->mail_encryption]);
        SiteSetting::updateOrCreate(['key' => 'mail_from_name'], ['value' => $this->mail_from_name]);
        SiteSetting::updateOrCreate(['key' => 'mail_from_address'], ['value' => $this->mail_from_address]);

        $env = new DotenvEditor();
        // Changes the value of the Database name and username
        $env->changeEnv([
            'MAIL_MAILER' => $this->mail_mailer,
            'MAIL_HOST' => $this->mail_host,
            'MAIL_PORT' => $this->mail_port,
            'MAIL_USERNAME' => $this->mail_username,
            'MAIL_PASSWORD' => $this->mail_password,
            'MAIL_ENCRYPTION' => $this->mail_encryption,
            'MAIL_FROM_ADDRESS' => $this->mail_from_address,
            'MAIL_FROM_NAME' => $this->mail_from_name,
        ]);

        $this->alert('success', 'Mail settings updated.');
    }
    public function SaveSocialiteSettings()
    {
        Gate::authorize('app.settings.update');
        $this->validate([
            'google_client_id' => 'required|string|max:255',
            'google_client_secret' => 'required|string|max:255',
        ]);
        SiteSetting::updateOrCreate(['key' => 'google_client_id'], ['value' => $this->google_client_id]);
        SiteSetting::updateOrCreate(['key' => 'google_client_secret'], ['value' => $this->google_client_secret]);

        $env = new DotenvEditor();
        // Changes the value of the Database name and username
        $env->changeEnv([
            'GOOGLE_CLIENT_ID' => $this->google_client_id,
            'GOOGLE_CLIENT_SECRET' => $this->google_client_secret,
        ]);

        $this->alert('success', 'Social login settings updated.');
    }

    private function deleteOldImage($file)
    {
        Gate::authorize('app.settings.update');
        Storage::disk('public')->delete($file);
    }

    public function mount()
    {
        Gate::authorize('app.settings.index');
        $this->primary_color = setting('primary_color') ?? null;
        $this->secondary_color = setting('secondary_color') ?? null;
    }
    public function render()
    {
        return view('livewire.backend.general-settings');
    }
}
