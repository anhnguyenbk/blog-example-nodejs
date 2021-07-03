<?php

namespace App\Http\Resources;

use App\Utils\DateUtils;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'content' => $this->content,
            'view' => $this->view,
            'createdAt' => DateUtils::formatDateTime($this->created_at),
            'updatedAt' => DateUtils::formatDateTime($this->updated_at),
        ];
    }
}
