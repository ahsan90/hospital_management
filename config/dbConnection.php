<?php
use Illuminate\Database\Capsule\Manager as Capsule;
//use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'health_db',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
//$capsule->setEventDispatcher(new Dispatcher(new Container));
// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();
// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

//class DbConnection{
//    public function __construct()
//    {
//        //$this->setDbConnection();
//    }
//
//    public static function setDbConnection(){
//        $capsule = new Capsule;
//        $capsule->addConnection([
//            'driver'    => 'mysql',
//            'host'      => 'localhost',
//            'database'  => 'health_db',
//            'username'  => 'root',
//            'password'  => '',
//            'charset'   => 'utf8',
//            'collation' => 'utf8_unicode_ci',
//            'prefix'    => '',
//        ]);
//    }
//}