<?php
/* 
 *   PalermoAbout2.php
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
    //isset($_GET['root']) && !empty($_GET['root'])
    $jsonApiList = json_decode($db->getListOf($what, true), true);

    //var_dump($jsonApiList);
    
    $xml = new SimpleXMLElement('<main/>');

        switch($what)
        {
            case "churches":
                foreach($jsonApiList as $church)
                {
                    $churchXML = $xml->addChild('CHURCH');
                    $churchXML->addChild("IMAGE", $church['image']);          
                    
                    $churchName = $churchXML->addChild("NAME");

                    foreach($church['name'] as $lang => $name)
                    {                
                        $churchName->addChild($lang, $name);
                    }

                    $churchLocation = $churchXML->addChild("LOCATION");
                    $churchLocation->addChild("LAT", $church['location']['lat']);
                    $churchLocation->addChild("LNG", $church['location']['lng']);            
                }
            break;            
            case "theatres":
                foreach($jsonApiList as $theatre)
                {
                    $theatreXML = $xml->addChild('THEATRE');                            
                    $theatreXML->addChild("NAME", $theatre['name']);
                    $theatreXML->addChild("SEATS", $theatre['seats']);

                    $theatreLocation = $theatreXML->addChild("LOCATION");
                    $theatreLocation->addChild("ADDRESS", $theatre['address']);

                    if ($theatre['location']['lat'] > 0 && $theatre['location']['lng'] > 0)
                    {
                        $lat = str_replace(",", ".", $theatre['location']['lat']);
                        $lng = str_replace(",", ".", $theatre['location']['lng']);
                        
                        $theatreLocation->addChild("LAT", $lat);
                        $theatreLocation->addChild("LNG", $lng);
                    }                 
                }
            break;
            case "typicalfoods":
                foreach($jsonApiList as $food)
                {
                    $foodXML = $xml->addChild('FOOD'); 
                    
                    if ( isset($food['image']) )
                        $foodXML->addChild("IMAGE", $food['image']);

                    $foodName = $foodXML->addChild("NAME");
                    
                    foreach($food['name'] as $lang => $name)
                    {                
                        $foodName->addChild($lang, $name);
                    }                    
                }
            break;
            case "pubs":
            case "cinemas":
            case "cocktailbars":
            case "discos":
            case "streetfoods":
            case "winebars":
            case "restaurants":
                foreach($jsonApiList as $locID => $loc)
                {
                    $tagXML = "";
                    switch ($what)
                    {
                        case "pubs":
                            $tagXML = 'PUB';
                        break;
                        case "cinemas":
                            $tagXML = 'CINEMA';
                        break;
                        case "cocktailbars":
                            $tagXML = 'COCKTAILBAR';
                        break;
                        case "discos":
                            $tagXML = 'DISCO';
                        break;
                        case "streetfoods":
                            $tagXML = 'FOOD';
                        break;
                        case "winebars":
                            $tagXML = 'WINEBAR';
                        break;
                        case "restaurants":
                            $tagXML = 'RESTAURANT';
                        break;
                        default: 
                            $tagXML = "THING";
                        break;
                    }

                    $locXML = $xml->addChild($tagXML);
                    $locXML->addChild("ID", $locID);                              
                    $locXML->addChild("NAME", htmlspecialchars($loc['name']));

                    if(filter_var($loc['email'], FILTER_VALIDATE_EMAIL)) 
                        $locXML->addChild("EMAIL", $loc['email']);
                    
                    if(filter_var($loc['website'], FILTER_VALIDATE_URL)) 
                        $locXML->addChild("WEBSITE", $loc['website']);

                    $locXML->addChild("PHONE", $loc['phone']);

                    $locLocation = $locXML->addChild("LOCATION");
                    $locLocation->addChild("ADDRESS", $loc['address']);
                    $locLocation->addChild("CITY", $loc['city']);

                    if ($loc['geo']['lat'] > 0 && $loc['geo']['lng'] > 0)
                    {
                        $lat = str_replace(",", ".", $loc['geo']['lat']);
                        $lng = str_replace(",", ".", $loc['geo']['lng']);
                        
                        $locLocation->addChild("LAT", $lat);
                        $locLocation->addChild("LNG", $lng);
                    }                 
                }
            break;
        }
        

        Header('Content-type: text/xml');
        echo $xml->asXML();
    
} else
{
    echo json_encode(array (
        "result" => "Invalid request. No listOf param specified."
    ));
}
?>


