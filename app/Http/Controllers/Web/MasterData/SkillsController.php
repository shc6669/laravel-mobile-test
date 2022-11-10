<?php

namespace Vanguard\Http\Controllers\Web\MasterData;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\MasterData\SkillsCreatedUpdatedRequest;
use Vanguard\MSkills;
use DataTables;

class SkillsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:master-data.manage');
    }

    public function getSkills()
    {
        $queries = MSkills::get();

        $skills = [];
        foreach($queries as $query)
        {
            $skills[] = [
                'id'    => $query->id,
                'name'  => $query->name
            ];
        }

        return DataTables::of($skills)
        ->addIndexColumn()
        ->addColumn('action', function($skills) {
            $edit = '
                <a data-toggle="tooltip" title="Edit Data" href="'.route('skills.edit',['skill' => $skills['id']]).'" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>
                <a data-toggle="tooltip" data-placement="top" data-method="DELETE" data-confirm-title="Confirm" data-confirm-text="Are you sure to delete this data?" data-confirm-delete="Delete" title="Delete" href="'.route('skills.destroy',['skill' => $skills['id']]).'" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
            ';
            return $edit;
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master-data.skills.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;

        return view('master-data.skills.add-edit', compact('edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillsCreatedUpdatedRequest $request)
    {
        $inputs = $request->all();
        MSkills::create($inputs);

        return redirect()->route('skills.index')
            ->withSuccess('Success submited data');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = true;
        $skills = MSkills::findOrFail($id);

        return view('master-data.skills.add-edit', compact('edit', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SkillsCreatedUpdatedRequest $request, $id)
    {
        $inputs = $request->all();
        $service = MSkills::find($id);
        $service->update($inputs);

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
        $service = MSkills::findOrFail($id);
        $service->delete();

        return redirect()->route('skills.index')
            ->withSuccess('Data deleted!');
    }
}
