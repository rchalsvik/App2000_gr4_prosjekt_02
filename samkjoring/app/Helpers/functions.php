<?php
  // Funksjoner //
  function jegHater($alt) {
    return "Jeg hater " . $alt;
  }

  function testerMinTålmodighet() {
    $hestArr = array("Hest", "Hesten", "Hæst", "Hæsten", "Hæææst", "Hester", "Ponni", "Pålegg-på-4-Bein", "Hæst-Fæst");
    $hestparty = "";
    for ($hest=0; $hest < rand(10,400); $hest++) {
      $hestparty .= $hestArr[array_rand($hestArr)] . ' ';
    }
    return $hestparty;
  }

  /*
   * Velget et random bilde.
   */
  function randomImagesThatWeTotallyOwnFromDirectoryOnMachine($dir = 'img/brukers/') {
    $img = glob($dir . '*.*');
    $randIdx = array_rand($img);

    return '/' . $img[$randIdx];
  }

  /*
   * Velget et random bilde hvis ikke bruker har valgt et selv.
   * Dette skjer hvis 'trip_image' er null.
   * Hvis bruker har valgt et bilde, så ligger det i 'tripImage' mappen.
   * Eller i 'img/brukers' om valgte ikke å laste opp et bilde.
   * Funker fett for .blade. Ross.
   */
  function giMegBilde($image) {
    if(!is_null($image)) {
      return $image;
    } else {
      $tmp = randomImagesThatWeTotallyOwnFromDirectoryOnMachine();
      return $tmp;
    }
  }


  function pakkSammenBilde($file, $dest = 'tripImage/') {
    $img = 'image'. '_' . date('YmdHis') . "." . $file->getClientOriginalExtension();
    $file->move($dest, $img);
    return  '/' . $dest . $img;
  }


  /*
   * Mekka en liten liste for randomisering av Hallo
   */
  function heyheyGenerator($listBool) {
    if ($listBool) {
      $list = ['Hello', 'Heyhey', 'Hola', 'Howdy', 'G\'day'];
      $tmp = array_rand($list);
      return $list[$tmp];
    } else {
      return 'Hello';
    }

  }
