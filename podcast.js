function hmsToSecondsOnly(str) {
	var p = str.split(':');
	var s = 0;
	var m = 1;

	while (p.length > 0) {
		s += m * parseInt(p.pop(), 10);
		m *= 60;
	}

	return s;
}

function loadFeed(url, parent) {
	var x = new XMLHttpRequest();
	x.onreadystatechange = function () {
		if (x.readyState == 4 && x.status == 200) {
			var parser = new DOMParser();
			var xmlDoc = parser.parseFromString(x.responseText, 'text/xml');
			parent.querySelector('.channel-description').innerHTML = xmlDoc.querySelector('rss channel description').textContent;
			parent.querySelector('.channel-lastBuildDate').textContent = xmlDoc.querySelector('rss channel lastBuildDate').textContent;
			var items = xmlDoc.querySelectorAll('rss item');
			parent.querySelector('.channel-item-count').textContent = items.length + ' episodes';
			var totalDuration = 0;
			for (var item of items) {
				totalDuration += hmsToSecondsOnly(item.querySelector('duration').textContent);
			}
			parent.querySelector('.channel-item-duration').textContent = (Math.ceil(totalDuration / 60 / 6) / 10) + " hours";

		}
	}
	x.open('GET', url, true);
	x.send();
}

function loadFeeds() {
	var nodes = document.querySelectorAll('.channel-header');
	for (var i = 0; i < nodes.length; i+=1) {
		var node = nodes[i];
		var feed = node.querySelector('.channel-feed a').getAttribute('href');
		loadFeed(feed, node);
	}
}