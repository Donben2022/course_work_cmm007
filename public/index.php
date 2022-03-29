<?php

defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath( dirname(__FILE__) . '/../app' ));

const DS = DIRECTORY_SEPARATOR; //PHP internal function that gets the directory separator base on user OS

require APPLICATION_PATH. DS . 'config' . DS . 'config.php';

//  index.php?page=stories

$page = get('page', 'home');

$model = $config['MODEL_PATH']. $page . '.php';
$view  = $config['VIEW_PATH']. $page . '.phtml';
$_404  = $config['VIEW_PATH']. '404.phtml';

$db_connect  = $config['DB_PATH']. 'db_conn.php';

if(file_exists($db_connect)){
    require $db_connect;
}

if(file_exists($model)){
    require $model;
}

$main_content = '';

if(file_exists($view)){
    $main_content =  $view; 
    if( strpos($view, 'user_') !== false ) {
        include $config['VIEW_PATH']. '/layouts/dashboard.phtml';
    }elseif(strpos($view, 'admin_') !== false ){
        include $config['VIEW_PATH']. '/layouts/dashboard.phtml';

    }
    else{
        include $config['VIEW_PATH']. '/layouts/layout.phtml';
    }
    
}else{
    require $_404;
}


