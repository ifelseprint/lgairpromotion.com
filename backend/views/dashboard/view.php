<table class="table table-striped table-sm m-0 table-bordered">
	<tr>
		<td>แคมเปญ : <?=$Register->application->NAME;?></td>
	</tr>
	<tr>
		<td>ชื่อ-นามสกุล : <?=$Register->FULLNAME;?></td>
	</tr>
	<tr>
		<td>เบอร์โทรศัพท์ : <?=$Register->TEL;?></td>
	</tr>
	<tr>
		<td>อีเมล : <?=$Register->EMAIL;?></td>
	</tr>
</table>
<br>
<table class="table table-striped table-sm m-0 table-bordered">
	<tr>
		<td>รุ่นผลิตภัณฑ์ : <?=$Register->SELECT_1;?></td>
	</tr>
	<tr>
		<td>หมายเลขซีเรียล : <?=$Register->QUESTION_1;?></td>
	</tr>
	<tr>
		<td>วันที่รับบริการ : <?=date("d/m/Y", strtotime($Register->QUESTION_2));?></td>
	</tr>
	<tr>
		<td>ใบเสร็จสินค้า : <a target="_blank" href="uploads/cleanandcoolpromotion/<?=$Register->PATH_FILE_1;?>/<?=$Register->FILE_1;?>"><img src="uploads/cleanandcoolpromotion/<?=$Register->PATH_FILE_1;?>/<?=$Register->FILE_1;?>" width="100"></a></td>
	</tr>
</table>
<br>
<table class="table table-striped table-sm m-0 table-bordered">
	<tr>
		<td>ที่อยู่ : <?=$Register->ADDRESS;?></td>
	</tr>
	<tr>
		<td>แขวง/ตำบล : <?=$Register->DISTRICT;?></td>
	</tr>
	<tr>
		<td>เขต/อำเภอ : <?=$Register->AMPHUR;?></td>
	</tr>
	<tr>
		<td>จังหวัด : <?=$Register->PROVINCE;?></td>
	</tr>
	<tr>
		<td>รหัสไปรษณีย์ : <?=$Register->ZIPCODE;?></td>
	</tr>
</table>
<br>
<table class="table table-striped table-sm m-0 table-bordered">
	<tr>
		<td>UTM_SOURCE : <?=$Register->UTM_SOURCE;?></td>
	</tr>
	<tr>
		<td>UTM_MEDIUM : <?=$Register->UTM_MEDIUM;?></td>
	</tr>
	<tr>
		<td>UTM_CAMPAIGN : <?=$Register->UTM_CAMPAIGN;?></td>
	</tr>
	<tr>
		<td>CREATED_DATETIME : <?=date("d/m/Y H:i:s", strtotime($Register->CREATED_DATETIME));?></td>
	</tr>
	<tr>
		<td>IP ADDRESS : <?=$Register->IP;?></td>
	</tr>
</table>
<br>