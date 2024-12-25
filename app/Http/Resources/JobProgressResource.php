<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobProgressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'rowId' => $this->rowId,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'telephone' => $this->telephone,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'assignment' => $this->assignment,
            'remark_color' => $this->remark_color,
            'display' => $this->display,
            'displayName' => $this->displayName,
            'cid' => $this->cid,
            'name_th' => $this->name_th,
            'name_en' => $this->name_en,
            'copyright' => $this->copyright,
            'categoryNo' => $this->categoryNo,
            'categoryKey' => $this->categoryKey,
            'categoryNameTH' => $this->categoryNameTH,
            'categoryNameEN' => $this->categoryNameEN,
            'profile_url' => $this->profile_url,
            'jobId' => $this->jobId,
            'license' => $this->license,
            'attachfile' => $this->attachfile,
            'send_email' => $this->send_email,
            'send_email_by' => $this->send_email_by,
            'refuse' => $this->refuse,
            'refuse_by' => $this->refuse_by,
            'cannot_contact' => $this->cannot_contact,
            'cannot_contact_by' => $this->cannot_contact_by,
            'follow' => $this->follow,
            'follow_by' => $this->follow_by,
            'no_response' => $this->no_response,
            'no_response_by' => $this->no_response_by,
            'on_process' => $this->on_process,
            'on_process_by' => $this->on_process_by,
            'call_again' => $this->call_again,
            'call_again_by' => $this->call_again_by,
            'check_filter' => $this->check_filter,
            'check_filter_by' => $this->check_filter_by,
            'rowCreated' => $this->rowCreated,
            'public' => $this->public,
            'created' => $this->created,
            'appointment'=> \App\Models\JobAppointmentMd::where('company',$this->cid)->get()
        ];
    }
}
