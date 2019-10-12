<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'name',
        'iconFontAw',
        'iconURL',
        'category'
    ];

    public function getCategory()
    {
        return $this->hasOne('App\Category', 'id', 'category');
    }
}
