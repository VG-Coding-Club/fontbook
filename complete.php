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
<meta http-equiv="refresh" content="1;URL=submit.php">
<title> Done | Font Book </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
$("#").load("");
})
</script>
<link rel="stylesheet" href="/coding/css/book.css"/>
<link rel="stylesheet" href="css/stylesheet.css"/>
<style type="text/css">
</style>
</head>
<body>
<div id="header">
<a href="index.php">Font Book</a>
</div>
</body>
</html>
