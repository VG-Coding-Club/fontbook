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
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title> Submit | Font Book </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
$("#").load("");
})
</script>
<link rel="stylesheet" href="/coding/submit/org/form.css"/>
<link rel="stylesheet" href="css/font-family.css"/>
<style type="text/css">
</style>
</head>
<body>
<div id="header">
<a href="index.php">Font Book</a>
</div>
<form action="complete.php" id="org" method="post" target="_parent">
<div class="search-box family">
<ul>
<li>
<input type="radio" name="family" value="sans" id="sans">
<label for="sans" class="label">sans-serif ゴシック体</label></li>
<li>
<input type="radio" name="family" value="serif" id="serif">
<label for="serif" class="label">serif 明朝体</label></li>
<li>
<input type="radio" name="family" value="cursive" id="cursive">
<label for="cursive" class="label">cursive 手描き風書体</label></li>
<li>
<input type="radio" name="family" value="fantasy" id="fantasy">
<label for="fantasy" class="label">fantasy 装飾書体</label></li>
</ul>
</div>
<p><input type="text" name="title" placeholder="title" required></p>
<p><input type="text" name="id" placeholder="id" required></p>
<p><input type="text" name="by" placeholder="by" required></p>
<p><input type="text" name="link" placeholder="link" required></p>
<div class="reset">
<button type="submit">Submit | 投稿する</button>
</div>
</form>
</body>
</html>
