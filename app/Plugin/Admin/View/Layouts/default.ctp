<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>La Gran Prueba</title>
        
        <!-- Bootstrap & jQuery -->
        <link href="/css/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">                
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="/css/bootstrap/js/bootstrap.js"></script>
        <script src="/js/highcharts/js/highcharts.js"></script>

        <!-- Custom Styles -->
        <link href="/css/admin.css" rel="stylesheet" media="screen">  
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.min.css" rel="stylesheet" />          
        <link href="/js/summernote/summernote.css"  rel="stylesheet"  />
        
        <script src="/js/summernote/summernote.min.js"></script>
        
    </head>
    <body>
        
        <div class="wrapper">
            
            <?php echo $this->element('header'); ?>
            
            <div id="content">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>        
            </div>

            <?php echo $this->element('footer'); ?>            
            <?php // echo $this->element('sql_dump'); ?>
        </div>            
    </body>
    
</html>