<?php

namespace App\Http\Middleware;

use Locale;
use Closure;
use Carbon\Carbon;

class SetApplicationLocale
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
        $locale = Locale::getPrimaryLanguage(
            Locale::acceptFromHttp(
                $request->header('Accept-Language')
            )
        );

        if (in_array($locale, ['ar', 'en'])) {
            app()->setLocale($locale);
            Carbon::setLocale($locale);
        }

        return $next($request);
    }
}
