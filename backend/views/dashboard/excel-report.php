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

$arrayHeader = ['CAMPAIGN','FULLNAME','TEL','EMAIL','ADDRESS','DISTRICT','AMPHUR','PROVINCE','ZIPCODE','POLICY','NEWSLETTER','MODEL','SERIAL NUMBER','SERVICE_DATE','FILE','IP','CREATED_DATETIME','UTM_SOURCE','UTM_MEDIUM','UTM_CAMPAIGN'];

$sheet->fromArray(
    $arrayHeader, // The data to set
    NULL, // Array values with this value will not be set
    'A'.$row_sheet // Top left coordinate of the worksheet range where
//  we want to set these values (default is A1)
);
$sheet->getStyle('A'.$row_sheet.':'.'T'.$row_sheet)->applyFromArray($header_row);

$row_sheet++;
foreach($dataExcel as $data){

    $application = \common\models\Application::find()->where(['ID' => $data->APP_ID])->one();

    $FILE = '';
    if(!empty($data->FILE_1)){
        $FILE = $baseUrl.'/uploads/'.$application->LINK.'/'.$data->PATH_FILE_1.'/'.$data->FILE_1;
    }

    $sheet->setCellValue("A".$row_sheet, $application->NAME);
    $sheet->setCellValue("B".$row_sheet, $data->FULLNAME);
    $sheet->setCellValue("C".$row_sheet, $data->TEL);
    $sheet->setCellValue("D".$row_sheet, $data->EMAIL);
    $sheet->setCellValue("E".$row_sheet, $data->ADDRESS);
    $sheet->setCellValue("F".$row_sheet, $data->DISTRICT);
    $sheet->setCellValue("G".$row_sheet, $data->AMPHUR);
    $sheet->setCellValue("H".$row_sheet, $data->PROVINCE);
    $sheet->setCellValue("I".$row_sheet, $data->ZIPCODE);
    $sheet->setCellValue("J".$row_sheet, $data->SELECT_2);
    $sheet->setCellValue("K".$row_sheet, $data->SELECT_3);
    $sheet->setCellValue("L".$row_sheet, $data->SELECT_1);
    $sheet->setCellValue("M".$row_sheet, $data->QUESTION_1);
    $sheet->setCellValue("N".$row_sheet, date('d/m/Y', strtotime($data->QUESTION_2)));
    $sheet->setCellValue("O".$row_sheet, $FILE);
    $sheet->setCellValue("P".$row_sheet, $data->IP);
    $sheet->setCellValue("Q".$row_sheet, date('d/m/Y', strtotime($data->CREATED_DATETIME)));
    $sheet->setCellValue("R".$row_sheet, $data->UTM_SOURCE);
    $sheet->setCellValue("S".$row_sheet, $data->UTM_MEDIUM);
    $sheet->setCellValue("T".$row_sheet, $data->UTM_CAMPAIGN);

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