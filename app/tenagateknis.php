<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tenagateknis extends Model
{
    protected $table = 'tb_tenagateknis';
    protected $primaryKey = 'id_tenaga';
    public $timestamps = false;
    protected $fillable = [];

    public function jeniskelamin()
    {
        return $this->belongsTo(jeniskelamin::class,'id_jk');
    }
    public function divisi()
    {
        return $this->belongsTo(divisi::class,'id_divisi');
    }
    public function pendidikan()
    {
        return $this->belongsTo(pendidikan::class,'id_pendidikan');
    }
}
