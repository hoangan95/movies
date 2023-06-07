@extends('admin.master')
@section('title','Users Index')
@section('modules','User')
@section('action','Index')
@section('content')

@push('js')
<script src="{{ asset('admin01/font/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('admin01/font/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<!--end::Vendors Javascript-->

@endpush

<div class="col-lg-12">
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <h6 class="mb-0">List User</h6>
      <div class="ms-auto">
          <a href="#" class="text-body animation" data-animation="bounce">
            <i class="ph-play-circle"></i>
          </a>
      </div>
    </div>
  </div>  
</div>


<div class="card card-p-0 card-flush">
	<div class="card-header align-items-center py-5 gap-2 gap-md-5">
		<div class="card-title">
			<!--begin::Search-->
			<div class="d-flex align-items-center position-relative my-1">
				<span class="svg-icon fs-1 position-absolute ms-4">...</span>
				<input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Report" />
			</div>
			<!--end::Search-->
			<!--begin::Export buttons-->
			<div id="kt_datatable_example_1_export" class="d-none"></div>
			<!--end::Export buttons-->
		</div>
	</div>

{{-- Data table --}}
	<div class="card-body">
		<table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example">
			<thead>
				<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
          <th class="min-w-100px"><span style="color:rgb(68, 235, 62);">ID</span></th>
					<th class="min-w-100px"><span style="color:rgb(68, 235, 62);">Email</span></th>
					<th class="min-w-100px"><span style="color:rgb(68, 235, 62);">Fullname</span></th>
					<th class="min-w-100px"><span style="color:rgb(68, 235, 62);">Phone</span></th>
					<th class="min-w-100px"><span style="color:rgb(68, 235, 62);">Adress</span></th>
					<th class="min-w-100px"><span style="color:rgb(68, 235, 62);">Image</span></th>
					<th class="min-w-100px"><span style="color:rgb(68, 235, 62);">Level</span></th>
          <th class="min-w-100px"><span style="color:rgb(68, 235, 62);">Status</span></th>
					<th class="min-w-100px pe-5"><span style="color:rgb(68, 235, 62);">Delete</span></th>
          <th class="min-w-100px pe-5"><span style="color:rgb(68, 235, 62);">Edit</span></th>
				</tr>
			
			</thead>
			<tbody class="fw-semibold text-gray-600">
        @foreach($users as $item)
          <tr class="odd">
            <td class="min-w-100px">{{ $loop->iteration }}</td>
            <td class="min-w-100px">{{ $item->email }}</td>
            <td cclass="min-w-100px">{{ $item->fullname }}</td>
            <td class="min-w-100px">{{ $item->phone }}</td>
            <td class="min-w-100px">{{ $item->adress }}</td>
            <td class="min-w-75px"><img width="50px" src="{{ asset('uploads/'. $item->image) }}" /></td>
            @if ($item->level == 1)
              <td class="min-w-100px">Admin</td>
            @else 
              <td class="min-w-100px">Member</td>
            @endif
            <td>
              <div class="form-check form-switch">
                @if($item->status == 2)
                  <input class="form-check-input switch-status" data-url="{{ route("admin.users.status.change", ["id" => $item->id]) }}" data-value="2" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
                @else
                  <input class="form-check-input switch-status" data-url="{{ route("admin.users.status.change", ["id" => $item->id]) }}" data-value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                @endif
              </div>
            </td>
            {{-- @if ($item->status == 2)
              <td class="min-w-100px">Đang hoạt động</td>
            @else 
              <td class="min-w-100px">Tamk khóa</td>
            @endif --}}
            <td class="min-w-100px"><a href="{{ route('admin.users.delete', ['id'=>$item->id]) }}">Delete</a></td>
            <td class="min-w-100px"><a href="{{ route('admin.users.edit', ['id'=>$item->id]) }}">Edit</a></td>
          </tr>
        @endforeach
			</tbody>
		</table>
	</div>
  {{-- End Data table --}}
</div>
@endsection