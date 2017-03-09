<?php
/** Incluir la libreria PHPExcel */
require_once './includes/PHPExcel-1.8/Classes/PHPExcel.php';
require_once './includes/php/trabajos.php';

// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("Usuario")
->setLastModifiedBy("Usuario")
->setTitle("Documento Excel de Consulta")
->setSubject("Documento Excel de Consulta")
->setCategory("Consultas en Excel");

//Estilo de las celdas
  $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

    $objPHPExcel->getDefaultStyle()->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);

// Agregar Informacion

	$tr = $_GET['trabajos']; 
		//Hay que hacer esto para poder usar el array.
		$trabajos = stripslashes($tr); 
		$trabajos = urldecode($trabajos); 
		$trabajos = unserialize($trabajos); 
	$tipo = $_GET['tipo']; 
	$titulo = '';
	if($tipo == 2){
		$cliente = $_GET['cliente']; 
		$fIni = $_GET['fIni'];
		$fFin = $_GET['fFin'];
		$titulo = 'Listado de trabajos de '.$cliente.' entre '.$fIni.' - '.$fFin;
	} else {
		$tecnico = $_GET['tecnico']; 
		$fIni = $_GET['fIni'];
		$fFin = $_GET['fFin'];
		$titulo = 'Listado de trabajos de '.$tecnico.' entre '.$fIni.' - '.$fFin;
	}
	
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('C1', $titulo)
	->setCellValue('A3', 'Nº Trabajo')
	->setCellValue('B3', 'Descripción')
	->setCellValue('C3', 'Fecha visita')
	->setCellValue('D3', 'Duración')
	->setCellValue('E3', 'Materiales');
	
	
	$celda = 4; //Donde se empieza
	$index = 1;
	$totalHoras = 0;
foreach((array)$trabajos as $trabajo){
	$h1 = conversorHorasSegundos($trabajo['HoraE']);
	$h2 = conversorHorasSegundos($trabajo['HoraS']);
	$aux = abs($h1 - $h2);
	$duracion =  conversorSegundosHoras($aux);
	$totalHoras += $aux;
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$celda, $index)
	->setCellValue('B'.$celda, $trabajo['Descripcion'])
	->setCellValue('C'.$celda, date_format(new DateTime($trabajo['FVisita']), 'd-m-Y'))
	->setCellValue('D'.$celda, $duracion)
	->setCellValue('E'.$celda, $trabajo['DescripcionMat']);
	
	$index++;
	$celda++;
}
	$totalHoras =  conversorSegundosHoras($totalHoras);
	
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('E'.($celda+1), 'Total horas: '.$totalHoras);

	//Bordes
	$borders = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );
	$objPHPExcel->getActiveSheet()->getStyle('A3:E'.($celda-1).'')->applyFromArray($borders);
	$objPHPExcel->getActiveSheet()->getStyle('E'.($celda+1))->applyFromArray($borders);
	$objPHPExcel->getActiveSheet()->getStyle('B1:D1')->applyFromArray($borders);
	
	//Colores
	cellColor('B1:D1', 'D3F1EE');
	cellColor('A3:E3', 'D3F1EE');
	cellColor('E'.($celda+1), 'D3F1EE');
	
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('Consulta');

	// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.

	$objPHPExcel->setActiveSheetIndex(0);

	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.

	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="consulta.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;

	

function cellColor($cells,$color){

	global $objPHPExcel;
	
    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
             'rgb' => $color
        )
    ));
}
?>