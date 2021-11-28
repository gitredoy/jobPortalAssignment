@extends('dashboard.admin.include.master')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4">Job Type</h2>
            <hr>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Job  List</li>
            </ol>
            <div class="card mb-4">
                <div class="card">
                    <div class="card-header">
                      <h5 style="float: left">Job List</h5>
                        <button onclick="document.location='{{route('admin.job-create')}}'" style="float: right" type="button" class="btn btn-lg btn-outline-primary">Add Job</button>
                    </div>
                    <div class="card-body">
                        <style>
                            .dataTable-sorter{
                                text-align: center;
                            }
                            .dataTable-table > tbody > tr > #des {
                                width: 200px !important;
                                text-align: justify;
                            }
                        </style>
                        <table id="datatablesSimple" style="text-align: center">
                            <thead style="text-align: center">
                            <tr>
                                <th>Sl</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Thumbnail</th>
                                <th>Total Application</th>
                                <th>Create Date</th>
                                <th>Update Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Thumbnail
                                <th>Total Application</th>
                                <th>Create Date</th>
                                <th>Update Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($jobs as $key =>$job)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$job->title}}</td>
                                <td>{{optional($job->type)->title}}</td>
                                <td id="des">
                                    {!! Str::limit($job->description, 90) !!}
                                    <a style="padding-left: 3px" data-bs-toggle="modal" href="#job{{$job->id}}">See More</a>
                                </td>
                                <td>
                                    <img src="{{asset('jobimage/'.$job->thumbnail)}}" alt="Job Image" height="70px" width="90px">
                                </td>
                                <td>
                                    <a href="{{route('admin.applicant-list',['id'=>$job->id])}}">{{$job->apply->count()}}</a>
                                </td>
                                <td> {{$job -> created_at -> format('d-m-y, g:i~A')}}</td>
                                <td> {{$job -> updated_at -> format('d-m-y, g:i~A')}}</td>
                                <td>
                                    <a style="color: {{$job->status == 0 ?'blue':'red'}}; text-decoration: none" href="{{route('admin.job-status',['id' => $job->id])}}">
                                        {{$job->status == 0 ?'Active':'Inactive'}}
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-sm" href="{{route('admin.job-edit',['id' => $job->id])}}"><i class="far fa-edit"></i></a>
                                    <a class="btn btn-sm text-danger" onclick="deleteAlert({{$job->id}},this)" ><i class="fas fa-window-close"></i></a>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade " id="job{{$job->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                   <span class="text-secondary" style="font-weight: bold">Job Title:</span> {{$job->title}}
                                                </div>
                                                <div class="col-md-4">
                                                  <span class="text-secondary" style="font-weight: bold">Job Type:</span> {{optional($job->type)->title}}
                                                </div>
                                                <hr style="margin-top: 13px !important;">
                                                <div class="col-md-8" >
                                                    <span class="text-primary" style="font-weight: bold;">Job Description:</span>
                                                    <br>
                                                     <p style="text-align: justify">  {!! $job->description !!}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="text-primary" style="font-weight: bold; text-align: center">Job Image:</p>
                                                    <img class="card-img"  src="{{asset('jobimage/'.$job->thumbnail)}}" alt="Job Image">
                                                    <p style="text-align: center">
                                                        <span class="text-primary" style="font-weight: bold;">Job Status:</span>
                                                        <span style="color: {{$job->status == 0 ?'green':'red'}};">
                                                        {{$job->status == 0 ?'Active':'Inactive'}}
                                                    </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </main>
    <script>
        function deleteAlert($id){

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location='job-delete/' + $id;
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })

        }
    </script>
@endsection
