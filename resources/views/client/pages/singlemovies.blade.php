@extends('client.master')
@section('content')
<nav class="breadcrumb-nav" aria-label="breadcrumb">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('client.home') }}">Home</a></li>
			<li class="breadcrumb-item">Movies</li>
			<li class="breadcrumb-item active" aria-current="page">{{ $movies->name }}</li>
		</ol>
	</div>
</nav>

<div class="single-media-section pt-3 pb-3">
	<div class="page-cover" style="background-image: url('{{ asset('uploads/'.$movies->image) }}')"></div>

	<div class="container">
		<div class="row">
			<!-- start media-box -->
			<div class="col-8 col-md-4 col-lg-3 m-auto m-sm-0">
				<div class="single-media-box mt-2">
					<div class="media-thumb" style="background-image: url('{{ asset('uploads/'.$movies->image) }}');"></div>
				</div>

				<!-- start buttons -->
				<div class="d-flex flex-wrap justify-content-center flex-direction-column mt-2">
					<button type="button" class="btn btn-favorite">
						<i class="icofont-star"></i>
						Add To Favorite
					</button>
					<div class="w-100 d-flex justify-content-center">
						<div class="btn-group btn-group-sm mt-2">
							<button type="button" class="btn btn-sm btn-primary">
								<i class="icofont-thumbs-up"></i>
								Like
							</button>
							<button type="button" class="btn btn-sm btn-danger">
								<i class="icofont-thumbs-down"></i>
								Deslike
							</button>
						</div>
					</div>
				</div>
			</div>
			
				<div class="col-md-8 col-lg-9 text-white">
					<h1 class="single-media-title">{{ $movies->name }}</h1>

					<!-- start single-base-info -->
					<ul class="nav single-base-info">
						<li class="nav-item">
							<i class="icofont-star"></i>
							7.8
						</li>

						<li class="nav-item">
							<strong>IMDB</strong>
							167
						</li>
						<li class="nav-item">
							<i class="icofont-clock-time"></i>
							{{ $movies->time }}
						</li>
						<li class="nav-item">
							<i class="icofont-like"></i>
							34
						</li>
						<li class="nav-item">
							<i class="icofont-calendar"></i>
							2020
						</li>
					</ul>

					<div class="single-media-info">
						<div class="info-data">
							<!-- start description -->
							<p class="description mt-1 mb-3">
								{!! $movies->intro !!}
							</p>

							<ul class="single-info-group">
								<li>
									<span>
										<strong>
											<i class="icofont-contrast"></i>
											Quality
										</strong>
									</span>
									@if ($movies->status == 3)
										<a href="#" class="quality">HD</a>
									@elseif ($movies->status == 4)
										<a href="#" class="quality">CAM</a>
									@elseif ($movies->status == 1)
										<a href="#" class="quality">Còn chiếu</a>
									@elseif ($movies->status == 2)
										<a href="#" class="quality">Không còn chiếu</a>
									@endif
								</li>

								<li>
									<span>
										<strong>
											<i class="icofont-globe"></i>
											Language
										</strong>
									</span>
									@if ($movies->languages == 1)
										<a href="#" class="language">Vietsub</a>
									@elseif ($movies->languages == 2)
										<a href="#" class="language">Tiếng anh</a>
									@elseif ($movies->languages == 3)
										<a href="#" class="language">Lồng tiếng</a>
                	@endif
								</li>

								<li>
									<span>
										<strong>
											<i class="icofont-flag"></i>
											Manufacture
										</strong>
									</span>
									<a href="#" class="country">{{ DB::table("manufactures")->where("id", $movies->manufacture_id)->value("name") ?? "" }}</a>
								</li>

								<li>
									<span>
										<strong>
											<i class="icofont-folder-open"></i>
											Category
										</strong>
									</span>
									<a
									@if ($movies->type_id == 1)
										href="{{ route('client.movie.theaters') }}" 
									@elseif($movies->type_id == 2)
										href="{{ route('client.series.movie') }}"
									@endif
									class="category">{{ DB::table("type")->where("id", $movies->type_id)->value("name_type") ?? "" }}</a>
								</li>
							</ul>

							<div class="d-inline-block w-100 mt-3 mb-2">
								<span class="d-inline-block w-20">
									<strong>
										<i class="icofont-tags"></i>
										Tags
									</strong>
								</span>
								<ul class="nav categories-list">
									<li>
										<a href="#">Animation</a>
									</li>

									<li>
										<a href="#">Adventure</a>
									</li>
									<li>
										<a href="#">Comedy</a>
									</li>
								</ul>
							</div>
						</div>

						<!-- start Btns -->
						<div class="btns me-sm-auto">
							<div class="wathing-btn-group">
								<a href="#" class="btn-watching" data-bs-toggle="modal" data-bs-target="#trailer-modal">
									<!-- <i class="icofont-play-alt-3"></i> -->
									<i class="icofont-play-alt-2"></i>
									<span>Watch trailer</span>
								</a>
							</div>
						</div>

						<!-- Login Modal -->
						<div class="modal login-modal" id="trailer-modal">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<!-- Modal body -->
									<div class="modal-body d-inline-flex p-0">
										<button type="button" class="modal-right-close" data-bs-dismiss="modal">
											<i class="icofont-close"></i>
										</button>

										<iframe
											id="iframe-show-trailer-1"
											class="w-100"
											height="480"
											src="{{ asset('uploads/trailer/'.$movies->trailer) }}"
											title="YouTube video player"
											{{-- allow="accelerometer; muted; clipboard-write; encrypted-media; gyroscope; picture-in-picture" --}}
											allowfullscreen
										></iframe>
										<script>
											var iframe = document.getElementById('iframe-show-trailer-1');
											iframe.mute();
										</script>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			
			<!-- start cast & actors sliders -->
			<div class="col-md-12 pt-3 pb-3">
				<hr class="text-white" />
				<h3 class="global-title mb-3">Cast & Actors</h3>

				<div class="actors">
					@foreach($cast as $item)
						<div class="actor-box">
							<img src="{{ asset('uploads/'.$item->image) }}" alt="" class="rounded-circle" />
							<p>
								<strong>{{ $item->name }}</strong>
								<span>Actors</span>
							</p>
						</div>
					@endforeach
					
				</div>
				
			</div>
			<!-- end media-box -->
		</div>
	</div>
