<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // Husk denne!!
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
      // Denne her må til for å ikke få en feilmelding når man migrater på Ekstern server. Ross.
      Schema::defaultStringLength(191);

      // Legger til noen .Blade funksjoner. Ross.
      Blade::directive('samDateTimeFormat', function($args) {
        list($date, $time) = explode(',', $args);

        return "<?php echo Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date . ' ' . $time)->isoFormat('HH:mm - dddd DD. MMMM YYYY'); ?>";
      });

      Blade::directive('samDateFormat', function($arg) {
        $date = $arg;

        return "<?php echo Carbon\Carbon::createFromFormat('Y-m-d', $date)->isoFormat('dddd DD. MMMM'); ?>";
      });

      Blade::directive('samYearFormat', function($arg) {
        $date = $arg;

        return "<?php echo Carbon\Carbon::createFromFormat('Y-m-d', $date)->isoFormat('YYYY'); ?>";
      });

      Blade::directive('samFullDateFormat', function($arg) {
        $date = $arg;

        return "<?php echo Carbon\Carbon::createFromFormat('Y-m-d', $date)->isoFormat('dddd DD. MMMM - YYYY'); ?>";
      });

      Blade::directive('samTimeFormat', function($arg) {
        $time = $arg; // Lettere å lese $time

        return "<?php echo Carbon\Carbon::createFromFormat('H:i:s', $time)->isoFormat('HH:mm'); ?>";
      });

      Blade::directive('samDateShortFormat', function($arg) {
        $date = $arg; // Lettere å lese $time

        return "<?php echo Carbon\Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD. MMM'); ?>";
      });

      Blade::directive('samDateYearShortFormat', function($arg) {
        $date = $arg; // Lettere å lese $time

        return "<?php echo Carbon\Carbon::createFromFormat('Y-m-d', $date)->isoFormat('DD. MMM YYYY'); ?>";
      });
    }
}
