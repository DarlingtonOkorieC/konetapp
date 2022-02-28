<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Friend;
use App\Models\User;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $user_friend = Friend::where('user_id', Auth::user()->id)->get();
        

        $friends = User::where('country_id', Auth::user()->country_id)
    ->where('id', '!==', Auth::id())->get();
    
    $friendoffriends =  Friend::where('user_id', Auth::user()->id)
    ->orWhere('friend_id', Auth::user()->id)->get(); 

    $friendrequests = Friend::where('friend_id', Auth::user()->id)->get();
        if($friendrequests->count() > 0){
            return view('friend.requests')
            ->with('user_friend', $user_friend)
            ->with('friendrequests', $friendrequests);
        }elseif($friends->count() > 0){
        return view('friend.friends')
        ->with('friends', $friends)
        ->with('user_friend', $user_friend)
        ->with('friendoffriends', $friendoffriends)
        ->with('friendrequests', $friendrequests);
    }else{
        $friends = User::orderBy('created_at', 'desc')->take(4)->get();
        return view('friend.friends')
        ->with('friends', $friends)
        ->with('user_friend', $user_friend);
    }
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $friend = Friend::create([
            'user_id' => Auth::user()->id,
            'friend_id' => $user->id
        ]);

        return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        //
        $friend = User::findOrFail($id);

        Friend::create([
            'user_id' => Auth::user()->id,
            'friend_id' => $friend->id
        ]);

        return redirect()->route('friends');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $friend =  Friend::where('friend_id', $id)->first();
        $friend->delete();

        return redirect()->back();
    }
}
