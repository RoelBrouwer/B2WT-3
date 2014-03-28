<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>DataDate - Persoonlijkheidstest</title>
</head>
<body>
<div id="container">
	<!-- Color: #F46867 -->
	<h1>De vragen</h1>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
	<?php foreach ($questions as $q):?>
		<h4><?php echo $q['question'];?></h4>
		<?php foreach ($q['answers'] as $answer):?>
			<input type="radio" name="<?php echo $q['tag'];?>" value="<?php echo $answer['value'];?>" /><?php echo $answer['text'];?><br />
		<?php endforeach;?>
	<?php endforeach;?>
	<input type="submit" value="Submit">
	</form>
</div>

</body>
</html>