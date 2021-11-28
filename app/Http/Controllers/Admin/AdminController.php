<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApply;
use App\Models\JobType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home(){
        $this->data['totalJobs'] = Job::orderBy('id','DESC')->get();
        $this->data['totalJobType'] = JobType::count();
        $this->data['totalUser'] = User::count();
        return view('dashboard.admin.home',$this->data);
    }
    public function check(Request $request){
        //Validate Inputs
        $request->validate([
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:5|max:30'
        ],[
            'email.exists'=>'This email is not exists in admins table'
        ]);

        $creds = $request->only('email','password');

        if( Auth::guard('admin')->attempt($creds) ){
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('admin.login')->with('fail','Incorrect credentials');
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }

    public function applicantList($id){
        $this->data['JobApply'] = JobApply::where('job_id',$id)->get();
        $this->data['jobTitle'] = Job::find($id);
        return view('dashboard.admin.job.applicant',$this->data);
    }
    public function user(){
        $this->data['users'] = User::all();
        return view('dashboard.user.list',$this->data);
    }
}
