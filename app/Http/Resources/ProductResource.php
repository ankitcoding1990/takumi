<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    // public static $wrap = 'products';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'    =>  $this->id,
            'sku'   =>  $this->sku,
            'name'  =>  $this->name,
            'category_id'   =>  $this->category_id,
            'category'  => ($this->category ? $this->category->name : ''),
            'category_slug'  => ($this->category ? $this->category->slug : ''),
            'price' =>  [
                'original'  =>  $this->price,
                'final' =>  $this->final,
                'discount_percentage'   =>  $this->discount_percentage,
                'currency'  => 'EUR'
            ],
            'status'    =>  $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
