<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            'name' => $this->name,
            'photo' => $this->photo,
            'likes' => $this->likes,
            'phonenumber' => $this->phonenumber,
            'description' => $this->description,
            'city' =>  $this->ciudadObject,// relación con ciudades
            'category' =>  $this->categoriaObject, // relación con categorias
        ];
    }
}
