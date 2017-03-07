<?php
/** Incluir la libreria PHPExcel */
require_once './includes/PHPExcel-1.8/Classes/PHPExcel.php';

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
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
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
		
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A1', 'Listado de trabajos')
	->setCellValue('A3', 'Nº Trabajo')
	->setCellValue('B3', 'Descripción')
	->setCellValue('C3', 'Fecha visita')
	->setCellValue('D3', 'Duración')
	->setCellValue('E3', 'Materiales');
	$celda = 4; //Donde se empieza
	$index = 1;
foreach((array)$trabajos as $trabajo){
	$duracion =  number_format(abs($trabajo['HoraE'] - $trabajo['HoraS']),2).' horas';
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$celda, $index)
	->setCellValue('B'.$celda, $trabajo['Descripcion'])
	->setCellValue('C'.$celda, $trabajo['FVisita'])
	->setCellValue('D'.$celda, $duracion)
	->setCellValue('E'.$celda, $trabajo['DescripcionMat']);
	
	$index++;
	$celda++;
}

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

?>