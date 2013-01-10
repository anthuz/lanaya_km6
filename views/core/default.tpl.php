<!doctype html>
<html lang="sv">
<head>
	<meta charset="utf-8">
	<title><?=$title?></title>
	<link rel="stylesheet" href="<?=$stylesheet?>">
</head>
<body>
	<div id="main" role="main">
		<?=@$main?>
      	<?=render_views()?>
	</div>
	<div id="footer">
		<?=$footer?>
	</div>
</body>
</html>