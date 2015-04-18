<?php
/*
* Contient toute les methodes générale qui s'appliquent a toutes les classes
*
*/
class Controller{
	
	var $name = "";
	var $vars = array();
	var $layout = 'default'; // le layout par default


	function error404(){
		ob_start();
		require(ROOT.'views/error404/404.php');
		$content_for_layout = ob_get_clean();
		if($this->layout==false){ // si on a pas de layout on écrit direct le content
			echo $content_for_layout;
		}
		else{ // si on un a layout on l'ouvre
			require(ROOT.'views/layout/'.$this->layout.'.php');
		}
	}

	function set($d){ // set un tableau de variable
		$this->vars = $d; // on fusionne les données envoyées avec celles qui y sont déja (si on fait plusieurs set)
	}


	/*
	* fonction qui rend la vue qui correspond a la fonction qu'on utilise
	* ex index.php pour la fonction index
	*/
	function render($filename){
		
		extract($this->vars); // On recupère les variables passées dans la vue dans des variables ( ex : si on lui passe 'nom' => 'bob', il créé une varible $nom qui contient bob)
		ob_start(); // on enregistre tout ce qui va suivre
		require(ROOT.'views/'.get_class($this).'/'.$filename.'.php');
		$content_for_layout = ob_get_clean();
		if($this->layout==false){ // si on a pas de layout on écrit direct le content
			echo $content_for_layout;
		}
		else{ // si on un a layout on l'ouvre
			require(ROOT.'views/layout/'.$this->layout.'.php');
		}
	}

	/*
	* Charge le model qui correspond aux controller et créé une instance de cette classe
	*
	*/
	function loadModel($name){
			// On inclus qu'une fois (si jamais on l'appel plusieurs fois)
			require_once(ROOT.'models/'.strtolower($name).'.php');  // strtolower pour enlever la majuscule de la classe
			$this->$name = new $name();
	}

	/**
	* enlève les actions (et paramètre) du $_server['QUERY_STRING'], pour renvoyer uniquement le controleur
	*/
	static function getController(){
		$params = explode('/', $_SERVER['QUERY_STRING']);
	    return $params[0];
	}

	function connexion(){
		$err = array();
		if(isset($_POST['submit']) && $_POST['submit']=='Login'){

			if(empty($_POST['username']) || empty($_POST['password'])){
				$err[] = 'Tous les champs doivent être remplis !';
			}
			if(!count($err)){
				$db = Singleton::getInstance()->bd_connect(); // connection a la bdd
				$username = $_POST['username']; // on protege les variables
				$password = $_POST['password'];
				$_POST['rememberMe'] = (int)$_POST['rememberMe'];
				


				$row = $db->query("SELECT id,usr FROM membres WHERE usr='$username' AND pass='".md5($password)."'"); // on test si il existe
				if($row->rowCount() > 0){ // si on en a touvé au moins un qui correspond
					
					foreach($row as $user){
					$_SESSION['usr'] = $user['usr'];
					$_SESSION['id'] = $user['id'];
					$_SESSION['rememberMe'] = $_POST['rememberMe'];
					}

					setcookie('remember',$_POST['rememberMe']);
				}
				
				else {$err[]='Erreur mot de passe ou login';}
			}
			
			if(count($err))
			$_SESSION['msg']['login-err'] = implode('<br />',$err);
			// Enregistre les messages d'erreur dans la session

			header("Location:".$_SERVER['HTTP_REFERER']); // redirige vers page précédente
			exit;
		}
		else{ // l'utilisateur n'est pas passé par le formulaire, il n'a rien a faire la, on redirige 404
			$this->render('../error404/404'); // on affiche la vue
		}
	}

	function inscription(){
		$err=array(); // on enleve les éventuelles erreurs précédente a chaque envoie
		if(isset($_POST['submit']) && $_POST['submit']=='Inscription'){ // Si le formulaire a été soumis
			include(ROOT."template/functions/functions_mail.php");
			// username entre 3 et 32 caractères ?
			if(empty($_POST['username']) || empty($_POST['email']) || empty($_POST['nom']) || empty($_POST['prenom'])){
				$err[]='Tous les champs doivent etre remplis';
			}
			if(strlen($_POST['username'])<4 || strlen($_POST['username'])>32){
				$err[]='Votre nom d\'utilisateur doit être entre 3 et 32 caracteres';
			}
			
			// username valide 
			if(preg_match('/[^a-z0-9\-\_\.]+/i',$_POST['username'])){
				$err[]='Votre nom d\'utilisateur contient des caracteres invalides ';
			}
			
			// adresse mail valide ?
			if(!checkEmail($_POST['email'])){ // on teste l'email avec la fonction checkEmail dans function_mail
			
				$err[]='Votre adresse mail n\'est pas valide';
			}
			
			// Si on n'a pas d'erreur on génére un mdp, on insert a la bdd le membre et on envoi un mail au membre avec son mdp
			if(!count($err))
			{
				$this->loadModel("Membre");
				$pass = substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6); // Genere un mot de passe aléatoire
				
				$exist=$this->Membre->search($_POST['username']);
				echo $exist;
				if($exist==0){
				$this->Membre->insert(array(
					'usr' => $_POST['username'],
					'pass' => md5($pass),
					'email' => $_POST['email'],
					'nom' =>$_POST['nom'],
					'prenom' => $_POST['prenom'],
					'regiP' => $_SERVER['REMOTE_ADDR'],
					'dt' => 'NOW()'
					)
				);
				
					// envoi le mail
					send_mail(	'keryan.sanie@gmail.com',
								$_POST['email'],
								'Votre mot de passe e-Uml Team !',
								'Votre mot de passe est : '.$pass);

					$_SESSION['msg']['reg-success']='Vous avez reçu un e-mail avec votre nouveau mot passe : '.$pass;
				}
				else $err[]='Ce nom d\'utilisateur est déjà pris';
			}

			if(count($err))
			{
				$_SESSION['msg']['reg-err'] = implode('<br />',$err);
			}	
			
			header("Location:".$_SERVER['HTTP_REFERER']); // redirige vers page précédente	
			exit;
		}
		else{ // l'utilisateur n'est pas passé par le formulaire, il n'a rien a faire la, on redirige 404
			header("Location:".ROOT."views/error404/404.php");
		}
	}

	function deconnexion(){
		$_SESSION = array();
		session_destroy();
		header("Location:".$_SERVER['HTTP_REFERER']);
		exit;
	}


}
?>