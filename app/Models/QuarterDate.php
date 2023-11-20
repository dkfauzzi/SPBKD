<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuarterDate extends Model
{
    use HasFactory;
    protected $table = "test_sk_dosen";
    public $timestamps = false;
    protected $fillable = ['sks','sk','jenis_sk','keterangan_sk',
    'start_date','end_date',
    'q1_start','q1_end',
    'q2_start','q2_end',
    'q3_start', 'q3_end',
    'q4_start', 'q4_end', 
    'start_sk','end_sk'];
}
