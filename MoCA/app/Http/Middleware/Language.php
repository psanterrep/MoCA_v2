<?php namespace App\Http\Middleware;

use Closure;
use Session;
use App;
use Config;

class Language {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $language = Session::get('language', Config::get('app.locale'));
        App::setLocale($language);

        return $next($request);
    }

}