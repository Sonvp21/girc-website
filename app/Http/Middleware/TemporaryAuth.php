<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TemporaryAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Chỉ áp dụng trong môi trường thử nghiệm
        if (App::environment('local', 'testing', 'production')) {
            // Mật khẩu tạm thời
            $username = 'testuser';
            $password = 'TempPass123!'; // Mật khẩu tạm thời

            // Kiểm tra Basic Auth
            if (!$request->getUser() || !$request->getPassword() ||
                $request->getUser() !== $username || $request->getPassword() !== $password) {
                return response('Unauthorized', 401, ['WWW-Authenticate' => 'Basic']);
            }
        }

        return $next($request);
    }
}