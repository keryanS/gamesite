<?php //require(ROOT.'template/functions/functions_panel.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WeedLife</title>
<!--[if (gt IE 8)|!(IE)]><!-->
<link rel="stylesheet" type="text/css" href="<?php echo WEBROOT;?>template/css/style.css" />
<!--<![endif]-->
</head>

<body>
<noscript>
    <div id="messageCenter">
        <div id="javamessagebox">
            <strong>Veuillez activer JavaScript afin de pouvoir continuer.</strong>
        </div>
    </div>
</noscript>
<div id="ie_message">
    <p>Votre navigateur est obsolète et pourrait occasionner des erreurs dans l`affichage de ce site web. Veuillez télécharger une version plus récente: <a href="http://www.microsoft.com/upgrade/">Internet Explorer</a> ou <a href="http://www.mozilla-europe.org/de/firefox/">Mozilla Firefox</a></p>
</div>

<?php include(ROOT.'views/layout/includes/panel.php'); ?> <!-- panel de connexion/inscription -->

<div id="main" class="clear">
    <?php include(ROOT.'views/layout/includes/header.php');?>

    <?php include(ROOT.'views/layout/includes/menu_left.php');?>

    <!-- Y'a que cette partie qui sera differente sur chaque page -->
    <!-- on peut même lu dire de charger la page en fonction de l'adresse de l'url -->
    <div id="content" class="col-md-9">
        <h2><?php echo $this->name; ?></h2>
        <?php echo $content_for_layout ?> <!-- contenu de la vue -->
    </div>

</div>
<?php include(ROOT.'views/layout/includes/footer.php');?>

<div id="wavybg-wrapper"> 
    <canvas>Your browser does not support HTML5 canvas.</canvas>
</div>
<div id="smoker"></div>

<div class="clearfix"></div>

<script type="text/javascript" src="<?php echo WEBROOT;?>template/scripts/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="<?php echo WEBROOT;?>template/scripts/slide.js"></script>
<script type="text/javascript" src="<?php echo WEBROOT;?>template/scripts/waterpipe.js"></script>
<script type="text/javascript" src="<?php echo WEBROOT;?>template/scripts/main.js"></script>
</body>
</html>