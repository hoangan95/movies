@extends('admin.master')
@section('title','Categories Index')
@section('modules','Categories')
@section('action','Index')
@section('content')

@push('js')
<script src="{{ asset('admin01/font/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('admin01/font/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->

<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('admin01/font/assets/js/custom/documentation/general/datatables/basic.js') }}"></script>
@endpush

<div class="col-lg-12">
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <h6 class="mb-0">List Categories</h6>
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
					<th class="min-w-100px"><span style="color:rgb(68, 235, 62);">Name</span></th>
          <th class="min-w-100px"><span style="color:rgb(68, 235, 62);">Parent</span></th>
					<th class="min-w-100px"><span style="color:rgb(68, 235, 62);">Status</span></th>
					<th class="min-w-100px pe-5"><span style="color:rgb(68, 235, 62);">Delete</span></th>
          <th class="min-w-100px pe-5"><span style="color:rgb(68, 235, 62);">Edit</span></th>
				</tr>
			
			</thead>
			<tbody class="fw-semibold text-gray-600">
        @foreach($categories as $item)
          <tr class="odd">
            <td class="min-w-100px">{{ $loop->iteration }}</td>
            <td class="min-w-100px">{{ $item->name }}</td>
            <td class="min-w-100px">{{ DB::table("categories")->where("id", $item->parent_id)->value("name") ?? "Trang chủ" }}</td>
            @if ($item->status == 1)
            <td class="min-w-100px">Outstanding</td>
            @elseif ($item->status == 2)
              <td class="min-w-100px">Not outstanding</td>
            @elseif ($item->status == 3)
              <td class="min-w-100px">Does not exist</td>
            @else
              <td class="min-w-100px">Exist</td>
            @endif
            <td class="min-w-100px"><a href="{{ route('admin.categories.delete', ['id'=>$item->id]) }}">Delete</a></td>
            <td class="min-w-100px"><a href="{{ route('admin.categories.edit', ['id'=>$item->id]) }}">Edit</a></td>
          </tr>
        @endforeach
			</tbody>
		</table>
	</div>
  {{-- End Data table --}}
</div>

 
@endsection