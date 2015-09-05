<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StoreTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands_stores_t;");
            Store::deleteAll();
            Brand::deleteAll();
        }

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

            //Assert
            $result = Store::getAll();
            $this->assertEquals($test_store, $result[0]);
        }//end test

        function test_store_getAll()
        {
            //Arrange
            $store_name2 = "Goody New Shoes";
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            $store_name = "Groos Shoes";
            $test_store = new Store($store_name);
            $test_store->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store2, $test_store], $result);
        }//end test

        function test_store_deleteAll()
        {
            //Arrange
            $store_name2 = "Goody New Shoes";
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            $store_name = "Groos Shoes";
            $test_store = new Store($store_name);
            $test_store->save();

            //Act
            Store::deleteAll();

            //Assert
            $result = Store::getAll();
            $this->assertEquals([], $result);
        }//end test

        function test_store_find()
        {
            //Arrange
            $store_name2 = "Goody New Shoes";
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            $store_name = "Groos Shoes";
            $test_store = new Store($store_name);
            $test_store->save();

            //Act
            $result = Store::find($test_store->getId());

            //Assert
            $this->assertEquals($test_store, $result);
        }//end test

        function test_store_delete()
        {
            //Arrange
            $store_name2 = "Goody New Shoes";
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            $store_name = "Groos Shoes";
            $test_store = new Store($store_name);
            $test_store->save();

            //Act
            $test_store->delete();

            //Assert
            $result = Store::getAll();
            $this->assertEquals([$test_store2], Store::getAll());
        }//end test

        function test_store_update()
        {
            //Arrange
            $store_name2 = "Goody New Shoes";
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            $store_name = "Groos Shoes";
            $test_store = new Store($store_name);
            $test_store->save();

            $new_name = "Foot Action";

            //Act
            $test_store->update($new_name);

            //Assert
            $this->assertEquals($new_name, $test_store->getStoreName());
        }//end test

        function test_store_addBrand()
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
            $test_store->addBrand($test_brand);

            //Assert
            $this->assertEquals($test_store->getBrands(), [$test_brand]);
        }//end test

        function test_store_getBrands()
        {
            //Arrange
            $store_name = "Goody New Shoes";
            $id=1;
            $test_store = new Store($store_name,$id);
            $test_store->save();

            $brand_name = "Nike";
            $id1=1;
            $test_brand = new Brand($brand_name,$id1);
            $test_brand->save();
            $test_store->addBrand($test_brand);

            $brand_name2 = "Converse";
            $id2=2;
            $test_brand2 = new Brand($brand_name2,$id2);
            $test_brand2->save();
            $test_store->addBrand($test_brand2);

            //Act
            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand2,$test_brand], $result);
        }//end test




    }//end of class

?>
