<?php require(ROOT.'template/functions/functions_panel.php'); ?>
<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<h2>Support</h2>           
	            <a href="mailto:keryan.sanie@gmail.com">keryan.sanie@gmail.com</a>
	            <h2>WeedLife</h2>           
	            <p>version : 1.0</p>
				<p>© 2015 WeedLife. Tous droits réservés.</p>
			</div>
           
            <?php
			
			if(!isset($_SESSION['id']) || empty($_SESSION['id'])):
			
			?>
            
			<div class="left">
				<!-- Login Form -->
				<form class="clearfix" action="<?php echo CTR_ROOT;?>connexion" method="post">
					<h1>Connexion</h1>
                    
                    <?php
						
						if(isset($_SESSION['msg']['login-err']))
						{
							echo '<div class="err">'.$_SESSION['msg']['login-err'].'</div>';
							unset($_SESSION['msg']['login-err']);
						}
					?>
					
					<label class="grey" for="username">Pseudonyme:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
					<label class="grey" for="password">Mot de passe:</label>
					<input class="field" type="password" name="password" id="password" size="23" />
	            	<p><input name="rememberMe" id="rememberMe" type="checkbox" checked="checked" value="1" /> &nbsp;Se souvenir de moi</p>
        			<div class="clear"></div>
					<input type="submit" name="submit" value="Login" class="bt_login" />
				</form>
			</div>
			<div class="left right">			
				<!-- Formulaire d'inscription -->
				<form action="<?php echo CTR_ROOT;?>inscription" method="post">
					<h1>Pas encore inscrit ?</h1>		
                    
                    <?php
						
						if(isset($_SESSION['msg']['reg-err']))
						{
							echo '<div class="err">'.$_SESSION['msg']['reg-err'].'</div>';
							unset($_SESSION['msg']['reg-err']);
						}
						
						if(isset($_SESSION['msg']['reg-success']))
						{
							echo '<div class="success">'.$_SESSION['msg']['reg-success'].'</div>';
							unset($_SESSION['msg']['reg-success']);
						}
				
					?>
                    		
					<label class="grey" for="username">Pseudonyme:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
					<label class="grey" for="email">Email:</label>
					<input class="field" type="text" name="email" id="email" size="23" />
					<label class="grey" for="nom">Nom:</label>
					<input class="field" type="text" name="nom" id="nom" value="" size="23" />
					<label class="grey" for="prenom">Prenom:</label>
					<input class="field" type="text" name="prenom" id="prenom" size="23" />
				
					<input type="submit" name="submit" value="Inscription" class="bt_register" />
				</form>
			</div>
            
            <?php
			
			else:
			
			?>
            
            <div class="left">
				<h2>Retrouver des joueurs</h2>
				<li><a href="#">Mes amis</a></li>	
				<li><a href="#">Rechercher</a></li>		
				<h2>Classement</h2>
				<li><a href="#">Mon classement</a></li>	
				<li><a href="#">Top joueurs</a></li>
			</div>
            
            <div class="left right">
            	<h2>Options</h2>            
	            <p>Vous pouvez acceder à vos informations personnelles</p>
	            <?php if(($_SESSION['usr'])=='admin'){ ?>
	            <a href="<?php echo WEBROOT."admin"?>">Administration</a>
	            <?php } else {?>
	            <a href="<?php echo WEBROOT."membres/espace_membre"?>">Espace membre</a>
	            <?php } ?>
	            <p>- ou -</p>
	            <a href="<?php echo CTR_ROOT;?>deconnexion">Vous déconnecter</a>
            </div>
            
            <?php
			endif;
			?>
		</div>
	</div> <!-- /login -->	

    <!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
	    	<li class="left">&nbsp;</li>
	        <li>Joueur : <?php if(isset($_SESSION['usr'])) echo $_SESSION['usr']; else echo 'invité';?></li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#"><?php if(isset($_SESSION['id'])) echo 'Espace membre'; else echo 'Connexion | Inscription';?></a>
				<a id="close" style="display: none;" class="close" href="#">Réduire</a>			
			</li>
	    	<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
</div> <!--panel -->
