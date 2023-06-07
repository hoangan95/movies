@extends('admin.master')
@section('title','Blog Create')
@section('modules','Blog')
@section('action','Create')
@section('content')
<form action="{{ route('admin.blog.store') }}" method="post" enctype="multipart/form-data">
  @csrf

    <div id="kt_app_content" class="app-content flex-column-fluid">
      <div class="row" >
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h6 class="mb-0">Create BLog</h6>
              <div class="ms-auto">
                  <a href="#" class="text-body animation" data-animation="bounce">
                    <i class="ph-play-circle"></i>
                  </a>
              </div>
            </div>
            <div class="card-body">

              <div class="mb-3">
                <label for="exampleFormControlInput1" class="required form-label">Name</label>
                <input type="text" class="form-control form-control-solid" placeholder="Please create name blog" name="name" value="{{ old('name') }}"/>
              </div>

              <div class="mb-3">
                <label class="form-label">Content</label>
                <input type="text" class="form-control" name='content' placeholder="Please create content"value="{{ old('content') }}">
              </div>

              <div class="mb-3">
                <label class="form-label">Director</label>
                <input  name='director' type="text" class="form-control"placeholder="Please create director"value="{{ old('director') }}">
              </div>

              <div class="mb-3" id="editor">
                <label class="form-label">Intro</label>
                <textarea type="text"name="intro"class="form-control">{{ old('intro') }}</textarea><script>
                  CKEDITOR.replace( 'intro', {
                  filebrowserBrowseUrl: '{{ asset('ckfinder01/ckfinder/ckfinder.html') }}',
                  filebrowserImageBrowseUrl: '{{ asset('ckfinder01/ckfinder/ckfinder.html?type=Images') }}',
                  filebrowserFlashBrowseUrl: '{{ asset('ckfinder01/ckfinder/ckfinder.html?type=Flash') }}',
                  filebrowserUploadUrl: '{{ asset('ckfinder01/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                  filebrowserImageUploadUrl: '{{ asset('ckfinder01/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                  filebrowserFlashUploadUrl: '{{ asset('ckfinder01/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
              } );</script>
              </div>
                
            
              
              <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file"name="image"class="form-control" placeholder="Please create image">
              </div>

              <div class="mb-3"> 
                <label class="form-label">Status</label>
                <select class="form-select" aria-label="Select example" name="status"value="{{ old('status') }}">
                  <option>Open this select menu</option>
                  <option value="2">Outstanding</option>
                  <option value="1">Not stand out</option>
                  <option value="3">Does not exist</option>
                </select>
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
                        <h6 class="mb-0">Create Categories Movies</h6>
                        <div class="ms-auto">
                            <a href="#" class="text-body animation" data-animation="bounce">
                            <i class="ph-play-circle"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            {{ showCategories($categories) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>  
    </div>
</form>
@endsection