
@php
    use App\Models\Friend;

    $request = Friend::where('friend_id', Auth::user()->id)
    ->where('accepted', 0)->get();

@endphp

<!-- header starts -->
    <div class="header">
      <div class="header__left">
           <h3 class="font"> ConnetApp </h3>
        <div class="header__input">
          <span class="material-icons"> search </span>
          <input type="text" placeholder="Search ConetApp" />
        </div>
      </div>

      <div class="header__middle">
        <div class="header__option active">
          <span class="material-icons"> home </span>
        </div>
        <div class="header__option">
          <span class="material-icons"> flag </span>
        </div>
        <div class="header__option">
          <span class="material-icons"> subscriptions </span>
        </div>
        <div class="header__option">
          <span class="material-icons"> storefront </span>
        </div>
        <div class="header__option wrapper">
          <span class="material-icons"> supervised_user_circle </span> 
          @if($request->count() > 0)
          <sup class="badge" style="margin-left: -13px">
              {{$request->count()}}
            </sup>
            @endif
        </div>
      </div>

      <a class="dropdown">
      <div class="header__right">
        <div class="header__info">
          @if (isset(Auth::user()->profile->passport))
          <img class="user__avatar"
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
          <h4>{{Auth::user()->fname}}</h4>
        </div>
        <div class="dropdown-content">
          <p onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Logout</p>
        </div>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
        @csrf
      </form>
        <span class="material-icons"> forum </span>
        <span class="material-icons"> notifications_active </span>
      </div>
    </div>
    <!-- header ends -->
