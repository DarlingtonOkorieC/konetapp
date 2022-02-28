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
     @if ($user_friend->count() > 0)
         

      @elseif ($friends->count() > 0)    
        <div class="storyReel">
     

            
          <!-- friends starts -->
              @foreach ($friends as $friend)
                  
          @if ($friend->id !== Auth::user()->id)
              

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
              
            <h4 style="color: hsl(0, 3%, 21%); margin-bottom: 10px">{{$friend->fname}} {{$friend->lname}}</h4>
            @if (Auth::user()->friends->count() > 0)
            @foreach (Auth::user()->friends as $f)
              @if ($f->friend_id == $friend->id)
              <a style="border: none; padding: 4px; border-radius: 4px; background:rgb(201, 201, 201); font-style: italic; color:rgb(49, 48, 48);" href="{{route('request.cancel', ['id' => $friend->id])}}">Cancel Request</a>      
              @else
              <a class="pad" href="{{route('friend.add', ['id' => $friend->id])}}">Add Friend</a>
              @endif                
            @endforeach    
            @else
            <a class="pad" href="{{route('friend.add', ['id' => $friend->id])}}">Add Friend</a>
            @endif                                
            
            
          </div>
          @endif
          <!-- friends ends -->
          @endforeach
          
          
          
        </div>
        @endif
        @endif
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