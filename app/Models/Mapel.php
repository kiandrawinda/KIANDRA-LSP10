<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ← wajib
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'durasi'];
}
