<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends BaseModel
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voteable()
    {
        return $this->morphTo();
    }

}
