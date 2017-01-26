<div class="top-bar"><!-- TOP BAR START -->

    <div class="top-bar-left">
        <ul>
            <li class="menu-text">
                <a href="{{ Auth::guest() ? url('/') : url('/home') }}">
                    <img class="logo" src="/img/indulge.png">
                </a>
            </li>
        </ul>
    </div>

    <div class="top-bar-right">
        <!-- Authentication Links -->
        @if (Auth::guest())
            <div class="menu right-menu">
                <a href="{{ url('/login') }}" type="button" class="button myBtn">Login</a>
                <a href="{{ url('/register') }}" type="button" class="button myBtn">Register</a>
            </div>
        @else
            <ul id="indulge-menu" class="no-bullet vertical medium-horizontal dropdown menu right-menu" data-dropdown-menu>
                <li class="is-down-arrow">
                    <a>{{ Auth::user()->first_name }}</a>
                    <ul class="menu">
                        <li><a href="{{ url('/profile/edit')}}">Edit Profile</a></li>
                        <li><a href="{{ url('/profile/change-password')}}">Change Password</a></li>
                        <li><a href="{{ url('/logout') }}">Logout</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('/home') }}"><p class="{{ url()->current()===url('/home') ? 'active' : '' }}">Home</p></a></li>
                <li><a href="{{ url('/user', [Auth::user()->username]) }}"><p class="{{ url()->current()===url('/user' , [Auth::user()->username]) ? 'active' : '' }}">Profile</p></a></li>
                <li><a href="{{url('/messages')}}"><p class="{{ url()->current()===url('/messages') ? 'active' : '' }}">Messages</p></a></li>
                <li><a href="{{ url('/friends') }}"><p class="{{ url()->current()===url('/friends') ? 'active' : '' }}">Friends @if (Auth::user()->friendRequests()->count() !== 0)
                    ({{Auth::user()->friendRequests()->count()}})
                @endif</p></a></li>
            </ul>
        @endif
    </div>
</div><!-- TOP BAR END -->
