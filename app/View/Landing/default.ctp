<!DOCTYPE html>
<html>
    <head>
        
        <title>La Gran Prueba</title>

        <script src="/js/jquery-2.1.0.min.js"></script>
        <script src="/js/jquery.transit.min.js"></script>      
        <script src="/js/jquery.animateNumber.js"></script>      
        <script src="/js/jquery.chrony.min.js"></script>                 
        <script src="/js/ion-sound/ion.sound.min.js"></script>
        <script src="/js/main.js"></script>
        <!--<script src="/js/main.min.js"></script>-->
        
        <link rel="shortcut icon" href="/favicon.png">
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet' type='text/css'>
        <link href="/css/styles.css" rel="stylesheet" media="screen">  

        <script type="text/javascript">
            var _gaq = _gaq || [];
            var pluginUrl = '//www.google-analytics.com/plugins/ga/inpage_linkid.js';
            _gaq.push(['_require', 'inpage_linkid', pluginUrl]);
            _gaq.push(['_setAccount', 'UA-2230421-10']);
            _gaq.push(['_setDomainName', 'preunab.cl']);
            _gaq.push(['_addIgnoredRef', 'preunab.cl']);
            _gaq.push(['_setAllowLinker', true]);
            _gaq.push(['_trackPageview']);

            (function() {
              var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
              ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
              var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>        
    </head>
    
    

    <body>                
        <!-- Google Tag Manager -->
        <noscript>
                <iframe src="//www.googletagmanager.com/ns.html?id=GTM-J7JW" height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <script>
                (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-J7JW');
        </script>
        <!-- End Google Tag Manager -->
    
        <div id="fb-root"></div>
        
        <!--[if lte IE 8]>
        <div id="ie-advice">
            Su navegador esta antiguo! Optimizado solo para Firefox, Chrome, IE9 o superior. <a href="http://www.google.com/intl/es/chrome/browser/" target="_blank">Descargar Google Chrome</a>
        </div>
        <![endif]-->        
        
        <?php echo $this->element('header'); ?>   
        
        <div id="content">
            <?php echo $this->fetch('content'); ?> 
        </div>
        
        <div id="loading">
                
            <div class="loader-box">
                <div class="loader"></div>  
                cargando
            </div>

        </div>
        
        <div id="overlay">
            
        </div>
        
        <div id="modal-alive">  
            <img src="/img/alive.png" />            
            <div class="start-button">Continuar</div>
        </div>
        
    </body>
    
</html>