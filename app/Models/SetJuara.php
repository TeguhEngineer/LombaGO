<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetJuara extends Model
{
    protected $guarded = ['id'];

    public function peserta() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
