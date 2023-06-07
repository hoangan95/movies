@extends('admin.master')
@section('title','Cast Create')
@section('modules','Cast')
@section('action','Create')
@section('content')
<form action="{{ route('admin.cast.store') }}" method="post" enctype="multipart/form-data">
  @csrf
      <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="row">
          <div class="col-lg-8">
            <div class="card">
              <div class="card-header d-flex align-items-center">
                <h6 class="mb-0">Create Cast</h6>
                  <div class="ms-auto">
                    <a href="#" class="text-body animation" data-animation="bounce">
                      <i class="ph-play-circle"></i>
                    </a>
                  </div>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="required form-label">Name</label>
                  <input type="text" class="form-control form-control-solid" placeholder="Please create cast" name="name" value="{{ old('name')}}"/>
                </div>

                <div class="mb-3">
                  <label class="form-label">Image</label>
                  <input type="file" class="form-control" name='image' placeholder="Please create image">
                </div>

                <div class="mb-3">
                  <label class="form-label">Intro</label>
                  <textarea  name='intro' type="text" class="form-control">{{ old('intro')}}</textarea><script>
                    CKEDITOR.replace( 'intro', {
                    filebrowserBrowseUrl: '{{ asset('ckfinder01/ckfinder/ckfinder.html') }}',
                    filebrowserImageBrowseUrl: '{{ asset('ckfinder01/ckfinder/ckfinder.html?type=Images') }}',
                    filebrowserFlashBrowseUrl: '{{ asset('ckfinder01/ckfinder/ckfinder.html?type=Flash') }}',
                    filebrowserUploadUrl: '{{ asset('ckfinder01/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                    filebrowserImageUploadUrl: '{{ asset('ckfinder01/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                    filebrowserFlashUploadUrl: '{{ asset('ckfinder01/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
                } );</script>
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success hover-rotate-end" >Submit</button>
              </div>
            </div>
          </div> 
          <div class="col-lg-4">
                <div class="card">
                  <div class="card-header d-flex align-items-center">
                        <h6 class="mb-0">Create Movies</h6>
                        <div class="ms-auto">
                            <a href="#" class="text-body animation" data-animation="bounce">
                            <i class="ph-play-circle"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Movies</label><br>
                            <select class="form-select form-select-solid" data-control="select2" data-close-on-select="false" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple"name="movie_id[]">
                                <option>Root</option>
                                 @foreach($movies as $item)
                                   <option value="{{$item->id }}">{{ $item->name }}</option>
                                  @endforeach
                            </select>
                        </div>
                    </div>
                  </div>
                 </div>
              </div>
        </div>
      </div>
</form>
@endsection