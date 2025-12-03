<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
<<<<<<< HEAD
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'phone_number' => 'nullable|string|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

=======
    /**
     * معالجة عملية التسجيل (Register).
     */
    public function register(Request $request)
    {
        // 1. التحقق من صحة البيانات (Validation)
        $request->validate([
            'email' => 'required|email|unique:users',
            'phone_number' => 'nullable|string|unique:users',
            'password' => 'required|string|min:8|confirmed', // 'confirmed' تتطلب حقل 'password_confirmation'
        ]);

        // 2. إنشاء المستخدم
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
        $user = User::create([
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

<<<<<<< HEAD
        $token = $user->createToken('auth_token')->plainTextToken;

=======
        // 3. إنشاء رمز (Token) للمصادقة باستخدام Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        // 4. إرجاع الرد
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user,
            'token' => $token,
<<<<<<< HEAD
        ], 201);
    }

    public function registerBakeryOwner(Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|unique:users,phone_number',
            'password' => 'required|string|min:6|confirmed',

        ]);


        $user = User::create([
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'bakery_owner',



        ]);

        return response()->json([
            'message' => 'Bakery owner registered successfully.',
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
            ]
        ], 201);
    }

    public function login(Request $request)
    {

        $request->validate([
            'credential' => 'required|string',
            'password' => 'required|string',
        ]);

        $credential = $request->credential;

=======
        ], 201); // 201 Created
    }

    /**
     * معالجة عملية تسجيل الدخول (Login).
     */
    public function login(Request $request)
    {
        // 1. التحقق من صحة البيانات (Validation)
        // الواجهة تتضمن إما إيميل أو رقم هاتف، لذا نتحقق من وجود أحدهما.
        $request->validate([
            'credential' => 'required|string', // يمكن أن يكون إيميل أو رقم هاتف
            'password' => 'required|string',
        ]);

        // 2. محاولة البحث عن المستخدم بالإيميل أو رقم الهاتف
        $credential = $request->credential;

        // تحديد ما إذا كان المدخل إيميل أو رقم هاتف (افتراض مبسط)
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
        $field = filter_var($credential, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

        $user = User::where($field, $credential)->first();

<<<<<<< HEAD
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'credential' => [__('auth.failed')],
            ]);
        }

        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

=======
        // 3. التحقق من وجود المستخدم وصحة كلمة المرور
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'credential' => [__('auth.failed')], // يمكن استخدام رسالة 'auth.failed' الافتراضية
            ]);
        }

        // 4. حذف الرموز القديمة وإنشاء رمز جديد
        $user->tokens()->delete(); // لإجبار المستخدم على تسجيل الدخول بجلسة واحدة
        $token = $user->createToken('auth_token')->plainTextToken;

        // 5. إرجاع الرد
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
        return response()->json([
            'message' => 'Login successful!',
            'user' => $user,
            'token' => $token,
        ]);
    }

<<<<<<< HEAD
    public function logout(Request $request)
    {
=======
    /**
     * معالجة عملية تسجيل الخروج (Logout).
     */
    public function logout(Request $request)
    {
        // حذف الرمز المستخدم حالياً
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully!'
        ]);
    }
}
