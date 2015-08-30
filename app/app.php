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

    $app->post("/store_brand", function() use ($app) {
        $store_name = $_POST['stone_name'];
        $store = new Store($store_name, $id = null);
        $store->save();
        $brand_name = $_POST['brand_name'];
        $brand = new Brand($brand_name, $id = null);
        $brand->save();
        $result = $store->addBrand($brand);
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    $app->post("/delete_all", function() use ($app) {
        $GLOBALS['DB']->exec("DELETE FROM brands_stores_t;");
        Store::deleteAll();
        Brand::deleteAll();
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    return $app;
?>
