<?php
  /**
   * Alle kommenterte klasser, funksjoner og kode er
   * skrevet av alle i Grp04. 2020
   *
   * Globale funksjoner
   */


  /**
   * Hestetest, trenger jeg å si no mer?
   *
   * @return \Illuminate\Http\Response
   */
  function hesteTest() {
    $hestArr = array("Hest", "Hesten", "Hæst", "Hæsten", "Hæææst",
                     "Hester", "Ponni", "Pålegg-på-4-Bein", "Hæst-Fæst");
    $hestparty = "";
    for ($hest=0; $hest < rand(10,400); $hest++) {
      $hestparty .= $hestArr[array_rand($hestArr)] . ' ';
    }
    return $hestparty;
  }


  /**
   * Velget et tilfeldig bilde
   * fra valgt mappe eller default.
   *
   * @param  $dir
   * @return \Illuminate\Http\Response
   */
  function randomImagesThatWeTotallyOwnFromDirectoryOnMachine($dir = 'img/brukers/') {
    $img = glob($dir . '*.*');
    $randIdx = array_rand($img);

    return '/' . $img[$randIdx];
  }


  /**
   * Velget et random bilde hvis ikke bruker har valgt et selv.
   * Dette skjer hvis 'trip_image' er null.
   * Hvis bruker har valgt et bilde, så ligger det i 'tripImage' mappen.
   * Eller i 'img/brukers' om valgte ikke å laste opp et bilde.
   * Funker fett for .blade. Ross.
   *
   * @param  $image
   * @return \Illuminate\Http\Response
   */
  function giMegBilde($image) {
    if(!is_null($image)) {
      return $image;
    } else {
      $tmp = randomImagesThatWeTotallyOwnFromDirectoryOnMachine();

      return $tmp;
    }
  }


  /**
   * Tar bildet som "bruker" ønsker lastet opp
   * og gir den et nytt navn, "image_20201228223002.ext"
   * og bruker den opprinnelige extensionet.
   * Flytter deretter filen til ny destinasjon.
   *
   * @param  $file
   * @param  $dest
   * @return \Illuminate\Http\Response
   */
  function pakkSammenBilde($file, $dest = 'tripImage/') {
    $img = 'image'. '_' . date('YmdHis') . "." . $file->getClientOriginalExtension();
    $file->move($dest, $img);

    return  '/' . $dest . $img;
  }
