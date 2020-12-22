<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ActivitiesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'status'     => true,
            'message'    => "Success",
            'request'    => $request->all(),
            'activities' => $this->collection,
            'pagination' => [
                'total'        => $this->total(),
                'per_page'     => $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page'    => $this->lastPage(),
                'from'         => $this->firstItem(),
                'to'           => $this->lastItem(),
            ],
        ];
    }
}
