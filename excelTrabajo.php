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
->setTitle("Documento Excel de Informe")
->setSubject("Documento Excel de Informe")
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
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
// Agregar Informacion
	$tr = $_GET['trabajo']; 
		$trabajo = stripslashes($tr); 
		$trabajo = urldecode($trabajo); 
		$trabajo = unserialize($trabajo); 
		//Hay que hacer esto para poder usar el array.
		$cliente = $_GET['cliente']; 
		$fVisita = date_format(new DateTime($trabajo['FVisita']), 'd/m/y');
		$titulo = 'Trabajo hecho a '.$cliente.' el '.$fVisita.'';
	
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('C1', $titulo)
	->setCellValue('A3', 'Nº Trabajo')
	->setCellValue('B3', 'Cliente')
	->setCellValue('C3', 'Fecha visita')
	->setCellValue('D3', 'Ubicación')
	->setCellValue('E3', 'Descripción')
	->setCellValue('F3', 'Realizado por')
	->setCellValue('G3', 'Descripción Material')
	->setCellValue('H3', 'Observaciones')
	->setCellValue('I3', 'Duración');
	
	
	$celda = 4; //Donde se empieza
	$totalHoras = 0;

	$h1 = conversorHorasSegundos($trabajo['HoraE']);
	$h2 = conversorHorasSegundos($trabajo['HoraS']);
	$aux = abs($h1 - $h2);
	$duracion =  conversorSegundosHoras($aux);
	$totalHoras += $aux;
	
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$celda, $trabajo['Id'])
	->setCellValue('B'.$celda, $trabajo['IdCliente'])
	->setCellValue('C'.$celda, date_format(new DateTime($trabajo['FVisita']), 'd/m/y'))
	->setCellValue('D'.$celda, $trabajo['Ubicacion'])
	->setCellValue('E'.$celda, $trabajo['Descripcion'])
	->setCellValue('F'.$celda, $trabajo['Trabajador'])
	->setCellValue('G'.$celda, $trabajo['Descripcion'])
	->setCellValue('H'.$celda, $trabajo['Observaciones'])
	->setCellValue('I'.$celda, $duracion);

	$celda++;
	
$objPHPExcel->setActiveSheetIndex(0);
	//Bordes
	$borders = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );
	$objPHPExcel->getActiveSheet()->getStyle('A3:I'.($celda-1).'')->applyFromArray($borders);
	$objPHPExcel->getActiveSheet()->getStyle('B1:D1')->applyFromArray($borders);
	
	//Colores
	cellColor('B1:D1', 'D3F1EE');
	cellColor('A3:I3', 'D3F1EE');
	
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('Informe');
	// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
	$objPHPExcel->setActiveSheetIndex(0);
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="informe.xlsx"');
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
