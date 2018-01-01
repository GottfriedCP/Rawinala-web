<div class="container-fluid" style="text-align: center; padding-top: 0; padding-bottom: 0">
  <h1 class="home-h1-prime">Selamat datang di YPD Rawinala</h1>
</div>

<?php require('templates/home_carousel.php'); ?>

<div class="container" style="padding-top: 20px;">
  <p><strong>Yayasan Pendidikan Dwituna (YPD) Rawinala</strong> adalah sebuah lembaga yang melayani kebutuhan pendidikan penyandang tunaganda netra, sebuah kondisi dimana penyandangnya memiliki dua atau lebih hambatan, dengan hambatan utama pada penglihatan. Penyandang tunaganda netra sulit mendapatkan layanan pendidikan di sekolah luar biasa.</p>
  <div class="video-container d-none d-sm-block">
    <p style="text-align: center;">
      <video width="480" controls>
        <source src="<?php echo base_url('assets/videos/video.webm'); ?>" type="video/webm">
        Your browser does not support HTML5 video.
      </video>
    </p>
  </div>
</div>
<div class="container-fluid">
  <h1 class="home-h1">Pelayanan Pendidikan</h1>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-4 overview">
      <p style="text-align: center;"><img src="<?php echo base_url('assets/images/ovv1.jpg')?>" height="168px" alt="gambar-keterlibatan"></p>
      <h2>Pelayanan Dini</h2>
      <p>Program pendidikan bagi anak usia 0-6 tahun untuk mengajari konsep awal orientasi mobilitas. Potensi awal anak mulai diamati, digali, dan dikembangkan melalui program-program yang disesuaikan dengan kebutuhan dan kemampuan anak.</p>
    </div>
    <div class="col-md-4 overview">
      <p style="text-align: center;"><img src="<?php echo base_url('assets/images/ovv2.jpg')?>" height="168px" alt="gambar-keterlibatan"></p>
      <h2>Pendidikan Dasar</h2>
      <p>Program ini dirancang dari 4 area pokok pendidikan fungsional: to live, to work, to play, dan to love. Melalui 4 hal tersebut, anak diarahkan untuk mengembangkan potensi yang dimiliki, dan mengeksplorasi kemampuan lainnya yang dapat menunjang proses kemandiriannya.</p>
    </div>
    <div class="col-md-4 overview">
      <p style="text-align: center;"><img src="<?php echo base_url('assets/images/ovv3.jpg')?>" height="168px" alt="gambar-keterlibatan"></p>
      <h2>Pendidikan Lanjut</h2>
      <p>Program pendidikan lanjutan yang diberikan pada anak usia 14-18 tahun untuk mengembangkan keterampilan bekerja sesuai dengan kebutuhan dan kemampuannya. Tujuannya bukan hanya untuk mendapatkan penghasilan, melainkan juga agar anak mampu melakukan berbagai pekerjaan sederhana.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 overview">
      <p style="text-align: center;"><img src="<?php echo base_url('assets/images/ovv4.jpg')?>" height="168px" alt="gambar-keterlibatan"></p>
      <h2>Sheltered Workshop</h2>
      <p>Bengkel kerja tempat berlatih bagi anak-anak yang telah menyelesaikan pendidikan lanjutan. Anak-anak yang masuk dalam kategori mampu latih akan diberikan ketrampilan yang sesuai dengan kemampuannya, agar anak dapat memiliki penghasilan untuk mencukupi kebutuhan sehari-hari.</p>
    </div>
    <div class="col-md-4 overview">
      <p style="text-align: center;"><img src="<?php echo base_url('assets/images/ovv5.jpg')?>" height="168px" alt="gambar-keterlibatan"></p>
      <h2>Asrama Sekolah</h2>
      <p>Disediakan bagi siswa/siswi yang tidak memiliki akses untuk melakukan perjalanan pulang-pergi setiap hari. Konsep Asrama Sekolah bukan hanya sebagai tempat penitipan saja, melainkan juga sebagai sarana untuk mengembangkan keterampilan kegiatan sehari-hari yang telah dipelajari anak di sekolah.</p>
    </div>
    <div class="col-md-4 overview">
      <p style="text-align: center;"><img src="<?php echo base_url('assets/images/ovv6.jpg')?>" height="168px" alt="gambar-keterlibatan"></p>
      <h2>Asrama Perawatan</h2>
      <p>Tempat tinggal bagi Tunanetra Ganda dewasa yang sudah tidak memiliki keluarga. Konsep yang dikembangkan disini adalah kekeluargaan dimana setiap individu memiliki peran dalam pekerjaan rumah tangga sehari-hari. Penghuni Rumah Perawatan dibantu oleh beberapa asisten yang bekerja sama membangun lingkungan rumah tinggal yang fungsional dan bahagia.</p>
    </div>
  </div>
