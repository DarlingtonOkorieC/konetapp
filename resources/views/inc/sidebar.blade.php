      <!-- sidebar starts -->
      <div class="sidebar">
        <a href="{{route('home')}}">
        <div class="sidebarRow">
          @if (isset(Auth::user()->profile->passport))
          <img
            class="user__avatar"
               src="{{ asset(Auth::user()->profile->passport)}}"
               alt=""
             />
            @else
            <img
            class="user__avatar"
               src="{{ asset('app/images/avatar3.jpg')}}"
               alt=""
             />
             @endif
             <h4>{{Auth::user()->fname}} {{Auth::user()->lname}}</h4>
            </div>
          </a> 

        <div class="sidebarRow">
          <span class="material-icons"> local_hospital </span>
          <h4>Health & Fitness</h4>
        </div>

        <div class="sidebarRow">
          <span class="material-icons"> emoji_flags </span>
          <h4>Pages</h4>
        </div>

        <a href="{{route('friends')}}">
        <div class="sidebarRow">
          <span class="material-icons"> people </span>
          <h4>Friends</h4>
        </div>
      </a>

        <div class="sidebarRow">
          <span class="material-icons"> chat </span>
          <h4>Messenger</h4>
        </div>

        <div class="sidebarRow">
          <span class="material-icons"> storefront </span>
          <h4>Affiliate Program</h4>
        </div>
        <div class="sidebarRow">
          <span class="material-icons"> money </span>
          <h4>Finance</h4>
        </div>

        <div class="sidebarRow">
          <span class="material-icons"> video_library </span>
          <h4>Videos</h4>
        </div>

        <div class="sidebarRow" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
          <span class="material-icons"> person </span>
          <h4>Logout</h4>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
          @csrf
        </form>
      </div>
      <!-- sidebar ends -->
