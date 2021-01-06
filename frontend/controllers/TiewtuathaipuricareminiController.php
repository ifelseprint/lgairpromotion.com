<?php
namespace frontend\controllers;
use yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use frontend\models\Register;
class TiewtuathaipuricareminiController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	echo "Campaign inactive.";
    	exit;
        $this->layout = 'tiewtuathaipuricaremini/main';
    	$getUTM = Yii::$app->CoreFunctions->getUTM();

    	$Register = new Register;
    	$Register->UTM_SOURCE = $getUTM->utm_source;
        $Register->UTM_MEDIUM = $getUTM->utm_medium;
        $Register->UTM_CAMPAIGN = $getUTM->utm_campaign;
        return $this->render('index', [
            'Register' => $Register,
            'dataSerialNumber' => ArrayHelper::map(\common\models\SerialNumber::find()
            ->where(['APP_ID' => 2])
            ->groupBy(['MODEL'])
            ->all(), 'MODEL', 'MODEL')
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
		        ->where(['APP_ID'=> 2])
		        ->andWhere(['MODEL'=> $postModel])
		        ->andWhere(['SERIAL_NUMBER'=> $postSerialNumber])
		        ->andWhere(['IS_STATUS' => '0'])
		        ->one();

		        $Register->APP_ID = '2';
		        $Register->FULLNAME = $postFirstname." ".$postLastname;
		        $Register->CREATED_DATETIME = new \yii\db\Expression('NOW()');
		        $Register->CREATED_AT = 'user-event';

		        // IP Address
		        $Register->IP = Yii::$app->CoreFunctions->getIP();

		        if(!empty($SerialNumber)){

		        	$folder_name = date('Ym');
		        	$folder_upload = Yii::getAlias('@frontend').'/web/uploads/tiewtuathaipuricaremini';
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
	                        "response" => '<div class="text-center"><h5><b>ท่านได้ทำการลงทะเบียนผู้ใช้และรับสิทธิ์เรียบร้อยแล้ว</b></h5>เจ้าหน้าที่จะทำการติดต่อกลับเพื่อยืนยันสิทธิ์<br/>และนัดหมายให้บริการอีกครั้ง หลังจากสิ้นสุดระยะเวลาการลงทะเบียน</div>'
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
                        "response" => '<div class="text-center" style="color: #f00;"><h5><b>ลงทะเบียนไม่สำเร็จ</b></h5>หมายเลขซีเรียลไม่ถูกต้องหรือถูกใช้ไปแล้ว</div>'
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
