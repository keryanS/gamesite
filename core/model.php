<?php
class Model{

	public $table;

	function read($fields=null){
	if($fields==null){ $fields = '*';	}
	$sql = "SELECT $fields FROM " .$this->table. " WHERE id=".$this->id;
	$req = mysql_query($sql) or die(mysql_error());
	$data = mysql_fetch_assoc($req);
	foreach ($data as $k=> $v){
		$this ->$k = $v;
		}
	}

	/*
	* Enregistre les données passées en paramètre dans la bdd (modifie si déja existant)
	*/
	public function save($data){
		$db = Singleton::getInstance()->bd_connect();
		// si on donne un id c'est qu'on veut modifier
		if(isset($data["id"]) && !empty($data["id"])){
			$sql = "UPDATE ".$this->table." SET ";
			foreach($data as $k => $v){ // on ajoute toutes les valeurs a changer
				if($k!="id"){
				$sql .= "$k='$v',";
				}
			}
			$sql = substr ($sql,0, -1); // on enlève la dernière virgule
			$sql .= " WHERE id =".$data["id"];
		}
		// sinon on insert
		else{
			$sql = "INSERT INTO ".$this->table."(";
			unset($data["id"]); 
			foreach($data as $k=>$v){
				$sql .="$k,";
			}
			$sql = substr ($sql,0, -1); // on enleve la virgule en trop
			$sql .=") VALUES (";
			foreach($data as $v){
				$sql .= "'$v',";
			}
			$sql = substr ($sql,0, -1);	// on enleve la virgule en trop
			$sql .= ")"; 
			
		}
		$insert = $db->prepare($sql);
		$insert->execute();

		return $db->lastInsertId();
	}	
			
	
	/*
	* Fonction qui fait un select avec les paramètres données en tableau
	*/
	public function find($data=array()){
		$db = Singleton::getInstance()->bd_connect();
		$conditions = "1=1";
		$fields = "*";
		$limit = "";
		$order = "id DESC";
		if(isset($data['conditions'])){ $conditions = $data["conditions"];}
		if(isset($data['fields'])){ $fields = $data["fields"];}
		if(isset($data['limit'])){ $limit = "LIMIT ".$data["limit"];}
		if(isset($data['order'])){ $order = $data["order"];}
		$sql = "SELECT $fields FROM ".$this->table." WHERE $conditions ORDER BY '$order' $limit";
		$list = $db->query($sql);
		$d = array();
		foreach($list as $l){
			$d[]=$l;
		}
		return $d;
	}
	
	public function destroy($id){
		$db = Singleton::getInstance()->bd_connect();
		$sql = "DELETE FROM ".$this->table." WHERE id='".$id."'";
		$delete = $db->prepare($sql);
		$delete->execute();
	}

/*
static function load ($name){
		require("$name.php");
		return new $name();
	}


 */
}
?>