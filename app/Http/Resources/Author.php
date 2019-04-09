<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Author extends JsonResource
{
    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public $preserveKeys = true;

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
            'type'          => 'author',
            'id'            => (string)$this->id,
            'attributes'    => $resource,
            'relationships' => [
                'quotes'    => $this->quotes()->get(),
                'books'     => $this->books()->get(),
                'ideas'     => $this->ideas()->get(),
                'currents'  => $this->currents()->get()
            ],
            'links'         => [
                'self' => route('author.show', ['author' => $this->id]),
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
                'self' => route('author.index'),
            ],
        ];
    }
}
