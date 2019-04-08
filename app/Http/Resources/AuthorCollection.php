<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AuthorCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // public function toArray($request)
    // {
    //     return [
    //         'data' => $this->collection,
    //         'links' => [
    //             'self' => route('author.index'),
    //         ],
    //     ];
    // }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array|AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return Author::collection($this->collection);
    }
    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function with($request): array
    {
        $quotes = $this->collection->flatMap(
            function ($author) {
                return $author->quotes;
            }
        );
        //$included = $authors->merge($comments)->unique();
        return [
            'links'    => [
                'self' => route('author.index'),
            ],
            //'included' => $this->withIncluded($quotes),
        ];
    }

    /**
     * @param Collection $included
     *
     * @return Collection
     */
    private function withIncluded(Collection $included)
    {
        return $included->map(function ($include) {
            // if ($include instanceof Quote) {
            //     return new PeopleResource($include);
            // }
            // if ($include instanceof Comment) {
            //     return new CommentResource($include);
            // }
        });
    }
}
