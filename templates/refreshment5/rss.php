<rss version="2.0">
    <channel>
        <title><?php echo $this->view['title']; ?></title>
        <description>TFF3-Feed </description>
        <link><?php echo $this->view['PAGEROOT'] ?>blog/</link>
        <docs>http://blogs.law.harvard.edu/tech/rss</docs>
        <lastBuildDate><?php echo $this->view['pubDate'] ?></lastBuildDate>
        <pubDate><?php echo $this->view['pubDate'] ?></pubDate>
        <generator>TFF 3 Coding Blogging Framewort</generator>
        <?php foreach ($this->view['blogposts'] as $row => $items) : ?>
            <item>
                <title><?php echo $items['title'] ?></title>
                <description><?php echo htmlspecialchars($items['description']) ?></description>
                <link><?php echo $items['url'] ?></link>
                <guid><?php echo $items['url'] ?></guid>
                <pubDate><?php echo $items['updated'] ?></pubDate>
                <author><?php echo $items['author'] ?></author>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>
