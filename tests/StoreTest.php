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
            $result = $test_store->getStoreName();
            $result2 = $test_store->getId();

            //Assert
            $this->assertEquals($store_name, $result);
            $this->assertEquals($id, $result2);
        }//end test

        function test_store_set()
        {
            //Arrange
            $store_name = "Gary's Shoes and Accessories for Today's Woman";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $new_name = "Goody New Shoes";

            //Act
            $test_store->setStoreName($new_name);
            $result = $test_store->getStoreName();

            //Assert
            $this->assertEquals($new_name, $result);
        }//end test

        function test_store_save()
        {
            //Arrange
            $store_name = "Goody New Shoes";
            $test_store = new Store($store_name);

            //Act
            $test_store->save();
            print_r($test_store);
            //Assert
            $result = Store::getAll();
            print_r($result);
            $this->assertEquals($test_store, $result[0]);
        }//end test

        function test_store_getAll()
        {
            //Arrange
            $store_name = "Goody New Shoes";
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = "Groo''s Shoes";
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store, $test_store], $result);
        }//end test

    }//end of class

?>
