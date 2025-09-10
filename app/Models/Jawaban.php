<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $guarded = ['id'];

    public function soal() {
        return $this->belongsTo(Soal::class, 'soal_id');
    }

    // public function user() {
    //     return $this->hasMany(User::class, 'user_id');
    // }
}
