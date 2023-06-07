@extends('admin.master')
@section('title','Categories Edit')
@section('modules','Categories')
@section('action','Edit')
@section('content')
<form action="{{ route('admin.categories.update',['id'=>$categories->id]) }}" method="post" enctype="multipart/form-data">
  @csrf

    <div id="kt_app_content" class="app-content flex-column-fluid">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h6 class="mb-0">Edit Categories</h6>
            <div class="ms-auto">
                <a href="#" class="text-body animation" data-animation="bounce">
                  <i class="ph-play-circle"></i>
                </a>
              </div>
            </div>

          <div class="card-body">

            <div class="mb-3">
              <label for="exampleFormControlInput1" class="required form-label">Name</label>
              <input type="text" class="form-control form-control-solid" name="name" placeholder="Please create categories" value="{{ old('name', $categories->name) }}"/>
            </div>

            <div class="mb-3"> 
              <label class="form-label">Status</label>
              <select name="status" class="form-select" aria-label="Select example" >                   
                <option value="1"{{ 1 == $categories->status ? 'selected' : '' }}>Outstanding</option>
                <option value="2"{{ 2 == $categories->status ? 'selected' : '' }}>Not outstanding</option>
                <option value="3"{{ 3 == $categories->status ? 'selected' : '' }}>Does not exist</option>
                <option value="4"{{ 4 == $categories->status ? 'selected' : '' }}>Exist</option>
              </select>
            </div>
            <div class="mb-3"> 
              <label class="form-label">Parent</label>
              <select name="parent_id" id="" class="form-select" aria-label="Select example">
                <option value="0" {{ $categories->parent_id == 0 ? "seleted" : "" }}>Root</option>
                {{ dequy($all, $categories->parent_id) }}
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