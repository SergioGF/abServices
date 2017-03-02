<?php ob_start(); ?>
<h2>Lista de trabajos</h2>
	<?php
	
		$tr = $_GET['trabajos']; 
		//Hay que hacer esto para poder usar el array.
		$trabajos = stripslashes($tr); 
		$trabajos = urldecode($trabajos); 
		$trabajos = unserialize($trabajos); 
	?>
	<table width="500px" cellpadding="5px" cellspacing="5px" border="1">
    <tr>
        <td><?php echo utf8_decode('Descripción')?></td>
        <td>Fecha de visita</td>
    </tr>
	<?php foreach((array)$trabajos as $trabajo){ ?>
    <tr bgcolor="#FF9933">
        <td><?php echo utf8_decode($trabajo['Descripcion'])?></td>
        <td><?php echo utf8_decode($trabajo['FVisita']) ?></td>
    </tr>
	<?php 
	}
	?>
	
	</table>
	
<?php
require_once("./includes/dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "consulta".time().'.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename); ?>