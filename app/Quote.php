<?php

namespace App;

class Quote extends BaseModel
{
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo('App\Author')->withDefault(); 
    }
}