</div>

<div class="container-fluid">
  <h1 class="home-h1" id="partisipasi-anda">Bagaimana Anda dapat terlibat?</h1>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <p style="text-align: center;"><img src="<?php echo base_url('assets/images/keterlibatan.jpg')?>" alt="gambar-keterlibatan"></p>
      <p>Rawinala membuka kesempatan bagi sahabat-sahabat yang ingin meluangkan waktunya untuk bekerja sukarela di Rawinala, ataupun memberikan bantuan lainnya.</p>
    </div>
    <div class="col-md-6">
       
      <p>Bagi Anda yang ingin menjadi relawan, dibutuhkan waktu dan komitmen yang tinggi. Anda tidak perlu menjadi seorang ahli pendidikan Luar Biasa. Yang mereka butuhkan adalah ketulusan dan kerelaan hati untuk menjadi seorang sahabat.</p>
      <p>Silakan <a href="/contact">hubungi kami</a> untuk informasi lebih lanjut mengenai partisipasi Anda.</p>
      <p>Temukan nilai-nilai kehidupan bersama mereka. Kami akan membuatkan program untuk Anda.</p>
    </div>
  </div>
</div>

<div class="container-fluid">
  <h1 class="home-h1" id="berita-terbaru">Berita Terbaru</h1>
</div>
<div class="container">
  <?php foreach($news as $news_item) {?>
    <div class="container article-item">
    <a href=<?php echo "/blog/view/".$news_item->id."/".$news_item->url_title ?>><h2 class="article-title"><?php echo $news_item->title; ?></h2></a>
    <div class="article-body"><?php if (strlen($news_item->body) > 240) { echo "<p>" . substr(strip_tags($news_item->body), 0, 240) . '. . . ' . "</p>"; } else { echo "<p>" . strip_tags($news_item->body, "<img>") . "</p>"; } ?><a href=<?php echo "/blog/view/".$news_item->id."/".$news_item->url_title ?>><p>[Selengkapnya]</p></a></div>
    </div>
  <?php } ?>

  <!-- Newsletter registration -->
  <h3 style="margin-top: 50px;">Daftar Newsletter</h3>
  <small>Daftarkan email Anda untuk mendapatkan <i>newsletter</i> "Sapa Sahabat Rawinala".</small>
  <?php echo form_open('newsletter/subscribe', ['id' => 'form-ci', 'style' => 'padding: 10px;']);?>
    <div class="form-group mx-sm-3">
      <label for="subscribe_email" class="sr-only">Email</label>
      <input type="email" class="form-control col-md-4" name="subscribe_email" id="subscribe_email" placeholder="email@example.com" required>
    </div>
    <button name="btn_submit" id="btn_submit" class="g-recaptcha btn btn-primary" data-sitekey="6Le1xzIUAAAAANn-8kWNrBw0yKT-l0-mLRVA7vxs" data-callback="onSubmit" data-badge="inline">Daftar</button>
  </form>

  <?php
    if ($this->session->flashdata('subscribe_status')) {
      echo "
        <script>alert('You have been subscribed successfully.'); </script>
      ";
    }
    if ($this->session->flashdata('unsubscribed')) {
      echo "
        <script>alert('You have been unsubscribed successfully.'); </script>
      ";
    }
  ?>
</div>

<!-- Addon -->
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "name": "Yayasan Pendidikan Dwituna Rawinala",
  "legalName": "Yayasan Pendidikan Dwituna Rawinala",
  "url": "http://www.rawinala.org/",
  "logo": "http://www.rawinala.org/assets/images/logo.png",
  "sameAs": [
    "https://www.facebook.com/Yayasan-Pendidikan-Dwituna-Rawinala-188650806928/",
    "https://twitter.com/YayasanRawinala",
    "https://www.youtube.com/user/rawinala?feature=watch"
  ]
}
</script>