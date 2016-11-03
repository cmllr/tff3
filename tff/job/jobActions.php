<?php

class job
{
    public function doDefault()
    {
        global $SQL;
        $query = 'OPTIMIZE TABLE `tff_ads`, `tff_ad_modules`, `tff_albums`, `tff_blogroll`, `tff_blog_categories`, `tff_blog_categories_copy`, `tff_blog_comments`, `tff_blog_posts`, `tff_blog_posts_copy`, `tff_blog_relations`, `tff_blog_relations_copy`, `tff_categories`, `tff_cmspages`, `tff_news`, `tff_quotes`, `tff_shortlinks`, `tff_songs`, `tff_sqlcache`, `tff_teasers`, `tff_users`';
        $SQL->query($query);
        die('Hu');
    }
}
