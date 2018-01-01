<div class="container" style="padding-top: 30px;">
    <?php
        if ($this->session->flashdata('message_not_found')) {
            echo '<p style="color: red; ">Message not found</p>';
        }
    ?>
    <small>Click on Name to open the message.</small>
    <table class="table table-sm table-hover table-responsive table-messages">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date</th>
                <th>Read?</th>
                <th>Replied?</th>
                <th>Forwarded to</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message) { ?>
            <tr <?php if (!$message->read) { echo 'class="table-primary"'; } ?>>
                <td><a href="/message/view/<?php echo $message->id; ?>"><?php echo $message->name; ?></a></td>
                <td><?php echo $message->email; ?></td>
                <td><?php echo substr($message->message, 0, 40).'...'; ?></td>
                <td><?php echo date("j-M-Y", $message->created_on); ?></td>
                <td><?php echo ($message->read)?'YES':'NO'; ?></td>
                <td><?php echo ($message->reply == NULL?'NO':'YES'); ?></td>
                <td><?php echo ($message->forwarded_to == NULL)?'-':$message->forwarded_to; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="container pagination-box"><p>
    <?php echo $this->pagination->create_links(); ?>
    </p></div>
</div>