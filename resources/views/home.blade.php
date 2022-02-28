<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ConnetApp</title>
    <link rel="stylesheet" href="{{ asset('app/style.css')}}" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  </head>
  
  <body>
@include('inc.header')
 @if(isset($error))
 {{$error}}
 @endif

 <!-- main body starts -->

    <div class="main__body">
        @include('inc.sidebar')
      <!-- feed starts -->
      
      <div class="feed">
        @if(Auth::user()->friends->count() < 10)
<!-- Trigger/Open The Modal -->
  <button id="myBtn" style="display: none">Open Modal</button>

<!-- The Modal -->
  <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    @if (!isset(Auth::user()->country))
        <form action="{{route('country_post')}}" method="POST">
          {{ csrf_field() }}
          <small>Select a country for more connectivity</small>
          <label for="">Select Country</label>
          <select name="country_id" class="messageSender__input">
            @foreach ($countries as $c)
                <option value="{{$c->id}}">{{$c->country_name}}</option>
            @endforeach
          </select>
          <button class="pad" style="border: none" type="submit">Set</button>
        </form>
    @endif
    <br>
    <p class="font">ConnetApp is better with friends.    <a class="pad" href="{{route('friends')}}">Add friends</a></p> 
  </div>

</div>
      @endif
      
      @if ($friends->count() > 0)
      <p class="font">People You may know</p>     
        <div class="storyReel">
     

            
          <!-- friends starts -->
              @foreach ($friends as $friend)
                  

          <div class="box" style="text-align:center; margin-bottom:4px">
          @if (isset($friend->profile->passport))
            <img
              class="user__avatar story__avatar"
                 src="{{ asset($friend->profile->passport)}}"
                 alt=""
               />
               
              @else
              <img
              class="user__avatar story__avatar"
                 src="{{ asset('app/images/avatar3.jpg')}}"
                 alt=""
               />
                
              @endif
              
            <h4 style="color: rgb(36, 34, 34); margin-bottom: 10px">{{$friend->fname}} {{$friend->lname}}</h4>
          <a href="{{route('friend.add', ['id' => $friend->id])}}" class="pad font">Add Friend</a>
          </div>
          <!-- friends ends -->
          @endforeach
          
          
          
        </div>
        @endif

        <!-- post message starts -->
        <div class="messageSender">
          <div class="messageSender__top">
            <img
              class="user__avatar"
              src="{{ asset('app/images/avatar3.jpg')}}"
              alt=""
            />
            <form action="{{route('post.save')}}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input class="messageSender__input" name="content" placeholder="What's on your mind?" type="text" required/>
            
          </div>

          <div class="messageSender__bottom">
            <div class="messageSender__option">
              <span style="color: red" class="material-icons"> videocam </span>
              
              <h3 onclick="OpenVidUpload()">Video</h3>
            </div>
            <input type="file" id="vidupload" name="vid" accept="video" style="display:none"/>
            <div class="messageSender__option">
              <span style="color: green" class="material-icons"> photo_library </span>
              <input type="file" name="photo" id="imgupload" style="display:none"/>
              <h3 onclick="OpenImgUpload()">Photo</h3>
              <img id="blah" height="70" width="70" src="#" alt="your image" style="display: none"/>
            </div>
            <button class="btn">POST</button>
          </div>
        </form>
        </div>
        <!-- message sender ends -->
        @if ($posts->count() > 0)
            
@foreach ($posts as $p)
    

<div class="post">
  <div class="post__top">
    @if (isset($p->user->profile->passport))
    <img
      class="user__avatar post__avatar"
      src="{{ asset($p->user->profile->passport)}}"
      alt=""
    />    
    @else
    <img
      class="user__avatar post__avatar"
      src="{{ asset('app/images/avatar.png')}}"
      alt=""
    />    
    @endif
    
    <div class="post__topInfo">
      <h3>{{$p->user->fname}} {{$p->user->lname}}</h3>
      <p>{{$p->created_at->diffForHumans()}}</p>
    </div>
  </div>

  <div class="post__bottom">
    <p>Message</p>
  </div>

  <div class="post__image">
    <img
      src="{{ asset('app/images/post1.jpg')}}"
      alt=""
    />
  </div>

  <div class="post__options">
    <div class="post__option">
      <span class="material-icons"> thumb_up </span>
      <p>Like</p>
    </div>

    <div class="post__option">
      <span class="material-icons"> chat_bubble_outline </span>
      <p>Comment</p>
    </div>

    <div class="post__option">
      <span class="material-icons"> near_me </span>
      <p>Share</p>
    </div>
  </div>
</div>
<!-- post ends -->

@endforeach
        <!-- post starts -->
@endif
      </div>
      <!-- feed ends -->

    </div>
    <!-- main body ends -->

    <script>
    // Get the modal

// Get the button that opens the modal
 var btn = document.getElementById("myBtn");

window.onload = function(){
  

          btn.click();
}

setTimeout(() => {
  btn.click();
}, 10000);
var modal = document.getElementById("myModal");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
        function OpenImgUpload(){
          document.getElementById("imgupload").click();
        }
        let imgInp = document.getElementById("imgupload")
        imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
    blah.src = URL.createObjectURL(file)
    blah.style.display = "block"
  }
}
        function OpenVidUpload(){
          document.getElementById("vidupload").click();
        }
        function OpenfeelingUpload() {

          let x = document.getElementById("feelingupload")
          if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }

  
         }
    </script>

    <div id="fb-root"></div>
    <script
      async
      defer
      crossorigin="anonymous"
      src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v10.0"
      nonce="zUxEq08J"
    ></script>
  </body>
</html>