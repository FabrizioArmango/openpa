<?php
    // saveTheatresFromPA.php
    ini_set('display_errors', 1); error_reporting(E_ALL);

    require_once('./Firebase.php');
    require_once('./FirebaseTheatre.php');
    
    $db = new Firebase();

    $teatri = file_get_contents('../datasets/teatri.json');
    echo $teatri;
    $teatriJSON = json_decode($teatri, true);
    
    foreach($teatriJSON as $teatroJSON)
    {
        $teatro = new FirebaseTheatre();
        $teatro->name = $teatroJSON["teatro"];
        $teatro->address = $teatroJSON["ubicazione"];
        $teatro->seats = $teatroJSON["capienza [posti]"];
        /*  Deprecati per mancanza di informazioni su DBPedia riguardanti i teatri privati palermitani
         *  e per mancato rispetto delle licenze delle API di Google Maps. 
         *  Per il secondo, sono possibili implementazioni con Nominatim.
         *   $teatro->getOtherInfoFromDBPedia();
         *   $teatro->getGeoCoord();
         */
        echo $db->saveTheatre($teatro);
    }
?>
