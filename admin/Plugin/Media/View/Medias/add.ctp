<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'media', 'controller' => 'medias', 'action' => 'index')); ?>';
        });
    });
</script>

<?php
echo $this->Html->script(array('add_media'));
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
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'media', 'controller' => 'medias', "action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
                        echo $this->Form->create('Media', array(array('method' => 'post', 'class' => 'form', 'role' => 'form'), 'enctype' => 'multipart/form-data'));
                        ?>
                        <div class="row">
                            <div class="col-md-6"> 

                                <div class="col-md-12"> 
                                    <div class="form-group">
                                        <label class="control-label">Media Type <span class="symbol required"></span></label>
                                        <?php echo $this->Form->select('media_type_id', $cat_list, array('id' => 'media_type_id', "class" => "form-control validate[required]", 'empty' => false,)); ?>
                                        <span id="media_type_id-error" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-12"> 
                                    <div class="form-group">
                                        <label class="control-label">Title <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('title', array('type' => 'text', 'maxlength' => '200', 'class' => 'form-control', 'id' => 'title', 'div' => false, 'label' => false)); ?>
                                        <span id="title-error" class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-12 youtube_url"> 
                                    <div class="form-group">
                                        <label class="control-label">Youtube Video URL <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('media_url', array('type' => 'text', 'maxlength' => '200', 'class' => 'form-control', 'id' => 'media_url', 'div' => false, 'label' => false)); ?>
                                        <span id="media_url-error" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-12 image_url" style="display: none;"> 
                                    <div class="form-group">
                                        <label class="control-label">Alt Tag </label>
                                        <?php echo $this->Form->input('alt_tag', array('type' => 'text', 'maxlength' => '255', 'class' => 'form-control', 'id' => 'alt_tag', 'div' => false, 'label' => false)); ?>
                                        <span id="alt_tag-error" class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-12 image_url" style="display: none;"> 
                                    <div class="form-group">
                                        <label class="control-label">Newspaper Image <span class="symbol required"></span></label>
                                        <?php echo $this->Form->file('media_url_image', array('id' => "media_url_image")); ?>
                                        <span id="media_url_image-error" class="help-block"></span>
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
                                    <?php echo $this->Form->button('Save', array('class' => 'btn btn-primary btn-wide', 'type' => 'submit', 'id' => 'submit_button')) ?>
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
