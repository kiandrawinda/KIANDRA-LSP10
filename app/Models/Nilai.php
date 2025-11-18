<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = ['siswa_id','mapel_id','guru_id','nilai','keterangan'];

    public function mapel() { return $this->belongsTo(Mapel::class); }
    public function guru() { return $this->belongsTo(Guru::class); }
    public function siswa() { return $this->belongsTo(User::class, 'siswa_id'); }
}

