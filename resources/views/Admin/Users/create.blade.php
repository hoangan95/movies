@extends('admin.master')
@section('title','Users Create')
@section('modules','User')
@section('action','Create')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h6 class="mb-0">Create Users</h6>
            <div class="ms-auto">
                <a href="#" class="text-body animation" data-animation="bounce">
                  <i class="ph-play-circle"></i>
                </a>
              </div>
            </div>

            <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="card-body">

                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Please create email"value="{{ old('email')}}"/>
                </div>

                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control" name='password' placeholder="Please create password" value="{{ old('password')}}">
                </div>

                <div class="mb-3">
                  <label class="form-label">Fullname</label>
                  <input  name='fullname' type="text" class="form-control"placeholder="Please create fullname" value="{{ old('fullname')}}">
                </div>

                <div class="mb-3">
                  <label class="form-label">Phone</label>
                  <input type="text"name="phone"class="form-control"placeholder="Please create phone number" value="{{ old('phone')}}" >
                </div>

                <div class="mb-3">
                  <label class="form-label">Adress</label>
                  <input type="text"name="adress"class="form-control" placeholder="Please create adress" value="{{ old('adress')}}">
                </div>

                <div class="mb-3">
                  <label class="form-lebel">Image</label><br>
                  <input class="form-control" type="file"name="image" >
                </div>

                <div class="mb-3"> 
                  <label class="form-label">Level</label>
                  <select name="level" class="form-select" aria-label="Select example" value="{{ old('level')}}">
                    <option value="2">Member</option>
                    <option value="1">Admin</option>
                  </select>
                </div>

                <div class="mb-3"> 
                  <label class="form-label">Status</label>
                  <select name="status" class="form-select" aria-label="Select example" value="{{ old('status')}}">
                    <option value="2">Đang hoạt động</option>
                    <option value="1">Tạm khóa</option>
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
      <!--end::Content container-->
    </div>
@endsection