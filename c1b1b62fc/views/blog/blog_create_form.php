<script src="<?php echo base_url('assets/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>
<script>
tinymce.init({
    selector: 'textarea#content',
    height: 500,
    theme: 'modern',
    plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help',
        'jbimages'
    ],
    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages',
    toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
    image_advtab: true,
    relative_urls: false,
    templates: [
        { title: 'Test template 1', content: 'Test 1' },
        { title: 'Test template 2', content: 'Test 2' }
    ]/*,
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'
    ]*/
});
</script>

<div class="container">
    <?php echo form_open('blog/create', ['class' => 'form-create-article', 'id' => 'form-create-article']);?>
    <?php
        if ($this->session->flashdata('article_empty')) {
            echo '<p class="article-error">Artikel tidak boleh kosong</p>';
        }
    ?>
    <h2>Buat artikel baru</h2>

    <div class="form-group">
    <label for="title">Judul: </label>
    <input type="text" id="title" name="title" class="form-control col-md-8" placeholder="Judul artikel" maxlength="100" required autofocus>
    </div>

    <div class="form-group">
    <label for="content">Isi artikel: </label>
    <textarea id="content" name="content" class="form-control"></textarea>
    </div>

    <button type="submit" name="btn_article_submit" class="btn btn-lg btn-primary btn-block" >Unggah</button>
    </form>
</div>