<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>La Gran Prueba</title>
        <meta name="description" content="">
        <link rel="shortcut icon" href="favicon.png" type="image/png" />

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Alfa+Slab+One" rel="stylesheet" type="text/css">
        <script src="<?=$this->Html->url('/')?>js/jquery.min.js"></script>
        <script src="<?=$this->Html->url('/')?>js/json2.js"></script>
        <script src="<?=$this->Html->url('/')?>js/login-functions.js"></script>
        <script src="<?=$this->Html->url('/')?>js/jquery.rut.min.js"></script>
        <link href="<?=$this->Html->url('/')?>css/main.css" rel="stylesheet" >
    </head>
    <body>
        <div id="fb-root"></div>
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    appId      : '481530158619215',
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
        <div class="bg-principal ingreso transitions">
            <!--<div class="los-personajes">
                <img src="<?=$this->Html->url('/')?>images/personajes-home.png" alt="">
            </div>-->
            <div class="contenedor">
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
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
                    var APPID = "481530158619215"
                    var uri = encodeURI('http://lagranprueba.preunab.cl/?fbregister=1');
                    FB.getLoginStatus(function(response) {
                        //console.log(response);
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

			ga('create', 'UA-2230421-10', 'auto');
			ga('send', 'pageview');
        </script>
    </body>
</html>
