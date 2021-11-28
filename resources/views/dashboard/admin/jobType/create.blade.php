@extends('dashboard.admin.include.master')
@section('main')
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4">Job Type</h2>
            <hr>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Job Type {{!empty($edit)?'Edit':'Create'}}</li>
            </ol>
            <div class="card mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 style="float: left">Job Type {{!empty($edit)?'Edit':'Create'}}</h5>
                        <button onclick="document.location='{{route('admin.job-type-list')}}'" style="float: right"
                                type="button" class="btn btn-lg btn-outline-primary">List Type
                        </button>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.job-type-store') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Title<span class="text-danger">*</span></label>
                                <input value="{{!empty($edit)?$singleType->title:old('title')}}" type="text" class="form-control" name="title" placeholder="Title">
                                <span class="text-danger p-2">@error('title'){{ $message }} @enderror</span>
                                <input name="id" value="{{!empty($edit)?$singleType->id:''}}" type="hidden" class="form-control edit-field" />
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
@endsection
