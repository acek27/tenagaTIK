<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jeniskelamin extends Model
{
    protected $table = 'tb_jk';
    protected $primaryKey = 'id_jk';
    public $timestamps = false;
    protected $fillable = [];

    public function tenagateknis()
    {
        return $this->hasMany(tenagateknis::class);
    }
}
