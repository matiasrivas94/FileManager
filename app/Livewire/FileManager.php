<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\File;
use App\Models\Folder;

class FileManager extends Component
{
    use WithFileUploads;

    public $file;
    public $files;
    public $folders;
    public $folder_id;

    public function mount()
    {
        $this->folders = Folder::all();
        $this->files = File::whereNull('deleted_at')
            ->where('folder_id', $this->folder_id)
            ->get();
    }

    public function upload()
    {
        $validated = $this->validate([
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        $originalName = $this->file->getClientOriginalName(); //Obtiene el nombre original del archivo
        $path = $this->file->storeAs('uploads', uniqid() . '_' . $originalName); //Guarda el archivo en la carpeta storage/app/uploads/. 
                                                                                 //Le cambia el nombre para que sea único, usando uniqid().

        File::create([
            'name' => $originalName,
            'path' => $path,
            'folder_id' => $this->folder_id,
        ]);

        $this->files = File::whereNull('deleted_at')
            ->where('folder_id', $this->folder_id)
            ->get();
        $this->reset('file');
    }

    public function delete($id)
    {
        $file = File::find('$id');
        $file->deleted_at = now();
        $file->save();
        $this->files = File::whereNull('deleted_at')->get();
    }

    public function render()
    {
        return view('livewire.file-manager');
    }

}
