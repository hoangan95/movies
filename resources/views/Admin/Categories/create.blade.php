@extends('admin.master')
@section('title','Categories Create')
@section('modules','Categories')
@section('action','Create')
@section('content')

<form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
  @csrf
    <div id="kt_app_content" class="app-content flex-column-fluid">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h6 class="mb-0">Create Categories</h6>
            <div class="ms-auto">
                <a href="#" class="text-body animation" data-animation="bounce">
                  <i class="ph-play-circle"></i>
                </a>
              </div>
            </div>

              <div class="card-body">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="required form-label">Name</label>
                  <input type="text" class="form-control form-control-solid" name="name" placeholder="Please create categories"/>
                </div>

                <div class="mb-3"> 
                  <label class="form-label">Status</label>
                  <select name="status" class="form-select" aria-label="Select example">
                    <option value="">Open this select menu</option>
                    <option value="1" {{ old("status") == 1 ? "selected" : "" }}>Outstanding</option>
                    <option value="2" {{ old("status") == 2 ? "selected" : "" }}>Not outstanding</option>
                    <option value="3" {{ old("status") == 3 ? "selected" : "" }}>Does not exist</option>
                    <option value="4" {{ old("status") == 4 ? "selected" : "" }}>Exist</option>
                  </select>
                </div>

                <div class="mb-3"> 
                  <label class="form-label">Parent</label>
                  <select name="parent_id" class="form-select" aria-label="Select example">
                    <option value="0">Open this select menu</option>
                    {{ dequy($categories) }}
                  </select>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-success hover-rotate-end" >Submit</button>
              </div>
          </div>
        </div>
      </div>
    </div>
</form>
@endsection