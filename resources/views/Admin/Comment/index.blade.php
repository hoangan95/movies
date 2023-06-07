@extends('admin.master')
@section('title','Comment Index')
@section('modules','Comment')
@section('action','Index')
@section('content')

@push('.js')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('admin01/font/assets/plugins/custom/prism.js') }}/prism.js') }}.bundle..js') }}"></script>
    <script src="{{ asset('admin01/font/assets/plugins/custom/datatables/datatables.bundle..js') }}"></script>
<!--end::Vendors Javascript-->

<!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('admin01/font/assets/.js') }}/custom/documentation/general/datatables/basic..js') }}"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
@endpush
<div class="col-lg-12">
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <h6 class="mb-0">Danh sách Comment</h6>
      <div class="ms-auto">
          <a href="#" class="text-body animation" data-animation="bounce">
            <i class="ph-play-circle"></i>
          </a>
      </div>
    </div>   
 
        
    <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5" border="1px">
      <thead>
          <tr class="fw-semibold fs-6 text-muted">
              <th>ID</th>
              <th>Comment</th>
              <th>Delete</th>
              <th>Edit</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($comment as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->comment}}</td>
          <td><a href="{{ route('admin.comment.delete',['id'=>$item->id]) }}">Delete</a></td>
          <td><a href="{{ route('admin.comment.edit',['id'=>$item->id]) }}">Edit</a></td>
      </tr>
        @endforeach
      </tbody>
      <tfoot>
          <tr>
            <th>ID</th>
            <th>Comment</th>
            <th>Delete</th>
            <th>Edit</th>
          </tr>
      </tfoot>
   </table>
  </div>      
</div>
 
@endsection