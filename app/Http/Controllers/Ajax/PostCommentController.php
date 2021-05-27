<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\Comments\CommentStoreRequest;
use App\Http\Requests\Comments\CommentUpdateRequest;
use App\Services\Comments\GetComments;
use App\Services\Comments\CreateComment;
use App\Services\Comments\UpdateComment;
use App\Services\Comments\DeleteComment;
use App\Http\Resources\CommentResource;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetComments $getComments, $postId)
    {
        $comments = $getComments->execute($postId);
        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentStoreRequest $request, CreateComment $createComment, $postId)
    {
        $comment = $createComment->execute($postId, $request->validated());
        $comment->load('user');
        return new CommentResource($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentUpdateRequest $request, UpdateComment $updateComment, $postId, $commentId)
    {
        $comment = $updateComment->execute($postId, $commentId, $request->validated());
        $comment->load('user');
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteComment $deleteComment, $postId, $commentId)
    {
        $deleteComment->execute($postId, $commentId);
    }
}
