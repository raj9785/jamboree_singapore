<?php
echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'), null, array('inline' => false));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'), array('inline' => false));
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'review', 'controller' => 'reviews', 'action' => 'index')); ?>';
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
<?php //echo $this->Html->script('ckeditor/ckeditor.js', array('inline' => false)); ?>
<?php
echo $this->Html->script(array('reviews'));
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
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'review', 'controller' => 'reviews', "action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
                        echo $this->Form->create('Review', array(array('method' => 'post', 'class' => 'form', 'role' => 'form'), 'enctype' => 'multipart/form-data'));
                        ?>
                        <?php echo $this->Form->input('Review.id', array('type' => 'hidden')); ?>
                        <input type="hidden" name="course_id_sel" id="course_id_sel" value="<?php echo $users_data['Review']['course_id']; ?>">
                        <div class="row">


                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Course <span class="symbol required"></span></label>
                                        <?php echo $this->Form->select('course_id', $cat_list, array('id' => 'course_id', "disabled", "class" => "form-control validate[required]", 'empty' => "Select Course",)); ?>
                                        <span id="course_id-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12"> 
                                <div class="col-md-6"> 

                                    <div class="form-group">
                                        <label class="control-label">Student Name <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('student_name', array('type' => 'text', 'maxlength' => '200', 'class' => 'form-control', 'id' => 'student_name', 'div' => false, 'label' => false)); ?>
                                        <span id="student_name-error" class="help-block"></span>
                                    </div>


                                </div>


                            </div>
                            <div class="col-md-12 " > 
                                <div class="col-md-6"> 

                                    <div class="form-group">
                                        <label class="control-label">Change Student Image </label>
                                        <?php echo $this->Form->file('url_image', array('id' => "url_image", 'class' => "validate[required]")); ?>
                                        <span id="image-error" class="help-block"></span>
                                    </div>



                                </div>


                            </div>

                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Uploaded Image </label>
                                        <?php
                                        $file_name = $users_data["Review"]['image'];
                                        if (is_file(REVIEWS_IMAGE_PATH . $file_name)) {
                                            $images = $this->Html->image(REVIEWS_IMAGE_HTTP_PATH . $file_name, array('height' => 200, 'height' => '150'));
                                            ?>
                                            <a id="single_1" href="<?php echo REVIEWS_IMAGE_HTTP_PATH . $file_name; ?>">
                                                <?php echo $images; ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>


                            </div>



                            <?php
                            if ($users_data["Review"]['course_id'] == 6) {
                                ?>   
                                <div class="col-md-12 university_name"> 
                                    <div class="col-md-6"> 

                                        <div class="form-group">
                                            <label class="control-label">University Name <span class="symbol required"></span></label>
                                            <?php echo $this->Form->input('university_name', array('type' => 'text', 'maxlength' => '200', 'class' => 'form-control', 'id' => 'university_name', 'div' => false, 'label' => false)); ?>
                                            <span id="university_name-error" class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            <?php } else {
                                ?>
                                <div class="col-md-12 marks"> 
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label class="control-label">Score <span class="symbol required"></span></label>
                                            <?php echo $this->Form->input('marks', array('type' => 'number', 'min' => '1', 'max' => '2000', 'class' => 'form-control', 'id' => 'marks', 'div' => false, 'label' => false)); ?>
                                            <span id="marks-error" class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                            <?php }
                            ?>
                            <div class="col-md-12"> 
                                <div class="col-md-6"> 

                                    <div class="form-group">
                                        <label class="control-label">Reviews <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('reviews', array('type' => 'textarea', 'class' => 'form-control ckeditor', 'id' => 'reviews', 'div' => false, 'label' => false)); ?>
                                        <span id="reviews-error" class="help-block"></span>
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



