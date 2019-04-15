<?php

namespace App;

class Quote extends BaseModel
{
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo('App\Author')->withDefault(); 
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable')->where('status', 1);
    }

    public function votesSumByType($type) {
        $votes = $this->votes()->get()->mapToGroups(function ($item, $key) {
            return [$item['type'] => $item['id']];
        });
        return ($votes->get($type)) ? $votes->get( $type)->count() : 0;
    }
}
