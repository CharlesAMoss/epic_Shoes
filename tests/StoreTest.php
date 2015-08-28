<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StoreTest extends PHPUnit_Framework_TestCase
    {

        // protected function tearDown()
        // {
        //     Store::deleteAll();
        // }

        function test_store_get()
        {
            //Arrange
            $store_name = "Gary's Shoes and Accessories for Today's Woman";
            $id = 1;
            $test_store = new Store($store_name, $id);

            //Act
            $result = $test_store->getName();
            $result2 = $test_store->getId();

            //Assert
            $this->assertEquals($store_name, $result);
            $this->assertEquals($id, $result);
        }//end test

    }//end of class

?>
