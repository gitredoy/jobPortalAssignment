@extends('dashboard.admin.include.master')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4">Applicant List</h2>
            <hr>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Applicant  List</li>
            </ol>
            <div class="card mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 style="float: left">Applicant list for this "<span class="text-primary" >{{$jobTitle->title}}</span>" job </h5>
                        <button onclick="document.location='{{route('admin.job-list')}}'" style="float: right;font-size: 15px" type="button" class="btn  btn-outline-primary">Back</button>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Cover Letter</th>
                                <th>Phone</th>
                                <th>Application Time</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Cover Letter</th>
                                <th>Phone</th>
                                <th>Application Time</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($JobApply as $key =>$job)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{optional($job->user)->name}}</td>
                                    <td>{{optional($job->user)->email}}</td>
                                    <td id="des">
                                        {!! Str::limit($job->message, 90) !!}
                                        <a style="padding-left: 3px" data-bs-toggle="modal" href="#job{{$job->id}}">See More</a>
                                    </td>
                                    <td>{{optional($job->user)->phone}}</td>
                                    <td> {{$job -> created_at -> format('d-m-y, g:i~A')}}</td>

                                </tr>
                                <!-- Modal -->
                                <div class="modal fade " id="job{{$job->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <span class="text-secondary" style="font-weight: bold">Job Title:</span>  {{$job->singlejob ->title}}
                                                    </div>
                                                    <hr style="margin-top: 13px !important;">
                                                    <div class="col-md-12" >
                                                        <span class="text-primary" style="font-weight: bold;">Cover Letter:</span>
                                                        <br>
                                                        <p style="text-align: justify">  {!! $job->message !!}</p>
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

