<!DOCTYPE html>
<html lang="en">
	<!-- Mirrored from leeucode.site/demo/aster-cima/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 26 Apr 2023 02:37:54 GMT -->
	@include('client.pages.block.head')

	<body>
    @include('client.pages.block.header')
		@if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      @if(Session::has('error'))
        <p class="alert alert-danger">{{ Session::get('error') }}</p>
      @endif

	

		
	@yield('content')

    @include('client.pages.block.footer')

			

		<!-- Login Modal -->
		<div class="modal login-modal" id="login-modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- Modal body -->
					<div class="modal-body">
						<button type="button" class="modal-right-close" data-bs-dismiss="modal">
							<i class="icofont-close"></i>
						</button>

						<h5 class="modal-title text-center text-white"><i class="icofont-wink-smile"></i> Welcome back!</h5>

						<form action="{{ route('client.login') }}" method="post">
							@csrf
							<div class="mb-3 mt-3">
								<label for="email" class="form-label">Email:</label>
								<div class="input-group">
									<span class="input-group-text"><i class="icofont-at"></i></span>
									<input id="email" type="text" class="form-control" placeholder="Username" name="email" />
								</div>
							</div>
							<div class="mb-3">
								<label for="pwd" class="form-label">Password:</label>
								<div class="input-group">
									<span class="input-group-text"><i class="icofont-key"></i></span>
									<input id="pwd" type="password" class="form-control" placeholder="Password" name= "password" />
								</div>
							</div>
							<div class="form-check mb-3">
								<label class="form-check-label"> <input class="form-check-input" type="checkbox" name="remember" /> Remember me </label>
							</div>
							<div class="d-grid">
								<button class="btn btn-primary btn-block"><i class="icofont-login"></i> Login</button>
							</div>
						</form>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer text-center">Don't have an account? <a href="{{ route('client.registration') }}" title="Register" class="link-highlight">Register</a></div>
				</div>
			</div>
		</div>
		

    @include('client.pages.block.foot')

	</body>

	<!-- Mirrored from leeucode.site/demo/aster-cima/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 26 Apr 2023 02:38:12 GMT -->
</html>
