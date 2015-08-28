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
        function getName()
        {
            return $this->store_name;
        }

        function getId()
        {
            return $this->id;
        }
    //set

    //get all

    //update

    //delete

    //delete all

    }//end of class

?>
