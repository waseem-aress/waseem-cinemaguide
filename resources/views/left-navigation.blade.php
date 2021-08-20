<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('images/sidebar-1.jpg')}}">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="{{ url('/')}}" class="simple-text logo-normal">
          Cinema Guide
      </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="@if(Request::is('cinemas') || Request::is('cinemas/*') || Request::is('/')) active @endif nav-item">
            <a class="nav-link" href="{{url('/cinemas')}}">
              <i class="material-icons">Cinemas</i>
              <p>Cinema List</p>
            </a>
          </li>
          <li class="@if(Request::is('movies') || Request::is('movies/*') ) active @endif nav-item">
            <a class="nav-link" href="{{url('/movies')}}">
              <i class="material-icons">Movies</i>
              <p>Movies List</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{url('/logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="material-icons">Logout</i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </div>
    </div>