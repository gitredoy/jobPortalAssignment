@extends('dashboard.admin.include.master')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4">Job</h2>
            <hr>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Job {{!empty($edit)?'Edit':'Create'}}</li>
            </ol>
            <div class="card mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 style="float: left">Job  {{!empty($edit)?'Edit':'Create'}}</h5>
                        <button onclick="document.location='{{route('admin.job-list')}}'" style="float: right"
                                type="button" class="btn btn-lg btn-outline-primary">Job List
                        </button>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.job-store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Title<span class="text-danger">*</span></label>
                                        <input value="{{!empty($edit)?$singleType->title:old('title')}}" type="text" class="form-control" name="title" placeholder="Title">
                                        <span class="text-danger p-2">@error('title'){{ $message }} @enderror</span>
                                        <input name="id" value="{{!empty($edit)?$singleType->id:''}}" type="hidden" class="form-control edit-field" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Job Type<span class="text-danger">*</span></label>
                                        <select name="job_types_id" class="form-select" aria-label="Default select example">
                                            <option selected disabled>select job type</option>
                                            @foreach($types as $type)
                                                <option @if(!empty($edit)) {{$type->id == $singleType -> job_types_id ? 'selected':''}} @endif  value="{{$type->id}}">{{$type->title}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger p-2">@error('job_types_id'){{ $message }} @enderror</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="Description" class="form-label">Job Description<span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" id="Description" rows="3">{{!empty($edit)?$singleType->description:old('description')}}</textarea>
                                <span class="text-danger p-2">@error('description'){{ $message }} @enderror</span>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="formFileSm" class="form-label">Image<span class="text-danger">*</span></label>
                                        <input onchange="loadFile(event)" name="thumbnail" class="form-control form-control" id="formFileSm" type="file">
                                        <span class="text-danger p-2">@error('thumbnail'){{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <div class="col">
                                    @if(!empty($edit))
                                    <img src="{{asset('jobimage/'.$singleType->thumbnail)}}"  id="output_hide" style=" display: block;margin: 0 auto;"   height="250px" width="300px">
                                    @endif
                                    <img   id="output" style=" display: block;margin: 0 auto;"   height="250px" width="300px">

                                </div>
                            </div>

                            <div class="form-check">
                                <input @if(!empty($edit)) {{ ($singleType->status == 0)? 'checked' :''}} @else checked  @endif  value="0" class="form-check-input" type="radio" name="status"
                                       id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Active
                                </label>
                            </div>

                            <div class="form-check">
                                <input @if(!empty($edit)) {{ ($singleType->status == 1)? 'checked' :''}}  @endif value="1" class="form-check-input" type="radio" name="status"
                                       id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Inactive
                                </label>
                            </div>
                            <br>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#output").hide();

        });
        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('output');
                output.src = reader.result
                $("#output_hide").hide(850);
                $("#output").show();

            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
@endsection
