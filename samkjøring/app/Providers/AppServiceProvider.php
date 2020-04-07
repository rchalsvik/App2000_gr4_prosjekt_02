<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade; // Denne må være her slik at vi kan bruke dette i .Blade filer. Ross.

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

      // Legger til noen .Blade funksjoner. Ross.
      Blade::directive('samDateTimeFormat', function($args) {
        list($date, $time) = explode(',', $args);

        return "<?php echo Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date . ' ' . $time)->isoFormat('dddd DD. MMMM - hh:mm'); ?>";
      });

      Blade::directive('samDateFormat', function($arg) {
        $date = $arg;

        return "<?php echo Carbon\Carbon::createFromFormat('Y-m-d', $date)->isoFormat('dddd DD. MMMM'); ?>";
      });

      Blade::directive('samTimeFormat', function($arg) {
        $time = $arg; // Lettere å lese $time

        return "<?php echo Carbon\Carbon::createFromFormat('H:i:s', $time)->isoFormat('hh:mm'); ?>";
      });

    }
}
