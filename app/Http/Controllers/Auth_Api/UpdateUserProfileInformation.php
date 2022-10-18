<?php

namespace App\Http\Controllers\Auth_Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UpdateUserProfileInformation extends Controller
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

        $user->update(['name' => $data['name']]);
        if($request->file('avatar')) {
            $user->storeFile($request->file('avatar'));
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
