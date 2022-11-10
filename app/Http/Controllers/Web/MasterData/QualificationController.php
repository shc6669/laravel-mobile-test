<?php

namespace Vanguard\Http\Controllers\Web\MasterData;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\MasterData\QualificationCreatedUpdatedRequest;
use Vanguard\MQualification;
use DataTables;

class QualificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:master-data.manage');
    }

    public function getQualification()
    {
        $queries = MQualification::get();

        $qualification = [];
        foreach($queries as $query)
        {
            $qualification[] = [
                'id'    => $query->id,
                'name'  => $query->name
            ];
        }

        return DataTables::of($qualification)
        ->addIndexColumn()
        ->addColumn('action', function($qualification) {
            $edit = '
                <a data-toggle="tooltip" title="Edit Data" href="'.route('qualifications.edit',['qualification' => $qualification['id']]).'" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>
                <a data-toggle="tooltip" data-placement="top" data-method="DELETE" data-confirm-title="Confirm" data-confirm-text="Are you sure to delete this data?" data-confirm-delete="Delete" title="Delete" href="'.route('qualifications.destroy',['qualification' => $qualification['id']]).'" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
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
        return view('master-data.qualifications.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;

        return view('master-data.qualifications.add-edit', compact('edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QualificationCreatedUpdatedRequest $request)
    {
        $inputs = $request->all();
        MQualification::create($inputs);

        return redirect()->route('qualifications.index')
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
        $qualification = MQualification::findOrFail($id);

        return view('master-data.qualifications.add-edit', compact('edit', 'qualification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QualificationCreatedUpdatedRequest $request, $id)
    {
        $inputs = $request->all();
        $qualification = MQualification::find($id);
        $qualification->update($inputs);

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
        $qualification = MQualification::findOrFail($id);
        $qualification->delete();

        return redirect()->route('qualifications.index')
            ->withSuccess('Data deleted!');
    }
}
