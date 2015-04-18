<?php


/**
* 	La classe Singleton permet d'appeler une seule fois une méthode.
* 	Créé une instance uniquement s'il n'en existe pas encore.
*	@Author http://fr.wikipedia.org/wiki/Singleton_(patron_de_conception)
*/
class Singleton {
 
    private static $_instance;
 
    /**
     * Empêche la création externe d'instances.
     */
    private function __construct () {}
 
    /**
     * Empêche la copie externe de l'instance.
     */
    private function __clone () {}
 
    /**
     * Renvoi de l'instance et initialisation si nécessaire.
     */
    public static function getInstance () {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
 
        return self::$_instance;
    }
 
    /* 
	* 	connexion avec PDO
	*	En paramètre on passe ATTR_PERSISTENT => true qui permet de garder en mémoire la connexion, pour gagner du temps lors de la prochaine ouverture
	*	@return une instance de PDO
	*/
    public function bd_connect () {
		 require('config.php');
		    	try{
			$db = new PDO('mysql:host='.$server.';dbname='.$database.';charset=utf8', $db_user, $db_pass, array(PDO::ATTR_PERSISTENT => true)); 
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e){
			print "Impossible de se connecter a la base : ".$e->getMessage();
			die();
		}
		return $db;
    }
}
 
?>