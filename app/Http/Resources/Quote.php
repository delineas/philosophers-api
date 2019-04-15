<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Author as AuthorResource;

class Quote extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $resource = parent::toArray($request);

        return [
            'type'          => 'quote',
            'id'            => (string)$this->id,
            'attributes'    => $resource,
            'relationships' => [
                'vote'     => [
                    'type' => 'vote',
                    'meta' => [
                        'up'    => $this->votesSumByType('up'),
                        'down'  => $this->votesSumByType('down'),
                    ]
                ],
                'author'    => new AuthorResource($this->author()->first()),
            ],
            'links'         => [
                'self' => route('quote.show', ['quote' => $this->id]),
            ],
        ];
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
        return [
            'links' => [
                'self' => route('quote.index'),
            ],
        ];
    }
}
