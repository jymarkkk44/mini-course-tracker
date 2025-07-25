<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    protected $fillable = ['title'];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
    use HasFactory;
}

