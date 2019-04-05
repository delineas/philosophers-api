<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends BaseModel
{
    protected $guarded = [];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
    public function currents()
    {
        return $this->hasMany(Current::class);
    }
    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
