
<!DOCTYPE html>
<html>
    <head>
        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body class = "cyan">
    

        <div id="login-page" class="row" style="margin-top: 100px;">
            <div class="col s4 z-depth-4 card-panel offset-s4">
            <form class="login-form" action="includes/authenticate.php" method="post">
                <div class="row">
                    <div class="input-field col s12 center">
                        <img src="images/logo.jpg" alt="" class="circle responsive-img valign profile-image-login">
                        <h4 class="center ">CSI Portal, DDU</h4>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-social-person-outline prefix"></i>
                        <input id="username" name="username" type="text">
                        <label for="username" class="center-align">Username</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-action-lock-outline prefix"></i>
                        <input id="password" name="password" type="text">
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button class="amber darken-3 btn waves-effect waves-light col s12">Login</button>
                    </div>
                </div>
            </form>
            </div>
        </div>

        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>