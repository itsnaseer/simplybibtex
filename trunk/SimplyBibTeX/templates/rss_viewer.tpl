<rss version="2.0"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:syn="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" >
	<channel>
		<title><?=$title?></title>
		<link><?=$baselink?></link>
		<description>SimplyBibTeX Feed</description>
		<webMaster>webmaster@technotecture.com</webMaster>
		<lastBuildDate><?=$dbtime?></lastBuildDate>
		<dc:creator>SimplyBibTeX</dc:creator>
		<dc:language>en</dc:language>
		<docs>http://backend.userland.com/rss</docs>
		<ttl>60</ttl>
		<?=$content?>
	</channel>
</rss>
