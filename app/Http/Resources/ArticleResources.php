<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'publihsed' => $this->created_at->diffForHumans(),
            'body' => $this->body,
            'subject' => $this->subject->name,
            'author' => $this->user->name,
        ];
    }

    public function with($request)
    {
        return ['status' => 'success'];
    }
}
