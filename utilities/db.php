<?php
/**
 * Class defined for Database
 * @since 29-04-2015
 * @author Anila Gopi
 */
class Db extends PDO {

    public function __construct() {
	    $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=UTF-8';
        parent::__construct($dsn,DB_USER, DB_PASS);
        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        parent::setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    }

}





