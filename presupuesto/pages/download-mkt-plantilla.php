<?php
session_start();
ini_set("max_execution_time", "7200");
include("conexion/conexion.php");
include("conexion/conexionODBC.php");

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);


$username   = $_SESSION['username'];
$sql        = $_SESSION['sqlmkt'];
$result     = db_select($sql);
//

$file = basename("plantilla_mkt_" . date("Ymd") . "_" . date("His"));

define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

// Create new PHPExcel object
echo date('H:i:s'), " Documento creado con exito ", EOL;
$objPHPExcel = new PHPExcel();

// Set document properties
echo date('H:i:s'), " Agregando propiedades del documento ", EOL;
$objPHPExcel->getProperties()->setCreator("Grupo Planeta México")
    ->setLastModifiedBy("Grupo Planeta México")
    ->setTitle("Plantilla Presupuesto")
    ->setSubject("Plantilla Presupuesto")
    ->setDescription("Plantilla Presupuesto")
    ->setKeywords("Grupo Planeta México ")
    ->setCategory("Plantilla Presupuesto");

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo');
$objDrawing->setPath('images/firmas/EPM880422LV3.jpg');
$objDrawing->setHeight(90);
$objDrawing->setCoordinates('F1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// Add some data

echo date('H:i:s'), " Agregando Cabecera de Resumen General ", EOL;
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A6', '#')
    ->setCellValue('B6', 'Epigrafe')
    ->setCellValue('C6', 'Nombre Epigrafe')
    ->setCellValue('D6', 'Clave')
    ->setCellValue('E6', 'Descripción del Gasto')
    ->setCellValue('F6', 'Motivo del Gasto')
    ->setCellValue('G6', 'REAL/ENE')
    ->setCellValue('H6', 'PPTO/ENE')
    ->setCellValue('I6', 'REAL/FEB')
    ->setCellValue('J6', 'PPTO/FEB')
    ->setCellValue('K6', 'REAL/MAR')
    ->setCellValue('L6', 'PPTO/MAR')
    ->setCellValue('M6', 'REAL/ABR')
    ->setCellValue('N6', 'PPTO/ABR')
    ->setCellValue('O6', 'REAL/MAY')
    ->setCellValue('P6', 'PPTO/MAY')
    ->setCellValue('Q6', 'REAL/JUN')
    ->setCellValue('R6', 'PPTO/JUN')
    ->setCellValue('S6', 'REAL/JUL')
    ->setCellValue('T6', 'PPTO/JUL')
    ->setCellValue('U6', 'REAL/AGO')
    ->setCellValue('V6', 'PPTO/AGO')
    ->setCellValue('W6', 'REAL/SEP')
    ->setCellValue('X6', 'PPTO/SEP')
    ->setCellValue('Y6', 'REAL/OCT')
    ->setCellValue('Z6', 'PPTO/OCT')
    ->setCellValue('AA6', 'REAL/NOV')
    ->setCellValue('AB6', 'PPTO/NOV')
    ->setCellValue('AC6', 'REAL/DIC')
    ->setCellValue('AD6', 'PPTO/DIC');

$i = 7;
$cont   = 0;
foreach ($result as $key) {
    $cont++;
    $Depigrafe = FnDatosepigrafe($key['ID_epigrafe']);

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $i, $cont)
        ->setCellValue('B' . $i, $Depigrafe['cuentajde'])
        ->setCellValue('C' . $i, utf8_encode($Depigrafe['epigrafe']))
        ->setCellValue('D' . $i, $Depigrafe['clave'])
        ->setCellValue('E' . $i, utf8_encode($Depigrafe['desgasto']))
        ->setCellValue('F' . $i, utf8_encode($Depigrafe['motgasto']))
        ->setCellValue('G' . $i, 0)
        ->setCellValue('H' . $i, 0)
        ->setCellValue('I' . $i, 0)
        ->setCellValue('J' . $i, 0)
        ->setCellValue('K' . $i, 0)
        ->setCellValue('L' . $i, 0)
        ->setCellValue('M' . $i, 0)
        ->setCellValue('N' . $i, 0)
        ->setCellValue('O' . $i, 0)
        ->setCellValue('P' . $i, 0)
        ->setCellValue('Q' . $i, 0)
        ->setCellValue('R' . $i, 0)
        ->setCellValue('S' . $i, 0)
        ->setCellValue('T' . $i, 0)
        ->setCellValue('U' . $i, 0)
        ->setCellValue('V' . $i, 0)
        ->setCellValue('W' . $i, 0)
        ->setCellValue('X' . $i, 0)
        ->setCellValue('Y' . $i, 0)
        ->setCellValue('Z' . $i, 0)
        ->setCellValue('AA' . $i, 0)
        ->setCellValue('AB' . $i, 0)
        ->setCellValue('AC' . $i, 0)
        ->setCellValue('AD' . $i, 0);

    $i++;
} //While


