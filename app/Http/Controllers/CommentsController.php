<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;

class CommentsController extends Controller
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
        $this->validate($request,array([
            'name'=>'required|max:255',
            'email'=>'required|max:255',
            'comment'=>'required|min:5|max:2000'
        ]));
        $comment = new Comment;
        $comment->name = $request->get('name');
        $comment->email = $request->get('email');
        $comment->comment = $request->get('comment');
        $comment->approved = true;

        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);

        session()->flash('success','Comment added successfully.');

        return redirect()->route('blog.show',$post);
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

    public function replyStore(Request $request)
    {
        $reply = new Comment();
        $reply->name = $request->get('name');
        $reply->email = $request->get('email');
        $reply->comment = $request->get('comment');
        $reply->parent_id = $request->get('comment_id');
        $reply->approved = true;

        $post = Post::find($request->get('post_id'));

        $post->comments()->save($reply);

        return back();

    }
}
