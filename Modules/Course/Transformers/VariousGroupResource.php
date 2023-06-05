<?php

namespace Modules\Course\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VariousGroupResource extends ResourceCollection
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
            'data'=>$this->collection,
            "pagination"=> [
                "more"=>$this->hasMorePages()
            ]
        ];
    }
}
