<?php
use yii\base\Widget;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
?>
<!-- Main content -->
<?php Pjax::begin(['id' => 'pjax-grid','timeout' => 0,'enablePushState' => false]); ?>
<div id="loadingOverlay" class="loader-overlay" style="display: none;">
    <div class="loader-content loader-center">
        <div id="loading" class="loader"></div>
    </div>
</div>
<?php
$action = Yii::$app->controller->action->id;

$form = ActiveForm::begin([
    'action' => ['home/register'],
    'method' => 'post',
    'options' => ['id' => 'formRegister', 'class' => 'form-horizontal','enctype' => 'multipart/form-data' ],
    'enableClientValidation' => true,
    'fieldConfig' => [
        'template' => "{input} {error}",
        'inputOptions' => ['class' => 'form-control form-control-sm'],
        'options' => [
          'data-pjax' => true,
          'tag' => false,
        ],
    ],
]); ?>
<div class="content" style="padding: 40px 0px;">
  <div class="container">
    <div class="row" style="margin-bottom: 40px;">
      <div class="col-sm-12">
          <div style="text-align: center;">
            <h2 style="margin:0px;"><span style="padding: 10px 30px; background: #c13442; color: #fff;">ลงทะเบียนเพื่อรับสิทธิที่นี่</span></h2>
          </div>
      </div>
    </div>
    <div class="row" style="margin-bottom: 40px;">
      <div class="col-sm-6">
        <h4 style="text-decoration: underline;">ข้อมูลส่วนตัว</h4>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">ชื่อ <span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <?= $form->field($Register, 'FIRSTNAME')->textInput(['class' => 'form-control form-control-sm','id'=>'FIRSTNAME','required'=> true,'errorMessage'=>'คุณยังไม่ได้ระบุชื่อ'])?>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">นามสกุล<span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <?= $form->field($Register, 'LASTNAME')->textInput(['class' => 'form-control form-control-sm','id'=>'LASTNAME','required'=> true,'errorMessage'=>'คุณยังไม่ได้ระบุนามสกุล'])?>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <div class="col-sm-3"></div>
          <div class="col-sm-9">
            <div style=" font-size: 14px;height:34px; color: #ababab;"><span class="field_required">*</span> ชื่อ และนามสกุล ที่ลงทะเบียนจะต้องเป็นชื่อเดียวกับที่ออกใบกำกับภาษีเท่านั้น</div>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">เบอร์โทรศัพท์ <span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <?= $form->field($Register, 'TEL')->textInput(['class' => 'form-control form-control-sm','id'=>'TEL','required'=> true,'onkeypress' =>'return appLG.App.OnlyNumbers(event)','pattern'=> '^0[0-9]{8,10}','maxlength' =>'10','errorMessage'=>'คุณยังไม่ได้ระบุเบอร์โทรศัพท์'])?>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">อีเมล <span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <?= $form->field($Register, 'EMAIL')->textInput(['class' => 'form-control form-control-sm','id'=>'EMAIL','required'=> true,'pattern'=>'[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$','errorMessage'=>'คุณยังไม่ได้ระบุอีเมล'])?>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <h4 style="text-decoration: underline;">ข้อมูลที่อยู่</h4>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">ที่อยู่ <span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <?= $form->field($Register, 'ADDRESS')->textInput(['class' => 'form-control form-control-sm','id'=>'ADDRESS','required'=> true,'errorMessage'=>'คุณยังไม่ได้ระบุที่อยู่'])?>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">รหัสไปรษณีย์ <span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <?= $form->field($Register, 'ZIPCODE')->dropDownList([],['prompt'=>'พิมพ์รหัสไปรษณีย์','class'=>'form-control form-control-sm select2','id' => 'ZIPCODE','required'=> true,'errorMessage'=>'คุณยังไม่ได้ระบุรหัสไปรษณีย์']); ?>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">จังหวัด <span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <?= $form->field($Register, 'PROVINCE')->textInput(['class' => 'form-control form-control-sm','id'=>'PROVINCE','readonly' => true,'required'=> true,'errorMessage'=>'คุณยังไม่ได้ระบุจังหวัด'])?>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">อำเภอ/เขต <span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <?= $form->field($Register, 'AMPHUR')->textInput(['class' => 'form-control form-control-sm','id'=>'AMPHUR','readonly' => true,'required'=> true,'errorMessage'=>'คุณยังไม่ได้ระบุอำเภอ/เขต'])?>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">ตำบล/แขวง <span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <?= $form->field($Register, 'DISTRICT')->textInput(['class' => 'form-control form-control-sm','id'=>'DISTRICT','readonly' => true,'required'=> true,'errorMessage'=>'คุณยังไม่ได้ระบุตำบล/แขวง'])?>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="margin-bottom: 20px;">
      <div class="col-md-12">
        <h4 style="text-decoration: underline;">ข้อมูลผลิตภัณฑ์</h4>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">รุ่นผลิตภัณฑ์ <span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <?= $form->field($Register, 'SELECT_1')->dropDownList($dataSerialNumber,['prompt'=>': : : กรุณาเลือก : : :','class'=>'form-control form-control-sm select2','id' => 'SELECT_1','required'=> true,'errorMessage'=>'คุณยังไม่ได้ระบุรุ่นผลิตภัณฑ์']); ?>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">หมายเลขซีเรียล <span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <?= $form->field($Register, 'QUESTION_1')->textInput(['class' => 'form-control form-control-sm','id'=>'QUESTION_1','required'=> true,'errorMessage'=>'คุณยังไม่ได้ระบุหมายเลขซีเรียล'])?>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">วันที่ต้องการรับบริการล้างแอร์ <span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <div class="input-calendar">
              <?= $form->field($Register, 'QUESTION_2')->textInput(['class' => 'form-control form-control-sm datepicker','id'=>'QUESTION_2','required'=> true,'pattern'=>'\d{1,2}/\d{1,2}/\d{4}','errorMessage'=>'คุณยังไม่ได้ระบุวันที่ต้องการรับบริการล้างแอร์'])?>
            </div>
            <span style=" font-size: 14px; color: #ababab;"><span class="field_required">*</span> กำหนดให้เริ่มรับบริการได้ตั้งแต่วันที่ 1 มีนาคม 2564 - 31 ธันวาคม 2564</span>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">แนบใบเสร็จสินค้า <span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <label for="FILE_1" class="custom-file-upload">
                <i class="fa fa-cloud-upload"></i> BROWSE
            </label>
            <?= $form->field($Register, 'FILE_1')->fileInput(['class' => 'form-control form-control-sm','id'=>'FILE_1','required'=> true,'pattern' => '^.+\.(jpg|png|jpeg)$','errorMessage'=>'คุณยังไม่ได้ระบุไฟล์แนบใบเสร็จสินค้า'])?>
            <span style=" font-size: 14px; color: #ababab;"><span class="field_required">*</span> ใบเสร็จที่ลงทะเบียนต้องออกเป็นใบกำกับภาษีเท่านั้น</span>
            <div class="file_result" style=" font-size: 14px; color: #ababab;"></div>
          </div>
        </div>
        <div class="form-group-sm row">
          <label class="col-sm-3"></label>
          <div class="col-sm-9">
            <?= $form->field($Register, "SELECT_2")->checkbox(['value' => "1",'required'=> true,'label' => 'ฉันได้อ่านนโยบายป้องกันข้อมูลโดยละเอียดแล้ว ตกลงยินยอมอนุญาตตามที่กำหนดไว้ในเงื่อนไขของขโยบายป้องกันข้อมูลทุกประกาศ <a href="'.Yii::$app->request->baseUrl.'/privacy-policy" style="text-decoration: underline;" target="_blank">อ่านนโยบายเพิ่มเติม</a>']); ?>
          </div>
        </div>
        <div class="form-group-sm row">
          <label class="col-sm-3"></label>
          <div class="col-sm-9">
            <?= $form->field($Register, "SELECT_3")->checkbox(['value' => "1",'required'=> true,'label' => 'ฉันต้องการที่จะได้รับข่าวสารล่าสุดและข้อเสนอจากแอลจี อีเล็กทรอนิกส์']); ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12" style="text-align: center;">
        <?= $form->field($Register, 'UTM_SOURCE')->textInput(['type' => 'hidden','id'=>'UTM_SOURCE'])?>
        <?= $form->field($Register, 'UTM_MEDIUM')->textInput(['type' => 'hidden','id'=>'UTM_MEDIUM'])?>
        <?= $form->field($Register, 'UTM_CAMPAIGN')->textInput(['type' => 'hidden','id'=>'UTM_CAMPAIGN'])?>
        <?= Html::Button(Yii::t('app', '<i class="fa fa-floppy-o"></i> SUBMIT'), ['class' => 'btn btn-primary btn-sm submit-register']) ?>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<?php ActiveForm::end(); ?>
<?php

$script = <<<JS
$("document").ready(function(){
  appLG.App.initializeInPjax();
});
JS;
$this->registerJs($script,\yii\web\View::POS_READY);
?>

<?php Pjax::end(); ?>
