<?php

namespace Module;

class RESTController {
	
	private $connect;
	
	public function __construct($method, $connector)
	{
		$connect = $connector;
		$this->{$method}();
	}
	
	private function GET()
	{
		foreach($connect->query('SELECT * FROM item') as $row)
		{
			$array[] = array('id' => $row['id'], 'name' => $row['name'], 'price' => $row['price']);
		}
		
		header('Content-Type: application/json');
		echo json_encode($array);
	}
	
	private function POST()
	{
		$json = json_decode(file_get_contents('php://input'));

		$stmt = $connect->prepare('INSERT INTO item VALUES(NULL, :name, :price)');
		$stmt->bindParam(':name', $json->{'name'}, PDO::PARAM_STR);
		$stmt->bindParam(':price', $json->{'price'}, PDO::PARAM_STR);
		$stmt->execute();
	}
	
	private function PUT()
	{
		$json = json_decode(file_get_contents('php://input'));

		$stmt = $connect->prepare('UPDATE item SET name = :name, price = :price WHERE id = :id');
		$stmt->bindParam(':name', $json->{'name'}, PDO::PARAM_STR);
		$stmt->bindParam(':price', $json->{'price'}, PDO::PARAM_STR);
		$stmt->bindParam(':id', $json->{'id'}, PDO::PARAM_STR);
		$stmt->execute();
	}
	
	private function DELETE()
	{
		$json = json_decode(file_get_contents('php://input'));

		$stmt = $connect->prepare('DELETE FROM item WHERE id = :id');
		$stmt->bindParam(':id', $json->{'id'}, PDO::PARAM_STR);
		$stmt->execute();
	}
	
}