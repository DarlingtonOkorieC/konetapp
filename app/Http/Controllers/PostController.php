<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //

$validator = Validator::make($request->all(),[
           'content' => 'required',
       ]);
       
        if($validator->fails()){
            $error = 'You must fill content';
            return view('home', compact('error'));
        }else{
            $post = Post::create([
                'content'=> $request->content,
                'user_id'=> auth::id()
            ]);

        if($request->hasFile('photo')){
        $photo = $request->photo;
        $photo_new_name = time().$photo->getClientOriginalName();
        $photo->move('uploads/photos',$photo_new_name);
        
        $post->photo = 'uploads/photos/'.$photo_new_name;
        }

        if($request->has('feeling')){
        $post->feeling = $request->feeling;
        }

        if($request->hasFile('vid')){
            $vid = $request->vid;
            $vid_new_name = time().$vid->getClientOriginalName();
            $vid->move('uploads/vids',$vid_new_name);
            
            $post->vid = 'uploads/vids/'.$vid_new_name;
            }

          $post->save();
          
          return redirect()->back();
        }
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
    public function update(Request $request, $id)
    {
        //
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
    }
}
