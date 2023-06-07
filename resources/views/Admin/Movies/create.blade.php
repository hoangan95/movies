@extends('admin.master')
@section('title','Movies Create')
@section('modules','Movies')
@section('action','Create')
@section('content')
<form action="{{ route('admin.movies.store') }}" method="post" enctype="multipart/form-data">
  @csrf
    <div id="kt_app_content" class="app-content flex-column-fluid">
      <div class="row">
        <div class="col-lg-8">
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
                  <label for="exampleFormControlInput1" class="required form-label">Type Movies</label>
                  <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" name="type_id">
                      @foreach ($type as $item)
                      <option value="{{ $item->id }}">{{ $item->name_type }}</option>
                      @endforeach
                  </select>
                </div>

                <div class="mb-3">
                  <label for="exampleFormControlInput1"  class="required form-label">Name</label>
                  <input type="text" class="form-control form-control-solid" name="name" placeholder="Please create name movies" value="{{ old('name') }}"/>
                </div>

                <div class="mb-3"> 
                  <label class="form-label">Feature</label>
                  <select name="feature" class="form-select" aria-label="Select example">
                    <option>Open this select menu</option>
                    <option value="1" {{ old("feature") == 1 ? "selected" : "" }}>Nổi bật</option>
                    <option value="2"{{ old("feature") == 2 ? "selected" : "" }}>Không nổi bật</option>
                    <option value="3"{{ old("feature") == 3 ? "selected" : "" }}>Bom tấn</option>
                    <option value="4"{{ old("feature") == 4 ? "selected" : "" }}>Kinh điển</option>
                  </select>
                </div>

                <div class="mb-3"> 
                  <label class="form-label">Status</label>
                  <select name="status" class="form-select" aria-label="Select example">
                    <option>Open this select menu</option>
                    <option value="1"{{ old("status") == 1 ? "selected" : "" }}>Còn chiếu</option>
                    <option value="2"{{ old("status") == 2 ? "selected" : "" }}>Không còn chiếu</option>
                    <option value="3"{{ old("status") == 3 ? "selected" : "" }}>Bản full HD</option>
                    <option value="4"{{ old("status") == 4 ? "selected" : "" }}>Bản CAM</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label  class="required form-label">Director</label>
                  <input type="text" class="form-control form-control-solid" name="director" placeholder="Please create director movies"value="{{ old('director') }}"/>
                </div>

                <div class="mb-3">
                  <label  class="required form-label">Intro</label>
                  <textarea type="text" class="form-control form-control-solid" name="intro" placeholder="Please create intro movies">{{ old('intro') }}</textarea><script>
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
                  <label  class="required form-label">Image</label>
                  <input type="file" class="form-control form-control-solid" name="image" placeholder="Please create image movies"/>
                </div>

                <div class="mb-3">
                <label  class="required form-label">Time</label>
                <input type="time" class="form-control form-control-solid" name="time" placeholder="Please create time movies"value="{{ old('time') }}"/>
              </div>

              <div>
                  <label for="exampleFormControlInput1" class="required form-label">Manufactures</label>
                  <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" name="manufacture_id">
                    <option value="0">Root</option>
                    @foreach($manufactures as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                </div>

              <div class="mb-3"> 
                <label class="form-label">Languages</label>
                <select name="languages" class="form-select" aria-label="Select example"value="{{ old('languages') }}">
                  <option>Open this select menu</option>
                  <option value="1">Vietsub</option>
                  <option value="2">Tiếng anh</option>
                  <option value="3">Lồng tiếng</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label">Trailer</label>
                <input type="file" class="form-control form-control-solid" name="trailer" />
              </div>
              <div class="mb-3">
                <label class="form-label">Link Phim</label>
                <input type="text" class="form-control form-control-solid" name="link" placeholder="Please enter link film" value="{{ old('link') }}"/>
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
                        <h6 class="mb-0">Categories</h6>
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