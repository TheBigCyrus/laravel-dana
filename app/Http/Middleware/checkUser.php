<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()){
        return $next($request);
        }
        return redirect('notification/ابتدا باید وارد سایت شوید/error')->with([
        'message' => 'ابتدا باید وارد سایت شوید',
        'type'    => 'error']);
    }
}
