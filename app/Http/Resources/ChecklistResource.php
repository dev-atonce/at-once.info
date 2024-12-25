<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ChecklistItemResource;

class ChecklistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    // public $collects = '\App\Models\ChecklistItemMd';
    public $preserveKeys = true;
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'todoId' => $this->todoId,
            'title' => $this->title,
            'items' => ChecklistItemResource::collection(\App\Models\ChecklistItemMd::where('checklist',$this->id)->orderBy('created_at','desc')->get()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
