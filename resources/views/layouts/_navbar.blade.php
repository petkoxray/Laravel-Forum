<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel Forum') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li>
                    <a href="/threads/create">New Thread</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Browse <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <li><a href="/threads">All Threads</a></li>

                        @auth
                            <li><a href="/threads?by={{ auth()->user()->username }}">My Threads</a></li>
                        @endauth
                        <li><a href="/threads?popular=1">All Time Popular</a></li>
                        <li><a href="/threads?unanswered=1">Unanswered Threads</a></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Channels <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        @forelse ($channels as $channel)
                            <li><a href="/threads/{{ $channel->slug }}">{{ $channel->name }}</a></li>
                        @empty
                            <h4>No records for this channel :(</h4>
                        @endforelse
                    </ul>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <div class="pull-right">
                        <form class="navbar-form pull-right" method="get" role="search"
                              action="{{route('threads_search')}}">
                            <div class="input-group">
                                <input name="q" type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><span
                                                class="glyphicon glyphicon-search"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <user-notifications></user-notifications>
                    @role('admin')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><i class="icon-eye-open mr-05"></i> Admin Panel <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{route('admin_channels_all')}}">Manage Channels</a></li>
                        </ul>
                    </li>
                    @endrole
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            <i class="icon-user mr-05"></i> {{ Auth::user()->username }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{route('user_profile', Auth::user())}}">My Profile</a></li>
                            <li><a href="{{route('user_settings', Auth::user())}}">My Settings</a></li>

                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
