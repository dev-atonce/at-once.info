<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'id' => $this->id,
            "name" => $this->name,
            'logo' => $this->logo,
            "description" => $this->description,
            'public' => $this->public,
            'profile_url' => $this->profile_url,
            'website' => $this->website,
            'facebook' => $this->facebook,
            'gallerys'=> \App\Models\GaaleryMd::where('company',$this->id)->get(),
            'line' => $this->line,
            'type' => $this->type,
            'email' => $this->email,
            'nationality' => $this->nationality,
            'alpha2' => $this->alpha2
        ];
    }
}
