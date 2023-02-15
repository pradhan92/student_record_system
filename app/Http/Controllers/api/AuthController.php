<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\OtpNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //register
    public function register(Request $request)
    {
        $user = new User();
        $user -> name = $request->name;
        $user -> email = $request->email;
        $user -> password = Hash::make($request->password);
        $user -> save();
        return response()->json(['message' =>'Your Account has been successfully registered']);
    }
    //login
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken('token')->plainTextToken;
        return response()->json(['token' => $token]);
    }
    //logout
    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json(['message' => 'You have successfully logged out']);
    }
    //forgot password
    public function forgotPassword(Request $request)
    {
        $email = $request->email;
        $otp = rand(1111, 9999);
        $user = User::where('email', $email)->first();
        $user->password = Hash::make($otp);
        $user->update();
        $data = [
            "message"=>"Dear $user->name,Your otp is $otp,please don't share your otp with others"
        ];
        Notification::send($user, new OtpNotification($data));
        //send the email
        return response()->json(['message' =>'otp has been sent successfully check your mail']);

    }
    //reset password


}
