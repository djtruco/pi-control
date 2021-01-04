<?php

include 'GPIO.php';

$GPIO = new GPIO();

if ($GPIO->getValue(4) == '1') {
    $checked = 'checked="checked"';
} else {
    $checked = '';
}
?>
<html>
  <head>
    <title>Pi Control</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/jsToggle/lc_switch.js"></script>
    <link rel="stylesheet" href="js/jsToggle/lc_switch.css">
  </head>
  <body>
    <input type="checkbox" name="GPIO_4" value="1" <?php echo $checked ?> class="lcs_check lcs_tt2" autocomplete="off" />

    <script type="text/javascript">
    $(document).ready(function(e) {
        $('input').lc_switch();

        // triggered each time a field changes status
        $('body').delegate('.lcs_check', 'lcs-statuschange', function() {
            var parameter = $(this).attr('name');
            var value = $(this).is(':checked') ? '1' : '0';
            updateSetting(parameter, value)
        });

    });

    function updateSetting(parameter, value) {
        event.preventDefault();

        var payload = {
            parameter: parameter,
            value: value,
        };

        $.ajax({
            url: 'update_setting.php',
            method: 'POST',
            data: payload
        });
    }
    </script>
  </body>
</html>