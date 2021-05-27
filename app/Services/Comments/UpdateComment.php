<?php
namespace App\Services\Comments;

use App\Models\Post;

class UpdateComment
{
    public function execute($postId, $commentId, $data)
    {
        $comment = Post::find($postId)->comments()->find($commentId);
        $comment->update($data);
        return $comment;
    }
}