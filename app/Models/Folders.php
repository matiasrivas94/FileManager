<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folders extends Model
{
    protected $fillable = ['name'];

    public function files()
    {
        return $this->hasMany(Files::class);
    }
}
