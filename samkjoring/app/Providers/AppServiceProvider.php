<?php
/**
 * Alle kommenterte klasser, funksjoner og kode er
 * skrevet av alle i Grp04. 2020
 *
 * Globale funksjoner
 */

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
    // Denne her må til for å ikke få en feilmelding når man
    // migrater på Ekstern server. Ross.
    Schema::defaultStringLength(191);


    /**
    * Formaterer DatoTid.
    * Brukes i .blade filene:
    * @samDateTimeFormat([$args])
    *
    * @param  [$arg1, $arg2]
    * @return \Illuminate\Http\Response
    */
    Blade::directive('samDateTimeFormat', function($args) {
      list($date, $time) = explode(',', $args);

      return "<?php echo Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date . ' ' . $time)->isoFormat('HH:mm - dddd DD. MMMM YYYY'); ?>";
    });


    /**
    * Formaterer Dato Uten År.
    * Brukes i .blade filene:
    * @samDateFormat($arg)
    *
    * @param  $arg
    * @return \Illuminate\Http\Response
    */
    Blade::directive('samDateFormat', function($arg) {
      return "<?php echo Carbon\Carbon::createFromFormat('Y-m-d', $arg)->isoFormat('dddd DD. MMMM'); ?>";
    });


    /**
    * Formaterer År.
    * Brukes i .blade filene:
    * @samYearFormat($arg)
    *
    * @param  $arg
    * @return \Illuminate\Http\Response
    */
    Blade::directive('samYearFormat', function($arg) {
      return "<?php echo Carbon\Carbon::createFromFormat('Y-m-d', $arg)->isoFormat('YYYY'); ?>";
    });


    /**
    * Formaterer Full Dato.
    * Brukes i .blade filene:
    * @samFullDateFormat($arg)
    *
    * @param  $arg
    * @return \Illuminate\Http\Response
    */
    Blade::directive('samFullDateFormat', function($arg) {
      return "<?php echo Carbon\Carbon::createFromFormat('Y-m-d', $arg)->isoFormat('dddd DD. MMMM - YYYY'); ?>";
    });


    /**
    * Formaterer Tid.
    * Brukes i .blade filene:
    * @samTimeFormat($arg)
    *
    * @param  $arg
    * @return \Illuminate\Http\Response
    */
    Blade::directive('samTimeFormat', function($arg) {
      return "<?php echo Carbon\Carbon::createFromFormat('H:i:s', $arg)->isoFormat('HH:mm'); ?>";
    });


    /**
    * Formaterer Dato i kortformat.
    * Brukes i .blade filene:
    * @samDateShortFormat($arg)
    *
    * @param  $arg
    * @return \Illuminate\Http\Response
    */
    Blade::directive('samDateShortFormat', function($arg) {
      return "<?php echo Carbon\Carbon::createFromFormat('Y-m-d', $arg)->isoFormat('DD. MMM'); ?>";
    });


    /**
    * Formaterer Dato m/år i kortformat. År er i full-lengde.
    * Brukes i .blade filene:
    * @samDateYearShortFormat($arg)
    *
    * @param  $arg
    * @return \Illuminate\Http\Response
    */
    Blade::directive('samDateYearShortFormat', function($arg) {
      return "<?php echo Carbon\Carbon::createFromFormat('Y-m-d', $arg)->isoFormat('DD. MMM YYYY'); ?>";
    });
  }
}
