<?php

namespace App\Http\Middleware;

use App\Models\Group;
use App\Models\Member;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkInGroup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $Member = Member::where('status' , 'accepted')->get();
        foreach ($Member as $items) {
            if ($items->user_id == Auth::id()){
                return $next($request);
            }
        }

        $group = Group::all();
        foreach ($group as $item) {
            if ($item->owner_id == Auth::id()){
                return $next($request);
            }
        }

        $Member = Member::where('group_id',$request->input('group_id'))->where('user_id' ,  Auth::id())->where('status' , 'accepted')->first();

        return redirect("/todo/search");
    }
}
