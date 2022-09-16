<?php

namespace App\Http\Controllers\Auth_Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UpdateProfileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(UpdateUserProfileRequest $request, User $user): \Illuminate\Http\JsonResponse
    {
        if (Gate::denies('edit_user')) return abort(401);
        $data = $request->validated();
        if($request->filled('oldPsw')) {
            if (Hash::check($data['oldPsw'], $user->password)) {
                $user->update(['name' => $data['name'], 'password' => Hash::make($data['newPsw'])]);
                $user['supplier'] = $user->supplier;
                $user['role_name'] = $user->roles->pluck('name');
                return response()->json(['message' => 'Successful update info!', 'user' => $user]);
            } else {
                return response()->json(
                    ['error' => 'Old password not matched.'],
                    422
                );
            }
        }

        $user->update(['name' => $data['name']]);
        if ($request->avatar) {
            $file = $request->avatar;
            $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $type = 'image';
            $path = $file->storeAs('users/' . $user->id . '/' . $type . '/', $name . '.' . $extension);
            $user->profile()->updateOrCreate(['contact_fname' => $user->name, 'avatar' => $path], ['avatar' => $path]);
            $user['userAvatarLink'] = $user->profile->avatar;
        }
        $loads = [];
        if ($user->hasRole('customer')) {
            $loads[] = 'customer';
            $user['avatarCustLink'] = asset('storage/customers/' . $user->id . '/');
        }
        if ($user->hasRole('supplier')) {
            $loads[] = 'supplier';
            $user['logoSuplLink'] = asset('storage/suppliers/' . $user->id . '/');
        }
        $user->load($loads);
        return response()->json(['message' => 'Successful update info.!', 'user' => $user]);
    }
}
