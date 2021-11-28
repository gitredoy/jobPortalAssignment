@extends('dashboard.admin.include.master')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4">General User</h2>
            <hr>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">General User List</li>
            </ol>
            <div class="card mb-4">
                <div class="card">
                    <div class="card-header">
                      <h5 style="float: left">General User List</h5>
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
                                <th>Phone</th>
                                <th>Join Date</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Join Date</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($users as $key =>$user)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user -> created_at -> format('d-m-y, g:i~A')}}</td>
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
