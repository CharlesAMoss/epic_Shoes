<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    require_once "src/Store.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class BrandTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Store::deleteAll();
            //Brand::deleteAll();
        }

        function test_brand_get()
        {
            //Arrange
            $brand_name = "Converse";
            $id = 1;
            $test_brand = new Store($brand_name, $id);

            //Act
            $result = $test_brand->getBrandName();
            $result2 = $test_brand->getId();

            //Assert
            $this->assertEquals($brand_name, $result);
            $this->assertEquals($id, $result2);
        }//end test

    }//end of class

?>        
