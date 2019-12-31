<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pendidikan extends Model
{
    protected $table = 'tb_pendidikanterakhir';
    protected $primaryKey = 'id_pendidikan';
    public $timestamps = false;
    protected $fillable = [];

    public function tenagateknis()
    {
        return $this->hasMany(tenagateknis::class);
    }
}
