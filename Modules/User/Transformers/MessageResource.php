<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'sender_type'=>$this->sender_type,
            'sender_id'=>$this->sender_id,
            'receiver_type'=>$this->receiver_type,
            'receiver_id'=>$this->receiver_id,
            'message'=>$this->message,
            'read'=>$this->read?true:false,
            'created_at'=>$this->created_at->format('y-m-d'),
        ];
    }
}
