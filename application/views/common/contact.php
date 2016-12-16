<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Get It Done</title>
        <!-- save no cache -->
<!--        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />-->
        <!-- save no cache -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo $page["page_desc"] ?>">
        <meta name="keywords" content="<?php echo $page["page_keywords"]; ?>">
        <link rel="shortcut icon" href="/web/images/Get it done logotyp small.ico"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
        <link rel="stylesheet" href="/web/css/main.css" />
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <style>
            p {
                margin: 0px 0 10px 0;
            }
            /* animate menu */
            .menu-main li > a:before {
                content: "";
                position: absolute;
                width: 100%;
                height: 2px;
                bottom: 0;
                left: 0;
                background-color: #000;
                visibility: hidden;
                -webkit-transform: scaleX(0);
                transform: scaleX(0);
                -webkit-transition: all 0.3s ease-in-out 0s;
                transition: all 0.3s ease-in-out 0s;
            }
            .menu-main li > a:hover:before {
                visibility: visible;
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
            }
            .menu-main li a {
                color: #000 !important;
            }
        </style>
    </head>
    <?php flush(); ?>
    <body>
        <div class="test">
            <!-- needed for background image -->
        </div>
        <?php require_once('menu.php'); ?>
        <div class="clearfix"></div>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="text text-left">
                        <h2 class="text lead"><?php echo $page["page_title"]; ?></h2>
                        <form method="POST" action="/common/sendEmail">
                            <div class="form-group">
                                <input type="email" class="form-control" id="contact_email" name="email_from" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="contact_question" name="email_body" placeholder="Dina fråga"></textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="text text-left">
                        <h2 class="text text-center lead">FAQ</h2>
                        <div class="text text-left">
                            <?php echo $page["page_text"]; ?>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>