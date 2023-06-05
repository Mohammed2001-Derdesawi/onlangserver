<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RecievedMessagesResourceToAdmin extends ResourceCollection
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
            'users'=>$this->collection->pluck('sender'),
            'next_page'=>$this->currentPage()+1,
            'has_more'=>$this->hasmorePages()
        ];
    }
}
