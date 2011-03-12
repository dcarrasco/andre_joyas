<?php 

require_once('conn/db_joyas.php'); 

mysql_select_db($database_db_joyas, $db_joyas);
$query_rsCatalogo = "SELECT id, `desc`, foto FROM catalogo WHERE visible = 1 ORDER BY orden ASC";
$rsCatalogo = mysql_query($query_rsCatalogo, $db_joyas) or die(mysql_error());
$row_rsCatalogo = mysql_fetch_assoc($rsCatalogo);
$totalRows_rsCatalogo = mysql_num_rows($rsCatalogo);
$arrCatalogo = array();
do {
	array_push($arrCatalogo, array(id => $row_rsCatalogo['id'], foto => $row_rsCatalogo['foto'], desc => $row_rsCatalogo['desc']));
} while ($row_rsCatalogo = mysql_fetch_assoc($rsCatalogo));
mysql_free_result($rsCatalogo);

$colname_rsListaJoyas = "-1";
if (isset($_GET['catalogo_id'])) {
  $colname_rsListaJoyas = (get_magic_quotes_gpc()) ? $_GET['catalogo_id'] : addslashes($_GET['catalogo_id']);
}
mysql_select_db($database_db_joyas, $db_joyas);
$query_rsListaJoyas = sprintf("SELECT * FROM joyas WHERE catalogo_id = '%s' and visible=1 ORDER BY orden ASC", $colname_rsListaJoyas);
$rsListaJoyas = mysql_query($query_rsListaJoyas, $db_joyas) or die(mysql_error());
$row_rsListaJoyas = mysql_fetch_assoc($rsListaJoyas);
$totalRows_rsListaJoyas = mysql_num_rows($rsListaJoyas);
$arrJoyas = array();
do {
	array_push($arrJoyas, array(foto => $row_rsListaJoyas['foto'], desc => $row_rsListaJoyas['desc'], materiales => $row_rsListaJoyas['materiales']));
} while ($row_rsListaJoyas = mysql_fetch_assoc($rsListaJoyas));
mysql_free_result($rsListaJoyas);


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="description" content="Andrea Cortes - Orfebre. Coleccion 2010. Joyas, anillos, aros, colgantes, piedras en plata y oro" />
<meta name="keywords" content="andrea, cortes, orfebre, coleccion, orfebreria, joyas, anillos, aros, colgantes, piedras, plata, oro, oro blanco" />
<meta name="author" content="dcr"/>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="google-site-verification" content="neFoCWLdKwNGfXqkUlRMRapjRC4fHargwPi5y7e7fhY" />

<title>Andrea Cort&eacute;s - Orfebre</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.galleryview-1.1.js"></script>
<script type="text/javascript" src="js/jquery.timers-1.1.2.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#photos').galleryView({
			panel_width: 800,
			panel_height: 400,
			panel_background_color: 'black',
			frame_width: 100,
			frame_height: 75,
			filmstrip_size: 2,
			transition_speed: 500,
			transition_interval: 0,
			overlay_opacity: 0,
			overlay_color: 'blue',
			overlay_height: 70,
			overlay_font_size: '14pt',
			overlay_text_color: 'green',
			overlay_position: 'bottom',
			background_color: 'black',
			caption_text_color: 'green',
			border: '1px solid black',
			nav_theme: 'light',
			easing: 'swing',
			filmstrip_position: 'top',
			show_captions: false,
			fade_panels: true,
			pause_on_hover: false
		
		});
	});
</script>

</head>

<body>

<div id="header">
	<div id="colec"><a href="index.php"><img src="img/coleccion2010.jpg" alt="Coleccion 2010"/></a></div>
	<div id="logo"><img src="img/logo.jpg" alt="Andrea Cortes Orfebre" /></div>
</div>

<div id="content">
	<?php if($totalRows_rsListaJoyas==0) {?>
		<img src="img/imagen_principal.jpg" alt="imagen principal"/>
	<?php } else {?>
		<div id="center" align="center">
		<div id="photos" class="galleryview">
		<?php foreach($arrJoyas as $elemJoya) { ?>
			<div class="panel">
				<div id="foto_fondo"><img class="img_dark2" src="img_catalogo/<?php echo $elemJoya['foto']; ?>" width="600" height="450" alt="<?php echo $elemJoya['desc']; ?>" /></div>
				<div id="foto_top"><img src="img_catalogo/<?php echo $elemJoya['foto']; ?>" width="400" height="300" alt="<?php echo $elemJoya['desc']; ?>" /></div>
		  		<div class="panel-overlay">
					<span class="TextoFotos1"><?php echo $elemJoya['desc']; ?></span><br>
					<span class="TextoFotos2"><?php echo $elemJoya['materiales']; ?></span>
				</div>
			</div>
		<?php } ?>

		<ul class="filmstrip">
		<?php foreach($arrJoyas as $elemJoya) { ?>
			<li><img class="img_dark1" src="img_catalogo/<?php echo $elemJoya['foto']; ?>" alt="<?php echo $elemJoya['desc']; ?>" title="<?php echo $elemJoya['desc']; ?>" width="100" height="75" /></li>
		<?php } ; ?>
		</ul>
	</div>
	</div>
	<?php }?>	
</div>

<div id="bottom">
	<ul>
	<?php foreach($arrCatalogo as $elemCatalogo) { ?>	  
		<li><a href="index.php?catalogo_id=<?php echo $elemCatalogo['id']; ?>"><img src="<?php echo $elemCatalogo['foto']; ?>" alt="<?php echo $elemCatalogo['desc']; ?>" /></a></li>
	<?php } ?>
	<li><a href="mailto:acortess@gmail.com" class="titulo3"><img src="img/contacto.jpg" alt="contacto" /></a></li>
	</ul>
</div>

</body>
</html>
