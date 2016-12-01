<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Get It Done - Admin</title>
        <!-- save no cache -->
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />
        <!-- save no cache -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="/web/admin/css/admin.css" rel="stylesheet" type="text/css"/>
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="//cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>
        <script>
            onload = function () {
                var roxyFileman = '/web/fileman/index.html'; 
                CKEDITOR.replace('ckeditor_field', {
                    filebrowserBrowseUrl: roxyFileman,
                    filebrowserImageBrowseUrl:roxyFileman,
                    removeDialogTabs: 'link:upload;image:upload'
                });
            }
        </script>
        <script src="/web/admin/javascript/Ajax.js"></script>
        <script src="/web/admin/javascript/Pages.js"></script>
        <script src="/web/admin/javascript/Products.js"></script>
        <script src="/web/admin/javascript/main.js"></script>
    </head>
    <?php flush();?>
    <body>
        <br />
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li role="presentation" class="<?php echo ($uri == "home") ? 'active' : ''; ?>" ><a href="/admin/home">Home</a></li>
                        <li role="presentation" class="<?php echo ($uri == "products") ? 'active' : ''; ?>" ><a href="/admin/products">Products</a></li>
                        <li role="presentation" class="<?php echo ($uri == "pages") ? 'active' : ''; ?>" ><a href="/admin/pages">Pages</a></li>
                        <li role="presentation" class="disabled <?php echo ($uri == "events") ? 'active' : ''; ?>" ><a>Events</a></li>
                        <!--<li role="presentation" class="<?php // echo ($uri == "media") ? 'active' : ''; ?>" ><a href="/admin/media">Media</a></li>-->

                        <li role="presentation" class="dropdown navbar-right">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                Dropdown <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/admin/send_feedback">Send Feedback</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="/admin/doLogout">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <br />