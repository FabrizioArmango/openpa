<?php
    class FirebaseTourismLocation
    {
        public $id = ""; // id
        public $name  = ""; //denominazione
        public $category ="";
        public $desc = "";  //descrizione
        public $address = ""; //indirizzo 
        public $notes = ""; // annotazioni
        public $website = ""; //web
        public $email = ""; //email
        public $city  = ""; //citta
        public $geo = []; //latitude, longitude
        public $phone = ""; //telefono
        
        function toFirebaseJSON()
        {
            return json_encode([
                $this->id => array(
                    "name"      => $this->name, 
                    "category"   => $this->category,
                    "desc"     => $this->desc,
                    "address"     => $this->address,
                    "notes"     => $this->notes,
                    "website" => $this->website,
                    "email"   => $this->email,
                    "city"  => $this->city,
                    "geo"  => array(
                        "lat" => $this->geo["lat"],
                        "lng" => $this->geo["lng"]
                    ),
                    "phone" => $this->phone
                )
            ]);
        }
    }
?>
