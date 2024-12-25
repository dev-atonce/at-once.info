<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ChecklistResource;
use App\Http\Resources\MemberTodolistResource;

class TodolistCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $arr = json_decode($this->user);
        $data = [
            'id' => $this->id,
            'type' => $this->type,
            'list' => $this->list,
            'description' => $this->description,
            'do' => $this->do,
            'test' => $this->test,
            'done' => $this->done,
            'checklist'=> ChecklistResource::collection(\App\Models\ChecklistMd::where('todoId',$this->id)->orderBy('created_at','desc')->get()),
            'created' => $this->created,
            'updated' => $this->updated
        ];

        $arr = json_decode($this->user);
        if($arr){
            $data['members'] = MemberTodolistResource::collection(\App\Models\UsersMd::whereIn('id',$arr)->get());
        }

        return $data;
        
    }


}
