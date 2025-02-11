<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordResetController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Create a token
        $token = Str::random(60);

        // Store the token in the password_resets table
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        Mail::send('emails.PasswordReset', ['token' => $token], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Domaino Startup Password Reset Request');
        });

        return response()->json(['message' => 'Reset link sent']);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8',
        ]);

        $reset = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        if (!$reset) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        $user = User::where('email', $reset->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the token
        DB::table('password_reset_tokens')->where('token', $request->token)->delete();

        return response()->json(['message' => 'Password reset successful']);
    }
}
