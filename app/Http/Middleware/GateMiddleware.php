<?php

namespace App\Http\Middleware;
use Closure;

class GateMiddleware
{
    /**
     * Проверка роли пользователя на доступ к определенным разделам
     *
     * @param $request
     * @param Closure $next
     * @param $roles
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        $roles = explode('|', $roles);
        if (auth()->user()->roles->pluck('slug')->intersect($roles)->count() > 0) {
            return $next($request);
        }else {
            abort(403);
        }
    }
}