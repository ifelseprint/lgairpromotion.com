<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Request;
use yii\helpers\Url;
use yii\filters\AccessControl;
class FilemanagerController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['config','upload'],
                        'allow' => true,
                        'roles' => ['@'], // @ = login, ? = no login
                    ],
                ],
            ],
        ];
    }
    public function actionConfig()
    {
        if(YII_ENV=="prod"){
            $document_base_url = "/project/wehomemart.com/web/uploads/";
        }else{
            $document_base_url = "/project/wehomemart.com/web/uploads/";
        }

        echo json_encode(array('document_base_url' => $document_base_url));
    }
    public function actionUpload()
    {

        $folder_upload = Yii::getAlias('@frontend').'/web/uploads';
        $year = date("Y");
        $month = date("m");

        $folder = $folder_upload."/".$year;
        if (!is_dir($folder)) {
            mkdir($folder);
        }
        $folder = $folder_upload."/".$year."/".$month;
        if (!is_dir($folder)) {
            mkdir($folder);
        }

        foreach ($_FILES as $key => $file) {
            if (!empty($file['name'])) {
                $input_files[]  = $key;
                $info           = pathinfo($file['name']);
                $ext            = strtolower($info['extension']); // get the extension of the file
                $filename       = date("YdmHis")."_".$file['name'];

                if($ext=="png" || $ext=="jpg"){

                    if (move_uploaded_file($file['tmp_name'], $folder."/".$filename)) {

                        echo json_encode(array('location' => "../../uploads/".$year."/".$month."/".$filename));

                    } else {
                        echo json_encode(array('error' => 'File cannot not upload to '.$folder));
                        exit();
                    }
                }else{
                    echo json_encode(array('error' => 'File extension is support .xls and .xlsx'));
                    exit();
                }
            }else{
                echo json_encode(array('error' => 'File not found'));
                exit();
            }
        }
    }



}
