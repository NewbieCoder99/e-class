<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use App\Setting;
use Session;
use App\Currency;
use App\InstructorSetting;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            \DB::connection()->getPdo();
            Schema::defaultStringLength(191);
            view()->composer('*',function($view){

                    if(\DB::connection()->getDatabaseName()){
                        if(Schema::hasTable('settings')){
                    $project_title = Setting::first()->project_title;
                    $cpy_txt = Setting::first()->cpy_txt;
                    $gsetting = Setting::first();
                    $currency = Currency::first();
                    $isetting = InstructorSetting::first();
                    $zoom_enable = Setting::first()->zoom_enable;
                    $view->with([
                        'project_title' => $project_title,
                        'cpy_txt'=> $cpy_txt,
                        'gsetting' => $gsetting,
                        'currency' => $currency,
                        'isetting' => $isetting,
                        'zoom_enable' => $zoom_enable
                    ]);
                    }
                }
            });
        }catch(\Exception $ex){

          return redirect('/get/step2');
        }
    
    }
}
