@php 
    $locale = session()->get('locale');
    $user = session()->get('user');
    $usernme="name_".$locale;
    $address="address1_".$locale;
@endphp
<nav class="main-header navbar navbar-expand-sm navbar-toggleable-sm navbar-light js-nav-bg elevation-1 js-nav-text">
        <!-- Left navbar links -->
        <ul class="navbar-nav js-nav-text">
            <li class="nav-item">
                <a class="nav-link js-nav-text" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ url('/home') }}" class="nav-link js-nav-text"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('issue.index') }}" class="nav-link js-nav-text"><i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;Issue</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('return.index') }}" class="nav-link js-nav-text"><i class="fa fa-level-down" aria-hidden="true"></i>&nbsp;Return</a>
            </li>
            
            
        </ul>


        <!-- ------------------- -->
    
        <!-- ------------------- -->
     
      <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
            <div class="dropdown pull-right">
                  <a type="button" class="dropdown-toggle mr-3" data-toggle="dropdown">{{__('Theme')}}</a>
                  <div class="dropdown-menu dropdown-menu-right mt-2">
                    <a class="dropdown-item" href="{{ route('change_theme','js-colour') }}">LMS Colour</a>
                    <a class="dropdown-item" href="{{ route('change_theme','js-blue-dark') }}">LMS Blue dark</a>
                    <a class="dropdown-item" href="{{ route('change_theme','js-blue-light') }}">LMS Blue light</a>
                    <a class="dropdown-item" href="{{ route('change_theme','js-orange-dark') }}">LMS Orange dark</a>
                    <a class="dropdown-item" href="{{ route('change_theme','js-orange-light') }}">LMS Orange light</a>
                    <a class="dropdown-item" href="{{ route('change_theme','js-green-dark') }}">LMS Green dark</a>
                    <a class="dropdown-item" href="{{ route('change_theme','js-green-light') }}">LMS Green light</a>
                    <a class="dropdown-item" href="{{ route('change_theme','js-dark') }}">LMS Dark</a>
                    <a class="dropdown-item" href="{{ route('change_theme','js-light') }}">LMS Light</a>
                  </div>
            </div>
        </li>
       <li class="nav-item dropdown">
            <div class="dropdown pull-right">
                  <a type="button" class="dropdown-toggle mr-3" data-toggle="dropdown">
                  @switch($locale)
                      @case('si')
                      <img src="{{ asset('img/si.png') }}" width="32px" height="30px">&nbsp; සිංහල
                      @break
                      @case('ta')
                      <img src="{{ asset('img/si.png') }}" width="32px" height="30px">&nbsp; தமிழ்
                      @break
                      @default
                      <img src="{{ asset('img/en.png') }}" width="32px" height="25px">&nbsp; English
                      @endswitch
                  
                  </a>
                  <div class="dropdown-menu dropdown-menu-right mt-2">
                    <a class="dropdown-item" href="lang/si">Sinhala</a>
                    <a class="dropdown-item" href="lang/ta">Tamil</a>
                    <a class="dropdown-item" href="lang/en">English</a>
                  </div>
            </div>
        </li>
        
        <li class="nav-item dropdown user user-menu mt-1">
            
            <a href="#" class="dropdown-toggle js-nav-text" data-toggle="dropdown">
                @if(!empty($user->image))
                    <img src="{{ asset('images/staffs/'.$user->image) }}" class="user-image" alt="User">
                @else
                    <img src="{{ asset('img/user.png') }}" class="user-image" alt="User">
                @endif
                {{-- <span class="hidden-xs">Code-JS</span> --}}
            </a>
            <ul class="dropdown-menu dropdown-menu-md dropdown-menu-right mt-2">
                <!-- User image -->
                <li class="user-header js-nav-text">
                @if(!empty($user->image))
                    <img src="{{ asset('images/staffs/'.$user->image) }}" class="img-circle" alt="User">
                @else
                    <img src="{{ asset('img/user.png') }}" class="img-circle" alt="User">
                @endif
                   
                    <p>
                        <span class="text-dark"> Library management System</span>
                        @guest
                                
                        @else
                        <span class="font-weight-bold text-dark">@if(!empty($user)){{$user->$usernme}} @endif</span>
                        <!-- <span class="font-weight-bold text-primary">@if(!empty($user)){{$user->$address}} @endif</span> -->
                        @endguest
                    </p>
                </li>
                <!-- Menu Body -->
            
                <!-- Menu Footer-->
                <li class="user-footer">
                    @guest
                    <div class="row">
                        <div class="col-md-6 "> 
                        <a id="navbarDropdown" class="" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </div>
                    <div class="col-md-6 ">
                        <a id="navbarDropdown" class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </div>
                    </div>
                    @else
                    <div class="row">
                    <div class="col-md-6 "> 
                    <a href="#" class="btn btn-default btn-sm">Profile</a>
                    </div>
                    <div class="col-md-6 text-right">
                    <a class="btn btn-default btn-sm" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> &nbsp;
                            {{ __('Logout') }}
                        </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                    </div>
                    </div>
                    


                    @endguest
                </li>
            </ul>

        
        </li>
        
    </ul>
    

</nav>
