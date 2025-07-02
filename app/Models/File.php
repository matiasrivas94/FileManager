<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['name', 'path', 'folder_id','deleted_at'];
    protected $dates = ['deleted_at'];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
