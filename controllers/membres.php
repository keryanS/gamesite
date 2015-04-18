<?php
class membres extends Controller{

		var $name="Espace personnel";

		function index(){
			$this->loadModel('Membre'); //  appele le model de ce nom 
			$d['member'] = $this->Membre->getAll(); // on recupere tous les membres
			$this->set($d);
			$this->render('index');
		}	

		function espace_membre(){
			if(isset($_SESSION["id"]) && !empty($_SESSION['id'])){
				$this->loadModel('Membre'); //  appele le model de ce nom 
				$d['member'] = $this->Membre->get($_SESSION["id"]); // on recupere les infos du membre
				$this->set($d);
				$this->render('member_space');
			}
			else{
				$this->render('../error404/notConnected');
			}
		}


	
}
?>