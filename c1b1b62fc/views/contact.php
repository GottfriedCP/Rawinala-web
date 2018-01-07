<div class="container-fluid" style="text-align: center; padding-top: 0; padding-bottom: 15px;">
  <h1 class="home-h1-prime" style="font-weight: 400;">Hubungi kami</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6" style="padding: 20px 15px 20px 15px;">
            <p>Jika Anda membutuhkan info lebih lanjut mengenai pelayanan/program kami, atau hendak menyumbangkan bantuan, silakan hubungi kami melalui form di bawah ini atau datang langsung ke YPD Rawinala.</p>
            <p>Lihat juga: <a href="/#partisipasi-anda">Bentuk partisipasi Anda</a> dan <a href="/donation">Donasi via rekening dan PayPal</a></p>
            
            <?php echo form_open('contact/send', ['id' => 'form-ci', 'style' => 'border: solid grey 1px; padding: 10px;']);?>
                <div class="form-group">
                    <label for="name_input">Name:</label>
                    <input name="name" type="text" class="form-control" id="name_input" >
                </div>

                <div class="form-group">
                    <label for="email_input">Email:</label>
                    <input name="email" type="email" class="form-control" id="email_input" aria-describedby="emailHelp" placeholder="example@email.com" >
                    <small id="emailHelp" class="form-text text-muted">Kami tidak akan mempublikasikan alamat email Anda.</small>
                    <small id="emailHelpEn" class="form-text text-muted"><em>We will never publish your email.</em></small>
                </div>

                <div class="form-group">
                    <label for="message_input">Message:</label>
                    <textarea name="message" class="form-control" id="message_input" rows="5"></textarea>
                </div>

                <button name="btn_submit" id="btn_submit" class="g-recaptcha btn btn-primary" data-sitekey="6Le1xzIUAAAAANn-8kWNrBw0yKT-l0-mLRVA7vxs" data-callback="onSubmit" data-badge="inline">Submit</button>
            </form>
        </div>
        <div class="col-md-6">
            <p style="text-align: center; margin-top: 30px;"><img src="<?php echo base_url('assets/images/rawinala_office_front.jpg'); ?>" width="480px" alt="kantor_rawinala" style="max-width: 100%; height: auto;"></p>
            <address>
                <strong>Yayasan Pendidikan Dwituna Rawinala</strong><br>
                Jalan Inerbang 38, Kramat Jati, DKI Jakarta 13520, Indonesia <br>
                Telepon: (62-21) 8090407 / 80886248 <br>
                Fax: (62-21) 80886248 <br>
                Email: office[at]rawinala.org <br>
            </address>
            <div id="map"></div>
        </div>
    </div>
</div>

<!-- Google map -->
<script>
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -6.281551, lng: 106.8623499},
            zoom: 16
        });
        var marker = new google.maps.Marker({
            position: {lat: -6.281551, lng: 106.8623499},
            map: map,
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRLohwDsLL-ewtGUpUIhbV0KFhvGE2f1Y&callback=initMap" async defer></script>

<!-- Visitor message input response -->
<?php
    if ($this->session->flashdata('contact_form_input_error')) {
        echo "<script>alert('Please re-check your form input.'); </script>";
    }
    if ($this->session->flashdata('captcha_error')) {
        echo "<script>alert('Error verifying captcha.'); </script>";
    }
    if ($this->session->flashdata('message_sent') == 'sent') {
        echo "<script>alert('Message sent successfully.'); </script>";
    }elseif ($this->session->flashdata('message_sent') == 'not_sent') {
        echo "<script>alert('Message not sent.'); </script>";
    }
?>
