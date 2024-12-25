<?php

namespace App\Http\Resources\JobProgress;

use Illuminate\Http\Resources\Json\JsonResource;

class Presentation extends JsonResource
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
            'assignId' => $this->assignId,
            'assignName' => $this->assignName,
            'assignDisplay' => $this->assignDisplay,
            'profile_url' => $this->profile_url,
            'jobId' => $this->jobId,
            'present_send_email' => $this->present_send_email,
            'present_send_email_by' => $this->present_send_email_by,
            'present_follow' => $this->present_follow,
            'present_follow_by' => $this->present_follow_by,
            'cannot_contact' => $this->cannot_contact,
            'cannot_contact_by' => $this->cannot_contact_by,
            'present_done' => $this->present_done,
            'present_done_by' => $this->present_done_by,
            'present_not_interest' => $this->present_not_interest,
            'present_not_interest_by' => $this->present_not_interest_by,
            'quotation' => $this->quotation,
            'quotation_by' => $this->quotation_by,
            'quotation_file' => $this->quotation_file,
            'countersign' => $this->countersign,
            'countersign_by' => $this->countersign_by,
            'countersign_file' => $this->countersign_file,
            'rowCreated' => $this->rowCreated,
            'package' => $this->package,
            'package_at' => $this->package_at,
            'created' => $this->created,
            'appointment'=> \App\Models\JobAppointmentMd::where('company',$this->cid)->get()
        ];
    }
}
