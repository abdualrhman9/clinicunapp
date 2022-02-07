<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'role'=>$this->getRole(),
        ];
        if($this->hasRole('patient'))  { 
            $data = array_merge($data,
                ['doctor'=>['id' => $this->doctors->first()->id ?? null,'name' =>    $this->doctors->first()->name ?? null,]]
            );

        }

        // if($this->hasRole('doctor'))  { 
        //     $data = array_merge($data,
        //         [
        //             'patients'=> $this->patients->map
        //         ]
        //     );

        // }

        return $data;
    }

    private function getRole(){
        return $this->roles->count() != 0 ? $this->roles->first()->role : 'patient';
    }

    
}
