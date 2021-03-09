<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<?php
$action = Yii::$app->controller->action->id;

$form = ActiveForm::begin([
    'action' => ['lgcovid19care/register'],
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
            <h2 style="margin:0px;"><span style="padding: 10px 30px; background: #c13442; color: #fff;">ลงทะเบียนเพื่อรับสิทธิ์ที่นี่</span></h2>
          </div>
      </div>
    </div>
    <div class="row" style="margin-bottom: 40px;">
      <div class="col-sm-12">
        <h4 style="text-decoration: underline;">ข้อมูลส่วนตัว</h4>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-2">ชื่อ <span class="field_required">*</span> :</label>
          <div class="col-sm-4">
            <div class="form-group-sm row" style="margin-bottom: 10px;">
              <div class="col-3 col-sm-4">
                <?php
                $dataPrefix = ['นาย'=>'นาย','นาง'=>'นาง','นางสาว'=>'นางสาว'];
                ?>
                <?= $form->field($Register, 'PREFIX')->dropDownList($dataPrefix,['class'=>'form-control form-control-sm select2','id' => 'PREFIX','required'=> true,'data-msg'=>'คุณยังไม่ได้ระบุคำนำหน้าชื่อ']); ?>
              </div>
              <div class="col-9 col-sm-8">
                <?= $form->field($Register, 'FIRSTNAME')->textInput(['class' => 'form-control form-control-sm','id'=>'FIRSTNAME','required'=> true,'data-msg'=>'คุณยังไม่ได้ระบุชื่อ',])?>
              </div>
            </div>
          </div>

          <label class="col-sm-2">นามสกุล<span class="field_required">*</span> :</label>
          <div class="col-sm-4">
            <?= $form->field($Register, 'LASTNAME')->textInput(['class' => 'form-control form-control-sm','id'=>'LASTNAME','required'=> true,'data-msg'=>'คุณยังไม่ได้ระบุนามสกุล'])?>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <div class="col-xs-6 col-sm-2"></div>
          <div class="col-sm-4">
            <div style=" font-size: 14px;height:34px; color: #ababab;"><span class="field_required">*</span> ชื่อ และนามสกุล ที่ลงทะเบียนจะต้องเป็นชื่อเดียวกับที่ออกใบกำกับภาษีเท่านั้น</div>
          </div>
          <label class="col-sm-2">วัน/เดือน/ปีเกิด <span class="field_required">*</span>:</label>
          <div class="col-sm-4">
            <div class="input-calendar">
              <?= $form->field($Register, 'BIRTHDAY')->textInput(['class' => 'form-control form-control-sm datepicker','id'=>'BIRTHDAY','required'=> true,'pattern'=>'\d{1,2}/\d{1,2}/\d{4}','data-msg'=>'คุณยังไม่ได้ระบุวันวัน/เดือน/ปีเกิด'])?>
            </div>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-2">เบอร์โทรศัพท์ <span class="field_required">*</span> :</label>
          <div class="col-sm-4">
            <?= $form->field($Register, 'TEL')->textInput(['class' => 'form-control form-control-sm','id'=>'TEL','required'=> true,'onkeypress' =>'return appLG.App.OnlyNumbers(event)','pattern'=> '^0[0-9]{8,10}','maxlength' =>'10','data-msg'=>'ข้อมูลเบอร์โทรศัพท์ไม่ถูกต้อง และห้ามเป็นค่าว่าง'])?>
            <div style="font-size: 14px;color: #ababab;"><span class="field_required">*</span> หมายเลขโทรศัพท์ที่ใช้งานในปัจจุบันเท่านั้น</div>
          </div>

          <label class="col-sm-2">อีเมล <span class="field_required">*</span> :</label>
          <div class="col-sm-4">
            <?= $form->field($Register, 'EMAIL')->textInput(['class' => 'form-control form-control-sm','id'=>'EMAIL','required'=> true,'pattern'=>'[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$','data-msg'=>'ข้อมูลอีเมลไม่ถูกต้อง และห้ามเป็นค่าว่าง'])?>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-2">เลขบัตรประชาชน <span class="field_required">*</span> :</label>
          <div class="col-sm-4">
            <?= $form->field($Register, 'ID_CARD_NO')->textInput(['class' => 'form-control form-control-sm','id'=>'ID_CARD_NO','required'=> true,'data-msg'=>'คุณยังไม่ได้ระบุเลขบัตรประชาชน'])?>
          </div>

          <label class="col-sm-2">รูปภาพบัตรประชาชน <span class="field_required">*</span> :</label>
          <div class="col-sm-4">
            <label for="ID_CARD_IMAGE" class="custom-file-upload">
                <i class="fa fa-cloud-upload"></i> อัพโหลดไฟล์
            </label>
            <?= $form->field($Register, 'ID_CARD_IMAGE')->fileInput(['class' => 'form-control form-control-sm','id'=>'ID_CARD_IMAGE','required'=> true,'target_preview'=>'#preview_id_card_image','pattern' => '^.+\.(jpg|png|jpeg)$','data-msg'=>'คุณยังไม่ได้ระบุไฟล์แนบรูปภาพบัตรประชาชน หรือนามสกุลไฟล์ไม่ถูกต้อง jpg,png,jpeg'])?>
            <div id="preview_id_card_image" style=" font-size: 14px; color: #ababab;"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="margin-bottom: 40px;">
      <div class="col-sm-12">
        <h4 style="text-decoration: underline;">ข้อมูลที่อยู่</h4>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-2">ที่อยู่ <span class="field_required">*</span> :</label>
          <div class="col-sm-10">
            <?= $form->field($Register, 'ADDRESS')->textInput(['class' => 'form-control form-control-sm','id'=>'ADDRESS','required'=> true,'data-msg'=>'คุณยังไม่ได้ระบุที่อยู่'])?>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-2">รหัสไปรษณีย์ <span class="field_required">*</span> :</label>
          <div class="col-sm-4">
            <?= $form->field($Register, 'ZIPCODE')->dropDownList([],['prompt'=>'พิมพ์รหัสไปรษณีย์','class'=>'form-control form-control-sm select2','id' => 'ZIPCODE','required'=> true,'data-msg'=>'คุณยังไม่ได้ระบุรหัสไปรษณีย์']); ?>
          </div>
          <label class="col-sm-2">จังหวัด <span class="field_required">*</span> :</label>
          <div class="col-sm-4">
            <?= $form->field($Register, 'PROVINCE')->textInput(['class' => 'form-control form-control-sm','id'=>'PROVINCE','readonly' => true,'required'=> true,'data-msg'=>'คุณยังไม่ได้ระบุจังหวัด'])?>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-2">อำเภอ/เขต <span class="field_required">*</span> :</label>
          <div class="col-sm-4">
            <?= $form->field($Register, 'AMPHUR')->textInput(['class' => 'form-control form-control-sm','id'=>'AMPHUR','readonly' => true,'required'=> true,'data-msg'=>'คุณยังไม่ได้ระบุอำเภอ/เขต'])?>
          </div>

          <label class="col-sm-2">ตำบล/แขวง <span class="field_required">*</span> :</label>
          <div class="col-sm-4">
            <?= $form->field($Register, 'DISTRICT')->textInput(['class' => 'form-control form-control-sm','id'=>'DISTRICT','readonly' => true,'required'=> true,'data-msg'=>'คุณยังไม่ได้ระบุตำบล/แขวง'])?>
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
            <?= $form->field($Register, 'SELECT_1')->dropDownList($dataSerialNumber,['prompt'=>'::: เลือก :::','class'=>'form-control form-control-sm select2','id' => 'SELECT_1','required'=> true,'data-msg'=>'คุณยังไม่ได้ระบุรุ่นผลิตภัณฑ์']); ?>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">หมายเลขซีเรียลคอยล์เย็น (Indoor) <span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <?= $form->field($Register, 'QUESTION_1')->textInput(['class' => 'form-control form-control-sm','id'=>'QUESTION_1','required'=> true,'data-msg'=>'คุณยังไม่ได้ระบุหมายเลขซีเรียล'])?>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">ร้านค้าที่ซื้อสินค้า <span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <?= $form->field($Register, 'QUESTION_3')->dropDownList($dataShop,['prompt'=>'::: เลือก :::','class'=>'form-control form-control-sm select2','id' => 'QUESTION_3','required'=> true,'data-msg'=>'คุณยังไม่ได้ระบุร้านค้าที่ซื้อสินค้า']); ?>
            <div style="font-size: 14px;color: #ababab;"><span class="field_required">*</span> ระบุข้อมูลเป็นภาษาไทยเท่านั้น</div>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">วันที่ซื้อสินค้าตามใบกำกับภาษี <span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <div class="input-calendar">
              <?= $form->field($Register, 'QUESTION_2')->textInput(['class' => 'form-control form-control-sm datepicker','id'=>'QUESTION_2','required'=> true,'pattern'=>'\d{1,2}/\d{1,2}/\d{4}','data-msg'=>'คุณยังไม่ได้ระบุวันที่ซื้อสินค้าตามใบกำกับภาษี'])?>
            </div>
            <!-- <span style=" font-size: 14px; color: #ababab;"><span class="field_required">*</span> กำหนดให้เริ่มรับบริการได้ตั้งแต่วันที่ 1 มีนาคม 2564 - 31 ธันวาคม 2564</span> -->
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <label class="col-sm-3">รูปภาพใบกำกับภาษี <span class="field_required">*</span> :</label>
          <div class="col-sm-9">
            <label for="FILE_1" class="custom-file-upload">
                <i class="fa fa-cloud-upload"></i> อัพโหลดไฟล์
            </label>
            <?= $form->field($Register, 'FILE_1')->fileInput(['class' => 'form-control form-control-sm','id'=>'FILE_1','required'=> true,'target_preview'=>'#preview_file1','pattern' => '^.+\.(jpg|png|jpeg)$','data-msg'=>'คุณยังไม่ได้ระบุไฟล์แนบใบเสร็จสินค้า หรือนามสกุลไฟล์ไม่ถูกต้อง jpg,png,jpeg'])?>
            <span style=" font-size: 14px; color: #ababab;"><span class="field_required">*</span> ใบกำกับภาษีประเภทบุคคลธรรมดาเท่านั้น</span>
            <div id="preview_file1" style=" font-size: 14px; color: #ababab;"></div>
          </div>
        </div>
        <div class="form-group-sm row">
          <label class="col-sm-3"></label>
          <div class="col-sm-9">
            <?= $form->field($Register, "SELECT_2")->checkbox(['value' => "1",'required'=> true,'label' => 'ฉันได้อ่านนโยบายป้องกันข้อมูลโดยละเอียดแล้ว ตกลงยินยอมอนุญาตตามที่กำหนดไว้ในเงื่อนไขของนโยบายป้องกันข้อมูลทุกประกาศ <a href="'.Url::base(true).'/privacy-policy" style="text-decoration: underline;color: #c13442;" target="_blank">อ่านนโยบายเพิ่มเติม</a>','data-msg'=>'คุณยังไม่ได้เลือกยอมรับข้อนี้']); ?>
          </div>
        </div>
        <div class="form-group-sm row">
          <label class="col-sm-3"></label>
          <div class="col-sm-9">
            <?= $form->field($Register, "SELECT_3")->checkbox(['value' => "1",'label' => 'ฉันต้องการที่จะได้รับข่าวสารล่าสุดและข้อเสนอจากแอลจี อีเลคทรอนิคส์','data-msg'=>'คุณยังไม่ได้เลือกยอมรับข้อนี้']); ?>
          </div>
        </div>

        <div class="form-group-sm row">
          <label class="col-sm-3"></label>
          <div class="col-sm-9">
            <?= $form->field($Register, "SELECT_4")->checkbox(['value' => "1",'required'=> true,'label' => 'ฉันยินยอมให้เปิดเผยข้อมูลส่วนบุคคลแก่บริษัท TQM ที่ปรึกษาและนายหน้าประกัน เพื่อส่งต่อข้อมูลสำหรับทำประกัน COVID-19 ของบริษัทสินทรัพย์ประกันภัยเท่านั้น','data-msg'=>'คุณยังไม่ได้เลือกยอมรับข้อนี้']); ?>
          </div>
        </div>

      </div>
    </div>
    <div class="row" style="margin-bottom: 20px;">
      <div class="col-md-12">
        <h4 style="text-decoration: underline;">ข้อมูลแบบสอบถาม</h4>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <div class="col-sm-12">
            <div>1. ท่านเป็นผู้ที่มีสัญชาติไทย และพักอาศัยอยู่ในประเทศไทย หรือไม่</div>
            <?= $form->field($Register, 'Q1')->radioList(
              ['Y' => 'ใช่', 'N' => 'ไม่ใช่'],
              [
                'item' => function($index, $label, $name, $checked, $value) {
                  $return = '<label>';
                  $return .= '<input type="radio" required data-msg="คุณยังไม่ได้เลือกข้อนี้" name="' . $name . '" value="' . $value . '"> ';
                  $return .= $label.'</label>';
                  return $return;
                }
              ]
            ); ?>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <div class="col-sm-12">
            <div>2. ท่านมีหรือได้ขอเอาประกันที่คุ้มครองการเจ็บป่วยด้วยโรคติดเชื้อจากไวรัสโคโรนา 2019 (COVID-19) จากบริษัทสินทรัพย์ประกันภัย หรือไม่</div>
            <?= $form->field($Register, 'Q2')->radioList(
              ['Y' => 'ใช่', 'N' => 'ไม่ใช่'],
              [
                'item' => function($index, $label, $name, $checked, $value) {
                  $return = '<label>';
                  $return .= '<input type="radio" required data-msg="คุณยังไม่ได้เลือกข้อนี้" name="' . $name . '" value="' . $value . '"> ';
                  $return .= $label.'</label>';
                  return $return;
                }
              ]
            ); ?>
            <div style=" font-size: 14px; color: #ababab;"><span class="field_required">*</span> หากท่านมีประกัน COVID-19 จากบริษัทสินทรัพย์ประกันภัยอยู่แล้ว จะสามารถเลือกรับได้เพียง 1 กรมธรรม์เท่านั้น</div>
          </div>
        </div>
        <div class="form-group-sm row" style="margin-bottom: 10px;">
          <div class="col-sm-12">
            <div>3. ท่านมีอาการเป็นไข้สูง ไอ จาม จมูกไม่รับกลิ่น ลิ้นไม่รับรส หรืออาการอื่นๆ ที่เข้าข่ายติดเชื้อจากไวรัสโคโรนา 2019 (COVID-19) มาก่อนการสมัครประกันภัย</div>
            <?= $form->field($Register, 'Q3')->radioList(
              ['Y' => 'ใช่', 'N' => 'ไม่ใช่'],
              [
                'item' => function($index, $label, $name, $checked, $value) {
                  $return = '<label>';
                  $return .= '<input type="radio" required data-msg="คุณยังไม่ได้เลือกข้อนี้" name="' . $name . '" value="' . $value . '"> ';
                  $return .= $label.'</label>';
                  return $return;
                }
              ]
            ); ?>
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