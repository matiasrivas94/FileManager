<div>
    <label>Carpeta:</label>
    <select wire:model="folder_id">
        <option value="">Selecciona una carpeta</option>
        @foreach($folders as $folder)
            <option value="{{ $folder->id }}">{{ $folder->name }}</option>
        @endforeach
    </select>

    <input type="file" wire:model="file">
    <button wire:click="upload">Subir</button>

    <h3>Archivos</h3>
    <ul>
        @foreach($files as $file)
            <li>
                {{ $file->name }}
                <button wire:click="delete({{ $file->id }})">Eliminar</button>
            </li>
        @endforeach
    </ul>
</div>
