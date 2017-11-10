<?php
    // saveChurchesFromDBPedia.php
    ini_set('display_errors', 1); error_reporting(E_ALL);

    require_once('./Firebase.php');
    require_once('./FirebaseChurch.php');

    $db = new Firebase();

    $hookRes = file_get_contents('https://hook.io/elsinor/pa-churches');

    $hookArray = json_decode($hookRes, true);

    
    // Salva su Firebase
    foreach ($hookArray as $resource => $hookchurch)
    {
        $church = new FirebaseChurch();
        $church->id = $resource;
        $church->name = $hookchurch["name"];
        $church->geo["lat"] = @$hookchurch["lat"];
        $church->geo["lng"] = @$hookchurch["long"];
        $church->image = @$hookchurch["img"];
        echo $db->saveChurch($church);
    }
?>
