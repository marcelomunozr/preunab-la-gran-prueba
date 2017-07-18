<?php

?>
<!DOCTYPE html>
<html>
    <head>
        
        <title>La Gran Prueba</title>
        
        <!-- Bootstrap & jQuery -->
        <link href="/css/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">                
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="/css/bootstrap/js/bootstrap.js"></script>

        <!-- Custom Styles -->
        <link href="/css/admin.css" rel="stylesheet" media="screen">  
        
        <script>
            
            // center box
            $(window).resize(function(){                
                $('#logginBox').css({
                    position:'absolute',
                    left: ($(window).width() - $('#logginBox').outerWidth())/2,
                    top: ($(window).height() - $('#logginBox').outerHeight())/2  
                });
            });
            
            $(document).ready(function() {
                $(window).resize();
            });
                  
            
        </script>
    </head>
    <body>
        
        <?php echo $this->fetch('content'); ?>                             
        
    </body>
    
</html>