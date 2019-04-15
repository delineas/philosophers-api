<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;
use App\User;
use App\Quote;

class VoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = Quote::findOrFail($request->voteable_id);
        $vote = new Vote;
        $vote->user()->associate(User::first());
        $vote->voteable()->associate($model);
        $vote->type = $request->get('type');
        $vote->status = 1;
        $vote->save();
        return $vote;
    }
}
