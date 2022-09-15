<?php
function h($str)
{
	return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$fp = fopen('book.csv', 'a+b');
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
	<title> Font Book | creative-community.pe.hu </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://creative-community.space/coding/org/org.js"></script>
	<script src="https://creative-community.space/coding/js/smoothscroll.js"></script>

	<link rel="stylesheet" href="https://creative-community.space//coding/org/org.css" />
	<link rel="stylesheet" href="css/font-family.css" />
	<style type="text/css">
		#header {
			padding: 1.25% 2.5%;
			font-size: 1.5vw;
			display: flex;
			width: 95%;
			height: 2.5vw;
			bottom: 0;
			position: sticky;
			z-index: 100;
			flex-direction: row;
			justify-content: space-between;
		}

		#list li .id {
			display: block;
			float: right;
			margin: 1rem;
			color: #fff;
			font-size: 50%;
			font-family: "NewYork";
			text-shadow: 0.1rem 0.1rem #000;
		}
	</style>
</head>

<body>
	<div id="header">
		Update
		<i class="fontmotion">
			<?php
			$mod = filemtime("book.csv");
			date_default_timezone_set('Asia/Tokyo');
			print "" . date("m.d.y H:i", $mod);
			?>
		</i>
	</div>

	<form id="org">
		<div class="search-box tag">
			<ul>
				<li>
					<input type="radio" name="family" value="sans" id="sans">
					<label for="sans" class="click" style="font-family:sans-serif;">sans-serif</label>
				</li>
				<li>
					<input type="radio" name="family" value="serif" id="serif">
					<label for="serif" class="click" style="font-family:serif;">serif</label>
				</li>
				<li>
					<input type="radio" name="family" value="monospace" id="monospace">
					<label for="monospace" class="click" style="font-family:monospace;">monospace</label>
				</li>
				<li>
					<input type="radio" name="family" value="cursive" id="cursive">
					<label for="cursive" class="click" style="font-family:cursive;">cursive</label>
				</li>
				<li>
					<input type="radio" name="family" value="fantasy" id="fantasy">
					<label for="fantasy" class="click" style="font-family:fantasy;">fantasy</label>
				</li>
			</ul>
		</div>
		<div class="reset">
			<input type="reset" name="reset" value="RESET" class="reset-button">
		</div>
	</form>

	<ul class="random" id="list">
		<?php if (!empty($rows)) : ?>
			<?php foreach ($rows as $row) : ?>
				<li class="list_item list_toggle" data-family="<?= h($row[4]) ?>">
					<span class="id"><?= h($row[1]) ?></span>
					<span class="<?= h($row[1]) ?>"><?= h($row[0]) ?></span>
					<p>by <b style="font-family:<?= h($row[4]) ?>;"><?= h($row[2]) ?></b></p>
					<a href="<?= h($row[3]) ?>" target="_blank" rel="noopener noreferrer"></a>
				</li>
			<?php endforeach; ?>
		<?php else : ?>
			<li>
				<span class="id">id</span>
				<span class="NewYork">Title</span>
				<p>by <b class="NewYork">Name</b></p>
			</li>
		<?php endif; ?>
	</ul>
</body>

</html>