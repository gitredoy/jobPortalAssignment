@extends('dashboard.admin.include.master')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4">Job Type</h2>
            <hr>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Job Type List</li>
            </ol>
            <div class="card mb-4">
                <div class="card">
                    <div class="card-header">
                      <h5 style="float: left">Job Type List</h5>
                        <button onclick="document.location='{{route('admin.job-type-create')}}'" style="float: right" type="button" class="btn btn-lg btn-outline-primary">Add Type</button>
                    </div>
                    <div class="card-body">
                        <style>
                            .dataTable-sorter{
                                text-align: center;
                            }
                        </style>
                        <table id="datatablesSimple" style="text-align: center">
                            <thead style="text-align: center">
                            <tr>
                                <th style="text-align: center">Sl</th>
                                <th>Title</th>
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
                                <th>Create Date</th>
                                <th>Update Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($jobType as $key =>$type)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$type->title}}</td>
                                <td> {{$type -> created_at -> format('d-m-y')}}</td>
                                <td> {{$type -> updated_at -> format('d-m-y')}}</td>
                                <td>
                                    <a style="color: {{$type->status == 0 ?'blue':'red'}}; text-decoration: none" href="{{route('admin.job-type-status',['id' => $type->id])}}">
                                        {{$type->status == 0 ?'Active':'Inactive'}}
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-sm" href="{{route('admin.job-type-edit',['id' => $type->id])}}"><i class="far fa-edit"></i></a>
                                    <a class="btn btn-sm text-danger" onclick="deleteAlert({{$type->id}},this)" ><i class="fas fa-window-close"></i></a>
                                </td>
                            </tr>
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
                    window.location='job-type-delete/' + $id;
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
