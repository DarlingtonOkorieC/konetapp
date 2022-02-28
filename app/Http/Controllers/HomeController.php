<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Friend;
use App\Models\Country;
use App\Models\Profile;
use Auth;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $user_friends = Auth::user()->friends;

        $user_friends_id = $user_friends->pluck('id');
        $posts = Post::whereIn('user_id', $user_friends_id)
        ->orWhere('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->take(4)->get();
        
        $countries = Country::all();
        $friends = User::where('country_id', Auth::user()->country_id)
    ->where('id', '!==', Auth::id())->get();

        return view('home', [
            'countries' => $countries,
             'posts' => $posts,
             'friends' => $friends    
            ]);
        

        
    }
    public function country(Request $request){
    
        $user = Auth::user();
    
        $profile = Profile::where('user_id', $user->id);
     
        if($profile){ 
            $profile->update([
            'user_id' => $user->id,
            'country_id' => $request->country_id
        ]);
    }else{
        Profile::create([
            'country_id' => $request->country_id
        ]);
    }

    
    $user->update([
        'country_id' => $request->country_id
    ]);

        $success = "You successfully added country.";

        return redirect()->back()->with('success', $success);


// 3082998842
// Polaris
// Wisdom Chibueze
    }
}
