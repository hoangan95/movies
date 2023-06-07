@extends('client.master')
@section('content')

<div class="media-section">
	<div class="container-fluid-">
		<div class="media-slider">
			<!-- start media-box -->
      @foreach ($movies as $item)
			<div class="media-box">
						@if($item->type_id == 1)
								<a href="{{ route('client.singlemovies',['slug'=>$item->slug]) }}" class="full-click"></a>
						@elseif($item->type_id == 2)
								<a href="{{ route('client.movieslesson', ['slug' => $item->slug]) }}" class="full-click"></a>
						@endif
		
          <div class="media-thumb" style="background-image: url('{{ asset('uploads/'.$item->image) }}');"></div>

          <!-- Start media-play -->
          <a href="{{ route('client.singlemovies',['slug'=>$item->slug]) }}" class="media-play">
            <i class="icofont-ui-play"></i>
          </a>
          <!-- Start episode-info -->
          <div class="episode-info">

            <!-- Start season -->
            <span class="season">
              <i class="icofont-book-mark"></i>
              @if ($item->feature == 1)
                Nổi  bật
              @elseif ($item->feature == 2)
                Không nổi  bật              
              @elseif ($item->feature == 3)
                Bom tấn
              @elseif ($item->feature == 4)
                Kinh điển
               @endif
            </span>
          </div>
          <!-- Start rate-quality-info -->
          <div class="rate-quality-info">
            @if ($item->status == 3)
            <span class="media-badge bg-dark">HD</span>
            @elseif ($item->status == 4)
            <span class="media-badge bg-dark">CAM</span>
            @elseif ($item->status == 1)
            <span class="media-badge bg-dark">Còn chiếu</span>
            @elseif ($item->status == 2)
            <span class="media-badge bg-dark">Không còn chiếu</span>
           @endif
        
            <span class="rate icofont-star">7.8</span>
          </div>
          <div class="media-info">
						@if($item->type_id == 1)
							<a href="{{ route('client.singlemovies',['slug'=>$item->slug]) }}" class="media-box-category">
						@elseif($item->type_id == 2)
							<a href="{{ route('client.movieslesson', ['slug' => $item->slug]) }}" class="media-box-category">
						@endif
              <i class="icofont-video-alt"></i>
             @if ($item->type_id == 1)
               Phim chiếu rạp
             @elseif ($item->type_id == 2)
               Phim nhiều tập
            @endif
            </a>
            <h5 class="media-box-title">{{ $item->name }}</h5>
          </div>
        </div>
      @endforeach
			<!-- end media-box -->
		</div>
	</div>
</div>

