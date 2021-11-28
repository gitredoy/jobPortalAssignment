<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobApplyRequest;
use App\Models\Job;
use App\Models\JobApply;
use App\Models\JobType;
use App\Services\DocumentStoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    public function list(){
        $this->data['jobs'] = Job::orderBy('id','DESC')->get();
        return view('dashboard.admin.job.list',$this->data);
    }
    public function create(){
        $this->data['types'] = JobType::where('status',0)->get();
        return view('dashboard.admin.job.create',$this->data);
    }
    public function store(Request $request){
        //Validate Inputs
        if ($request->id){
            $validatedData = $request->validate([
                'title' => ['required', Rule::unique('jobs')->ignore($request->id)],
                'job_types_id' => 'required',
                'description' => 'required',
            ],[
                'job_types_id.required' => 'The job types field  is required.',
            ]);
        }else{
            $validatedData = $request->validate([
                'title' => ['required', Rule::unique('jobs')],
                'job_types_id' => 'required',
                'description' => 'required',
                'thumbnail' =>  'required|mimes:jpeg,png,jpg,gif|max:1024',
            ],[
                'job_types_id.required' => 'The job types field  is required.',
                'thumbnail.required' => 'The image field  is required.',
                'thumbnail.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
                'thumbnail.max' => 'The image must not be greater than 1MB.',
            ]);
        }
        if ($validatedData) {
            if (!empty($request->id)) {
                $job = Job::find($request->id);
            } else {
                $job = new Job();
            }
            $job->title = $request->title;
            $job->job_types_id = $request->job_types_id;
            $job->description = $request->description;
            if ($request->file('thumbnail')) {
                @unlink(public_path('jobimage/'.$job -> thumbnail));
                $job -> thumbnail = DocumentStoreService::docStore($request->file('thumbnail'));
            }
            $job->status = $request->status;
            $job->save();

            if ($request->id) {
                Session::flash('success','Job Updated successfully');
            }else{
                Session::flash('success','Job Added successfully');
            }
            return redirect()->route('admin.job-list');
        }

    }

    public function edit($id){
        $this->data['edit'] = 'edit';
        $this->data['types'] = JobType::where('status',0)->get();
        $this->data['singleType'] =  Job::find($id);
        return view('dashboard.admin.job.create',$this->data);
    }

    public function status($id){
        $data = Job::find($id);
        $data->status = $data->status ? 0 : 1;
        $data->save();
        if ($data) {
            Session::flash('success', 'Status Changed Successfully');
        }
        return redirect()->back();
    }

    public function delete($id){
        $data = Job::find($id);
        @unlink(public_path('jobimage/'.$data -> thumbnail));
        $data ->delete();
        return redirect()->back();
    }

    public function activeJob(){
        try {
            $jobs = Job::where('status',0)->get();
            foreach ($jobs as $key => $job){
                $data1 = [
                    'id'         => $job->id,
                     'job_title' => $job -> title,
                     'job_type'  => optional($job->type)->title,
                     'thumbnail' => asset('jobimage/'.$job->thumbnail),
                ];
                $data[] = $data1;
            }

            return response()->json([
                'success' => true,
                'message' => 'Active Jobs List',
                'jobs' => !empty($data)?$data:[]
            ], 200);
        }catch (\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 404);
        }
    }

    public function singleJob($id){
        try {
            $job = Job::find($id);
            $data = [
                'id'          => $job->id,
                'job_title'   => $job -> title,
                'job_type'    => optional($job->type)->title,
                'thumbnail'   => asset('jobimage/'.$job->thumbnail),
                'description' => $job -> description
            ];

            return response()->json([
                'success' => true,
                'message' => 'Single Job Details',
                'job' => $data
            ], 200);
        }catch (\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 404);
        }
    }

    public function jobApply(JobApplyRequest $request,$id){
        try {
            $apply = new JobApply();
            $apply -> job_id = $id;
            $apply -> user_id =  Auth::guard('general-api')->user()->id;
            $apply -> message =  $request->message;
            $apply -> save();
            return response()->json([
                'success' => true,
                'message' => 'Job Apply Successfully Done',
                'job' => $apply
            ], 200);
        }catch (\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 404);
        }
    }



}
