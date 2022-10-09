<?php

namespace App\Providers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('successRedirect', function ($message, $route='', $routePerameter = Null) {
                Toastr::success($message, '', ["progressBar" => true]);
            if(!empty($route)){
                if(is_null($routePerameter)){
                    return redirect()->route($route, $routePerameter);
                }else{
                    return redirect()->route($route, $routePerameter);
                }
            }else{
                return redirect()->back();
            }
        });
        Response::macro('errorRedirect', function ($message, $route='') {
                Toastr::error($message, '', ["progressBar" => true]);
            if(!empty($route)){
                return redirect()->route($route);
            }else{
                return redirect()->back();
            }
        });
    }
}