<section class="all-media">
	<!-- Start top-media -->
	<div class="top-media-header"></div>
	<div class="container mt--45">
		<div class="filter-group flex-column flex-lg-row">
			<div class="home-adv-filter row m-0 mb-3 mb-lg-0">
				<!-- Start advanced filter -->
				<div class="col-12">
					<h6 class="text-white mb-3">
						<i class="icofont-filter"></i>
						Advanced Filter
					</h6>
				</div>

				<div class="dropdown col-6 col-md-5 mb-3 mb-lg-0">
					<button type="button" class="btn btn-sm btn-filter dropdown-toggle" data-bs-toggle="dropdown">
						Categories
					</button>
					<ul class="dropdown-menu media-dropdown nice-scroll" onclick="event.stopPropagation()">
						@foreach($categories as $item)
							<li class="dropdown-item">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="category-{{ $item->id }}" name="category" value="{{ $item->id }}" />
									<label class="form-check-label" for="category-{{ $item->id }}">{{ $item->name }}</label>
								</div>
							</li>
						@endforeach
					</ul>
				</div>

				<div class="dropdown col-6 col-md-3 mb-3 mb-lg-0">
					<button type="button" class="btn btn-sm btn-filter dropdown-toggle" data-bs-toggle="dropdown">
						Type
					</button>
					<ul class="dropdown-menu media-dropdown nice-scroll" onclick="event.stopPropagation()">
						@foreach($type as $item)
						<li class="dropdown-item">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="type-{{ $item->id }}" name="type" value="{{ $item->id }}" />
								<label class="form-check-label" for="type-{{ $item->id }}">{{ $item->name_type }}</label>
							</div>
						</li>
						@endforeach
					</ul>
				</div>

				<div class="dropdown col-6 col-md-3 mb-3 mb-md-0-">
					<button type="button" class="btn btn-sm btn-filter dropdown-toggle w-100" data-bs-toggle="dropdown">
						Year
					</button>
					<ul class="dropdown-menu media-dropdown nice-scroll" onclick="event.stopPropagation()">
						@for ($i = 1990; $i <  date('Y', strtotime("now")); $i++)
							<li class="dropdown-item">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="year-{{$i}}" name="select_year" value="{{ $i }}" />
									<label class="form-check-label" for="year-{{$i}}">{{ $i }}</label>
								</div>
							</li>
						@endfor
					</ul>
				</div>

				<div class="dropdown col-6 col-md-3 mb-3 mb-md-0">
					<button type="button" class="btn btn-sm btn-filter dropdown-toggle" data-bs-toggle="dropdown">
						Quality
					</button>
					<ul class="dropdown-menu media-dropdown nice-scroll" onclick="event.stopPropagation()">
						@foreach([1, 2, 3, 4] as $item)
						<li class="dropdown-item">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="quality-{{ $item }}" name="quality" value="{{ $item }}" />
								<label class="form-check-label" for="quality-{{ $item }}">
									@if ($item == 1)
										Còn chiếu
									@elseif($item == 2) 
										Không còn chiếu
									@elseif($item == 3) 
										Full HD
									@elseif($item == 4) 
										Bản CAM
									@endif              
								</label>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
			
		</div>
	</div>

	<div class="container-fluid mt-2 movie-render" data-url="{{ route("ajax.filter.home") }}">
		<div class="row row-cols-2 row-cols-sm-4 row-cols-lg-5">
			<!-- start media-box -->
      @foreach($moviesall as $item)
        <div class="col mt-3">
          <div class="media-box">
						@if($item->type_id == 1)
								<a href="{{ route('client.singlemovies',['slug'=>$item->slug]) }}" class="full-click"></a>
						@elseif($item->type_id == 2)
								<a href="{{ route('client.movieslesson', ['slug' => $item->slug]) }}" class="full-click"></a>
						@endif
				  <div class="media-thumb" style="background-image: url('{{ asset('uploads/'.$item->image) }}');"></div>
            <!-- Start media-play -->
            <a href="{{ route('client.singlemovies',['slug'=>$item->slug]) }}" class="media-play">
              <i class="icofont-ui-play"></i>
            </a>
            <!-- Start rate-quality-info -->
            <div class="rate-quality-info">
              <span class="media-badge bg-dark"> 
                  @if ($item->status == 3)
                    <span class="media-badge bg-dark">HD</span>
                  @elseif ($item->status == 4)
                    <span class="media-badge bg-dark">CAM</span>
                  @elseif ($item->status == 1)
                    <span class="media-badge bg-dark">Còn chiếu</span>
                  @elseif ($item->status == 2)
                    <span class="media-badge bg-dark">Không còn chiếu</span>
                  @endif
              </span>
              <span class="rate icofont-star">8.9</span>
            </div>
            <div class="media-info">
								
								@if($item->type_id == 1)
									<a href="{{ route('client.singlemovies',['slug'=>$item->slug]) }}" class="media-box-category">
								@elseif($item->type_id == 2)
										<a href="{{ route('client.movieslesson', ['slug' => $item->slug]) }}" class="media-box-category">
								@endif
                <i class="icofont-video-alt"></i>
                @if ($item->languages == 1)
                    Vietsub
                @elseif ($item->languages == 2)
                  Tiếng Anh
                @elseif ($item->languages == 3)
                 Lồng Tiếng
                @endif
              </a>
              <h5 class="media-box-title">{{ $item->name}}</h5>
            </div>
          </div>
        </div>
      @endforeach
			<!-- end media-box -->
		</div>

		<!-- Start pagination -->
		<ul class="pagination aster-pagination justify-content-center mt-5 mb-5">
			@foreach ($moviesall->forPage(1, $moviesall->lastPage()) as $key => $item)
				<li class="page-item">
					<a class="page-link" href="{{ $moviesall->url($key + 1) }}">{{ $key + 1 }}</a>
				</li>
			@endforeach	
		</ul>
	</div>
</section>

@endsection