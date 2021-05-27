<?php
namespace App\Services\Comments;

use App\Models\Comment;

class GetComments
{
    public function execute($id)
    {
        return Comment::with('user.profile')->where('post_id', $id)
            ->orderBy('created_at', 'asc')->get();
    }
}