<?php

$podcasts = array();

foreach (new DirectoryIterator('.') as $fileInfo) {
	if($fileInfo->isDot()) continue;
	// $path = $fileInfo->getRealPath();
	// if (!is_dir($path)) continue;
	$inifile = $fileInfo->getFilename() . "/dir2cast.ini";
	if (!is_file($inifile)) continue;
	// echo $fileInfo->getFilename() . "/dir2cast.ini<br>\n";
	$ini = parse_ini_file($inifile);
	$podcasts[$fileInfo->getFilename()] = $ini;
}

ksort($podcasts);

?>
<!doctype html>
<html>
<head>
	<title>Podcasts - djazz.se</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" href="favicon.ico" />
	<link rel="stylesheet" type="text/css" href="./podcast.css" />
</head>
<body>
	<p class="explanation">
		This lists podcasts hosted on djazz.se
	</p>
	<div id="content">
		<?php
		foreach ($podcasts as $path => $podcast) {
			// var_dump($podcast);
			$title = $podcast['TITLE'];
			$subtitle = $podcast['ITUNES_SUBTITLE'];
			$description = $podcast['DESCRIPTION'];
			$author = $podcast['ITUNES_AUTHOR'];
			$link = $podcast['LINK'];
			$feed = $podcast['RSS_LINK'];
			$imagelink = is_file($path . '/itunes_image.jpg') ? $path . '/itunes_image.jpg' : $path . '/image.jpg';
		?>

		<div class="channel-header">
			<h1>
				<a href="<?=htmlentities($feed)?>"><?=htmlentities($title)?></a>
				<div id="channel-image">
					<a href="<?=htmlentities($imagelink)?>" target="_blank"><img src="<?=htmlentities($path . '/image.jpg')?>" title="<?=htmlentities($title)?>" /></a>
				</div>
			</h1>
			<div class="channel-subtitle">
				<?=htmlentities($subtitle)?>
			</div>
			<div class="channel-description">
				<?=$description?>...
			</div>
			<div class="channel-author">
				<a href="<?=htmlentities($link)?>" target="_blank">
					<i class="fas fa-globe"></i>
					<?=$author?>
				</a>
			</div>
			<div class="channel-feed">
				<a href="<?=htmlentities($feed)?>">
					<i class="fas fa-rss-square"></i> RSS Feed
				</a>
			</div>
			<i class="far fa-calendar"></i> <span class="channel-lastBuildDate">...</span> |
			<i class="fas fa-stopwatch"></i> <span class="channel-item-duration">...</span> |
			<span class="channel-item-count">...</span>
			<br clear="both"/>

		</div>
		<?php } ?>
	</div>
	<div class="channel-copyright">
		<a href="https://github.com/PhilGoud/podcast-XSL-template" target="_blank">XSL template by PhilGoud</a>, modified by djazz
	</div>

	<script src="./podcast.js"></script>
	<script>loadFeeds();</script>
</body>
</html>
</xsl:template>
</xsl:stylesheet>
