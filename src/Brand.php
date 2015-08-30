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
    //find
        static function find($search_id)
        {
            $found = null;
            $brands = Brand::getAll();
            foreach($brands as $brand){
                $brand_id = $brand->getId();
                if($brand_id == $search_id){
                    $found = $brand;
                }//end of if
            }//end foreach
            return $found;
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
    //add store
        function addStore($store)
        {
           $GLOBALS['DB']->exec("INSERT INTO brands_stores_t (brand_id, store_id) VALUES ({$this->getId()},{$store->getId()});");
        }

    //get stores
        function getStores()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT stores_t.* FROM brands_t JOIN brands_stores_t ON (brands_t.id = brands_stores_t.brand_id) JOIN stores_t ON (brands_stores_t.store_id = stores_t.id) WHERE brands_t.id = {$this->getId()} ORDER BY stores_t.store_name;");
            $stores = array();
            foreach($returned_stores as $store){
                $store_name = $store['store_name'];
                $id = $store['id'];
                $new_store = new Store($store_name,$id);
                array_push($stores, $new_store);
            }//end foreach

            return $stores;
        }

    }//end of class

?>
