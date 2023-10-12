<?php

namespace App\Http\Controllers\Users;

use App\Helpers\ApiResponder;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    use ApiResponder;

    public function get(Request $request)
    {
        $user = Auth::user();
        return $this->apiResponse($user);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . auth()->user()->id,
            'whatsapp_number' => 'sometimes|required|string|max:20',
            'password' => 'sometimes|nullable|string|min:6|confirmed',
        ]);

        // If the password is set in the request, hash it
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            $validated['password'] = $user->password;
        }

        // Update only the fields that are present in the request
        $user->update($validated);

        return $this->apiResponse(['message' => 'Profile updated successfully'], 200);
    }

    public function checkIfEmailUsed(Request $request) {
        $request->validate([
            'email' => 'email|required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return $this->apiResponse([
                'message' => 'Email already registered',
            ], 409);
        }

        return $this->apiResponse([
            'message' => 'Email is valid',
        ], 200);
    }
}
