<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Support\Str;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Candidate\CreateRequest;
use Vanguard\Http\Requests\Candidate\UpdateRequest;
use Vanguard\Country;
use Vanguard\CandidateSkills;
use Vanguard\MSkills;
use Vanguard\MQualification;
use Vanguard\TCandidate;
use DataTables;
use Storage;

class CandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:candidate.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:candidate.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:candidate.list.show', ['only' => ['index', 'show']]);
        $this->middleware('permission:candidate.destroy', ['only' => 'destroy']);
    }

    public function getData()
    {
        $queries = TCandidate::latest()->get();

        $datas = [];
        foreach($queries as $query)
        {
            $datas[] = [
                'id'            => $query->id,
                'name'          => $query->applicant_name,
                'email'         => $query->email
            ];
        }

        if(auth()->user()->hasRole('Admin_HRD'))
        {
            return DataTables::of($datas)
            ->addIndexColumn()
            ->addColumn('action', function($datas) {
                $edit = '
                    <a data-toggle="tooltip" title="Edit Data" href="'.route('candidate-management.edit',['candidate_management' => $datas['id']]).'" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>
                    <a data-toggle="tooltip" data-placement="top" data-method="DELETE" data-confirm-title="Confirm" data-confirm-text="Are you sure to delete this data?" data-confirm-delete="Delete" title="Delete" href="'.route('candidate-management.destroy',['candidate_management' => $datas['id']]).'" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
                ';
                return $edit;
            })
            ->rawColumns(['action'])
            ->toJson();
        }
        else if(auth()->user()->hasRole('HRD'))
        {
            return DataTables::of($datas)
            ->addIndexColumn()
            ->addColumn('name', function($datas) {
                $edit = '
                    <a data-toggle="tooltip" title="Show Data" href="'.route('candidate-management.show',['candidate_management' => $datas['id']]).'">'.$datas['name'].'</a>
                ';
                return $edit;
            })
            ->rawColumns(['name'])
            ->toJson();
        }
        else
        {
            return abort(403);
        }
    }

    public function getTagSkills($id)
    {
        $queries = TCandidate::join('candidate_skills as cs', 'cs.candidate_id', '=', 't_candidate.id')
                    ->join('m_skills as ms', 'cs.skill_id', '=', 'ms.id')
                    ->where('cs.candidate_id', $id)
                    ->get();

        $tag_skills = [];
        foreach ($queries as $query)
        {
            $tag_skills[] = $query->id;
            $tag_skills[] = $query->name;
        }

        return response()->json($tag_skills);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('candidate.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::select('id', 'name')->get();
        $skills = MSkills::select('id', 'name')->get();
        $qualifications = MQualification::select('id', 'name')->get();

        return view('candidate.add', compact('countries', 'skills', 'qualifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $inputs = $request->all();
        $candidate = new TCandidate;

        $candidate->education_qualification_id      = $inputs['education_qualification_id'];
        $candidate->education_country_id            = $inputs['education_country_id'];
        $candidate->education_name                  = $inputs['education_name'];
        $candidate->applicant_name                  = $inputs['applicant_name'];
        $candidate->birthday                        = $inputs['birthday'];
        $candidate->experience                      = $inputs['experience'];
        $candidate->last_position                   = $inputs['last_position'];
        $candidate->applied_position                = $inputs['applied_position'];
        $candidate->email                           = $inputs['email'];
        $candidate->phone                           = $inputs['phone'];
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

        return redirect()->route('candidate-management.index')
            ->withSuccess('Success submited data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = TCandidate::find($id);
        $skills = CandidateSkills::where('candidate_id', $id)
                    ->join('m_skills as ms', 'ms.id', '=', 'skill_id')
                    ->pluck('name');

        return view('candidate.show', compact('data', 'skills'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = TCandidate::findOrFail($id);
        $countries = Country::select('id', 'name')->get();
        $skills = MSkills::select('id', 'name')->get();
        $qualifications = MQualification::select('id', 'name')->get();

        return view('candidate.edit', compact('countries', 'data', 'skills', 'qualifications'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $inputs = $request->all();
        $candidate = TCandidate::find($id);

        $candidate->education_qualification_id      = $inputs['education_qualification_id'];
        $candidate->education_country_id            = $inputs['education_country_id'];
        $candidate->education_name                  = $inputs['education_name'];
        $candidate->applicant_name                  = $inputs['applicant_name'];
        $candidate->birthday                        = $inputs['birthday'];
        $candidate->experience                      = $inputs['experience'];
        $candidate->last_position                   = $inputs['last_position'];
        $candidate->applied_position                = $inputs['applied_position'];
        $candidate->email                           = $inputs['email'];
        $candidate->phone                           = $inputs['phone'];
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

        return redirect()->back()
            ->withSuccess('Success updated data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidate = TCandidate::findOrFail($id);
        $candidate->delete();
        
        // Delete Files
        Storage::delete('public/upload/files/'.$candidate->resume);

        // Delete relantionship
        $candidate->skills()->detach();

        return redirect()->route('candidate-management.index')
            ->withSuccess('Data deleted!');
    }

    /**
     * Delete File Resume.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroyFileResume($id)
    {
        $file = TCandidate::findOrFail($id);
        Storage::delete('public/upload/files/'.$file->resume);
        $file->resume = null;
        $file->save();

        return response()->json([
            'success' => true,
            'message' => 'Success delete file!'
        ]);
    }
}
