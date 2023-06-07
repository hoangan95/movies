@extends('client.master')
@section('content')
<nav class="breadcrumb-nav" aria-label="breadcrumb">
  <div class="container">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('client.home') }}">HOME</a></li>
          <li class="breadcrumb-item active" aria-current="page">MOVIES</li>
          <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb }}</li>
      </ol>
  </div>
</nav>

<div class="container-fluid mt-2">
	<div class="row row-cols-2 row-cols-sm-4 row-cols-lg-5 row-cols-xl-5 col-xxl-12">
    @foreach($movies as $item)
      <div class="col mt-3">
        <!-- start media-box -->
        <div class="media-box">
          @if($item->type_id == 1)
              <a href="{{ route('client.singlemovies',['slug'=>$item->slug]) }}" class="full-click"></a>
          @elseif($item->type_id == 2)
              <a href="{{ route('client.movieslesson', ['slug' => $item->slug]) }}" class="full-click"></a>
          @endif         
       <div class="media-thumb" style="background-image: url('{{ asset('uploads/'.$item->image) }}');"></div>

          <!-- Start media-play -->
          @if($item->type_id == 1)
              <a href="{{ route('client.singlemovies',['slug'=>$item->slug]) }}" class="media-play">
                <i class="icofont-ui-play"></i>
              </a>
          @elseif($item->type_id == 2)
              <a href="{{ route('client.movieslesson',['slug'=>$item->slug]) }}" class="media-play">    
                <i class="icofont-ui-play"></i>
              </a>
          @endif   
         
          <!-- Start rate-quality-info -->
          <div class="rate-quality-info">
            <span class="media-badge bg-dark">
              @if ($item->status == 3)
                <a href="#" class="quality">HD</a>
              @elseif ($item->status == 4)
                <a href="#" class="quality">CAM</a>
              @elseif ($item->status == 1)
                <a href="#" class="quality">Còn chiếu</a>
              @elseif ($item->status == 2)
                <a href="#" class="quality">Không còn chiếu</a>
              @endif
            </span>
            <span class="rate icofont-star">
              @if ($item->feature == 3)
                <a href="#" class="quality">Bom tấn</a>
              @elseif ($item->feature == 4)
                <a href="#" class="quality">Kinh điển</a>
              @elseif ($item->feature == 1)
                <a href="#" class="quality">Nổi bật</a>
              @elseif ($item->feature == 2)
                <a href="#" class="quality">Không nổi bật</a>
              @endif
            </span>
          </div>
          <div class="media-info">
            @if($item->type_id == 1)
                <a href="{{ route('client.singlemovies',['slug'=>$item->slug]) }}" class="media-box-category">
                  <i class="icofont-video-alt"></i>
                  Watch
                </a>
            @elseif($item->type_id == 2)
                <a href="{{ route('client.movieslesson',['slug'=>$item->slug]) }}" class="media-box-category">
                  <i class="icofont-video-alt"></i>
                  Watch
                </a>
            @endif      
            
            <h5 class="media-box-title">{{ $item->name }}</h5>
          </div>
        </div>
        <!-- end media-box -->
      </div>
    @endforeach
	</div>

	<!-- Start pagination -->
	<ul class="pagination aster-pagination justify-content-center mt-5 mb-5">
		@foreach ($movies->forPage(1, $movies->lastPage()) as $key => $item)
				<li class="page-item">
					<a class="page-link" href="{{ $movies->url($key + 1) }}">{{ $key + 1 }}</a>
				</li>
			@endforeach	
	</ul>
</div>

@endsection