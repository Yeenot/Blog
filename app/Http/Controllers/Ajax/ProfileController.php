<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Http\Requests\Users\UserImageUploadRequest;
use App\Services\Users\UpdateUser;
use App\Services\Users\UploadUserImage;
use App\Http\Resources\UserResource;

class ProfileController extends Controller
{
    public function update(UserUpdateRequest $request, UpdateUser $updateUser, $id)
    {
        $user = $updateUser->execute($id, $request->validated());
        return new UserResource($user);
    }

    public function imageUpload(UserImageUploadRequest $request, UploadUserImage $uploadUserImage, $id)
    {
        $uploadUserImage->execute($id, $request->validated());
        return back()
            ->with('success','You have successfully upload image.');
    }
}
