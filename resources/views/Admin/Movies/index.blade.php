@extends('admin.master')
@section('title','Movies Index')
@section('modules','Movies')
@section('action','Index')
@section('content')

@push('js')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('admin01/font/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ asset('admin01/font/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->

<!--begin::Custom Javascript(used for this page only)-->
<!--end::Custom Javascript-->
<!--end::Javascript-->
@endpush
<div class="col-lg-12">
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <h6 class="mb-0">List Movies</h6>
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
          <th class="min-w-50px"><span style="color:rgb(68, 235, 62);">ID</span></th>
          <th class="min-w-50px"><span style="color:rgb(68, 235, 62);">Name</span></th>
					<th class="min-w-50px"><span style="color:rgb(68, 235, 62);">Feature</span></th>
					<th class="min-w-50px"><span style="color:rgb(68, 235, 62);">Director</span></th>
          <th class="min-w-50px"><span style="color:rgb(68, 235, 62);">Intro</span></th>
					<th class="min-w-50px"><span style="color:rgb(68, 235, 62);">Status</span></th>
					<th class="min-w-50px"><span style="color:rgb(68, 235, 62);">Image</span></th>
					<th class="min-w-50px"><span style="color:rgb(68, 235, 62);">Time</span></th>
					<th class="min-w-50px"><span style="color:rgb(68, 235, 62);">Manufacture</span></th>
					<th class="min-w-50px"><span style="color:rgb(68, 235, 62);">Languages</span></th>
          <th class="min-w-50px"><span style="color:rgb(68, 235, 62);">Trailer</span></th>
          <th class="min-w-50px pe-5"><span style="color:rgb(68, 235, 62);">Delete</span></th>
          <th class="min-w-50px pe-5"><span style="color:rgb(68, 235, 62);">Edit</span></th>
				</tr>
			
			</thead>
			<tbody class="fw-semibold text-gray-600">
        @foreach($movies as $item)
          <tr class="odd">
            <td class="min-w-50px">{{ $loop->iteration }}</td>
            <td class="min-w-50px">{{ $item->name }}</td>
            @if ($item->feature == 1)
              <td class="min-w-50px">Nổi bật</td>
            @elseif($item->feature == 2) 
              <td class="min-w-50px">Không nổi bật</td>
            @elseif($item->feature == 3) 
              <td class="min-w-50px">Bom tấn</td>
            @elseif($item->feature == 4) 
              <td class="min-w-50px">Kinh điển</td>
            @endif              
            <td class="min-w-50px">{{ $item->director }}</td>
            <td class="min-w-100px">{!! Str::limit($item->intro, 100) !!}</td> 
              @if ($item->status == 1)
               <td class="min-w-50px">Còn chiếu</td>
              @elseif($item->status == 2) 
                <td class="min-w-50px">Không còn chiếu</td>
              @elseif($item->status == 3) 
               <td class="min-w-50px">Full HD</td>
              @elseif($item->status == 4) 
                <td class="min-w-50px">Bản CAM</td>
              @else 
              <td class="min-w-50px">Inactive</td>
              @endif              
            <td class="min-w-50px"><img width="100px" src="{{ asset('uploads/'.$item->image) }}"></td>
            <td class="min-w-50px">{{ $item->time }}</td>
            <td class="min-w-50px">{{ DB::table("manufactures")->where("id", $item->manufacture_id)->value("name") ?? "" }}</td>
              @if ($item->languages == 1)
                <td class="min-w-50px">Vietsub</td>
              @elseif($item->languages == 2) 
                  <td class="min-w-50px">Tiếng Anh</td>
              @elseif($item->languages == 3) 
                  <td class="min-w-50px">Lồng tiếng</td>
              @endif              
            <td class="min-w-50px">
              <video width="140" height="100" controls>
                <source src="{{ asset('uploads/trailer/'.$item->trailer) }}" type="video/mp4">
              </video>
            </td>
            <td class="min-w-50px"><a href="{{ route('admin.movies.delete', ['id'=>$item->id]) }}">Delete</a></td>
            <td class="min-w-50px"><a href="{{ route('admin.movies.edit', ['id'=>$item->id]) }}">Edit</a></td>
          </tr>
        @endforeach
			</tbody>
		</table>
	</div>
  {{-- End Data table --}}
</div>
 
 
@endsection