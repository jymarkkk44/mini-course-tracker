<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Topic extends Model
{
    protected $fillable = ['title', 'status', 'time_spent', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    use HasFactory;
}

