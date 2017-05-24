<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/variables.php';

require_once 'core/database.php';
require_once 'core/session.php';
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
