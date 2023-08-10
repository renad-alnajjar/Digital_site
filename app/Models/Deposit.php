<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    public function userDeposit()
    {
        return $this->hasMany(UserDeposit::class)->with('user');
    }
}
