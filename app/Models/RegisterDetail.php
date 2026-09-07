<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterDetail extends Model
{
    protected $table = 'register_detail';
    protected $primaryKey = 'detail_id';
    public $timestamps = false;

    protected $fillable = [
        'register_id',
        'subject_id',
        'subscoer',
        'final_score',
        'total_score',
        'grade',
        'subject_code',
    ];

    public function register()
    {
        return $this->belongsTo(Register::class, 'register_id', 'register_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_code');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id')->withDefault();
    }
}

