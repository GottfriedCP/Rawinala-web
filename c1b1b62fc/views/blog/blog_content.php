<div class="container article">
    <h1 class="article-title"><?php echo $title; ?></h1>
    <p class="article-detail small"><?php echo "Ditulis oleh ".$author_name." pada ".$created_on; ?></p>
    <?php if ($this->session->userdata('logged_in')) { ?>
        <span><a href="/blog/deletex/<?php echo $id; ?>/<?php echo $url_title; ?>" class="btn btn-danger" role="button" onclick="return confirm('Hapus artikel ini?')">Hapus</a></span>
        <span><a href="/blog/update/<?php echo $id; ?>/<?php echo $url_title; ?>" class="btn btn-outline-secondary" role="button">Update</a></span>
    <?php } ?>
    <div class="article-body"><?php echo $body; ?></div>

    <div class="container" id="disqus_thread"></div>
</div>

<script>
    var disqus_config = function () {
    this.page.url = "<?php echo current_url(); ?>";
    this.page.identifier = "<?php echo md5(current_url()); ?>";
    };
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://rawinala.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            