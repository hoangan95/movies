@extends('admin.master')
@section('title','Type Create')
@section('modules','Type')
@section('action','Create')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h6 class="mb-0">Create Type</h6>
            <div class="ms-auto">
                <a href="#" class="text-body animation" data-animation="bounce">
                  <i class="ph-play-circle"></i>
                </a>
              </div>
            </div>

            <form action="{{ route('admin.type.store') }}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="card-body">

                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="required form-label">Name</label>
                  <input type="text" class="form-control form-control-solid" placeholder="Please create type movies" name="name_type" value="{{ old('name_type')}}"/>
                </div>

              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success hover-rotate-end" >Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection