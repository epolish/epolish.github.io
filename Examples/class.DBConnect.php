<?php

namespace Module;

class DBConnect {
	
	private $_db;
	static $_instance;
	
	private function __construct()
	{
		try {			
			$this->_db = new \PDO('sqlite:db/items.sqlite3');
		} catch (Exception $e) {
			echo "Failed: " . $e->getMessage();
		}
    	}

    	private function __clone(){}

    	public static function getInstance()
	{
        	if (!(self::$_instance instanceof self))
		{
            		self::$_instance = new self();
        	}
		
        	return self::$_instance;
    	}

    	public function query($sql)
	{
        	return query($this->_db,$sql);
    	}
	
}
