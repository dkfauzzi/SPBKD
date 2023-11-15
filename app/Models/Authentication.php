<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $fillable = ['nama','JAD','NIP', 'KK','email', 'password','level',];
}
