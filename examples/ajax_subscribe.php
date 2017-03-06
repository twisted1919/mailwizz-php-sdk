<?php
/**
 * This file contains examples for using the MailWizzApi PHP-SDK.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2017 http://www.mailwizz.com/
 */
 
// require the setup which has registered the autoloader
require_once dirname(__FILE__) . '/setup.php';

// see if the request is made via ajax.    
$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

// and if it is and we have post values, then we can proceed in sending the subscriber.
if ($isAjaxRequest && !empty($_POST)) {

    $listUid    = 'LIST-UNIQUE-ID';// you'll take this from your customers area, in list overview from the address bar.
    $endpoint   = new MailWizzApi_Endpoint_ListSubscribers();
    $response   = $endpoint->create($listUid, array(
        'EMAIL' => isset($_POST['EMAIL']) ? $_POST['EMAIL'] : null,
        'FNAME' => isset($_POST['FNAME']) ? $_POST['FNAME'] : null,
        'LNAME' => isset($_POST['LNAME']) ? $_POST['LNAME'] : null,
    ));
    $response   = $response->body;
    
    // if the returned status is success, we are done.
    if ($response->itemAt('status') == 'success') {
        exit(MailWizzApi_Json::encode(array(
            'status'    => 'success',
            'message'   => 'Thank you for joining our email list. Please confirm your email address now!'
        )));
    }
    
    // otherwise, the status is error
    exit(MailWizzApi_Json::encode(array(
        'status'    => 'error',
        'message'   => $response->itemAt('error')
    )));
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" />
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Noto+Sans:700italic" />
    <link rel="stylesheet" type="text/css" href="http://www.mailwizz.com/backend/assets/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="http://www.mailwizz.com/backend/assets/css/bootstrap-glyphicons.css" />
    <link rel="stylesheet" type="text/css" href="http://www.mailwizz.com/backend/assets/css/style.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://www.mailwizz.com/backend/assets/js/bootstrap.js" id="script-bootstrap"></script>
    <link rel="shortcut icon" href="http://www.mailwizz.com/favicon.ico" type="image/x-icon" /> 
	<title>Ajax subscribe</title>
    <style>
    #content {
        margin-top: 30px; 
        border: 1px solid #c2c2c2;
        padding:10px;
    }
    div.error {
        border: 1px solid #b94a48;
	    background: #f2dede;
        color: #000000;
        font-size: 12px;
        padding:10px;
        margin-bottom:10px;
    }
    div.success {
        color: #000000;
        background: #dff0d8;
        border: 1px solid #d6e9c6;
        font-size: 12px;
        padding:10px;
        margin-bottom:10px;
    }
    input.error {
        border: 1px solid #b94a48;
	    background: #f2dede;
        font-size: 12px;
    }
    </style>
    <script>
    jQuery(document).ready(function($){
        // bootstrap button
        $('.btn-submit').button();
        
        $('#content form').on('submit', function(e){
            e.preventDefault();
            var $this = $(this);
            var $message = $('.message');
            var $email = $('input[name=EMAIL]', this);
            
            // empty any previous message
            $message.empty().removeClass('error').removeClass('success').hide();
            
            // remove dinamically attached error elements
            $('.error', $this).remove();
            
            // just a small check, the api server will check anyway
            var email = $email.val();
            if (!email || email.indexOf('@') < 0) {
                $message.addClass('error').text('Please enter a valid email!').show();
                return false;
            }
            
            // show the loading text on the submit button
            $('.btn-submit').button('loading');
            
            // post the form to the php script and get the response
            $.post('', $this.serialize(), function(json){
                $('.btn-submit').button('reset');
                $message.text(json.message).show();
                
                // if the status is success, add the success class.
                if (json.status == 'success') {
                    $message.addClass('success');
                    // also, empty the fields
                    $('input[type=text]', $this).val('');
                } else {
                    // otherwise, add the error class.
                    $message.addClass('error');
                }
            }, 'json');
            
            return false;
        });
    });
    </script>
</head>

<body>

<div class="col-lg-4"><!-- --></div>
                
<div class="col-lg-4" id="content">
    <!--
    The form below is generated by MailWizz EMA.
    You can see your list forms by viewing the "Embed forms" section of your email list.
    -->
    <div class="message"></div>
    <form action="" method="post" accept-charset="utf-8" target="_blank">

        <div class="form-group">
            <label>Email <span class="required">*</span></label>
            <input type="text" class="form-control" name="EMAIL" placeholder="" value="" required />
        </div>
    
        <div class="form-group">
            <label>First name</label>
            <input type="text" class="form-control" name="FNAME" placeholder="" value=""/>
        </div>
    
        <div class="form-group">
            <label>Last name</label>
            <input type="text" class="form-control" name="LNAME" placeholder="" value=""/>
        </div>
        
        <div class="clearfix"><!-- --></div>
        <div class="actions">
            <button type="submit" class="btn btn-default btn-submit" data-loading-text="Please wait...">Subscribe</button>
        </div>
        <div class="clearfix"><!-- --></div>
                
    </form>
</div>

<div class="col-lg-4"><!-- --></div>

</body>
</html>