<?php

namespace Vanguard\Http\Requests\Api\REST;

use Vanguard\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'education_qualification_id'    => 'required',
            'education_country_id'          => 'required',
            'education_name'                => 'required',
            'applicant_name'                => 'required',
            'experience'                    => 'required',
            'last_position'                 => 'required',
            'applied_position'              => 'required',
            // 'resume'                        => 'required'
        ];
    }

    public function messages()
    {
        return [
            'education_qualification_id.required'   => 'Qualification is required',
            'education_country_id.required'         => 'Country is required',
            'education_name.required'               => 'Name Institute/University is required',
            'applicant_name.required'               => 'Applicant name is required',
            // 'resume.required'                       => 'Resume is required',
            'experience.required'                   => 'Experience is required',
            'last_position.required'                => 'Last position is required',
            'applied_position.required'             => 'Applied position is required'
        ];
    }
}
