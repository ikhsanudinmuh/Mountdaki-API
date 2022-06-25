<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function loginUser(Request $request) {
        $validator = Validator::make($request->only('email', 'password'), [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->first();

        if(!$user) {
            return $this->sendError('Akun dengan email tersebut tidak ditemukan');
        }

        if (!Hash::check($request->password, $user->password)) {
            return $this->sendError('Password salah!', 401);
        }

        $token = $user->createToken($request->email, ['user'])->plainTextToken;
        return $this->sendResponse([
            'name' => $user->name,
            'id' => $user->id,
            'access_token' => $token
        ], 'Login Berhasil');
    }

    public function loginAdmin(Request $request) {
        $validator = Validator::make($request->only('email', 'password'), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 422);
        }

        $admin = Admin::where('email', $request->email)->first();

        if(!$admin) {
            return $this->sendError('Akun dengan email tersebut tidak ditemukan');
        }

        if (!Hash::check($request->password, $admin->password)) {
            return $this->sendError('Password salah!', 401);
        }

        $token = $admin->createToken($request->email, ['admin'])->plainTextToken;
        return $this->sendResponse([
            'name' => $admin->name,
            'access_token' => $token
        ], 'Login Berhasil');
    }
}
