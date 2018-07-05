<?php
echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'), null, array('inline' => false));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'), array('inline' => false));
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'social', 'controller' => 'socials', 'action' => 'index')); ?>';
        });
        $("#single_1").fancybox({
            helpers: {
                title: {
                    type: 'float'
                }
            }
        });

    });
</script>

<?php
echo $this->Html->script(array('socials'));
?>
<div id="app">
    <!-- sidebar -->
    <?php echo $this->element('sidebar'); ?>
    <!-- / sidebar -->
    <div class="app-content">
        <!-- start: TOP NAVBAR -->
        <?php echo $this->element('header'); ?>
        <!-- end: TOP NAVBAR -->
        <div class="main-content" >
            <div class="wrap-content container" id="container">
                <!-- start: PAGE TITLE -->
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1 class="mainTitle"><?php echo $title_for_layout; ?></h1>
                        </div>   
                        <div class="col-sm-2 text-align-right">
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'social', 'controller' => 'socials', "action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>

                    </div>
                </section>
                <!-- end: PAGE TITLE -->
                <!-- Global Messages -->
                <?php echo $this->Session->flash(); ?>
                <!-- Global Messages End -->
                <!-- start: FORM VALIDATION EXAMPLE 1 -->
                <div class="container-fluid container-fullw bg-white">

                    <div class="row">

                        <?php
                        echo $this->Form->create('Social', array(array('method' => 'post', 'class' => 'form', 'role' => 'form'), 'enctype' => 'multipart/form-data'));
                        ?>
                        <?php echo $this->Form->input('Social.id', array('type' => 'hidden')); ?>

                        <div class="row">
                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Image alt Tag <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('alt_tag', array('type' => 'text', 'maxlength' => '200', 'class' => 'form-control', 'id' => 'alt_tag', 'div' => false, 'label' => false)); ?>
                                        <span id="alt_tag-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12"> 
                                <div class="col-md-6"> 

                                    <div class="form-group">
                                        <label class="control-label">Social URL <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('social_url', array('type' => 'text', 'maxlength' => '200', 'class' => 'form-control', 'id' => 'social_url', 'div' => false, 'label' => false)); ?>
                                        <span id="social_url-error" class="help-block"></span>
                                    </div>


                                </div>


                            </div>
                            <div class="col-md-12 " > 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Change Image </label>
                                        <?php echo $this->Form->file('url_image', array('id' => "url_image")); ?>
                                        <span id="image-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Uploaded Image </label>
                                        <?php
                                        $file_name = $users_data["Social"]['image'];
                                        if (is_file(SOCIALS_IMAGE_PATH . $file_name)) {
                                            $images = $this->Html->image(SOCIALS_IMAGE_HTTP_PATH . $file_name);
                                            ?>
                                            <a id="single_1" href="<?php echo SOCIALS_IMAGE_HTTP_PATH . $file_name; ?>">
                                                <?php echo $images; ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12"> 
                                <div class="col-md-12">

                                    <span class="symbol required"></span>Required Fields
                                    <hr>

                                </div>
                            </div>

                            <div class="col-md-12"> 
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <?php echo $this->Form->button('Update', array('class' => 'btn btn-primary btn-wide', 'type' => 'submit', 'id' => 'submit_button_edit')) ?>
                                    <?php echo $this->Form->button('Cancel', array('class' => 'btn btn-primary btn-wide', 'type' => 'button', 'id' => 'cancel_button')) ?>
                                </div>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end: FORM VALIDATION EXAMPLE 1 -->
        </div>
    </div>

    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>



