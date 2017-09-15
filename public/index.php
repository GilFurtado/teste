<?php 
define('APP_ROOT', dirname(__DIR__));
chdir(APP_ROOT);

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Michelf\Markdown;
use GGF\Application\User\User;
//use GGF\Application\Product\Product;


require 'vendor/autoload.php';

$app = new Application();

$app['debug'] = true;

$app['entity'] = function(){
	 $pdo = new \PDO('mysql:host=localhost;dbname=teste_serasa', 'root', '');
	 return new GGF\Application\Entity\Entity($pdo);
};

$app->get('/', function() use ($app){
	return $app->redirect('/api/v1');
});

$app->get('teste', function(){
    return "Hello";
});

$app->get('/api/v1', function() use ($app) {

	$file = file_get_contents('public/README.md');
	return Markdown::defaultTransform($file);

});

$app->get('/api/v1/users', function() use($app){
	$user  = new User($app['entity']);
	$users = $user->getEntity()->getAll();

	return $app->json($users); 
});

$app->get('/api/v1/users/{id}', function($id) use($app){

	$user = new User($app['entity']);
	$user = $user->getEntity()->where(array('id' => $id));

	return $app->json($user);
})
->convert('id', function($id){ return (int) $id; });

$app->post('/api/v1/users', function(Request $request) use ($app){
	$data = json_decode($request->getContent(), true); //json_decode($request->getContent(), true); //$request->request->all();
	
	$user = array(
		'name'  => (string) $data['name'],
		'email' => (string) $data['email'],
		'password' => (string) $data['password'],
		'status' => (int) $data['status']
	);
	
	$save = new User($app['entity']);
	$save = $save->getEntity()->save($user);
    $code = Response::HTTP_OK;
    $return = array('code' => $code,'status' => true);

	if(!$save) $return = array('code' => '403','status' => false);

	return $app->json($return);

});

$app->put('/api/v1/users', function(Request $request) use ($app){
	
	$data = json_decode($request->getContent(), true); //$request->request->all();
	
	$user = array(
		'id'    => (int) $data['id'],
		'name'  => (string) $data['name'],
		'email' => (string) $data['email'],
		'password' => (string) $data['password'],
		'status' => (int) $data['status']
	);

	$update = new User($app['entity']);
	$update = $update->getEntity()->save($user);


    $return = array('status' => true);
	
	if(!$update) $return = array('status' => false);

	return $app->json($return);

});

$app->delete('/api/v1/users/{id}', function($id) use($app){

	$user = new User($app['entity']);
	$userDeleted = $user->getEntity()->delete($id);


    $return = array('status' => true);
	
	if(!$userDeleted) $return = array('status' => false);

	return $app->json($return);
});

$app->get('/api/v1/products', function() use($app){
  $product  = new Product($app['entity']);
  $products = $product->getEntity()->getAll();

  return $app->json($products); 
});

$app->get('/api/v1/products/{id}', function($id) use($app){

  $product = new Product($app['entity']);
  $product = $product->getEntity()->where(array('id' => $id));

  return $app->json($product);
})
->convert('id', function($id){ return (int) $id; });

$app->post('/api/v1/products', function(Request $request) use($app){
  $data = json_decode($request->getContent(), true); //$request->request->all();
  $product = array(
      "description" => (string) $data['description'],
      "value" => (float) $data['value'],
      "status" => (int) $data['status']
  );
  
  $save = new Product($app['entity']);
  $save = $save->getEntity()->save($product);
    
    $return = array('status' => true);
  
  if(!$save) $return = array('status' => false);

  return $app->json($return);

});

$app->put('/api/v1/products', function(Request $request) use($app){
  
  $data = json_decode($request->getContent(), true); //$request->request->all();
  
  $product = array(
      'id'    => (int) $data['id'],
      "description" => (string) $data['description'],
      "value" => (float) $data['value'],
      "status" => (int) $data['status']
  );

  $update = new Product($app['entity']);
  $update = $update->getEntity()->save($product);


    $return = array('status' => true);
  
  if(!$update) $return = array('status' => false);

  return $app->json($return);

});

$app->delete('/api/v1/products/{id}', function($id) use($app){

  $product = new Product($app['entity']);
  $productDeleted = $product->getEntity()->delete($id);


    $return = array('status' => true);
  
  if(!$productDeleted) $return = array('status' => false);

  return $app->json($return);
});

$app->run();