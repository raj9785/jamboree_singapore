
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'career', 'controller' => 'careers', 'action' => 'index')); ?>';
        });

    });
</script>
<?php echo $this->Html->script('ckeditor/ckeditor.js', array('inline' => false)); ?>
<?php
echo $this->Html->script(array('careers'));
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
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'career', 'controller' => 'careers', "action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
                        echo $this->Form->create('Career', array(array('method' => 'post', 'class' => 'form', 'role' => 'form'), 'enctype' => 'multipart/form-data'));
                        ?>
                        <?php echo $this->Form->input('Career.id', array('type' => 'hidden')); ?>
                        <div class="row">

                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Career Area <span class="symbol required"></span></label>
                                        <?php echo $this->Form->select('career_category_id', $cat_list, array('id' => 'career_category_id', "class" => "form-control validate[required]", 'empty' => "Select Career Area",)); ?>
                                        <span id="career_category_id-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12"> 
                                <div class="col-md-6"> 

                                    <div class="form-group">
                                        <label class="control-label">Career Title <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('title', array('type' => 'text', 'maxlength' => '200', 'class' => 'form-control', 'id' => 'title', 'div' => false, 'label' => false)); ?>
                                        <span id="title-error" class="help-block"></span>
                                    </div>


                                </div>


                            </div>
                            
                            <div class="col-md-12"> 
                                <div class="col-md-6"> 

                                    <div class="form-group">
                                        <label class="control-label">Job Functional Area <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('job_functional_area', array('type' => 'textarea', 'maxlength' => '200', 'class' => 'form-control', 'id' => 'job_functional_area', 'div' => false, 'label' => false)); ?>
                                        <span id="job_functional_area-error" class="help-block"></span>
                                    </div>


                                </div>


                            </div>


                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Career Location <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('location', array('type' => 'text', 'maxlength' => '255', 'class' => 'form-control', 'id' => 'location', 'div' => false, 'label' => false)); ?>
                                        <span id="location-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>






                            <div class="col-md-12"> 
                                <div class="col-md-12"> 

                                    <div class="form-group">
                                        <label class="control-label">Career Description <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('description', array('type' => 'textarea', 'class' => 'form-control ckeditor', 'id' => 'career_body', 'div' => false, 'label' => false)); ?>
                                        <span id="career_body-error" class="help-block"></span>
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
                                    <?php echo $this->Form->button('Update', array('class' => 'btn btn-primary btn-wide', 'type' => 'submit', 'id' => 'submit_button')) ?>
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
    editor = CKEDITOR.replace('career_body',
            {
                height: 300,
                //width: 800,
                //enterMode: CKEDITOR.ENTER_BR,
               



                                    });
</script>

