<?php
namespace App\Services\Comments;

use App\Models\Post;

class DeleteComment
{
    public function execute($postId, $commentId)
    {
        return Post::find($postId)->comments()->find($commentId)->delete();
    }
}