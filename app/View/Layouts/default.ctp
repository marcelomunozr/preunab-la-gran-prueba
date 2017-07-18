<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>La Gran Prueba</title>
    <link rel="<?=$this->Html->url('/')?>08-2015/shortcut icon" href="favicon.png" type="image/png" />
    <!-- Bootstrap Core CSS -->
    <link href="<?=$this->Html->url('/')?>08-2015/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    <link href="<?=$this->Html->url('/')?>08-2015/css/main.css" rel="stylesheet">
    <!--    Efectos -->
    <link href="<?=$this->Html->url('/')?>08-2015/css/animate.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?=$this->Html->url('/')?>08-2015/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,700,900' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-J7JW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-J7JW');</script>
<!-- End Google Tag Manager --> 
        <div id="fb-root"></div>
        <script>
            if(window.location.hostname == 'lagranprueba2.multinetlabs.com'){
                var appID = '729653897140172';
            }else{
                var appID = '481530158619215';
            }
            
        
            window.fbAsyncInit = function() {
                FB.init({
                    appId      : appID,
                    xfbml      : true,
                    version    : 'v2.1'
                });
            };
            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>



    <?php echo $this->fetch('content'); ?>



    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Universidad Andrés Bello © 2015. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="<?=$this->Html->url('/')?>08-2015/js/jquery.js"></script>

    <!-- Old Longi -->
    <script src="<?=$this->Html->url('/')?>js/json2.js"></script>
    <script src="<?=$this->Html->url('/')?>js/login-functions.js"></script>
    <script src="<?=$this->Html->url('/')?>js/jquery.rut.min.js"></script>

    <!-- Efectos -->
    <script src="<?=$this->Html->url('/')?>08-2015/js/viewportchecker.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=$this->Html->url('/')?>08-2015/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?=$this->Html->url('/')?>08-2015/js/jquery.easing.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=$this->Html->url('/')?>08-2015/js/main.js"></script>

    <!-- Old Login -->
    <script>
        $(document).ready(function(){
            $('body').on('click', '.fb-login', function(e){
                e.preventDefault();
                /*loading*/
                var $this = $(this);
                $this.attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-spin"></i>');
                setTimeout(function () {
                    $this.removeAttr('disabled').html('<i class="fa fa-spinner fa-spin"></i>');
                }, 3000)
                /*/loading*/
                var APPID = appID;
                var uri = encodeURI('http://lagranprueba.preunab.cl/?fbregister=1');
                FB.getLoginStatus(function(response) {
                    if (response.status === 'connected') {
                        $.post('/players/checkRegister.json', { fbid : response.authResponse.userID }, function(response){
                            if(response.existe){
                                FB.api('/me/permissions', function(response){
                                    var permisoAmigos = false;
                                    $.each(response.data, function(key, value){
                                        if(value.permission == 'user_friends' && value.status == 'granted'){
                                            permisoAmigos = true;
                                        }
                                    });
                                    if(!permisoAmigos){
                                        window.location = encodeURI("https://www.facebook.com/dialog/oauth?client_id=" + APPID + "&redirect_uri="+uri+"&response_type=token&scope=email,user_friends");
                                    }else{
                                        location.reload();
                                    }
                                });
                            }else{
                                FB.api('/me', function(response){
                                    var firstname   = (typeof response.first_name != 'undefined')   ? response.first_name : '';
                                    var middlename  = (typeof response.middle_name != 'undefined')  ? response.middle_name : '';
                                    var lastname    = (typeof response.last_name != 'undefined')    ? response.last_name : '';
                                    var email       = (typeof response.email != 'undefined')        ? response.email : '';
                                    $('#FormFullname').val(firstname + " " + middlename + " " + lastname);
                                    $('#FormEmail').val(email);
                                    $('#FormIdFacebookId').val(response.id);
                                });
                                $(".ingresa, .olvida").hide();
                                $(".registra").fadeIn(300);
                            }
                        });
                    }else {
                        window.location = encodeURI("https://www.facebook.com/dialog/oauth?client_id=" + APPID + "&redirect_uri="+uri+"&response_type=token&scope=email,user_friends");
                    }
                });
            });
            //console.log($(location).attr('hash'));
            var hash = $(location).attr('hash');
            <?php if(isset($registro_facebook) && $registro_facebook == true){ ?>
                $(window).load(function(){
                    FB.getLoginStatus(function(response) {
                        if(response.status === 'connected'){
                            $.getJSON('/players/checkRegister.json', { fbid : response.authResponse.userID }, function(response){
                                if(response.existe){
                                    location.reload();
                                }else{
                                    FB.api('/me', function(response){
                                        //console.log(response);
                                        $('#FormFullname').val(response.first_name + " " + response.middle_name + " " + response.last_name);
                                        $('#FormEmail').val(response.email);
                                        $('#FormIdFacebookId').val(response.id);
                                    });
                                    $(".ingresa, .olvida").hide();
                                    $(".registra").fadeIn(300);
                                }
                            });
                        }
                    });
                });
            <?php   } ?>
        });
    </script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-2230421-10', {'cookieDomain': 'preunab.cl'});
        ga('require', 'displayfeatures');
        ga('send', 'pageview');
    </script>    
    
</body>

</html>
