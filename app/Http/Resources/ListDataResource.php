<?php

namespace Vanguard\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'candidateId'           => $this->id,
            'candidateName'         => $this->applicant_name,
            'candidateBirthday'     => $this->birthday,
            'candidateEmail'        => $this->email,
            'candidatePhone'        => $this->phone,
            'candidateExperience'   => $this->experience.' years',
            'candidateLastPosition' => $this->last_position,
            'candidateApply'        => $this->applied_position,
            'education'             => [
                'qualificationId'   => $this->education_qualification_id,
                'qualificationName' => $this->qualification->name,
                'countryId'         => $this->education_country_id,
                'countryName'       => $this->country->name,
                'instituteName'     => $this->education_name
            ],
            'skills'                => $this->skills
        ];
    }
}
