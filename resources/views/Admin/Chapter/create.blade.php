@extends('admin.master')
@section('title','Chapter Create')
@section('modules','Chapter')
@section('action','Create')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h6 class="mb-0">Create Chapter</h6>
            <div class="ms-auto">
                <a href="#" class="text-body animation" data-animation="bounce">
                  <i class="ph-play-circle"></i>
                </a>
              </div>
            </div>

            <form action="{{ route('admin.chapter.store') }}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="card-body">

                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="required form-label">Name Chapter</label>
                  <input type="text" class="form-control form-control-solid" placeholder="Please create name chapter" name="name_chapter" value="{{ old('name_chapter')}}"/>
                </div>

                <div>
                  <label for="exampleFormControlInput1" class="required form-label">Movies</label>
                  <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" name="movie_id">
                    <option>Root</option>
                    @foreach($movies as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
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