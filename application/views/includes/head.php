<!DOCTYPE html>
<html>
    <head>
        <title>CAR SHARE</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- We load the Style sheets -->
        <!-- Style sheet for car share -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url');?>/css/style.css" />
        <!-- Style Sheet for the Jquery User Interface, in this case the pop up calendar -->
        <link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>/css/smoothness/jquery-ui-1.8.18.custom.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url'); ?>css/slide.css" />
        <!-- LOAD THE JQUERY LIBRARY -->
        <script type="text/javascript" src="<?php echo $this->config->item('base_url');?>/js/jquery-1.7.2.min.js"></script>
        <!-- LOAD THE JQUERY'S USER INTERFACE -->
        <script type="text/javascript" src="<?php echo $this->config->item('base_url');?>/js/jquery-ui-1.8.18.custom.min.js"></script>
        <!-- LOAD THE JQUERY'S USER INTERFACE TIME PICKER -->
        <script type="text/javascript" src="<?php echo $this->config->item('base_url');?>/js/jquery-ui-timepicker-addon.js"></script>
        
        <!-- LOAD THE GOOGLE MAP API -->
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <!-- LOAD GMAPI SUGGEST I FOUND ON http://blog.techno-barje.fr/post/2010/11/04/Google-maps-hacks-part1-auto-suggest-location-in/ -->
        <!--script type="text/javascript" src="<?php echo $this->config->item('base_url');?>/js/gmapi-suggest.js"></script-->
        <!-- LOAD GOOGLE MAP JQUERY PLUGIN GMAP -->
        <!--script type="text/javascript" src="<?php echo $this->config->item('base_url');?>/js/jquery.gmap-1.1.0-min.js"></script-->
        <!-- CUSTOM JQUERY -->
        <script type="text/javascript" src="<?php echo $this->config->item('base_url');?>/js/carshare_custom.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('base_url'); ?>js/slide.js"></script>
        <!--script type="text/javascript" src="<?php echo $this->config->item('base_url');?>/js/gmapi-custom.js"></script-->
        <!--script type="text/css">
            $(document).ready(function(){
                $("#map_canvas").gMap();
            });
        </script-->
        
        <script type="text/javascript">
            var base_url = '<?php echo $this->config->item('base_url'); ?>';
        </script>
        
    </head>