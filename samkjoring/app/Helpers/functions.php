<?php
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

  function randomImagesThatWeTotallyOwnFromDirectoryOnMachine($dir = 'img/brukers') {
    $img = glob($dir . '/*.*');
    $randIdx = array_rand($img);

    return $img[$randIdx];
  }
