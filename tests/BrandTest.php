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
            $GLOBALS['DB']->exec("DELETE FROM brands_stores_t;");
            Store::deleteAll();
            Brand::deleteAll();
        }

        function test_brand_get()
        {
            //Arrange
            $brand_name = "Converse";
            $id = 1;
            $test_brand = new Brand($brand_name, $id);

            //Act
            $result = $test_brand->getBrandName();
            $result2 = $test_brand->getId();

            //Assert
            $this->assertEquals($brand_name, $result);
            $this->assertEquals($id, $result2);
        }//end test

        function test_brand_set()
        {
            //Arrange
            $brand_name = "Converse";
            $id = 1;
            $test_brand = new Brand($brand_name, $id);
            $new_name = "Nike";

            //Act
            $test_brand->setBrandName($new_name);
            $result = $test_brand->getBrandName();

            //Assert
            $this->assertEquals($new_name, $result);
        }//end test

        function test_store_save()
        {
            //Arrange
            $brand_name = "Converse";
            $test_brand = new Brand($brand_name, $id);

            //Act
            $test_brand->save();

            //Assert
            $result = Brand::getAll();
            $this->assertEquals($test_brand, $result[0]);
        }//end test

        function test_brand_deleteAll()
        {
            //Arrange
            $brand_name = "Nike";
            $id1=1;
            $test_brand = new Brand($brand_name,$id1);
            $test_brand->save();

            $brand_name2 = "Converse";
            $id2=2;
            $test_brand2 = new Brand($brand_name2,$id2);
            $test_brand2->save();

            //Act
            Brand::deleteAll();

            //Assert
            $result = Brand::getAll();
            $this->assertEquals([], $result);
        }//end test

        function test_brand_find()
        {
            //Arrange
            $brand_name = "Nike";
            $id1=1;
            $test_brand = new Brand($brand_name,$id1);
            $test_brand->save();

            $brand_name2 = "Converse";
            $id2=2;
            $test_brand2 = new Brand($brand_name2,$id2);
            $test_brand2->save();

            //Act
            $result = Brand::find($test_brand->getId());

            //Assert
            $this->assertEquals($test_brand, $result);
        }//end test

        function test_brand_addStore()
        {
            //Arrange
            $store_name = "Goody New Shoes";
            $id=1;
            $test_store = new Store($store_name,$id);
            $test_store->save();

            $brand_name = "Nike";
            $id=1;
            $test_brand = new Brand($brand_name,$id);
            $test_brand->save();

            //Act
            $test_brand->addStore($test_store);

            //Assert
            $this->assertEquals($test_brand->getStores(), [$test_store]);
        }//end test

        function test_brand_getStore()
        {
            //Arrange
            $brand_name = "Nike";
            $id1=1;
            $test_brand = new Brand($brand_name,$id1);
            $test_brand->save();

            $store_name2 = "Goody New Shoes";
            $test_store2 = new Store($store_name2);
            $test_store2->save();
            $test_brand->addStore($test_store2);

            $store_name = "Groos Shoes";
            $test_store = new Store($store_name);
            $test_store->save();
            $test_brand->addStore($test_store);

            //Act
            $result = $test_brand->getStores();

            //Assert
            $this->assertEquals([$test_store2,$test_store], $result);
        }//end test

    }//end of class

?>
