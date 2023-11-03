<?php

namespace App\Livewire\Backend;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BackupManagement extends Component
{
    use LivewireAlert;
    public $backups = [];
    #[Title('Backup Management')]
    public function mount()
    {
        Gate::authorize('app.backups.index');
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $files = $disk->files(config('backup.backup.name'));
        foreach ($files as $key => $file) {
            if (substr($file, -4) == '.zip' &&  $disk->exists($file)) {
                $full_file_path = $file;
                $fs = $disk->size($file);
                $file_name = str_replace(config('backup.backup.name') . '/', '', $file);
                $this->backups[] = [
                    'file_path' => $full_file_path,
                    'file_name' => $file_name,
                    'file_size' => $this->ByteToHuman($fs),
                    'last_modified' => Carbon::parse($disk->lastModified($full_file_path))->addHours(6)->toDayDateTimeString(),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $this->backups = array_reverse($this->backups);
    }
    /**
     * Convert bytes to human readable
     * @param $bytes
     * @return string
     */
    private function ByteToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
    public function download($file_name)
    {
        Gate::authorize('app.backups.download');
        $thisFile = Storage::disk(config('backup.backup.destination.disks')[0])->path(config('backup.backup.name') . '/' . $file_name);
        return response()->download($thisFile);
    }
    public function destroy($file_name)
    {
        Gate::authorize('app.backups.destroy');
        Storage::disk(config('backup.backup.destination.disks')[0])->delete(config('backup.backup.name') . '/' . $file_name);
        // return $thisFile->delete();
        $this->alert('success', 'Backup deleted');
    }
    public function create()
    {
        Gate::authorize('app.backups.create');
        Artisan::call('backup:run');
        $this->alert('success', 'Backup Created');
    }
    public function clean()
    {
        Gate::authorize('app.backups.destroy');
        Artisan::call('backup:clean');
        $this->alert('success', 'Backup Cleaned');
    }
    public function render()
    {
        return view('livewire.backend.backup-management');
    }
}
