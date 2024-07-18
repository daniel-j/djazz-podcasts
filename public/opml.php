<?php
header("Content-type: text/xml");

$handle = fopen("feeds.txt", "r");
if (!$handle) die("No feeds found");

?>
<?xml version="1.0" encoding="UTF-8"?>
<opml version="2.0">
	<head>
		<title>djazz.se podcasts - OPML Feed</title>
	</head>
	<body>
<?php
while (($line = fgets($handle)) !== false) {

?>
		<outline text="<?=htmlentities($line)?>" title="<?=htmlentities($line)?>" type="rss" xmlUrl="<?=htmlentities($line)?>" htmlUrl="<?=htmlentities($line)?>" />
<?php
}
fclose($handle);
?>
	</body>
</opml>
