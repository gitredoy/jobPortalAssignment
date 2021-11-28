<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class JobTypeController extends Controller
{
    public function list(){
        $this->data['jobType'] = JobType::all();
        return view('dashboard.admin.jobType.list',$this->data);
    }
    public function create(){
        return view('dashboard.admin.jobType.create');
    }
    public function store(Request $request){
        //Validate Inputs
        if ($request->id){
            $validatedData = $request->validate([
                'title' => ['required', Rule::unique('job_types')->ignore($request->id)],
            ]);
        }else{
            $validatedData = $request->validate([
                'title' => ['required', Rule::unique('job_types')],
            ]);
        }
        if ($validatedData) {
            if (!empty($request->id)) {
                $job_type = JobType::find($request->id);
            } else {
                $job_type = new JobType();
            }
            $job_type->title = $request->title;
            $job_type->status = $request->status;
            $job_type->save();

            if ($request->id) {
                Session::flash('success','Job Type Updated successfully');
            }else{
                Session::flash('success','Job Type Added successfully');
            }
            return redirect()->route('admin.job-type-list');
        }

    }
    public function edit($id){
        $this->data['edit'] = 'edit';
        $this->data['singleType'] =  JobType::find($id);
        return view('dashboard.admin.jobType.create',$this->data);
    }
    public function status($id){
        $data = JobType::find($id);
        $data->status = $data->status ? 0 : 1;
        $data->save();
        if ($data) {
            Session::flash('success', 'Status Changed Successfully');
        }
        return redirect()->back();
    }
    public function delete($id){
        JobType::find($id)->delete();
        return redirect()->back();
    }
}
