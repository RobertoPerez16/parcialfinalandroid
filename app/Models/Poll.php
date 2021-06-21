<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_1',
        'question_2',
        'question_3',
        'question_4',
        'question_5',
        'average',
        'user_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }
}
