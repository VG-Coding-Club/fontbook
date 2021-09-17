<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$title = (string)filter_input(INPUT_POST, 'title');
$id = (string)filter_input(INPUT_POST, 'id');
$by = (string)filter_input(INPUT_POST, 'by');
$link = (string)filter_input(INPUT_POST, 'link');
$family = (string)filter_input(INPUT_POST, 'family');

$fp = fopen('library.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$title, $id, $by, $link, $family]);
    rewind($fp);
}

flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}
flock($fp, LOCK_UN);
fclose($fp);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="/coding/js/smoothscroll.js"></script>
<script src="/coding/submit/org/org.js"></script>
<script type="text/javascript">
$(function(){
})
</script>
<title> Font Book | creative-community.pe.hu </title>
<link rel="stylesheet" href="/coding/submit/org/book.css"/>
<link rel="stylesheet" href="/coding/fontbook/css/font-family.css"/>
<style type="text/css">
.list li .id {
	position: absolute;
	top:0; right:0;
	margin:1rem;
	color:#fff;
	font-size:50%;
	font-family: "NewYork";
	text-shadow:0.1rem 0.1rem #000;
}
</style>
</head>
<body>
<div id="header">
</div>

<form id="org">

<div class="search-box value">
<ul>
<li>
<input type="radio" name="family" value="sans" id="sans">
<label for="sans" class="label" style="font-family:sans-serif;">sans-serif</label></li>
<li>
<input type="radio" name="family" value="serif" id="serif">
<label for="serif" class="label" style="font-family:serif;">serif</label></li>
<li>
<input type="radio" name="family" value="cursive" id="cursive">
<label for="cursive" class="label" style="font-family:cursive;">cursive</label></li>
<li>
<input type="radio" name="family" value="fantasy" id="fantasy">
<label for="fantasy" class="label" style="font-family:fantasy;">fantasy</label></li>
</ul>
</div>
<div class="reset">
<input type="reset" name="reset" value="RESET" class="reset-button">
</div>
</form>

<ul class="list" id="random">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<li class="list_item list_toggle" data-family="<?=h($row[4])?>">
<span class="<?=h($row[1])?>"><?=h($row[0])?></span>
<p>by <b class="<?=h($row[1])?>"><?=h($row[2])?></b></p>
<span class="id"><?=h($row[1])?></span>
<a href="<?=h($row[3])?>" target="_blank" rel="noopener noreferrer"></a>
</li>
<?php endforeach; ?>
<?php else: ?>
<li>
<span class="NewYork">Title</span>
<span class="id">id</span>
<p>by <b class="NewYork">Name</b></p>
</li>
<?php endif; ?>
</ul>
</body>
</html>
