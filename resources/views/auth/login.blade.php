@extends('layouts.login')

@section('content')
<!-- ============================================================================== -->

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url({{ asset('img/login-bg.jpg') }});">
					<span class="login100-form-title-1">
						Sign In - LMS
					</span>
				</div>

				<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                @csrf
					<div class="wrap-input100 validate-input m-b-15" data-validate="Username or Email is required">
						<span class="label-input100">{{ __('User name Or EMail') }}</span>
                        <input id="username" type="username" class="input100" name="username" value="{{ old('username') }}"  autofocus>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-15" data-validate = "Password is required">
						<span class="label-input100">{{ __('Password') }}</span>
                        <input id="password" type="password" class="input100" name="password"  autocomplete="current-password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-15">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
                            {{ __('Remember Me') }}
							</label>
						</div>
					</div>
                    <div class="flex-sb-m w-full p-b-20">
                        @if (Route::has('password.request'))
                        <a class="txt1" href="#"> 
							<!-- href="{{ route('password.request') }}" -->
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
                        {{ __('Login') }}
						</button>
					</div>

                    

				</form>

			</div>
		</div>
	</div>


<!-- ============================================================================== -->
@endsection
