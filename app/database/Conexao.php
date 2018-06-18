<?php

include('db.php');

class Conexao {
	public static function conectar(){
		$PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);  
    	return $PDO;
	}
}
