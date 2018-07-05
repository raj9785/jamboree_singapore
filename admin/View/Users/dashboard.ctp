<?php
//bootstrap.min.js
echo $this->Html->script(array('jquery.min.js', 'main.js'));

echo $this->Html->css(array('morris'));
?>



<div id="app">
    <!-- sidebar -->
    <?php echo $this->element('sidebar'); ?>
    <!-- / sidebar -->
    <div class="app-content">
        <!-- start: TOP NAVBAR -->
        <?php echo $this->element('header'); ?>
        <!-- end: TOP NAVBAR -->
        <?php
        //if (!isset($permissions) || (isset($permissions) && isset($permissions['dashboard']) && $permissions['dashboard'] == 1)) {
        ?>	
        <div class="main-content" >
            <div class="wrap-content container" id="container">  
                <?php echo $this->Session->flash(); ?>				
                <div class="container-fluid container-fullw bg-white">

                    <div class="row">

                       


                        <div class="dashboard_panel"></div>






                    </div>
                </div> 
                <!-- end: FOURTH SECTION -->
            </div>
        </div>
    </div>
    <?php
//}
    ?> 


    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->    
</div>
<?php
$default_dashboard = 1;
if ((isset($permissions['checkdashboard1']) && $permissions['checkdashboard1'] == 1)) {
    $default_dashboard = 1;
} else if ((isset($permissions['checkdashboard4']) && $permissions['checkdashboard4'] == 1)) {
    $default_dashboard = 4;
}
?>

<script type="text/javascript">
    $(document).ready(function () {
        


       
        $(".slide_class").on("click", function () {
            var chks = $(this).hasClass("open");
            $(".slide_class").each(function () {
                if ($(this).hasClass("active")) {

                } else {
                    $(this).removeClass('open');
                    $(this).children(".sub-menu").slideUp();
                }
            });

            if (chks) {
                $(this).removeClass('open');
                $(this).children(".sub-menu").slideUp();
            } else {
                // alert("d2");
                $(this).addClass('open');
                $(this).children(".sub-menu").slideDown();
            }
        });



    });

   

    




</script>

<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery-1.11.1.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/bootstrap.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/modernizr.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.sparkline.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/toggles.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/retina.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.cookies.js"></script>


<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.symbol.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.crosshair.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.categories.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.pie.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/morris.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/raphael-2.1.0.min.js"></script>

<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/custom.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/charts.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
