<!DOCTYPE html>
<html lang="en">
<?php $this->load->helper('form'); ?>
<head>
	<meta charset="utf-8">
	<title>DataDate - Persoonlijkheidstest</title>
</head>
<body>
<div id="container">
	<!-- Color: #F46867 -->
	<?php echo validation_errors();
	if (isset($questions)) { ?>
	<h1>De vragen</h1>
	<?php echo form_open('test');
	foreach ($questions as $q):?>
		<h4><?php echo $q['text'];?></h4>
		<?php foreach ($q['answers'] as $answer):
			echo form_radio(array('name' => $q['tag'], 'value' => $answer['answer_tag'], 'checked' => set_radio($q['tag'], $answer['answer_tag'])));
			echo $answer['text'];?><br />
		<?php endforeach;
	endforeach;
	echo form_submit('test', 'Submit'); 
	echo form_close();
	} ?>
</div>

</body>
</html>