<?php

namespace App\Collections;

use DatePeriod;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Database\Eloquent\Collection;

class OnlineCollection extends Collection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    // public function toArray($request)
    // {
    //     return parent::toArray($request);
    // }

    public function withDefaults()
    {
        $date = $this->sortBy('day')[0]->day->StartOfYear();
        $days = array_map(function($day) {
            return $day->format('Y-m-d');
        }, [...new DatePeriod("R11/{$date->toIso8601ZuluString()}/P1D")]); // e.g. 2021-01-01T00:00:00Z
        $collection = array_fill_keys(array_fill_keys($days, []));
        foreach($this as $item) {
            $collection[$item->day->format('Y-m-d')] = $item;
        }
        return collect($collection);
    }
}
