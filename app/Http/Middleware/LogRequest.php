<?php

namespace App\Http\Middleware;

use Closure;

class LogRequest
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // Tiếp tục xử lý middleware sau khi Controller trả response
        // \Log::info('Request processed', [
        //     'url' => $request->url(),
        //     'method' => $request->method(),
        //     'status_code' => $response->status(),
        // ]);
    }
}