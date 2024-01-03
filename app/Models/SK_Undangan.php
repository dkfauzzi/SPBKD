<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SK_Undangan extends Model
{
    use HasFactory;
    protected $table = "sk_undangan";
    public $timestamps = false;
    protected $fillable = ['sks','sk','jenis_sk','NIP',
    'start_date',
    'start_sk'];


}
