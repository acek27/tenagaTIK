<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class divisi extends Model
{
    protected $table = 'tb_divisi';
    protected $primaryKey = 'id_divisi';
    public $timestamps = false;
    protected $fillable = [];

    public function tenagateknis()
    {
        return $this->hasMany(tenagateknis::class);
    }
}
