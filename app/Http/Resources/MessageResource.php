<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'message'=>$this->message,
            'doctor_id'=>$this->doctor_id,
            'patient_id'=>$this->patient_id,
            'message_type'=>$this->message_type,
        ];
    }
}
