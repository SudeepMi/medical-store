<?php

namespace App\Http\Middleware;

use App\Models\SoftwareSetting;
use Closure;

class setup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (is_null(SoftwareSetting::where('slug','is-shown')->first())){
            return redirect()->route('setup_wizard.index');
        }
        return $next($request);
    }
}
