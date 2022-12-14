<?php

namespace Vanguard\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListAllResource extends JsonResource
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
            'post_id'               => $this['id'],
            'user_id'               => $this['user_id'],
            'candidateName'         => $this['applicant_name'],
            'candidateBirthday'     => $this['birthday'],
            'candidateEmail'        => $this['email'],
            'candidatePhone'        => $this['phone'],
            'candidateExperience'   => $this['experience'].' years',
            'candidateLastPosition' => $this['last_position'],
            'candidateApply'        => $this['applied_position'],
            'education'             => [
                'qualificationId'   => $this['education_qualification_id'],
                'qualificationName' => $this['education_qualification_name'],
                'countryId'         => $this['education_country_id'],
                'countryName'       => $this['education_country_name'],
                'instituteName'     => $this['education_name']
            ],
            'skills'                => [
                'skillName'         => $this['skills']
            ]
        ];
    }
}
