<?php

class Membre extends Model{
	
	var $table = 'membres';


	function getAll(){
		return $this->find();
	}

	function get($id){
		$d = array(
			'conditions' => "id='$id'"
			);
		return $this->find($d);
	}

	function search($usr){
		$d = array(
			'conditions' => "usr='$usr'"
			);
		$rows=$this->find($d);
		
		return count($rows);
	}

	function insert($d){
		$this->save($d);
	}

	
	
}

?>