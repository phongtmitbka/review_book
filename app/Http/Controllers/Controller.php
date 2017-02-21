<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Auth;
use App;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->login();
    }

    function login()
    {
        if(Auth::check())
        {
            $user = Auth::user();
            if($user->language == 0)
                $lang = 'en';
            else 
                $lang = 'vi';
            App::setlocale($lang);
            view()->share('user_login', $user);
        }
    }
}
