@extends('admin.master')
@section('title','Manufactures Edit')
@section('modules','Manufactures')
@section('action','Edit')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h6 class="mb-0">Edit Manufactures</h6>
            <div class="ms-auto">
                <a href="#" class="text-body animation" data-animation="bounce">
                  <i class="ph-play-circle"></i>
                </a>
              </div>
            </div>

            <form action="{{ route('admin.manufactures.update',['id'=>$manufactures->id]) }}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="card-body">

                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="required form-label">Name</label>
                  <input type="text" class="form-control form-control-solid" placeholder="Please create lesson" name="name" value="{{ old('name',$manufactures->name)}}"/>
                </div>

                <div class="mb-3">
                  <label  class="required form-label">Intro</label>
                  <textarea type="text" class="form-control form-control-solid" name="intro" placeholder="Please create intro movies">{{ old('intro',$manufactures->intro) }}</textarea><script>
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
                  <label class="form-label">Status</label>
                  <select name="status" class="form-select" aria-label="Select example"value="{{ old('status',$manufactures->status) }}">
                    <option>Open this select menu</option>
                    <option value="1"{{ 1 == $manufactures->status ? 'selected' : '' }}>Outstanding</option>
                    <option value="2"{{ 2 == $manufactures->status ? 'selected' : '' }}>Not outstanding</option>
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