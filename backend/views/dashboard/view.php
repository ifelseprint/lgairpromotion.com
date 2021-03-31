<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<?php
$form = ActiveForm::begin([
    'action' => ['dashboard/save/'.base64_encode($Register->ID)],
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
<table class="table table-striped table-sm m-0 table-bordered">
	<tr>
		<td width="160">แคมเปญ : </td>
		<td><?=$Register->application->NAME;?></td>
	</tr>

	<?php
    $dataPrefix = ['นาย'=>'นาย','นาง'=>'นาง','นางสาว'=>'นางสาว','เด็กชาย'=>'เด็กชาย','เด็กหญิง'=>'เด็กหญิง'];
    ?>
    <?php if(!empty($Register->PREFIX)){ ?>
    <tr>
		<td>นำหน้าชื่อ : </td>
		<td><?= $form->field($Register, 'PREFIX')->dropDownList($dataPrefix,['class'=>'form-control form-control-sm select2','id' => 'PREFIX','required'=> true,'data-msg'=>'คุณยังไม่ได้ระบุคำนำหน้าชื่อ']); ?></td>
	</tr>
	<?php } ?>

	<tr>
		<td>ชื่อ-นามสกุล : </td>
		<td><?= $form->field($Register, 'FULLNAME')->textInput(['class' => 'form-control form-control-sm'])?></td>
	</tr>

	<?php if(!empty($Register->BIRTHDAY) && $Register->BIRTHDAY <> '01/01/1970'){ ?>
	<tr>
		<td>วัน/เดือน/ปีเกิด : </td>
		<td><?= $form->field($Register, 'BIRTHDAY')->textInput(['class' => 'form-control form-control-sm datepicker'])?></td>
	</tr>
	<?php } ?>

	<tr>
		<td>เบอร์โทรศัพท์ :</td>
		<td><?= $form->field($Register, 'TEL')->textInput(['class' => 'form-control form-control-sm'])?></td>
	</tr>

	<tr>
		<td>อีเมล : </td>
		<td><?= $form->field($Register, 'EMAIL')->textInput(['class' => 'form-control form-control-sm'])?></td>
	</tr>

	<?php if(!empty($Register->ID_CARD_NO)){ ?>
	<tr>
		<td>เลขบัตรประชาชน : </td>
		<td><?= $form->field($Register, 'ID_CARD_NO')->textInput(['class' => 'form-control form-control-sm'])?></td>
	</tr>
	<?php } ?>

	<?php if(!empty($Register->ID_CARD_IMAGE)){ ?>
	<tr>
		<td>รูปภาพบัตรประชาชน : </td>
		<td><a target="_blank" href="uploads/<?=$Register->application->LINK;?>/<?=$Register->ID_CARD_IMAGE_PATH;?>/<?=$Register->ID_CARD_IMAGE;?>"><img src="uploads/<?=$Register->application->LINK;?>/<?=$Register->ID_CARD_IMAGE_PATH;?>/<?=$Register->ID_CARD_IMAGE;?>" width="100"></a></td>
	</tr>
	<?php } ?>

</table>
<br>
<table class="table table-striped table-sm m-0 table-bordered">
	<tr>
		<td width="160">รุ่นผลิตภัณฑ์ : </td>
		<td><?=$Register->SELECT_1;?></td>
	</tr>
	<tr>
		<td>หมายเลขซีเรียล : </td>
		<td><?=$Register->QUESTION_1;?></td>
	</tr>

	<?php if(!empty($Register->shop->shop_name)){ ?>
	<tr>
		<td width="160">ร้านค้าที่ซื้อสินค้า : </td>
		<td><?=$Register->shop->shop_name;?></td>
	</tr>
	<?php } ?>

	<?php
	if($Register->application->ID==1){
		$LABEL_QUESTION_2 = 'วันที่รับบริการ';
	}else if($Register->application->ID==2){
		$LABEL_QUESTION_2 = 'วันที่ซื้อสินค้า';
	}
	?>
	<tr>
		<td><?=$LABEL_QUESTION_2?> : </td>
		<td><?= $form->field($Register, 'QUESTION_2')->textInput(['class' => 'form-control form-control-sm datepicker'])?></td>
	</tr>
	<tr>
		<td>ใบเสร็จสินค้า : </td>
		<td><a target="_blank" href="uploads/<?=$Register->application->LINK;?>/<?=$Register->PATH_FILE_1;?>/<?=$Register->FILE_1;?>"><img src="uploads/<?=$Register->application->LINK;?>/<?=$Register->PATH_FILE_1;?>/<?=$Register->FILE_1;?>" width="100"></a></td>
	</tr>
</table>
<br>
<table class="table table-striped table-sm m-0 table-bordered">
	<tr>
		<td width="160">ที่อยู่ : </td>
		<td><?= $form->field($Register, 'ADDRESS')->textInput(['class' => 'form-control form-control-sm'])?></td>
	</tr>
	<tr>
		<td>แขวง/ตำบล : </td>
		<td><?= $form->field($Register, 'DISTRICT')->textInput(['class' => 'form-control form-control-sm'])?></td>
	</tr>
	<tr>
		<td>เขต/อำเภอ : </td>
		<td><?= $form->field($Register, 'AMPHUR')->textInput(['class' => 'form-control form-control-sm'])?></td>
	</tr>
	<tr>
		<td>จังหวัด : </td>
		<td><?= $form->field($Register, 'PROVINCE')->textInput(['class' => 'form-control form-control-sm'])?></td>
	</tr>
	<tr>
		<td>รหัสไปรษณีย์ : </td>
		<td><?= $form->field($Register, 'ZIPCODE')->textInput(['class' => 'form-control form-control-sm'])?></td>
	</tr>
</table>
<?php if(!empty($Register->QUESTION_4)){ ?>
<table class="table table-striped table-sm m-0 table-bordered">
	<tr>
		<td width="160">ตอบคำถาม : </td>
		<td><?= $form->field($Register, 'QUESTION_4')->textInput(['class' => 'form-control form-control-sm'])?></td>
	</tr>
</table>
<?php } ?>
<br>
<table class="table table-striped table-sm m-0 table-bordered">
	<tr>
		<td width="160">UTM_SOURCE : </td>
		<td><?=$Register->UTM_SOURCE;?></td>
	</tr>
	<tr>
		<td>UTM_MEDIUM : </td>
		<td><?=$Register->UTM_MEDIUM;?></td>
	</tr>
	<tr>
		<td>UTM_CAMPAIGN : </td>
		<td><?=$Register->UTM_CAMPAIGN;?></td>
	</tr>
	<tr>
		<td>CREATED_DATETIME : </td>
		<td><?=date("d/m/Y H:i:s", strtotime($Register->CREATED_DATETIME));?></td>
	</tr>
	<tr>
		<td>IP ADDRESS :</td>
		<td><?=$Register->IP;?></td>
	</tr>
</table>
<div style="padding: 15px 0px;">
	<?= Html::submitButton(Yii::t('app', '<i class="fa fa-floppy-o"></i> SUBMIT'), ['class' => 'btn btn-primary btn-sm submit-form']) ?>	
</div>
<br>
<?php ActiveForm::end(); ?>

<?php

$script = <<<JS
  $("document").ready(function(){

	$("#pjax-grid").on("pjax:start", function() {
  		$('#loadingOverlay').show();
    });
    $("#pjax-grid").on("pjax:end", function() {
      	$('#loadingOverlay').hide();
    });

    $('.select2').select2({
      	width: '100%'
    });

	$('.datepicker').daterangepicker({
        singleDatePicker: true,
        autoUpdateInput: false,
        locale: {
            "format": "DD/MM/YYYY"
        },
        drops: "down",
        showDropdowns: true,
    });
    $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
        var date_select = picker.startDate.format('DD/MM/YYYY');
        $(this).val(date_select);
        
    });
    $('.datepicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    LG.App._enableForm();
  });
JS;
$this->registerJs($script,\yii\web\View::POS_READY);
?>