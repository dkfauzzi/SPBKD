<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            $level = auth()->check() ? auth()->user()->level : null;

            switch ($level) {
                case 'dekan':
                    return route('dekan-login')->with('warning', 'Please log in to access this page.');
                case 'wakildekan1':
                    return route('dekan-login', ['level' => 'wakildekan1'])->with('warning', 'Please log in to access this page.');
                case 'wakildekan2':
                    return route('dekan-login', ['level' => 'wakildekan2'])->with('warning', 'Please log in to access this page.');  
                case 'sekretariat':
                    return route('sekretariat-login')->with('warning', 'Please log in to access this page.');
                case 'sekretariat2':
                    return route('sekretariat2-login')->with('warning', 'Please log in to access this page.');
                case 'prodi':
                    return route('prodi-login')->with('warning', 'Please log in to access this page.');
                case 'kk':
                    return route('kk-login')->with('warning', 'Please log in to access this page.');
                case 'dosen':
                    return route('dosen-login')->with('warning', 'Please log in to access this page.');
            }
        }
    }
}