//$objPHPExcel->getActiveSheet()->getStyle('F7:F'.$i)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );	
//$objPHPExcel->getActiveSheet()->getStyle('D7:D'.$i)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );


// Miscellaneous glyphs, UTF-8
$r = $i - 1;
$t = $i + 1;
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:D1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:D2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:D3');
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Plantilla de Presupuesto - Presini')
    ->setCellValue('A2', 'Creado por: ' . $username)
    ->setCellValue('A3', 'Fecha de emisión ' . date("d/m/Y"));
//->setCellValue('E'.$t, 'Totales');
//->setCellValue('G'.$t, '=SUM(G7:G'.($i-1).')')
//->setCellValue('H'.$t, '=SUM(H7:H'.($i-1).')');
//->setCellValue('I'.$i, );

$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);

//Borde
//$objPHPExcel->getActiveSheet()->getStyle('E'.$t.':H'.$t)->applyFromArray($styleArray);
unset($styleArray);

function cellColor($cells, $color)
{
    global $objPHPExcel;

    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
            'rgb' => $color
        )
    ));
}

function FnDatosepigrafe($ID)
{
    $BTBEPI = "SELECT * FROM tb_mkt_epigrafes WHERE ID=" . $ID . " ";
    $RTBEPI = db_select($BTBEPI);

    if (count($RTBEPI) > 0) {
        $datos['cuentatg']  = $RTBEPI[0]['cuentatg'];
        $datos['cuentajde'] = $RTBEPI[0]['cuentajde'];
        $datos['epigrafe']  = $RTBEPI[0]['epigrafe'];
        $datos['clave']     = $RTBEPI[0]['clave'];
        $datos['desgasto']  = $RTBEPI[0]['desgasto'];
        $datos['motgasto']  = $RTBEPI[0]['motgasto'];
    } else {
        $datos['cuentatg']  = '';
        $datos['cuentajde'] = '';
        $datos['epigrafe']  = '';
        $datos['clave']     = '';
        $datos['desgasto']  = '';
        $datos['motgasto']  = '';
    }


    return $datos;
}



$objPHPExcel->getActiveSheet()->getStyle('A6:AD6')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$objPHPExcel->getActiveSheet()->getStyle('A6:AD6')->getFont()->setSize(10);
$objPHPExcel->getActiveSheet()->getStyle('A6:AD6')->getFont()->setBold(true);

//Número
$objPHPExcel->getActiveSheet()->getStyle('G7:AD' . $t)->getNumberFormat()->setFormatCode('#,##0.00');

//$objPHPExcel->getActiveSheet()->getStyle('E'.$t.':H'.$t)->getFont()->setSize(14);
//$objPHPExcel->getActiveSheet()->getStyle('E'.$t.':H'.$t)->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A1:A1')->getFont()->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('A1:A1')->getFont()->setBold(true);


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);

$objPHPExcel->getActiveSheet()->getStyle('A6:AD6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A6:AD6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A1:A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A7:AD' . $t)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A7:AD' . $t)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);



cellColor('A6:AD6', '204CAF');
for ($c = 8; $c <= $r;) {
    cellColor('A' . $c . ':AD' . $c . '', 'DCE6F1');
    $c = $c + 2;
}
//cellColor('G7:G'.$r.'', 'EBF1DE');
//cellColor('H7:H'.$r.'', 'DAEEF3');


// Rename worksheet
echo date('H:i:s'), " Renombrando hoja de trabajo ", EOL;
$objPHPExcel->getActiveSheet()->setTitle('PPTO');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Save Excel 2007 file
echo date('H:i:s'), " Guardando el documento en formato Office 2010 ", EOL;
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
//$objWriter->setPreCalculateFormulas(true);
//$objWriter->save($file.'.xlsx');
//$objWriter->save("php://output");

$objWriter->save('excel/' . $file . '.xlsx');

$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

//echo date('H:i:s') , " Documento guardado en: " , str_replace('.php', '.xlsx', pathinfo($file, PATHINFO_BASENAME)) , EOL;
echo date('H:i:s'), ' Tiempo de ejecución ', sprintf('%.4f', $callTime), " seconds", EOL;
// Echo memory usage
echo date('H:i:s'), ' Memoria usada en la ejecución: ', (memory_get_usage(true) / 1024 / 1024), " MB", EOL;



// Echo memory peak usage
echo date('H:i:s'), " Pico de memoria usada: ", (memory_get_peak_usage(true) / 1024 / 1024), " MB", EOL;


header("Location: download_excel.php?file=" . $file . ".xlsx ");
exit();
