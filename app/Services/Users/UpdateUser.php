<?php
namespace App\Services\Users;

use App\Models\User;
use Illuminate\Support\Arr;

class UpdateUser
{
    public function execute($id, $data)
    {
        $profile = Arr::pull($data, 'profile');
        $user = User::find($id);
        $user->update($data);
        if ($user->profile()->exists())
            $user->profile()->update($profile);
        else 
            $user->profile()->create($profile);

        return $user;
    }
}