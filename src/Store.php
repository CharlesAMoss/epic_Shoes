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

    //save

    //update

    //delete

    //get all

    //delete all

    //add brand

    //get brand
    }//end of class

?>
