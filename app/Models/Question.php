<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'user_id',
        'code',
        'status'
    ];

    protected $attributes = [
        'status' => 'active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function polls()
    {
        return $this->hasMany(Poll::class, 'question_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'question_id');
    }

}
