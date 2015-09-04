<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    $app = new Silex\Application();
    $app['debug']  = true;
    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(),array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });


    $app->get("/brand_store", function() use ($app) {
        return $app['twig']->render('brand_store.html.twig', array('brands' => Brand::getAll(), 'display_form' => false));
    });

    $app->post("/brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $store = Store::find($_POST['store_id']);
        $brand->addStore($store);
        return $app['twig']->render('brand.html.twig', array('brands' => Brand::getAll(),'brand_stores' => $brand->getStores(), 'display_form' => false, 'all_stores' => Store::getAll()));
    });

    $app->get("/brand_store_add_form", function() use ($app) {
        return $app['twig']->render('brand_store.html.twig', array('brands' => Brand::getAll(), 'display_form' => true));
    });

    $app->post("/add_brand", function() use ($app) {
        $brand = new Brand($_POST['brand_name']);
        $brand->save();
        return $app['twig']->render('brand.html.twig', array('brands' => Brand::getAll(),'brand_stores' => $brand->getStores(), 'display_form' => false, 'all_stores' => Store::getAll()));
    });

    $app->get("/brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        return $app['twig']->render('brand.html.twig', array('brands' => Brand::getAll(),'brand_stores' => $brand->getStores(), 'display_form' => false, 'all_stores' => Store::getAll()));
    });

    $app->post("/brands/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $store = Store::find($_POST['store_id']);
        $brand->addStore($store);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'brand_stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->get("/store_brand", function() use ($app) {
        return $app['twig']->render('store_brand.html.twig', array('stores' => Store::getAll(), 'display_form' => false));
    });

    $app->get("/stores_add_form", function() use ($app) {
        return $app['twig']->render('store_brand.html.twig', array('stores' => Store::getAll(), 'display_form' => true));
    });

    $app->post("/add_store", function() use ($app) {
        $store = new Store($_POST['name']);
        $store->save();
        return $app['twig']->render('store_brand.html.twig', array('stores' => Store::getAll(), 'display_form' => false));
    });

    $app->get("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'store_brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->post("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $brand = Brand::find($_POST['brand_id']);
        $store->addBrand($brand);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'store_brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->get("/all_brands", function() use ($app) {
        return $app['twig']->render('all_brands.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    $app->get("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brand_stores' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->post("/delete_all", function() use ($app) {
        $GLOBALS['DB']->exec("DELETE FROM brands_stores_t;");
        Store::deleteAll();
        Brand::deleteAll();
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    return $app;
?>
