<?php

namespace App\Http\Controllers\Auth_Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Gate;
use Hash;
use Illuminate\Http\Request;

class UpdateUserPassword extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
        if (Gate::denies('edit_user')) return abort(401);

        $data = $this->validate($request, [
            'oldPsw' => ['required'],
            'newPsw' => ['required','same:passwordConfirmation']
        ]);

        if (Hash::check($data['oldPsw'], $user->password)) {
            $user->password = Hash::make($request->input('newPsw'));
            $user->save();
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
}
