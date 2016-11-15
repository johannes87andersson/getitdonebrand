<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Get It Done</title>
        <!-- save no cache -->
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />
        <!-- save no cache -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo $page["page_desc"]?>">
        <meta name="keywords" content="<?php echo $page["page_keywords"];?>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>
        <link rel="stylesheet" href="/web/css/main.css" />
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    </head>
    <?php flush();?>
    <body>
        <div class="test">
            <!-- needed for background image -->
        </div>
        <nav class="navbar main-menu">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<a class="navbar-brand" href="/">GetItDone</a>-->
                    <a class="navbar-brand logo" href="/"><img width="50" src="/web/images/getitdone-logo.svg"/> <!--<span class="inner-logo-text">Get It Done</span><span class="inner-logo-text2">Brand Sweden</span>--></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><img class="menu-icons" src="/web/images/facebook.svg" /></a></li>
                        <li><a href="#"><img class="menu-icons" src="/web/images/instagram.svg" /></a></li>
                        <li><a href="#"><img class="menu-icons" src="/web/images/snapchat.svg" /></a></li>
                        <li class="hide-me"><a href="#"><img class="menu-icons" src="/web/images/sv.png" /></a></li>
                        <li class="hide-me"><a href="#"><img class="menu-icons" src="/web/images/en.png" /></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="clearfix"></div>
        
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="text text-left">
                        <h2 class="text lead">My Special bar</h2>
                        Bunch of static data for whatever reason you may want!
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="text text-left">
                        <h1 class="text lead"><?php echo $page["page_title"];?></h1>
                        <?php echo $page["page_text"];?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>