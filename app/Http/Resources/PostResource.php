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
            'name'=>$this->name,
            'slug'=>$this->slug,
            'extract'=>$this->extract,
            'body'=>$this->body,
            'status'=>$this->status=='1'?'BORRADOR':'PUBLICADO',
            'user'=>UserResource::make($this->whenLoaded('user')),
        ];
       // return parent::toArray($request);
    }
}
