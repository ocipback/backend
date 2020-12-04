<?php

namespace App\Http\Resources;


use App\Http\Resources\Lookup\Category;
use App\Http\Resources\Lookup\Country;
use Illuminate\Http\Resources\Json\JsonResource;

class Oppotunity extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
            'judul' => $this->title,
            'deskripsi' => $this->description,
            'categoryId' => new Category($this->category),
            'negara' => new Country($this->country),
            'deadline' => $this->deadline->toDayDateTimeString(),
            'createdBy' => new User($this->user),
            'organizer'=> $this->organizer,
            'createAt' => $this->created_at->toDateTimeString(),
            'updateAt' => $this->updated_at->toDateTimeString(),
        ];
    }
}
