@extends('admin.master')
@section('title','Movies Edit')
@section('modules','Movies')
@section('action','Edit')
@section('content')
<form action="{{ route('admin.movies.update',['id'=>$movies->id]) }}" method="post" enctype="multipart/form-data">
  @csrf
    <div id="kt_app_content" class="app-content flex-column-fluid">
      <div class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h6 class="mb-0">Edit Movies</h6>
              <div class="ms-auto">
                  <a href="#" class="text-body animation" data-animation="bounce">
                    <i class="ph-play-circle"></i>
                  </a>
              </div>
            </div>            
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label">Type Movies</label>
                  <select name="type_id" class="form-select" aria-label="Select example">
                      <option>Vui lòng nhập kiểu phim</option>
                      @foreach ($type as $item)
                      <option value="{{ $item->id }}"{{ $movies->type_id == $item->id ? "selected" : "" }}>{{ $item->name_type }}</option>
                      @endforeach
                  </select>
                </div>

                <div class="mb-3">
                  <label for="exampleFormControlInput1"  class="required form-label">Name</label>
                  <input type="text" class="form-control form-control-solid" name="name" placeholder="Please create name movies" value="{{ old('name',$movies->name) }}"/>
                </div>

                <div class="mb-3"> 
                  <label class="form-label">Feature</label>
                  <select name="feature" class="form-select" aria-label="Select example"value="{{ old('feature',$movies->feature) }}">
                    <option>Open this select menu</option>
                    <option value="1"{{ 1 == $movies->status ? 'selected' : '' }}>Nổi bật</option>
                    <option value="2"{{ 2 == $movies->status ? 'selected' : '' }}>Không nổi bật</option>
                    <option value="3"{{ 3 == $movies->status ? 'selected' : '' }}>Bom tấn</option>
                    <option value="4"{{ 4 == $movies->status ? 'selected' : '' }}>Kinh điển</option>
                  </select>
                </div>

                <div class="mb-3"> 
                  <label class="form-label">Status</label>
                  <select name="status" class="form-select" aria-label="Select example"value="{{ old('status',$movies->status) }}">
                    <option>Open this select menu</option>
                    <option value="1"{{ 1 == $movies->status ? 'selected' : '' }}>Còn chiếu</option>
                    <option value="2"{{ 2 == $movies->status ? 'selected' : '' }}>Không còn chiếu</option>
                    <option value="3"{{ 3 == $movies->status ? 'selected' : '' }}>Bản full HD</option>
                    <option value="4"{{ 4 == $movies->status ? 'selected' : '' }}>Bản CAM</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label  class="required form-label">Director</label>
                  <input type="text" class="form-control form-control-solid" name="director" placeholder="Please create name director movies"value="{{ old('director',$movies->director) }}"/>
                </div>

                <div class="mb-3">
                  <label  class="required form-label">Intro</label>
                  <textarea type="text" class="form-control form-control-solid" name="intro" placeholder="Please create intro movies">{{ old('intro',$movies->intro) }}</textarea><script>
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
                  <img width="50px" src="{{ asset('uploads/'.$movies->image) }}">
                </div>

                <div class="mb-3">
                <label  class="required form-label">Time</label>
                <input type="time" class="form-control form-control-solid" name="time" placeholder="Please create time movies"value="{{ old('time',$movies->time) }}"/>
              </div>

              <div>
                  <label for="exampleFormControlInput1" class="required form-label">Manufactures</label>
                  <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" name="manufacture_id">
                    <option>Vui lòng nhập nhà sản xuất</option>
                    @foreach($manufactures as $item)
                      <option value="{{ $item->id }}" {{ $movies->manufacture_id == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                    @endforeach
                </select>
                </div>

              <div class="mb-3"> 
                <label class="form-label">Languages</label>
                <select name="languages" class="form-select" aria-label="Select example"value="{{ old('languages',$movies->languages) }}">
                  <option>Open this select menu</option>
                  <option value="1"{{ 1 == $movies->languages ? 'selected' : '' }}>Vietsub</option>
                  <option value="2"{{ 2 == $movies->languages ? 'selected' : '' }}>Tiếng anh</option>
                  <option value="3"{{ 3 == $movies->languages ? 'selected' : '' }}>Lồng tiếng</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label">Trailer</label>
                <input type="file" class="form-control form-control-solid" name="trailer" />
                <video width="100%"  controls>
                  <source src="{{ asset('uploads/trailer/'.$movies->trailer) }}" type="video/mp4">
                </video>
              </div>

              <div class="mb-3">
                <label class="form-label">Link Phim</label>
                <input type="text" class="form-control form-control-solid" name="link" placeholder="Please enter link film" value="{{ old('link',$movies->link) }}"/>
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
                            {{ showCategories($categories , $categories_movies) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>  
    </div>
</form>         
@endsection