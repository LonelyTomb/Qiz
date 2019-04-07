<div class="navbar-fixed">
    <nav class="nav">
        <div class="nav-wrapper">
            <a href="{{route('home')}}" class="brand-logo">Qiz</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                @guest
                    <li><a href="{{route('home')}}/#home">Home</a></li>
                    <li><a href="{{route('home')}}/#about">About</a></li>
                    <li><a href="{{route('login')}}" class="modal-trigger">Log In</a></li>
                    @else
                        <li><a href="{{session()->get('homeUrl')}}/home">{{ Auth::user()->name }}</a></li>
                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        @endguest
            </ul>
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi mdi-menu"></i></a>
        </div>
    </nav>
</div>
<ul id="slide-out" class="side-nav">
    @guest
        <li><a href="{{route('home')}}/#home">Home</a></li>
        <li><a href="{{route('home')}}/#about">About</a></li>
        <li><a href="{{route('login')}}" class="modal-trigger">Log In</a></li>
        @else
            <li><a href="#">{{ Auth::user()->name }}</a></li>
            <li><a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
            @endguest
</ul>
