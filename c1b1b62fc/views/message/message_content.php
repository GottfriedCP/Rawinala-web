<div class="container message-item" style="padding-top: 30px;">
    <?php
        if ($this->session->flashdata('reply_sent')) {
            echo "<p style='color: blue;'>Reply sent.</p>";
        }elseif ($this->session->flashdata('reply_not_sent')) {
            echo "<p style='color: red;'>Reply not sent. Please contact administrator.</p>";
        }
        if ($this->session->flashdata('message_forwarded')) {
            echo "<p style='color: blue;'>Message forwarded to ".$forwarded_to.".</p>";
        }elseif ($this->session->flashdata('message_not_forwarded')) {
            echo "<p style='color: red;'>Message not forwarded. Please contact administrator.</p>";
        }
    ?>
    <p><b>Name  :</b> <?php echo $name; ?> </p>
    <p><b>Email :</b> <?php echo $email; ?> </p>
    <p><b>Received at :</b> <?php echo date("j-F-Y, H:i", $created_on); ?> </p>
    <p><b>Message :</b></p>
    <div class="container border border-info message-body">
    <p><?php echo $message; ?><p>
    </div>
    
    <?php if ($reply != NULL) { // Tampilkan balasan ?>
        <p><b>Your reply :</b></p>
        <div class="container border border-info message-body">
        <p><?php echo $reply; ?><p>
        </div>
    <?php } else { // Buat form balasan ?>
        <?php echo form_open('message/send_reply', ['class' => 'form-send-reply', 'id' => 'form-send-reply', 'style' => 'padding-top: 20px;']) ?>
            
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="origin_message" value="<?php echo $message; ?>">

            <div class="form-group">
            <label for="reply"><b>Your reply : </b></label>
            <textarea id="reply" name="reply" class="form-control" rows="5" required></textarea>
            </div>

            <button type="submit" name="btn_reply_send" class="btn btn-lg btn-primary" >Send</button>
        </form>
    <?php } ?>

    <?php if ($forwarded_to != NULL) {
        echo "<p style='padding-top: 30px;'><b>Forwarded to :</b> ".$forwarded_to."</p>";
    } ?>
        
    <?php echo form_open('message/forward', ['class' => 'form-forward-message', 'id' => 'form-forward-message', 'style' => 'padding-top: 50px;']) ?>
        
        <input type="hidden" name="origin_id" value="<?php echo $id; ?>">
        <input type="hidden" name="origin_name" value="<?php echo $name; ?>">
        <input type="hidden" name="origin_email" value="<?php echo $email; ?>">
        <input type="hidden" name="message" value="<?php echo $message; ?>">
    
        <div class="form-group">
        <label for="email_forward"><b>Forward this message from <?php echo $name ?> to this email : </b></label>
        <input type="email" id="email_forward" name="email_forward" class="form-control col-md-4" placeholder="example@email.com" required>
        </div>

        <button type="submit" name="btn_forward" class="btn btn-lg btn-primary" >Forward</button>
    </form>

    <?php echo form_open('message/delete', ['class' => 'form-delete-message', 'id' => 'form-delete-message', 'style' => 'padding-top: 50px;']) ?>
        <input type="hidden" name="message_id" value="<?php echo $id; ?>">
        <button type="submit" name="btn_forward" onclick="return confirm('Delete this message?')" class="btn btn-lg btn-danger" >Delete</button>
    </form>
</div>