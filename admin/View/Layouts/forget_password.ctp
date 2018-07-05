<?php

/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = __d('cake_dev', 'Welcome to Tueeter');
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo WEBSITE_NAME ?> Admin Panel : <?php echo $title_for_layout; ?>
        </title>
        <?php echo $this->Html->meta('favicon.ico', 'images/favicon.ico', array('type' => 'icon')); ?>
        <?php
        echo $this->Html->css(array('bootstrap.min.css', 'font-awesome.min.css', 'themify-icons.min.css', 'animate.min.css', 'perfect-scrollbar.min.css', 'switchery.min.css', 'styles', 'plugins', 'themes/theme-1.css'));
        echo $this->Html->script(array('jquery.min.js', 'bootstrap.min.js', 'modernizr.js', 'jquery.cookie.js', 'perfect-scrollbar.min.js', 'switchery.min.js', 'jquery.sparkline.min.js', 'main.js', 'login'));
        echo $this->Html->scriptBlock("
		jQuery(document).ready(function () {
                                        Login.init();
                                        Main.init();
                                    });
		", array('inline' => false));
        ?>
        <?php
        $css = array('styles');
        echo $this->Html->css($css);

        //$js = array('jquery.min', 'tytabs.jquery.min', 'html5');
        //echo $this->Html->script($js);

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        <script type="text/javascript">
            var Config = {
                'Site_URL': "<?php echo $this->webroot; ?>",
            };
            setTimeout(function () {
                $('.alert').fadeOut('slow');
            }, 5000);


        </script>	
    </head>







    <body class="login">
        <!-- start: LOGIN -->
        <div class="row">

            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                <div class="margin-top-30">
                    <div class="col-sm-6">   
                        <?php
                        echo $this->Html->image('/img/logo.png', array('style' => "margin-top:0px;", 'border' => 0, 'width' => '233px'))
                        ?>
                    </div>
                    <div class="col-sm-6" style="font-family: Eurostile Extended; margin-top: 10px; font-size: 33px; color: rgb(110, 111, 114); border-left: 1px solid;">
                        Admin Panel
                    </div>
                </div>
            </div>

            <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">

                <!-- start: LOGIN BOX -->
                <div class="box-login">
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->Form->create('User',array('url'=>array('plugin'=>false,'controller'=>'users','action'=>'forget_password'))); ?>
                    <fieldset>
                        <legend>
                            Reset your Password
                        </legend>
                        <p>
                            To Reset Your Password please provide Your Valid login Email id
                        </p>
                        <div class="form-group">
                            <span class="input-icon">
                                <?php echo $this->Form->input('email', array('type' => 'text', 'placeholder' => 'Email ID', 'required' => 'required', 'class' => 'form-control', 'div' => false, 'label' => false)) ?>
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </span>

                        </div>

                        <div class="pull-right">
                            <?php echo $this->Form->button('Submit', array('type' => 'submit', 'class' => 'btn btn-primary ')); ?>&nbsp;&nbsp;
                            <?php echo $this->Html->link("Go to Login", array('plugin' => false, 'controller' => "users", 'action' => "login"), array('escape' => false, 'class' => 'btn btn-green pull-right')); ?>
                        </div>                        
                    </fieldset>
                    <?php echo $this->Form->end(); ?>


                    <!-- start: COPYRIGHT -->
                    <div class="copyright">
                        <?php /* ?>&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> <?php echo SITE_TITLE; ?></span>. <span>All rights reserved</span><?php */ ?>
                        &copy;2018 Get me a Flat ! All Rights Reserved.
                    </div>
                    <!-- end: COPYRIGHT -->
                </div>
                <!-- end: LOGIN BOX -->
            </div>
        </div>
    </body>




</html>
