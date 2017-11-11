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
