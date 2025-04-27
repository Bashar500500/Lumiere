<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PasswordResetCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\User\User;

class CustomPasswordResetController extends Controller
{
    public function sendResetCode(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $user = User::where('email', $request->email)->first();
    if (!$user) {
        return response()->json(['message' => 'Email not found'], 404);
    }

    $code = rand(100000, 999999);

    PasswordResetCode::updateOrCreate(
        ['email' => $request->email],
        ['code' => $code, 'created_at' => now()]
    );

    // أرسل الإيميل (يمكنك تخصيصه لاحقًا)
    Mail::raw("Your password reset code is: $code", function ($message) use ($request) {
        $message->to($request->email)->subject('Password Reset Code');
    });

    return response()->json(['message' => 'Reset code sent.']);
}

public function verifyResetCode(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'code' => 'required|string',
        'password' => 'required|confirmed|min:6'
    ]);

    $reset = PasswordResetCode::where('email', $request->email)
                              ->where('code', $request->code)
                              ->first();

    if (!$reset || Carbon::parse($reset->created_at)->addDay()->isPast()) {
        return response()->json(['message' => 'Invalid or expired code'], 400);
    }

    $user = User::where('email', $request->email)->first();
    $user->update(['password' => bcrypt($request->password)]);

    // حذف الكود بعد الاستخدام
    $reset->delete();

    return response()->json(['message' => 'Password reset successful']);
}
}
