<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeAdmins($query){
        return $query->where('role',1);
    }

    public function scopeDoctors($query){
        return $query->where('role',3);
    }
}
