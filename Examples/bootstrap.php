<?php

require_once 'class.DBConnect.php';
require_once 'class.RESTController.php';

new Module\RESTController($_SERVER['REQUEST_METHOD'], Module\DBConnect::getInstance());