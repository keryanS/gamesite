<?php

class Evenement extends Model{


	//les attributs:
	var $table = 'evenements';
	/*
	private $nom;
	private $dateDeb;
	private $dateFin;
	private $nbParticipants;
	private $statut;
	private $ville;

	// constructeur de base
	public function __construct ($nom, $dateDeb,$dateFin,$nbParticipants,$ville,$statut='EN ATTENTE') {
	$this->nom = $nom;
	$this->dateDeb = $dateDeb;
	$this->dateFin = $dateFin;
	$this->nbParticipants = $nbParticipants;
	$this->ville = $ville;
	$this->statut = $statut;
	}*/
	
	/*
	* Insert l'évenement dans la base de données
	*/
	function insert($nom,$theme,$dateDeb,$dateFin,$nbParticipants,$ville,$orga) {
		// on eregistre l'evenement
		$id = $this->save(array(
				'nom' => $nom,
				'theme' => $theme,
				'dateDeb' => $dateDeb,
				'dateFin' => $dateFin,
				'nbParticipants' => $nbParticipants,
				'statut' => 'EN ATTENTE',
				'ville' => $ville,
				'organisateur' => $orga
			));
		// on insert l'organisateur dans les inscrits
		$db = Singleton::getInstance()->bd_connect();
		$insert=$db->Prepare("INSERT INTO inscriptions VALUES('','".$_SESSION['usr']."' ,'$id')");
		$insert->execute();
	}

	function update($id,$nom,$theme,$dateDeb,$dateFin,$nbParticipants,$ville,$orga) {
		$this->save(array(
				'id' => $id,
				'nom' => $nom,
				'theme' => $theme,
				'dateDeb' => $dateDeb,
				'dateFin' => $dateFin,
				'nbParticipants' => $nbParticipants,
				'statut' => 'EN ATTENTE',
				'ville' => $ville,
			));
	}
		
	// retourne les événements
	function getAll($d){
		return $this->find($d);
	}

	function get($id){
		$d = array(
			'conditions' => "id='$id'"
			);
		return $this->find($d);
	}

	function getByUsername($usr){
		$d = array(
			'conditions' => "organisateur='$usr' AND statut!='ANNULE'"
			);
		return $this->find($d);
	}

	/**
	* Renvoi vrai (incorrect) si le debut est avant la fin
	*/
	function jourIncorrect($debut, $fin) {
		$deb = date($debut);
		$fin = date($fin);
		$deb = new DateTime( $deb );
		$fin = new DateTime( $fin );
		return $deb > $fin;

	}

	/**
	* Renvoi le nombre d'evenement qui sont chevauchant aux datent données en paramètres
	* Pour chaque événements dans la base de données on recupere ceux dont
	* - la date de fin est apres $debut ET la date de debut est avant $debut
	* - la date de fin est apres $fin ET la date de debut est avent $fin
	* - la date de fin et de début sont a l'interieur (de part et d'autre) de $debut et $fin
	* - la date de fin et de début sont a l'exterieur (de part et d'autre) de $debut et $fin
	*/
	function dateExistDeja($debut,$fin,$id=0){
		$rows = $this->find(array(
			'conditions' => '(("'.$debut.'"<=dateFin AND "'.$debut.'">=dateDeb) OR ("'.$fin.'"<=dateFin AND "'.$fin.'">=dateDeb) OR ("'.$debut.'"<=dateDeb AND "'.$fin.'">=dateFin) OR ("'.$debut.'">=dateDeb AND "'.$fin.'"<=dateFin)) AND id<>"'.$id.'"'
			));
		return count($rows);
	}

	/*
	* Valide l'évenement : son statut passe à VALIDE 
	*/
	function validate($id){
		$this->save(array(
				'id' => $id,
				'statut' => 'VALIDE'
			));
	}

	/*
	* Mets en attante l'évenement : son statut passe à EN ATTENTE
	*/
	function waiting($id){
		$this->save(array(
				'id' => $id,
				'statut' => 'EN ATTENTE'
			));
	}

	/*
	* Annule l'évenement : son statut passe à ANNULE 
	*/
	function cancel($id){
		$this->save(array(
				'id' => $id,
				'statut' => 'ANNULE'
			));
	}

	function delete4ever($id){
		$this->destroy($id);
	}

	/* 
	* retourne true si le membre connecté est l'organisateur de l'evenement passé en paramètre
	*/
	function usrIsOrga($id){
		$db = Singleton::getInstance()->bd_connect();
		$query = $db->query("SELECT organisateur FROM $this->table WHERE id=$id");
		$result = $query -> fetch();
		return ($result['organisateur'] == $_SESSION['usr']);
	}

	/*
	*	Retourne la liste des participants de l'évenement passé en parametre
	*/
	function getParticipants($id){
		$db = Singleton::getInstance()->bd_connect();
		$query = $db->query("SELECT membre FROM inscriptions WHERE evenement=$id");
		$result = $query -> fetchAll();
		return ($result);
	}

	function inscription($idEven){
		$db = Singleton::getInstance()->bd_connect();
		$sql = "INSERT INTO inscriptions VALUES('','".$_SESSION["usr"]."','".$idEven."')";
		$insert=$db->prepare($sql);
		$insert->execute();
	}
} 