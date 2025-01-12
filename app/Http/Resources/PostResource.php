<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'content' => $this->content,
            'thumbnail' => asset('storage/posts/'.$this->thumbnail),
            'youtube' => $this->youtube,
            'rutube' => $this->rutube,
            'dzen' => $this->dzen,
            'category_id' => $this->category_id,
            'group_id' => $this->group_id,
            'conference_id' => $this->conference_id,
            'postDate' => $this->postDate,
        ];
    }
}
