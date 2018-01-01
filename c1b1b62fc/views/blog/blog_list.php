<div class="container" style="padding-top: 10px;">
    <?php if ($this->session->userdata('logged_in')) { ?>
    <a href="/blog/create" class="btn btn-outline-dark" role="button" style="margin-left: 20px;"><img src="<?php echo base_url('assets/images/document-2x.png'); ?>"> Buat artikel baru</a>
    <?php } ?>

    <?php foreach($articles as $article) {?>
        <div class="container article-item">
        <a href=<?php echo "/blog/view/".$article->id."/".$article->url_title ?>><h2 class="article-title"><?php echo $article->title; ?></h2></a>
        <p class="article-detail small"><?php echo "ditulis pada ".date("j F Y, H:i:s", $article->created_on); ?></p>
        <div class="article-body"><?php if (strlen($article->body) > 320) { echo "<p>" . substr(strip_tags($article->body), 0, 320) . '. . . ' . "</p>"; } else { echo "<p>" . strip_tags($article->body, "<img>") . "</p>"; } ?><a href=<?php echo "/blog/view/".$article->id."/".$article->url_title; ?>><p>[Selengkapnya]</p></a></div>
        </div>
    <?php } ?>

    <div class="container pagination-box"><p>
    <?php echo $this->pagination->create_links(); ?>
    </p></div>
</div>