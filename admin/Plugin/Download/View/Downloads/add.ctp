<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'download', 'controller' => 'downloads', 'action' => 'index')); ?>';
        });
    });
</script>
<?php //echo $this->Html->script('ckeditor/ckeditor.js', array('inline' => false)); ?>
<?php
echo $this->Html->script(array('downloads'));
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
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'download', 'controller' => 'downloads', "action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
                        echo $this->Form->create('Download', array(array('method' => 'post', 'class' => 'form', 'role' => 'form'), 'enctype' => 'multipart/form-data'));
                        ?>
                        <div class="row">

                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Course <span class="symbol required"></span></label>
                                        <?php echo $this->Form->select('deadline_category_id', $cat_list, array('id' => 'deadline_category_id', "class" => "form-control", 'empty' => "Select",)); ?>
                                        <span id="deadline_category_id-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Type <span class="symbol required"></span></label>
                                        <?php echo $this->Form->select('download_category_id', $dcat_list, array('id' => 'download_category_id', "class" => "form-control", 'empty' => "Select",)); ?>
                                        <span id="download_category_id-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12"> 
                                <div class="col-md-6"> 

                                    <div class="form-group">
                                        <label class="control-label">Title <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('title', array('type' => 'text', 'maxlength' => '200', 'class' => 'form-control', 'id' => 'title', 'div' => false, 'label' => false)); ?>
                                        <span id="title-error" class="help-block"></span>
                                    </div>


                                </div>


                            </div>
                            <div class="col-md-12 file" > 
                                <div class="col-md-6"> 

                                    <div class="form-group">
                                        <label class="control-label">File <span class="symbol required"></span></label>
                                        <?php echo $this->Form->file('image', array('id' => "image", 'class' => " validate[required]")); ?>
                                        <span id="image-error" class="help-block"></span>
                                    </div>



                                </div>


                            </div>


                            <div class="col-md-12 yoytube"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Youtube URL <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('you_tube_url', array('type' => 'text', 'class' => 'form-control', 'id' => 'you_tube_url', 'div' => false, 'label' => false)); ?>
                                        <span id="you_tube_url-error" class="help-block"></span>
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


