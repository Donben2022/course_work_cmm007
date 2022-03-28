<?php

$config = [
    'MODEL_PATH' => APPLICATION_PATH . DS . 'model'. DS,
    'VIEW_PATH' => APPLICATION_PATH. DS . 'view' . DS,
    'CONTROLLER_PATH' => APPLICATION_PATH. DS . 'controller'. DS,
    'DB_PATH' => APPLICATION_PATH. DS . 'config'. DS
];

require $config['CONTROLLER_PATH']. 'controller.php';