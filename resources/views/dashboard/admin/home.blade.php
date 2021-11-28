@extends('dashboard.admin.include.master')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <hr>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Total Jobs  <span class="float-end">{{$totalJobs->count()}}</span></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{route('admin.job-list')}}">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body">Total Job Type <span class="float-end">{{$totalJobType}}</span></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{route('admin.job-type-list')}}">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Total User <span class="float-end">{{$totalUser}}</span></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            New Job Post
                        </div>
                        <div class="card-body">
                            <style>
                                table thead tr th {
                                    text-align: center !important;
                                }
                            </style>
                            <table id="datatablesSimple" style="text-align: center">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Create</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Create</th>
                                </tr>
                                </tfoot>
                               <tbody>
                               @foreach($totalJobs as $key => $job)
                                   <tr>
                                       <td>{{$key+1}}</td>
                                       <td>{{$job->title}}</td>
                                       <td>{{optional($job->type)->title}}</td>
                                       <td>{{$job -> created_at -> format('d-m-y, g:i~A')}}</td>
                                   </tr>
                               @endforeach

                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>
@endsection
