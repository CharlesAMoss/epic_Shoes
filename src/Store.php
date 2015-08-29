<?php

    class Store
    {

        private $id;
        private $store_name;

        function __construct($store_name, $id = null)
        {
            $this->store_name = $store_name;
            $this->id = $id;
        }

    //get
        function getStoreName()
        {
            return $this->store_name;
        }

        function getId()
        {
            return $this->id;
        }

    //set
        function setStoreName($new_store_name)
        {
            $this->store_name = $new_store_name;
        }

    //save
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_t (store_name) VALUES ('{$this->getStoreName()}');");
            $this->id=$GLOBALS['DB']->lastInsertId();
        }

    //update
        function update($new_name)
        {
           $GLOBALS['DB']->exec("UPDATE stores_t SET store_name = '{$new_name}' WHERE id = {$this->getId()};");
           $this->setStoreName($new_name);
        }

    //delete
        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores_t WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores_t WHERE store_id = {$this->getId()};");
        }

    //get all
        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores_t ORDER BY store_name;");
            $stores = array();
            foreach($returned_stores as $store) {
                $store_name = $store['store_name'];
                $id = $store['id'];
                $new_store = new Store($store_name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

    //find
        static function find($search_id)
        {
            $found = null;
            $stores = Store::getAll();
            foreach($stores as $store){
                $store_id = $store->getId();
                if($store_id == $search_id){
                    $found = $store;
                }//end of if
            }//end foreach
            return $found;
        }

    //delete all
        static function deleteAll()
        {
           $GLOBALS['DB']->exec("DELETE FROM stores_t;");
        }

    //add brand
        function addBrand($brand)
        {
           $GLOBALS['DB']->exec("INSERT INTO brands_stores_t (brand_id, store_id) VALUES ({$this->getId()},{$brand->getId()});");
        }

    //get brand
        function getBrands()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT brands_t.* FROM stores_t
                JOIN brands_stores_t ON (stores_t.id = brands_stores_t.store_id)
                JOIN brands_t ON (brands_stores_t.brand_id = brands_t.id)
                WHERE stores_t.id = {$this->getId()}
                ORDER BY brands_t.brand_name;");
            $brands = array();
            foreach($returned_brands as $brand){
                $brand_name = $brand['brand_name'];
                $id = $brand['id'];
                $new_brand = new Brand($brand_name,$id);
                array_push($brands, $new_brand);
            }//end foreach
            return $brands;
        }


    }//end of class

?>
