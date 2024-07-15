<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_date',
        'work_start',
        'work_end',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function breakings()
    {
        return $this->hasMany(Breaking::class);
    }
}
