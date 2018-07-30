<script type="text/javascript">
    jQuery(document).ready(function () {


        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'page_program_detail', 'controller' => 'page_program_details', 'action' => 'index',$page_id)); ?>';
        });



    });
</script>
<script src="//cdn.ckeditor.com/4.10.0/basic/ckeditor.js"></script>
<?php
echo $this->Html->script(array('add_page_program_detail'));
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
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'page_program_detail', 'controller' => 'page_program_details', "action" => "index",$page_id), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
                        echo $this->Form->create('PageProgramDetail', array(array('method' => 'post', 'class' => 'form', 'role' => 'form'), 'enctype' => 'multipart/form-data'));
                        ?>
                        <div class="row">
                            <div class="col-md-12 " > 
                                <div class="col-md-6"> 

                                    <div class="form-group">
                                        <label class="control-label">Icon <span class="symbol required"></span></label>
                                        <?php echo $this->Form->file('image', array('id' => "image", 'class' => "")); ?>
                                        <span id="image-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Icon Alt Text <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('alt_text', array('type' => 'text', 'maxlength' => '500', 'class' => 'form-control', 'id' => 'alt_text', 'div' => false, 'label' => false)); ?>
                                        <span id="alt_text-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Description <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('heading_text', array('type' => 'textarea', 'maxlength' => '500', 'class' => 'form-control', 'id' => 'heading_text', 'div' => false, 'label' => false)); ?>
                                        <span id="image_url-error" class="help-block"></span>
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
                                    <?php echo $this->Form->button('Save', array('class' => 'btn btn-primary btn-wide', 'onclick' => 'validate()', 'type' => 'submit', 'id' => 'submit_button')) ?>
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

<script type="text/javascript">
    // <![CDATA[
    editor = CKEDITOR.replace('heading_text1',
            {
                //height: 300,
                //width: 800,
                //enterMode: CKEDITOR.ENTER_BR,

              
                                            });
                                    //]]>	

                                    
                                    

</script>


