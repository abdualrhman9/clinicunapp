<?php

namespace App\Http\Resources;

use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
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
            'answer'=>$this->answer,
            'question'=>$this->answer->question,
        ];
    }
}
