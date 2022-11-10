<?php

namespace Vanguard\Http\Requests\MasterData;

use Vanguard\Http\Requests\Request;

class QualificationCreatedUpdatedRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:m_education_qualification,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'Name is required',
            'name.unique'      => 'This name has already registered to system, please input others'
        ];
    }
}
