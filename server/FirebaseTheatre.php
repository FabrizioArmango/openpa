<?php
    class FirebaseTheatre 
    {
        public $name  = ""; //teatro
        //public $desc = "";  //descrizione
        public $address = ""; //ubicazione 
        public $seats = ""; // capienza [posti]
        public $image = ""; //DBPEDIA
        public $since = ""; //DBPEDIA
        public $architect = ""; //DBPEDIA
        public $comment = ""; //DBPEDIA
        public $abstract = ""; //DBPEDIA
        public $geo = [];

        function getOtherInfoFromDBPedia()
        {
            $res = file_get_contents('https://hook.io/elsinor/ask-theatre-info?name=' . urlencode($this->name));
            $otherInfo = json_decode($res, true);
            
            $this->image = @$otherInfo["image"];
            $this->since = @$otherInfo["since"];
            $this->architect = @$otherInfo["architect"];
            $this->comment = @$otherInfo["comment"]["it"];
            $this->abstract = @$otherInfo["comment"]["it"];
        }

        function getGeoCoord()
        {
            $res = file_get_contents('https://hook.io/elsinor/ask-gmaps?address=' . urlencode($this->address));
            $geoInfo = json_decode($res, true);

            $this->geo['lat'] = $geoInfo["location"]["lat"];
            $this->geo['lng'] = $geoInfo["location"]["lng"];
        }

        function toFirebaseJSON()
        {
            return json_encode([
                $this->name => array(
                    "name"      => $this->name, 
                    "address"   => $this->address,
                    "seats"     => $this->seats,
                    "image"     => $this->image,
                    "since"     => $this->since,
                    "architect" => $this->architect,
                    "comment"   => $this->comment,
                    "abstract"  => $this->abstract,
                    "location"  => array(
                        "lat" => $this->geo["lat"],
                        "lng" => $this->geo["lng"]
                    )
                )
            ]);
        }
    }
?>
