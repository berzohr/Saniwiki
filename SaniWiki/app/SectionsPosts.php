<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionsPosts extends Model
{
    //use Searchable;

    protected $fillable = [
        'body',
        'section',
        'post'
    ];


    public function getPost()
    {
        return $this->hasOne('App\Post', 'id', 'post');
    }

    public function getSection()
    {
        return $this->hasOne('App\Section', 'id', 'section');
    }
}
