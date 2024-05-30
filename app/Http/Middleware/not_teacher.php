<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class not_teacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guard('teacher')->check()){
            return redirect('/teacher/quiz/showAll');
        }elseif (auth()->guard('admin')->check()){
            return redirect('/admin/teachers/show/type/all');
        }else {return $next($request);}


    }
}
