<?php

    // saveTourismLocationFromPA.php
    ini_set('display_errors', 1); error_reporting(E_ALL);

    require_once('./Firebase.php');
    require_once('./FirebaseTourismLocation.php');

    $db = new Firebase();

    $XML_TURISMO = "https://www.comune.palermo.it/xmls/VIS_DATASET_TURISMO02.xml";
    $xmlString = file_get_contents($XML_TURISMO);
    $xml = simplexml_load_string($xmlString);

    foreach ($xml as $record)
    {
        $loc = new FirebaseTourismLocation();
        $loc->id           = (string)$record->ID;
        $loc->name         = (string)$record->DENOMINAZIONE;
        $loc->category     = (string)$record->DES;
        $loc->desc         = (string)$record->DESCRIZIONE;
        $loc->address      = (string)$record->INDIRIZZO;
        $loc->notes        = (string)$record->ANNOTAZIONI;
        $loc->website      = (string)$record->WEB;
        $loc->email        = (string)$record->EMAIL;
        $loc->city         = (string)$record->CITTA;
        $loc->geo['lat']   = (string)$record->LATITUDE;
        $loc->geo['lng']   = (string)$record->LONGITUDE;
        $loc->phone        = (string)$record->TELEFONO;

        $db->saveTourismLocation($loc);
    }
?>
