<?php

namespace Vanguard\Http\Controllers\Api;

use Illuminate\Support\Str;
use Vanguard\Http\Requests\Api\REST\CreateRequest;
use Vanguard\Http\Requests\Api\REST\UpdateRequest;
use Vanguard\Http\Resources\ListAllResource;
use Vanguard\Http\Resources\ListDataResource;
use Vanguard\Http\Resources\DestroyResource;
use Vanguard\Http\Resources\SkillsResource;
use Vanguard\Http\Resources\QualificationsResource;
use Vanguard\MSkills;
use Vanguard\MQualification;
use Vanguard\TCandidate;
use Storage;

class RESTController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:candidate.create', ['only' => ['storeData']]);
        $this->middleware('permission:candidate.edit', ['only' => ['updateData']]);
        $this->middleware('permission:candidate.list.show', ['only' => ['listData']]);
        $this->middleware('permission:candidate.destroy', ['only' => 'destroyData']);
    }

    /**
     * List All Skills
     */
    public function listSkill()
    {
        $queries = MSkills::get();

        return SkillsResource::collection($queries);
    }

    /**
     * List All Qualifications
     */
    public function listQualifications()
    {
        $queries = MQualification::get();

        return QualificationsResource::collection($queries);
    }

    /**
     * List Data
     */
    public function listData()
    {
        $queries = TCandidate::with(['country:id,name', 'qualification:id,name'])->get();

        $json = [];
        foreach($queries as $key => $query)
        {
            $json[] = [
                'id'                            => $query->id,
                'applicant_name'                => $query->applicant_name,
                'birthday'                      => $query->birthday,
                'email'                         => $query->email,
                'phone'                         => $query->phone,
                'experience'                    => $query->experience,
                'last_position'                 => $query->last_position,
                'applied_position'              => $query->applied_position,
                'education_qualification_id'    => $query->education_qualification_id,
                'education_country_id'          => $query->education_country_id,
                'education_name'                => $query->education_name,
                'education_qualification_name'  => $query->qualification->name,
                'education_country_name'        => $query->country->name,
                'skills'                        => []
            ];

            $skills = $query->skills()->where('candidate_id', $query->id)->get();
            foreach($skills as $skill)
            {
                $json[$key]['skills'][] = $skill['name'];
            }
        }

        return ListAllResource::collection($json);
    }
    

    /**
     * Store Data
     */
    public function storeData(CreateRequest $request)
    {
        $inputs = $request->all();
        $candidate = new TCandidate;

        // Required Input
        $candidate->education_qualification_id      = $inputs['education_qualification_id'];
        $candidate->education_country_id            = $inputs['education_country_id'];
        $candidate->education_name                  = $inputs['education_name'];
        $candidate->applicant_name                  = $inputs['applicant_name'];
        $candidate->experience                      = $inputs['experience'];
        $candidate->last_position                   = $inputs['last_position'];
        $candidate->applied_position                = $inputs['applied_position'];
        
        // Optional Input
        $candidate->birthday                        = $request->input('birthday', null);
        $candidate->email                           = $request->input('email', null);
        $candidate->phone                           = $request->input('phone', null);
        $candidate->save();

        // File Resume
        $resume = $request->file('resume');
        if($resume)
        {
            $upload_files       = $resume->getClientOriginalName();
            $filename           = pathinfo($upload_files, PATHINFO_FILENAME);
            $extension          = $resume->getClientOriginalExtension();
            $filetostore        = Str::slug($filename, "-").'_'.time().'.'.$extension;
            $path               = $resume->storeAs('public/upload/files', $filetostore);
            $candidate->resume  = str_replace('public/upload/files/', '',$path);
            $candidate->save();
        }

        // Many to many relantionship
        $candidate->skills()->attach($request->input('skills', null));

        return new ListDataResource($candidate);
    }

    /**
     * Update Data
     */
    public function updateData(UpdateRequest $request, $id)
    {
        $inputs = $request->all();
        $candidate = TCandidate::find($id);

        // Required Input
        $candidate->education_qualification_id      = $inputs['education_qualification_id'];
        $candidate->education_country_id            = $inputs['education_country_id'];
        $candidate->education_name                  = $inputs['education_name'];
        $candidate->applicant_name                  = $inputs['applicant_name'];
        $candidate->experience                      = $inputs['experience'];
        $candidate->last_position                   = $inputs['last_position'];
        $candidate->applied_position                = $inputs['applied_position'];

        // Optional Input
        $candidate->birthday                        = $request->input('birthday', null);
        $candidate->email                           = $request->input('email', null);
        $candidate->phone                           = $request->input('phone', null);
        $candidate->save();

        // File Resume
        $resume = $request->file('resume');
        if($resume)
        {
            $upload_files       = $resume->getClientOriginalName();
            $filename           = pathinfo($upload_files, PATHINFO_FILENAME);
            $extension          = $resume->getClientOriginalExtension();
            $filetostore        = Str::slug($filename, "-").'_'.time().'.'.$extension;
            $path               = $resume->storeAs('public/upload/files', $filetostore);
            $candidate->resume  = str_replace('public/upload/files/', '',$path);
            $candidate->save();
        }

        // Many to many relantionship
        $candidate->skills()->sync($request->input('skills', null));

        return new ListDataResource($candidate);
    }

    /**
     * Delete Data
     */
    public function destroyData($id)
    {
        $candidate = TCandidate::findOrFail($id);
        $candidate->delete();
        
        // Delete Files
        Storage::delete('public/upload/files/'.$candidate->resume);

        // Delete relantionship
        $candidate->skills()->detach();

        return new DestroyResource($candidate);
    }
}
