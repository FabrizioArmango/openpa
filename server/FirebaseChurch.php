<?php
    class FirebaseChurch
    {
        public $id = "";
        public $name  = ""; 
        public $image = ""; 
        public $geo = [];

        function toFirebaseJSON()
        {
            
            return json_encode([
                $this->getFixedResource($this->id) => array(
                    "name"      => $this->name, 
                    "image"     => $this->image,
                    "location"  => array(
                        "lat" => $this->geo["lat"],
                        "lng" => $this->geo["lng"]
                    )
                )
            ]);
        }

        function getFixedResource()
        {
            $tmp = $this->id;
            $httpurl = array("http://", ".");
            $tmp = str_replace($httpurl, "", $tmp);
            $tmp = str_replace("/", "_-_", $tmp); 
            return $tmp;       
        }
    }
?>
