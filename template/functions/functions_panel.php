<?php

// Si vous êtes connecté, mais vous n'avez pas le cookie rememberme (redémarrage du navigateur)
// Et vous n'avez pas coché la case de rememberMe:
if(isset($_SESSION['id']) && !isset($_COOKIE['remember']) && !$_SESSION['rememberMe'])
{
	$_SESSION = array();
	session_destroy();// detruit la session	
}

// si on a une erreur on ouvre le panel pour voir l'erreur
if(isset($_SESSION['msg']['login-err']) || isset($_SESSION['msg']['reg-err'])) // si on a une erreur
{
	// script javascript qui ouvre le panel et change le contenu de la languette quand on clique dessus
	echo '
	<script type="text/javascript">

		$(function(){
		
			$("div#panel").show();
			$("#toggle a").toggle();
		});

	</script>';	
}

?>