<?php echo $header; ?>
<div id="content">

    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a
                href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>

    <?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>

    <div class="box">
        <div class="heading">
            <h1><img src="view/image/module.png" alt=""/> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a
                        href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
        </div>

        <div class="content">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                <table class="form">
                    <tr>
                        <td><?php echo $text_status; ?></td>
                        <td>
                            <select name="status">
                                <option value="1" <?php if ($status == 1) echo 'selected'; ?>><?php echo $text_enabled; ?></option>
                                <option value="0" <?php if ($status == 0) echo 'selected'; ?>><?php echo $text_disabled; ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $text_login; ?></td>
                        <td>
                            <input type="text" name="login" value="<?php echo $login; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $text_password; ?></td>
                        <td>
                            <input type="text" name="password" value="<?php echo $password; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $text_alfaname; ?></td>
                        <td>
                            <input type="text" name="alfaname" value="<?php echo $alfaname; ?>">
                        </td>
                    </tr>
                </table>

                <div id="language-smstext" class="htabs">
                    <?php foreach ($languages as $language) { ?>
                    <a href="#tab-language-smstext-<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                    <?php } ?>
                </div>
                <?php foreach ($languages as $language) { ?>
                <div id="tab-language-smstext-<?php echo $language['language_id']; ?>">
                    <table class="form">
                        <tr>
                            <td><?php echo $text_shortcodes; ?></td>
                            <td>
                                {store_name}<br/>
                                {order_id}<br/>
                                {order_total}<br/>
                                {shipping_city}<br/>
                                {shipping_address}
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $text_order_new; ?></td>
                            <td><textarea rows="5" cols="50" name="order_new[<?php echo $language['language_id']; ?>]"><?php echo $order_new[$language['language_id']]; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><?php echo $text_order_notify; ?></td>
                            <td><textarea rows="5" cols="50" name="order_notify[<?php echo $language['language_id']; ?>]"><?php echo $order_notify[$language['language_id']]; ?></textarea></td>
                        </tr>
                    </table>
                </div>
                <?php } ?></td>
            </form>
            v.1.1 &copy; vov1 [ <a href="http://knopix.net">knopix.net</a> ]
        </div>
    </div>

</div>

<script type="text/javascript"><!--
    $('#language-smstext a').tabs();
//--></script>

<?php echo $footer; ?>