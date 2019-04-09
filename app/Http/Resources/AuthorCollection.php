<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AuthorCollection extends ResourceCollection
{

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array|AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return Author::collection($this->collection);
    }
}
