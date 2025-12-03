<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsBakeryOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // الشرط الرئيسي: يجب أن يكون المستخدم موجوداً ولديه الدور الصحيح
        if ($user && $user->role === 'bakery_owner') {
            return $next($request);
        }

        // إذا فشل الشرط: رفض الطلب
        // نرجو ملاحظة: الرفض هنا يجب أن يكون استجابة JSON وليس HTML
        return response()->json(['message' => 'Access Denied. Owner rights required.'], 403);
    }
}
