Det er visst vanlig å lage en 'Helpers' mappe i Laravel for å lagre funkskjoner.
Ross.


- Enten lagre funksjonene i hver sin tekstfil eller samlet i functions.php.

- Lag enten app\Helpers mappe eller app\Helpers.php.

- Autoloader - composer.json filen må ha informasjon
  "autoload": {
   "classmap": ["database"],
   "psr-4": {"App\\": "app/"},
   "files" : ["app/Helper.php"]
   // ELLER
   "files" : ["app/Helper/function.php"]
  }

- Kjør (Trengs bare når man legger til extra filer i autoloaderen(composer.json)!)
  --> composer dumpautoload

- Bruk eks.
  --> minFunksjon($hest);
  --> {{ minFunksjon($hest) }}
