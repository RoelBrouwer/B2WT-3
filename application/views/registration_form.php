<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>DataDate - Persoonlijkheidstest</title>
</head>
<body>
<div id="container">
	<!-- Color: #F46867 -->
	<?php if (isset($debuginfo)) { echo $debuginfo; } ?>
	<h1>De vragen</h1>
	<form action="http://www.students.science.uu.nl/~3976866/ci/test/retrieve_answers" method="POST">
	<?php foreach ($questions as $q):?>
		<h4><?php echo $q['text'];?></h4>
		<?php foreach ($q['answers'] as $answer):?>
			<input type="radio" name="<?php echo $q['tag'];?>" value="<?php echo $answer['answer_tag'];?>" /><?php echo $answer['text'];?><br />
		<?php endforeach;?>
	<?php endforeach;?>
	<input type="submit" value="Submit">
	</form>
</div>

</body>
</html>