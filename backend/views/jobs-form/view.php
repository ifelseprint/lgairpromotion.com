
<?php
$style = "
table.viewDataResult { margin-bottom: 15px; }
table.viewDataResult td.col_header { font-weight: bold; width: 100px; }
";
$this->registerCss($style);
?>
<table class="viewDataResult" cellpadding="3" width="100%">
	<tr>
		<td class="col_header" align="right">Position :</td>
		<td align="left" colspan="3"><?=$JobsForm->jobs->jobs_name_th;?></td>
	</tr>
	<tr>
		<td class="col_header" align="right">Prefix :</td>
		<td align="left">
			<?php
			switch ($JobsForm->jobs_form_prefix) {
				case 1:
					$prefix = "Mr.";
				break;
				case 2:
					$prefix = "Mrs.";
				break;
				case 3:
					$prefix = "Ms.";
				break;
				default:
					$prefix = "Mr.";
				break;
			}
			echo $prefix;
			?>
		</td>
	</tr>
	<tr>
		<td class="col_header" align="right">Nationality :</td>
		<td align="left">
			<?php
			switch ($JobsForm->jobs_form_nationality) {
				case 1:
					$nationality = "สัญชาติไทย";
				break;
				case 2:
					$nationality = "ต่างชาติ";
				break;
				default:
					$nationality = "สัญชาติไทย";
				break;
			}
			echo $nationality;
			?>
		</td>
	</tr>
	<tr>
		<td class="col_header" align="right">First Name :</td>
		<td align="left" colspan="3"><?=$JobsForm->jobs_form_first_name;?></td>
	</tr>
	<tr>
		<td class="col_header" align="right">Last Name :</td>
		<td align="left" colspan="3"><?=$JobsForm->jobs_form_last_name;?></td>
	</tr>
	<tr>
		<td class="col_header" align="right">Date of birth :</td>
		<td align="left" colspan="3"><?=date('d/m/Y', strtotime(str_replace('/', '-', $JobsForm->jobs_form_birthday)));?></td>
	</tr>
	<tr>
		<td class="col_header" align="right">Telephone :</td>
		<td align="left" colspan="3"><?=$JobsForm->jobs_form_tel;?></td>
	</tr>
	<tr>
		<td class="col_header" align="right">Email :</td>
		<td align="left" colspan="3"><?=$JobsForm->jobs_form_email;?></td>
	</tr>
	<tr>
		<td class="col_header" align="right">Address :</td>
		<td align="left" colspan="3"><?=$JobsForm->jobs_form_address;?></td>
	</tr>
	<?php if(!empty($JobsForm->jobs_form_file)){ ?>
	<tr>
		<td class="col_header" align="right">File :</td>
		<td align="left" colspan="3"><a target="_blank" href="<?php echo str_replace('/admin', '', Yii::getAlias('@web')).'/uploads/'.$JobsForm->jobs_form_file_path.'/'.$JobsForm->jobs_form_file; ?>">Download</a></td>
	</tr>
	<?php } ?>
	<tr>
		<td class="col_header" align="right">Created Date :</td>
		<td align="left" colspan="3"><?=date('d/m/Y H:i:s', strtotime($JobsForm->created_date));?></td>
	</tr>
</table>