<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ConetApp</title>
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
        
@if (Auth::user()->friends->count() > 10 && !isset(Auth::user()->profile->location))
    
<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <p class="font">Now, set your profile.   <a href=""> View Profile</a></p> 
    </div>
  
  </div>
  
      @endif
     
      @if ($friendrequests->count() > 0)
      
      <div class="storyReel">
     

            
          <!-- friends starts -->
              @foreach ($friendrequests as $friend)
                  

          <div class="box" style="text-align:center; margin-bottom:4px">
          @if (isset($friend->user->profile->passport))
            <img
              class="user__avatar story__avatar"
                 src="{{ asset($friend->user->profile->passport)}}"
                 alt=""
               />
               
              @else
              <img
              class="user__avatar story__avatar"
                 src="{{ asset('app/images/avatar3.jpg')}}"
                 alt=""
               /> 
                
              @endif
              @if ($user_friend->count() > 0)
              @foreach ($user_friend as $fr)
                  @if ($fr->friend_id == $friend->user_id && $fr->user_id == $friend->friend_id)
                  <h4 style="color: rgb(36, 34, 34); margin-bottom: 10px">Message</h4>                   

                  @endif
              @endforeach              
              @else

              <h4 style="color: rgb(36, 34, 34); margin-bottom: 10px">{{$friend->user->fname}} {{$friend->lname}}<small>Sent you a friend request</small></h4> 
              
              <a href="{{route('friend.confirm', ['id' => $friend->user->id])}}" class="pad">Confirm Request</a>
              <a href="{{route('request.cancel', ['id' => $friend->friend_id])}}" class="pad" style="background: rgb(204, 207, 13)">Delete Request</a>
              @endif
            </div>
          <!-- friends ends -->
          @endforeach

          
          
        </div>
        @endif
  
          
          
        </div>

        <!-- post starts -->

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