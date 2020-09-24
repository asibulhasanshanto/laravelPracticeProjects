<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment();

        $comment->comment = $request->comment;

        $comment->user()->associate($request->user());

        $post = Post::find($request->post_id);

        $post->comments()->save($comment);

        return back();
    }

    public function replyStore(Request $request)

    {
        $reply = new Comment();

        $reply->comment = $request->get('comment');

        $reply->user()->associate($request->user());
        $comment_id = $request->get('comment_id');
        $comment = Comment::find($comment_id);

        if ($comment->parent_id) {
            $reply->parent_id = $comment->parent_id;
        } else {
            $reply->parent_id = $request->get('comment_id');
        }
        $post = Post::find($request->get('post_id'));


        $post->comments()->save($reply);

        return back();
    }
}
