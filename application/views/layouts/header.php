<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Qualita Consulting - Administrator</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/css/cosmo/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/bootstrap-datepicker/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/chartjs/Chart.min.css" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/css/open-iconic/font/css/open-iconic-bootstrap.min.css" rel="stylesheet" type="text/css">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
        <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.inputmask.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.id.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/clipboard.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/chartjs/Chart.bundle.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var clipboard = new ClipboardJS('.copyClipboard');
            var maxLength =100;
            clipboard.on('success', function(e) {
                console.info('Action:', e.action);
                console.info('Text:', e.text);
                console.info('Trigger:', e.trigger);
                $('#copyToast').toast('show')
                e.clearSelection();
            });

            clipboard.on('error', function(e) {
                console.error('Action:', e.action);
                console.error('Trigger:', e.trigger);
            });
            $('.standardDate').datepicker({
                format: "yyyy-mm-dd",
                language: "id",
                autoclose: true
            });

            $('.timemask').inputmask("99:99");
            
            $(".show-read-more").each(function(){
                var myStr = $(this).text();

                if($.trim(myStr).length > maxLength){
                    var newStr = myStr.substring(0, maxLength);
                    var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                    $(this).empty().html(newStr);
                    $(this).append(' <a href="javascript:void(0);" class="read-more text-decoration-none">read more...</a>');
                    $(this).append('<span class="more-text">' + removedStr + '</span>');
                }
            });

            $(".read-more").click(function(){
                $(this).siblings(".more-text").contents().unwrap();
                $(this).remove();
            });
        });

        function randomString(len) {
            charSet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var randomString = '';
            for (var i = 0; i < len; i++) {
                var randomPoz = Math.floor(Math.random() * charSet.length);
                randomString += charSet.substring(randomPoz,randomPoz+1);
            }
            return randomString;
        }

        function generate_random_token(obj){
            $('#' + obj).val(randomString(10));
        }
    </script>
    <style>

    .show-read-more .more-text{
        display: none;
    }

    </style>
</head>

<body>
<div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="true"  id="copyToast" style="position: absolute; top: 50%; right: 50%; z-index:10000;">
  <div class="toast-header">
    <strong class="mr-auto">Copied!</strong>
  </div>
</div>

    