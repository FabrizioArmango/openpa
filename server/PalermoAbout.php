<?php
/* 
 *   PalermoAbout.php
*/
    ini_set('display_errors', 1); error_reporting(E_ALL);

    require_once('./Firebase.php');
    require_once('./FirebaseChurch.php');
    require_once('./FirebaseFood.php');
    require_once('./FirebaseTheatre.php');
    require_once('./FirebaseTourismLocation.php');

/*  $_GET['listOf']
        -theatres
        -cinemas
        -churchs
        -typicalfoods
        -pubs
        -cocktailbars
        -winebars
        -streetfoods
        -restaurants
        -discos
*/
if(isset($_GET['listOf']) && !empty($_GET['listOf']))
{
    $what = $_GET['listOf'];

    $db = new Firebase();
    echo $db->getListOf($what, isset($_GET['root']) && !empty($_GET['root']));
} else
{
    echo json_encode(array (
        "result" => "Invalid request. No listOf param specified."
    ));
}
?>


