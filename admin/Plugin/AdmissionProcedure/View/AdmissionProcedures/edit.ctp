
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'admission_procedure', 'controller' => 'admission_procedures', 'action' => 'index')); ?>';
        });

    });
</script>
<?php echo $this->Html->script('ckeditor/ckeditor.js', array('inline' => false)); ?>
<?php
echo $this->Html->script(array('add_admission_procedure'));
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
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'admission_procedure', 'controller' => 'admission_procedures', "action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
                        echo $this->Form->create('AdmissionProcedure', array(array('method' => 'post', 'class' => 'form', 'role' => 'form'), 'enctype' => 'multipart/form-data'));
                        ?>
                        <?php echo $this->Form->input('AdmissionProcedure.id', array('type' => 'hidden')); ?>
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="col-md-12"> 
                                    <div class="form-group">
                                        <label class="control-label">Course <span class="symbol required"></span></label>
                                        <?php echo $this->Form->select('deadline_category_id', $pos_list, array('id' => 'deadline_category_id','disabled'=>true ,"class" => "form-control", 'empty' => "Select Course",)); ?>
                                        <span id="deadline_category_id-error" class="help-block"></span>
                                    </div>
                                </div>


                                <div class="col-md-12"> 

                                    <div class="form-group">
                                        <label class="control-label">Title <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('title', array('type' => 'text', 'class' => 'form-control', 'id' => 'title', 'div' => false, 'label' => false)); ?>
                                        <span id="question-error" class="help-block"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12"> 
                                <div class="col-md-12"> 

                                    <div class="form-group">
                                        <label class="control-label">Content <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('content', array('type' => 'textarea', 'rows' => 6, 'class' => 'form-control', 'id' => 'content', 'div' => false, 'label' => false)); ?>
                                        <span id="answer-error" class="help-block"></span>
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
<?php
$unique_id = "jamboree";
?>
<script type="text/javascript">
    // <![CDATA[
    editor = CKEDITOR.replace('content',
            {
                height: 500,
                //width: 800,
                //enterMode: CKEDITOR.ENTER_BR,
                extraPlugins: 'imageuploader',
                filebrowserBrowseUrl: '<?php echo WEBSITE_URL; ?>admin/js/ckeditor/plugins/imageuploader/imgbrowser.php?unique_id=<?php echo $unique_id; ?>',
                                filebrowserUploadUrl: '<?php echo WEBSITE_URL; ?>albums/<?php echo $unique_id; ?>/',
                                filebrowserImageBrowseUrl: '<?php echo WEBSITE_URL; ?>admin/js/ckeditor/plugins/imageuploader/imgbrowser.php?unique_id=<?php echo $unique_id; ?>',
                                                filebrowserImageUploadUrl: '<?php echo WEBSITE_URL; ?>albums/<?php echo $unique_id; ?>/',
                                            });
                                    //]]>


                                    var value = editor.getData();
                                    $(".preview_data").html(value);

                                    editor.on('blur', function (evt) {
                                        var value = editor.getData();
                                        $(".preview_data").html(value);
                                    });
                                    editor.on('focus', function (evt) {
                                        var value = editor.getData();
                                        $(".preview_data").html(value);
                                    });

                                    $("#prv").on("click", function () {
                                        var value = editor.getData();


                                        $(".preview_data").html(value);



                                    });
</script>

