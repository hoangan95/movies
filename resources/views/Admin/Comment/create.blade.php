@extends('admin.master')
@section('title','Comment Create')
@section('modules','Comment')
@section('action','Create')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h6 class="mb-0">Thêm Comment</h6>
            <div class="ms-auto">
                <a href="#" class="text-body animation" data-animation="bounce">
                  <i class="ph-play-circle"></i>
                </a>
              </div>
            </div>

            <form action="{{ route('admin.comment.store') }}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="card-body">

                <div class="mb-3">
                  <label  class="required form-label">Bình luận</label>
                  <textarea type="text" class="form-control form-control-solid" name="comment" placeholder="Vui lòng nhập bình luận">{{ old('comment') }}</textarea>
                <div>
                  <label for="exampleFormControlInput1" class="required form-label">Phim_id</label>
                  <select class="form-select" aria-label="Select example" name="movie_id">
                    <option value="0">Root</option>
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