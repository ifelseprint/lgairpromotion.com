
<?php
$style = "
table.viewDataResult { margin-bottom: 15px; }
table.viewDataResult td.col_header { font-weight: bold; width: 100px; }
";
$this->registerCss($style);
?>
<table class="viewDataResult" cellpadding="3" width="100%">
	<tr>
		<td class="col_header" align="right">First Name :</td>
		<td align="left"><?=$ContactForm->contact_form_first_name;?></td>
	</tr>
	<tr>
		<td class="col_header" align="right">Last Name :</td>
		<td align="left"><?=$ContactForm->contact_form_last_name;?></td>
	</tr>
	<tr>
		<td class="col_header" align="right">Telephone :</td>
		<td align="left"><?=$ContactForm->contact_form_tel;?></td>
	</tr>
	<tr>
		<td class="col_header" align="right">Email :</td>
		<td align="left"><?=$ContactForm->contact_form_email;?></td>
	</tr>
	<tr>
		<td class="col_header" align="right">Message :</td>
		<td align="left"><?=$ContactForm->contact_form_message;?></td>
	</tr>
	<tr>
		<td class="col_header" align="right">Created Date :</td>
		<td align="left"><?=date('d/m/Y H:i:s', strtotime($ContactForm->created_date));?></td>
	</tr>
</table>