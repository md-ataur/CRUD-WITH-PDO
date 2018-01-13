<?php
include('DB.php');
abstract class Main{

	protected $table;

	abstract function insert();
	abstract function update($id);	
		
	// single data fetch from table by id
	public function readById($id){
		$sql = "SELECT * FROM $this->table WHERE id=:id";
		$stmt = DB::prepareOwn($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		return $stmt->fetch();
	}

	// data fetch from table
	public function dataAll(){
		$sql = "SELECT * FROM $this->table";
		$stmt = DB::prepareOwn($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	
	}

	// data delete
	public function delete($id){
		$sql = "DELETE FROM $this->table WHERE id=:id";
		$stmt = DB::prepareOwn($sql);
		$stmt->bindParam(':id', $id);
		return $stmt->execute();
		
	}

}
?>