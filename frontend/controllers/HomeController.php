<?php
namespace frontend\controllers;
use yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use frontend\models\Register;
class HomeController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$Register = new Register; 
        return $this->render('index', [
            'Register' => $Register,
            'dataSerialNumber' => ArrayHelper::map(\common\models\SerialNumber::find()
            ->where(['APP_ID' => Yii::$app->params['appID']])
            ->groupBy(['MODEL'])
            ->all(), 'MODEL', 'MODEL'),
    	]);
    }

    public function actionRegister()
    {

    	$Register = new Register;
    	if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            
            if ($Register->load($post)){

            	$postFirstname = $post['Register']['FIRSTNAME'];
            	$postLastname = $post['Register']['LASTNAME'];
            	$postModel = $post['Register']['SELECT_1'];
            	$postSerialNumber = $post['Register']['QUESTION_1'];

            	$SerialNumber = \common\models\SerialNumber::find()
		        ->where(['APP_ID'=> Yii::$app->params['appID']])
		        ->andWhere(['MODEL'=> $postModel])
		        ->andWhere(['SERIAL_NUMBER'=> $postSerialNumber])
		        ->andWhere(['IS_STATUS' => '0'])
		        ->one();

		        $Register->APP_ID = Yii::$app->params['appID'];
		        $Register->FULLNAME = $postFirstname." ".$postLastname;
		        $Register->CREATED_DATETIME = new \yii\db\Expression('NOW()');
		        $Register->CREATED_AT = 'user-event';

		        // Tracking
		        $getUTM = Yii::$app->CoreFunctions->getUTM();
		        $Register->UTM_SOURCE = Yii::$app->session['utm_source'];
		        $Register->UTM_MEDIUM = Yii::$app->session['utm_medium'];
		        $Register->UTM_CAMPAIGN = Yii::$app->session['utm_campaign'];

		        // IP Address
		        $Register->IP = Yii::$app->CoreFunctions->getIP();

		        if(!empty($SerialNumber)){

		        	$folder_name = date('Ym');
		        	$folder_upload = Yii::getAlias('@frontend').'/web/uploads';
			    	$folder = $folder_upload."/".$folder_name;
			        if (!is_dir($folder)) {
			            mkdir($folder);
			        }

			        $path_folder = $folder_name;

			        $Register->FILE_1 = UploadedFile::getInstance($Register, 'FILE_1');
					$FILE_1  = $Register->FILE_1->baseName.'_'.time().'.'.$Register->FILE_1->extension;
					$PATH_FILE_1  = $folder_upload."/".$path_folder."/".$FILE_1;
					$Register->FILE_1->saveAs($PATH_FILE_1);
					$Register->FILE_1 = $FILE_1;
					$Register->PATH_FILE_1 = $path_folder;

	            	if ($Register->save()) {

	            		$SerialNumber->IS_STATUS = '1';
	            		$SerialNumber->save();

	                    return json_encode([
	                        "status" => true,
	                        "response" => "ทางเราได้รับข้อมูลของท่านเรียบร้อยแล้ว<br/>We have received your information successfully."
	                    ]);
	                }else{
	                    return json_encode([
	                        "status" => false,
	                        "response" => $Register->getErrors()
	                    ]);
	                }
	            }else{
	            	return json_encode([
                        "status" => false,
                        "response" => '<div class="invalid">หมายเลขซีเรียลไม่ถูกต้องหรือถูกใช้ไปแล้ว<br/>The serial number is invalid or used.</div>'
                    ]);
	            }
           	}else{
           		return json_encode([
           			"status" => false,
           			"response" => $Register->getErrors()
           		]);
           	}
        }
    }

}
