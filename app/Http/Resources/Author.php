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
                'quotes'    => $this->quotes()->get()->map(
                    function ($quote) {
                        return $quote->quote;
                    }
                ),
                'books'     => $this->books()->get()->map(
                    function ($book) {
                        return $book->book;
                    }
                ),
                'ideas'     => $this->ideas()->get()->map(
                    function ($idea) {
                        return $idea->idea;
                    }
                ),
                'currents'  => $this->currents()->get()->map(
                    function ($current) {
                        return $current->current;
                    }
                )
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