</div>

<div class="section-watch pt-5 pb-5-">
	<div class="container">
		<div class="row">
			<div class="col-md-12 media-player pe-0">
				<ul class="list-servers">
					<li class="active"><i class="icofont-play-alt-3"></i> LinkBox</li>
					<li><i class="icofont-play-alt-3"></i> GoStream</li>
					<li><i class="icofont-play-alt-3"></i> VIDBOM</li>
					<li><i class="icofont-play-alt-3"></i> ok</li>
					<li><i class="icofont-play-alt-3"></i> Vidshare</li>
					<li><i class="icofont-play-alt-3"></i> Uqload</li>
					<li><i class="icofont-play-alt-3"></i> Uptobox</li>
				</ul>
				<div class="media-iframe-player">
				
					<iframe
											class="w-100"
											height="480"
											src="{{ $link }}"
											title="YouTube video player"
											allowfullscreen
					></iframe>
					
				</div>
			</div>
		</div>
	</div>
</div>

<!-- start servers-download-list -->
<section class="servers-download-list pt-4 pb-5">
	<div class="container">
		<h3 class="global-title mb-4">Download Servers</h3>
		<div class="row">
			<ul class="downloads-list">
				<li>
					<a href="{{ route('client.movie.download.video', ['link' => $movies->trailer, 'name' => $movies->name]) }}">
						
										<i class="icofont-download"></i>
						Downlad Server 1
					</a>
				</li>

				<li>
					<a href="{{ route('client.movie.download.video', ['link' => $movies->trailer, 'name' => $movies->name]) }}">
						<i class="icofont-download"></i>
						Downlad Server 2
					</a>
				</li>

				<li>
					<a href="{{ route('client.movie.download.video', ['link' => $movies->trailer, 'name' => $movies->name]) }}">
						<i class="icofont-download"></i>
						Downlad Server 3
					</a>
				</li>

				<li>
					<a href="{{ route('client.movie.download.video', ['link' => $movies->trailer, 'name' => $movies->name]) }}">
						<i class="icofont-download"></i>
						Downlad Server 4
					</a>
				</li>

				<li>
					<a href="{{ route('client.movie.download.video', ['link' => $movies->trailer, 'name' => $movies->name]) }}">
						<i class="icofont-download"></i>
						Downlad Server 5
					</a>
				</li>
			</ul>
		</div>
	</div>
</section>

<section class="pt-4 pb-5">
	<div class="container">
		<h3 class="global-title mb-3">You May Also Like</h3>

		<div class="row row-cols-2 row-cols-sm-4 row-cols-lg-5 row-cols-xl-5 col-xxl-12">
			@foreach($movies_like as $item)
				<div class="col mt-3">
					<!-- start media-box -->
					<div class="media-box">
						@if($item->type_id == 1)
								<a href="{{ route('client.singlemovies', ['slug' => $item->slug]) }}" class="full-click"></a>
						@elseif($item->type_id == 2)
								<a href="{{ route('client.movieslesson',['slug'=>$item->slug]) }}" class="full-click"></a>
						@endif
						<div class="media-thumb" style="background-image: url('{{ asset('uploads/'.$item->image) }}');"></div>

						<!-- Start media-play -->
						<a href="{{ route('client.singlemovies', ['slug' => $item->slug]) }}" class="media-play">
							<i class="icofont-ui-play"></i>
						</a>
						<!-- Start rate-quality-info -->
						<div class="rate-quality-info">
								@if ($movies->status == 3)
										<span class="media-badge bg-dark">HD</a></span>
								@elseif ($movies->status == 4)
										<span class="media-badge bg-dark">CAM</a></span>
								@elseif ($movies->status == 1)
										<span class="media-badge bg-dark">Còn chiếu</a></span>
								@elseif ($movies->status == 2)
									<span class="media-badge bg-dark">Không còn chiếu</a></span>
								@endif
							<span class="rate icofont-star">9.0</span>
						</div>
						<div class="media-info">
							<a href="{{ route('client.singlemovies', ['slug' => $item->slug]) }}" class="media-box-category">
								<i class="icofont-video-alt"></i>
								Movies
							</a>
							<h5 class="media-box-title">{{ $item->name }}</h5>
						</div>
					</div>
					<!-- end media-box -->
				</div>
			@endforeach
		</div>
	</div>
</section>

@endsection
