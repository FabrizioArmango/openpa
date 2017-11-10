<?php
    class FirebaseFood 
    {
        public $id = "";
        public $name  = [];
        public $country = "";
        public $region = "";
        public $image = "";

        function toFirebaseJSON()
        {
            return json_encode([
                $this->getFixedResource() => array(
                    "name"  => $this->name,
                    "image"   => $this->image
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
