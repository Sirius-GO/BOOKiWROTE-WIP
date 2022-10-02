<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use Auth;
use App\Models\Contact;


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
        view()->composer('*', function($view) {  
            if (Auth::check()) {  
                if(auth()->user()->id == '1'){
                    $contact_form = Contact::where('r_id', '1')
                                            ->where('is_read', '0')
                                            ->orWhere('r_id', Null)
                                            ->where('is_read', '0')
                                            ->orWhere('r_id', '0')
                                            ->where('is_read', '0')
                                            ->get();                
                } else {
                    $contact_form = Contact::where('r_id', auth()->user()->id)
                                            ->where('is_read', '0')
                                            ->orWhere('r_id', '0')
                                            ->where('is_read', '0')
                                            ->get(); 
                }    
            } else {
                    $contact_form = [];
            }
            view()->share('contact_form', $contact_form);
        }); 






    }
}
