<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="/web/admin/css/admin.css" rel="stylesheet" type="text/css"/>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="/web/admin/javascript/main.js"></script>
    </head>
    <?php flush();?>
    <body>
        <?php print_r($_SESSION);
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text text-success lead">GetItDone <b class="text text-danger">Admin</b></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <form id="login_form" action="/admin/doLogin" method="POST">
                        <div class="form-group">
                            <label for="login_username">Email address</label>
                            <input type="text" class="form-control" id="login_username" name="login_username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="login_password">Password</label>
                            <input type="password" class="form-control" id="login_password" name="login_password" placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="login_persistent"> Keep me logged in
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
                <div class="col-md-4">
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </body>
</html>