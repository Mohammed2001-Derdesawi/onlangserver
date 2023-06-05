<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserResource extends ResourceCollection
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
            'users'=>$this->collection,
            'next_page'=>$this->hasmorePages()?$this->currentPage()+1:1,
            'countall'=>$this->total(),
            'has_more'=>$this->hasmorePages(),
        ];
    }
}
