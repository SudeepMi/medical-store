<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OccupiedTableResource extends JsonResource
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
            'name'=>$this->name,
            'uuid'=>$this->uuid,
            'pax'=>$this->order->pax,
            'occupied_time'=>$this->start_time->format('g:i a'),
            'occupy_url'=>route('order.index',[$this->uuid])       
        ];
    }
}
