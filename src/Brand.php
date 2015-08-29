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
        function setBrandName($new_brand_name)
        {
            $this->brand_name = $new_brand_name;
        }

    //save
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_t (brand_name) VALUES ('{$this->getBrandName()}');");
            $this->id=$GLOBALS['DB']->lastInsertId();
        }


    //get all
        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands_t ORDER BY brand_name;");
            $brands = array();
            foreach($returned_brands as $brand) {
                $brand_name = $brand['brand_name'];
                $id = $brand['id'];
                $new_brand = new Brand($brand_name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

    //delete all
        static function deleteAll()
        {
           $GLOBALS['DB']->exec("DELETE FROM brands_t;");
        }


    }//end of class

?>
