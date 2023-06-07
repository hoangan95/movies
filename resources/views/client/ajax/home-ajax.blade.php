@if (count($moviesallseach) > 0)
  <div class="row row-cols-2 row-cols-sm-4 row-cols-lg-5">
    <!-- start media-box -->
    @foreach ($moviesallseach as $item)
      <div class="col mt-3">
        <div class="media-box">
          @if($item->type_id == 1)
              <a href="{{ route('client.singlemovies',['slug'=>$item->slug]) }}" class="full-click"></a>
          @elseif($item->type_id == 2)
              <a href="{{ route('client.movieslesson',['slug'=>$item->slug]) }}" class="full-click"></a>
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
            <a href="movies.html" class="media-box-category">
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
@else
  <div class="row mt-5" style="width: 100%; text-align: center; color: white">
    <h3>Không có dữ liệu bạn cần tìm!!!</h3>
  </div>
@endif

<!-- Start pagination -->
<ul class="pagination aster-pagination justify-content-center mt-5 mb-5">
  @foreach ($moviesallseach->forPage(1, $moviesallseach->lastPage()) as $key => $item)
    <li class="page-item">
      <a class="page-link" href="{{ $moviesallseach->url($key + 1) }}">{{ $key + 1 }}</a>
    </li>
  @endforeach	
</ul>