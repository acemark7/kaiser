<?php
/*****
NOTE: make sure to enable extension=php_pdo_mysql.dll from php.ini file
*****/

class Database extends PDO{
	
	public function __construct(){
		parent::__construct(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
		//echo 'DB';
	}
}