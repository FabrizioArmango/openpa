<?php 
//Firebase
class Firebase 
{ 
    public $DB = 'FIREBASE_URI'; 
    public $FOOD_TABLE = "foods";    
    public $THEATRE_TABLE = "theatres";
    public $CHURCH_TABLE = "churches";
    public $NODE_PATCH = ".json";

    function saveFood($food)
    {
        // Initialize cURL
        $curl = curl_init();

        // Update
        curl_setopt( $curl, CURLOPT_URL, $this->DB . $this->FOOD_TABLE . "/" . $food->country . "/" . $food->region . $this->NODE_PATCH );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST,  "PATCH" );
        curl_setopt( $curl, CURLOPT_POSTFIELDS,  $food->toFirebaseJSON() );

        // Get return value
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );

        // Make request
        $response = curl_exec( $curl );
        // Close connection
        curl_close( $curl );
        // Show result
        return $response;
    }

    function saveTheatre($teatro)
    {
        // Initialize cURL
        $curl = curl_init();

        // Update
        curl_setopt( $curl, CURLOPT_URL, $this->DB . $this->THEATRE_TABLE . $this->NODE_PATCH );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST,  "PATCH" );
        curl_setopt( $curl, CURLOPT_POSTFIELDS,  $teatro->toFirebaseJSON() );

        // Get return value
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );

        // Make request
        $response = curl_exec( $curl );
        // Close connection
        curl_close( $curl );
        // Show result
        return $response;
    }

    function saveChurch($church)
    {
        // Initialize cURL
        $curl = curl_init();

        // Update
        curl_setopt( $curl, CURLOPT_URL, $this->DB . $this->CHURCH_TABLE . $this->NODE_PATCH );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST,  "PATCH" );
        curl_setopt( $curl, CURLOPT_POSTFIELDS,  $church->toFirebaseJSON() );

        // Get return value
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );

        // Make request
        $response = curl_exec( $curl );
        // Close connection
        curl_close( $curl );
        // Show result
        return $response;
    }

    function saveTourismLocation($loc)
    {
        // Initialize cURL
        $curl = curl_init();

        // Update
        curl_setopt( $curl, CURLOPT_URL, $this->DB . $this->fixTableName($loc->category) . $this->NODE_PATCH );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST,  "PATCH" );
        curl_setopt( $curl, CURLOPT_POSTFIELDS,  $loc->toFirebaseJSON() );

        // Get return value
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );

        // Make request
        $response = curl_exec( $curl );
        // Close connection
        curl_close( $curl );
        // Show result
        return $response;
    }

    function getListOf($what, $root=false)
    {
        // Initialize cURL
        $curl = curl_init();

        // Read
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        switch ($what)
        {
            case "typicalfoods":
                curl_setopt( $curl, CURLOPT_URL, $this->DB . $this->FOOD_TABLE . "/it/Sicily" . $this->NODE_PATCH );
            break;
            case "pubs":            
            case "restaurants":
            case "discos":
            case "cinemas":
            case "theatres":
            case "churches":
                curl_setopt( $curl, CURLOPT_URL, $this->DB . $what . $this->NODE_PATCH );
            break;
            case "cocktailbars":
                curl_setopt( $curl, CURLOPT_URL, $this->DB . "cocktail_bars" . $this->NODE_PATCH );
            break;
            case "winebars":
                curl_setopt( $curl, CURLOPT_URL, $this->DB . "wine_bars" . $this->NODE_PATCH );
            break;
            case "streetfoods":
                curl_setopt( $curl, CURLOPT_URL, $this->DB . "street_foods" . $this->NODE_PATCH );
            break;                
            default:
                $response = array (
                    "result" => "Invalid request parameter."
                );

                // Close connection
                curl_close( $curl );
                
                
                return json_encode($response);
            break;
        }
         // Make request
        $response = curl_exec( $curl );



        // Close connection
        curl_close( $curl );

        if ($root) 
            return $response;
            
        $res = array (
            "result" => json_decode($response)
        );


        // Show result
        return json_encode($res);
    }

     function fixTableName($des)
    {
        $des = strtolower($des);
        $tableName;
        switch($des)
        {
            case "ristoranti":
                $tableName = "restaurants";
            break;
            case "street food":
                $tableName = "street_foods";
            break;
            case "cocktail bar":
                $tableName = "cocktail_bars";
            break;
            case "pub":
                $tableName = "pubs";
            break;
            case "discoteche":
                $tableName = "discos";
            break;
            case "wine bar":
                $tableName = "wine_bars";
            break;
            case "cinema":
                $tableName = "cinemas";
            break;
            default:
                $tableName = "";
            break;
        }

        return $tableName;
    }

} 

?>
