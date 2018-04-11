<!-- views/templates/start -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Attendance</title>
  </head>
  <body>

	<nav>
<?php foreach ($nav as $page => $url): ?>
		<?=anchor($url, $page);?>
<?php endforeach; ?>
	</nav>
