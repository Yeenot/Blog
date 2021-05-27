<?php
namespace App\Services\Users;

use App\Models\User;

class UploadUserImage
{
    public function execute($id, $data)
    {
        $imageName = time().'.'.$data['image']->extension();  
        $data['image']->storeAs('images', $imageName, 'public');
        $user = User::find($id);
        if ($user->profile()->exists())
            $user->profile()->update(['image' => $imageName]);
        else
            $user->profile()->create(['image' => $imageName]);
    }
}