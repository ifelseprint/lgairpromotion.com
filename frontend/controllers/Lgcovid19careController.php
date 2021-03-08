<?php
namespace frontend\controllers;
use yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use frontend\models\Register;
class Lgcovid19careController extends \yii\web\Controller
{
	public $APP_ID = 2;

	public function beforeAction($action)
	{
	  	$Application = \common\models\Application::find()
        ->where(['ID'=> $this->APP_ID])
        ->andWhere(['<=','DATE_RUN_APP', new \yii\db\Expression('NOW()')])
        ->andWhere(['>','DATE_WINNER', new \yii\db\Expression('NOW()')])
        ->one();

        if(empty($Application)){
        	echo "Campaign inactive.";
    		return false;	
        }
        return true;
	}

    public function actionIndex()
    {
        $this->layout = 'lgcovid19care/main';
    	$getUTM = Yii::$app->CoreFunctions->getUTM();

    	$Register = new Register;
    	$Register->UTM_SOURCE = $getUTM->utm_source;
        $Register->UTM_MEDIUM = $getUTM->utm_medium;
        $Register->UTM_CAMPAIGN = $getUTM->utm_campaign;
        return $this->render('index', [
            'Register' => $Register,
            'dataSerialNumber' => ArrayHelper::map(\common\models\SerialNumber::find()
            ->where(['APP_ID' => $this->APP_ID])
            ->groupBy(['MODEL'])
            ->all(), 'MODEL', 'MODEL'),
            'dataShop' => ArrayHelper::map(\common\models\Shop::find()
            ->where(['is_active' => 1])
            ->all(), 'id', 'shop_name')
    	]);
    }

    public function actionRegister()
    {

    	$Register = new Register;
    	if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            
            if ($Register->load($post)){

                $Quiz = array();
                $Quiz[] = $post['Register']['Q1'];
                $Quiz[] = $post['Register']['Q2'];
                $Quiz[] = $post['Register']['Q3'];

            	$postFirstname = $post['Register']['FIRSTNAME'];
            	$postLastname = $post['Register']['LASTNAME'];
            	$postModel = $post['Register']['SELECT_1'];
            	$postSerialNumber = $post['Register']['QUESTION_1'];
                $postDateService = date('Y-m-d', strtotime(str_replace('/', '-', $post['Register']['QUESTION_2'])));
                $postBirthday = date('Y-m-d', strtotime(str_replace('/', '-', $post['Register']['BIRTHDAY'])));

            	$SerialNumber = \common\models\SerialNumber::find()
		        ->where(['APP_ID'=> $this->APP_ID])
		        ->andWhere(['MODEL'=> $postModel])
		        ->andWhere(['SERIAL_NUMBER'=> $postSerialNumber])
		        ->andWhere(['IS_STATUS' => '0'])
		        ->one();

		        $Register->APP_ID = $this->APP_ID;
		        $Register->FULLNAME = $postFirstname." ".$postLastname;
		        $Register->CREATED_DATETIME = new \yii\db\Expression('NOW()');
		        $Register->CREATED_AT = 'user-event';

		        // IP Address
		        $Register->IP = Yii::$app->CoreFunctions->getIP();

		        if(!empty($SerialNumber)){

		        	$folder_name = date('Ym');
		        	$folder_upload = Yii::getAlias('@frontend').'/web/uploads/lgcovid19care';
			    	$folder = $folder_upload."/".$folder_name;
			        if (!is_dir($folder)) {
			            mkdir($folder);
			        }

			        $path_folder = $folder_name;

                    $Register->ID_CARD_IMAGE = UploadedFile::getInstance($Register, 'ID_CARD_IMAGE');
                    $ID_CARD_IMAGE  = 'id_card_'.time().'.'.$Register->ID_CARD_IMAGE->extension;
                    $ID_CARD_IMAGE_PATH  = $folder_upload."/".$path_folder."/".$ID_CARD_IMAGE;
                    $Register->ID_CARD_IMAGE->saveAs($ID_CARD_IMAGE_PATH);
                    $Register->ID_CARD_IMAGE = $ID_CARD_IMAGE;
                    $Register->ID_CARD_IMAGE_PATH = $path_folder;

			        $Register->FILE_1 = UploadedFile::getInstance($Register, 'FILE_1');
					$FILE_1  = 'file_'.time().'.'.$Register->FILE_1->extension;
					$PATH_FILE_1  = $folder_upload."/".$path_folder."/".$FILE_1;
					$Register->FILE_1->saveAs($PATH_FILE_1);
					$Register->FILE_1 = $FILE_1;
					$Register->PATH_FILE_1 = $path_folder;

                    $Register->BIRTHDAY = $postBirthday;
                    $Register->QUESTION_2 = $postDateService;
                    $Register->QUESTION_4 = implode(",",$Quiz);

	            	if ($Register->save()) {

	            		$SerialNumber->IS_STATUS = '1';
	            		$SerialNumber->save();

	                    return json_encode([
	                        "status" => true,
	                        "response" => '<div class="text-center"><h5><b>ท่านได้ทำการลงทะเบียนผู้ใช้และรับสิทธิ์เรียบร้อยแล้ว</b></h5>ผู้ที่ได้รับสิทธิ์จะได้รับข้อความ SMS ยืนยัน<br/>จาก TQM บริษัทที่ปรึกษาและนายหน้าประกัน</div>'
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
        }else{
        	return json_encode([
        		"status" => false,
        		"response" => 'error submit form'
        	]);
        }
    }
}
