<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'invoice_no'=>$this->bill_no,
            'sub_total'=>$this->sub_total,
            'is_discount'=>$this->discount_percent>0?1:0,
            'discount_percent'=>$this->discount_percent,
            'discount'=>$this->discount_amount,

            'is_service_charge'=>$this->service_charge_percent>0?1:0,
            'service_charge_percent'=>$this->service_charge_percent,
            'service_charge_amount'=>$this->service_charge_amount,

            'total'=>$this->total,
            'round'=>$this->round,
            'cash'=>$this->payment_type==1?$this->total:'',
            'bank'=>$this->payment_type==2?$this->total:'',
            'credit'=>$this->payment_type==3?$this->total:'',

            'date'=>$this->created_at->format('Y/m/d g:i A'),
            'user'=>$this->user->name      
        ];
    }
}
