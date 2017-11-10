<?php
  // saveQueryFromDBPedia.php
ini_set('display_errors', 1); error_reporting(E_ALL);

$countries = array (
    'it' => array (
        "Piedmont",
        "Lombardy",
        "Veneto",
        "Trentino-Alto Adige",
        "Friuli-Venezia Giulia",
        "Liguria",
        "Emilia-Romagna",
        "Tuscany",
        "Marche", 
        "Umbria", 
        "Lazio", 
        "Abruzzo", 
        "Molise", 
        "Campania", 
        "Apulia", 
        "Basilicata",
        "Calabria", 
        "Sicily", 
        "Sardinia",
        "Aosta_Valley"
    )
);

require_once('./Firebase.php');
require_once('./FirebaseFood.php');
$db = new Firebase();

foreach ($countries as $countryID => $regionArray)
{
    //questo ciclo for viene eseguito soltanto per il valore i = 17
    // per prendere le informazioni dei cibi tipici siciliani.
    for ($i = 17; $i < count($regionArray); $i++)
    {
        $hookRes = file_get_contents('https://hook.io/elsinor/sparqler-hook?region=' . $regionArray[$i]);
        $hookArray = json_decode($hookRes, true);

        
        // Salva su Firebase
        foreach ($hookArray as $resource => $hookFood)
        {
            $food = new FirebaseFood();
            $food->id = $resource;
            $food->name = $hookFood["name"];
            $food->country = $countryID;
            $food->region = $regionArray[$i];
            $food->image = @$hookFood["img"];

            echo $db->saveFood($food);
        }
        
        sleep(2);
        break;

    }
}

?>
