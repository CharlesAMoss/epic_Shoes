<?php

    class Brand
    {

        private $id;
        private $brand_name;

        function __construct($brand_name, $id = null)
        {
            $this->brand_name = $brand_name;
            $this->id = $id;
        }

    //get
        function getBrandName()
        {
            return $this->brand_name;
        }

        function getId()
        {
            return $this->id;
        }
    //set

    //get all

    //delete all
        static function deleteAll()
        {
           $GLOBALS['DB']->exec("DELETE FROM brands_t;");
        }


    }//end of class

?>
