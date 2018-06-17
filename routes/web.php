<?php

// use MongoDB\Client as Mongo;

$router->get('/', function () use ($router) {
    return $router->app->version();
});



$router->get('users', 'UsersController@index'); 


$router->get('users/{userId}', 'UsersController@show'); 


$router->post('users[/{userId}]', 'UsersController@store'); 

// $router->post('users/{userId}', 'UsersController@update'); 


$router->post('users/delete/{userId}', 'UsersController@destroy'); 



// $router->get('mongo', function() {
//     // $collection = Mongo::get()->mydatabase->mycollection;
//     // return $collection->find()->toArray();

//     $collection = Mongo::get()->usersdatabase->users; 


//     // $insertOneResult = $collection->insertOne([
//     //     'username' => 'admin',
//     //     'email' => 'admin@example.com',
//     //     'name' => 'Admin User',
//     // ]);



//     $insertOneResult = $collection->insertOne([
//         'username' => 'ajay',
//         'email' => 'ajay@example.com',
//         'name' => 'Normal User',
//     ]);


//     return $collection->find()->toArray();


//     // dd(Mongo::get()->usersdatabase->users->find()->toArray());


//     // $collection = Mongo::get()->usersdatabase->users; 


//     // $insertOneResult = $collection->insertOne([
//     //     'username' => 'admin',
//     //     'email' => 'admin@example.com',
//     //     'name' => 'Admin User',
//     // ]);


//     // return $collection->find()->toArray();


// });