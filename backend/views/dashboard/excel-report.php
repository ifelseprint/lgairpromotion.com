<?php
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use yii\helpers\Url;
$baseUrl = str_replace('/admin', '', Url::base(true));
// Create new Spreadsheet object
$formatter = \Yii::$app->formatter;
$spreadsheet = new Spreadsheet();

// Set active sheet
$spreadsheet->setActiveSheetIndex(0);
$sheet = $spreadsheet->getActiveSheet();

$header_row = array(
    'fill' => array(
        'fillType' => Fill::FILL_SOLID,
        'startColor' => array('rgb' => 'cccccc' )
    ),
    'font' => array(
        'color' => array('rgb' => '000000'),
    )
);

$date_range = $search['search_date_range'];

$row_sheet = 1;

$arrayHeader = ['CAMPAIGN','PREFIX','FULLNAME','TEL','EMAIL','ID_CARD_NO','FILE_ID_CARD_IMAGE','BIRTHDAY','ADDRESS','DISTRICT','AMPHUR','PROVINCE','ZIPCODE','POLICY','NEWSLETTER','BROKER','MODEL','SERIAL NUMBER','SHOP','DATE','FILE','QUESTION','IP','CREATED_DATETIME','UTM_SOURCE','UTM_MEDIUM','UTM_CAMPAIGN'];

$sheet->fromArray(
    $arrayHeader, // The data to set
    NULL, // Array values with this value will not be set
    'A'.$row_sheet // Top left coordinate of the worksheet range where
//  we want to set these values (default is A1)
);
$sheet->getStyle('A'.$row_sheet.':'.'AA'.$row_sheet)->applyFromArray($header_row);

$row_sheet++;
foreach($dataExcel as $data){

    $application = \common\models\Application::find()->where(['ID' => $data->APP_ID])->one();

    $FILE_1 = '';
    if(!empty($data->FILE_1)){
        $FILE_1 = $baseUrl.'/uploads/'.$application->LINK.'/'.$data->PATH_FILE_1.'/'.$data->FILE_1;
    }

    $FILE_ID_CARD_IMAGE = '';
    if(!empty($data->ID_CARD_IMAGE)){
        $FILE_ID_CARD_IMAGE = $baseUrl.'/uploads/'.$application->LINK.'/'.$data->ID_CARD_IMAGE_PATH.'/'.$data->ID_CARD_IMAGE;
    }

    $sheet->setCellValue("A".$row_sheet, $application->NAME);
    $sheet->setCellValue("B".$row_sheet, $data->PREFIX);
    $sheet->setCellValue("C".$row_sheet, $data->FULLNAME);
    $sheet->setCellValue("D".$row_sheet, $data->TEL);
    $sheet->setCellValue("E".$row_sheet, $data->EMAIL);
    $sheet->setCellValue("F".$row_sheet, $data->ID_CARD_NO);
    $sheet->setCellValue("G".$row_sheet, $FILE_ID_CARD_IMAGE);
    $sheet->setCellValue("H".$row_sheet, (!empty($data->BIRTHDAY) && $data->BIRTHDAY <> '01/01/1970' ? date('d/m/Y', strtotime($data->BIRTHDAY)) : '' ));
    $sheet->setCellValue("I".$row_sheet, $data->ADDRESS);
    $sheet->setCellValue("J".$row_sheet, $data->DISTRICT);
    $sheet->setCellValue("K".$row_sheet, $data->AMPHUR);
    $sheet->setCellValue("L".$row_sheet, $data->PROVINCE);
    $sheet->setCellValue("M".$row_sheet, $data->ZIPCODE);
    $sheet->setCellValue("N".$row_sheet, $data->SELECT_2);
    $sheet->setCellValue("O".$row_sheet, $data->SELECT_3);
    $sheet->setCellValue("P".$row_sheet, $data->SELECT_4);
    $sheet->setCellValue("Q".$row_sheet, $data->SELECT_1);
    $sheet->setCellValue("R".$row_sheet, $data->QUESTION_1);
    $sheet->setCellValue("S".$row_sheet, (!empty($Register->shop->shop_name) ? $data->shop->shop_name : ''));
    $sheet->setCellValue("T".$row_sheet, date('d/m/Y', strtotime($data->QUESTION_2)));
    $sheet->setCellValue("U".$row_sheet, $FILE_1);
    $sheet->setCellValue("V".$row_sheet, $data->QUESTION_4);
    $sheet->setCellValue("W".$row_sheet, $data->IP);
    $sheet->setCellValue("X".$row_sheet, date('d/m/Y', strtotime($data->CREATED_DATETIME)));
    $sheet->setCellValue("Y".$row_sheet, $data->UTM_SOURCE);
    $sheet->setCellValue("Z".$row_sheet, $data->UTM_MEDIUM);
    $sheet->setCellValue("AA".$row_sheet, $data->UTM_CAMPAIGN);

    $row_sheet++;

}

foreach ($sheet->getColumnIterator() as $column) {
    $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
}


// Rename worksheet
$sheet->setTitle('Report Campaign');

$fileName = "report_campaign_".date("Y_m_d")."_".date("His").'.xlsx';
// $path = '../web/files/';

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$fileName.'" ');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
// $writer->save("php://output");
// exit();

ob_start();
$writer->save("php://output");
$xlsData = ob_get_contents();

ob_end_clean();
$response =  array(
    'status' => $status,
    'result' => $result,
    'op' => 'ok',
    'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($xlsData),
    'filename' => $fileName
);
die(json_encode($response));