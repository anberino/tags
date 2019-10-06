<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $table = 'tags';
    public $primaryKey = 'id';

    public function tag()
    {
        return $this->belongsTo('App/Tag');
    }

    public function tags()
    {
        return $this->hasMany('App/Tag');
    }
}
