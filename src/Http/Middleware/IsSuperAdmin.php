<?php

namespace Jawadabbass\LaravelPermissionUuid\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IsSuperAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard(config('jawad_permission_uuid.guard', null))->user()->user_type == 'super_admin'){
            return $next($request);
        }
        dd("You don't have admin access.");
    }
}
