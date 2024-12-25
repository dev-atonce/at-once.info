<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrowserCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'company' => $this->company,
            'accuracy' => $this->accuracy,
            'area_code' => $this->area_code,
            'ans' => $this->ans,
            'city' => $this->city,
            'continent_code' => $this->continent_code,
            'country' => $this->country,
            'country_code' => $this->country_code,
            'country_code3' => $this->country_code3,
            'ip' => $this->ip,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'organization' => $this->organization,
            'organization_name' => $this->organization_name,
            'clicks' => $this->clicks,
            'timezone' => $this->timezone,
        ];
    }
}
