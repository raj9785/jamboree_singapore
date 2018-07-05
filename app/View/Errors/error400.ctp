<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

<?php if(URL_DOMAIN!="beta"){
	?>
<div class="booking_top careers">
    <div class="container">
        <h2 class="cab_title"><?php echo $name; ?></h2>

        <div class="">
            <div class="col-sm-6 col-md-7 col-lg-8 ct_left">
                <div class="">
                    <div class="ct_main">
                        Sorry! This web page is not available.
						
						
                    </div>
                </div> 
            </div>
         
        </div>
    </div>
</div>
<?php
}else{ ?>
<p class="error">
	<strong><?php echo __d('cake', 'Error'); ?>: </strong>
	<?php printf(
		__d('cake', 'The requested address %s was not found on this server.'),
		"<strong>'{$url}'</strong>"
	); ?>
</p>
<?php } ?>
<?php
if (Configure::read('debug') > 0 ):
	echo $this->element('exception_stack_trace');
endif;
?>
