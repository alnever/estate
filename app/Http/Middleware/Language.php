<?php

namespace App\Http\Middleware;

use Closure;

class Language
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
        // get 1st segment of the URL
        $segment = $request->segment(1);

        // if the segement is not in the site locales array
        if (!in_array($segment, config('app.locales'))) {
            // get all segements
            $segments = $request->segments();
            // get the fallback locale
            $fallback = session('locale') ? : config('app.fallback_locale');
            // prepare a new segements array with fallback locale as a 1st segment
            $segments = array_prepend($segments, $fallback);
            // redirect to the URL with a fallback locale
            return redirect()->to(implode('/',$segments));
        }

        session()->put('locale', $segment);
        app()->setLocale($segment);

        $request->route()->forgetParameter('lang');

        return $next($request);
    }
}
