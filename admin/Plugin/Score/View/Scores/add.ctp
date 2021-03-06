<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'score', 'controller' => 'scores', 'action' => 'index')); ?>';
        });
    });
</script>

<?php
echo $this->Html->script(array('add_score'));
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
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'score', 'controller' => 'scores', "action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
                        echo $this->Form->create('Score', array(array('method' => 'post', 'class' => 'form', 'role' => 'form'), 'enctype' => 'multipart/form-data'));
                        ?>
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="col-md-12"> 

                                    <div class="form-group">
                                        <label class="control-label">Course <span class="symbol required"></span></label>
                                        <?php echo $this->Form->select('course_id', $cat_list, array('id' => 'course_id', "class" => "form-control validate[required]", 'empty' => "Select Course",)); ?>
                                        <span id="course_id-error" class="help-block"></span>
                                    </div>


                                </div>
                                <div class="col-md-12"> 

                                    <div class="form-group">
                                        <label class="control-label">Student Name <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('name', array('type' => 'text', 'maxlength' => '200', 'class' => 'form-control', 'id' => 'name', 'div' => false, 'label' => false)); ?>
                                        <span id="name-error" class="help-block"></span>
                                    </div>


                                </div>
                                <div class="col-md-12 " > 
                                    <div class="form-group">
                                        <label class="control-label">Student Image </label>
                                        <?php echo $this->Form->file('image', array('id' => "image", 'class' => " validate[required]")); ?>
                                        <span id="image-error" class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-12"> 

                                    <div class="form-group">
                                        <label class="control-label">Score <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('marks', array('type' => 'number', 'min' => 1, 'max' => 5000, 'maxlength' => '200', 'onkeypress' => 'return checkValiValue(event)', 'class' => 'form-control', 'id' => 'marks', 'div' => false, 'label' => false)); ?>
                                        <span id="marks-error" class="help-block"></span>
                                    </div>


                                </div>
                                <div class="col-md-12"> 

                                    <div class="form-group">
                                        <label class="control-label">Year (Ex:2018)<span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('pass_year', array('type' => 'number', 'min' => 2000, 'max' => date("Y"), 'maxlength' => '200', 'onkeypress' => 'return checkValiValue(event)', 'class' => 'form-control', 'id' => 'pass_year', 'div' => false, 'label' => false)); ?>
                                        <span id="pass_year-error" class="help-block"></span>
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
