
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'index')); ?>';
        });

    });
</script>
<?php echo $this->Html->script('ckeditor/ckeditor.js', array('inline' => false)); ?>
<?php
echo $this->Html->script(array('add_faq'));
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
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'faq', 'controller' => 'faqs', "action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
                        echo $this->Form->create('Faq', array(array('method' => 'post', 'class' => 'form', 'role' => 'form'), 'enctype' => 'multipart/form-data'));
                        ?>
                        <?php echo $this->Form->input('Faq.id', array('type' => 'hidden')); ?>
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="col-md-12"> 
                                    <div class="form-group">
                                        <label class="control-label">Page <span class="symbol required"></span></label>
                                        <?php echo $this->Form->select('menu_slug', $pos_list, array('id' => 'menu_slug', "class" => "form-control validate[required]", 'empty' => "Select Page",)); ?>
                                        <span id="menu_slug-error" class="help-block"></span>
                                    </div>
                                </div>

                                <?php
                                if ($users_data["Faq"]['deadline_category_id']) {
                                    ?>
                                    <div class="col-md-12 d_course"> 
                                        <div class="form-group">
                                            <label class="control-label">Course <span class="symbol required"></span></label>
                                            <?php echo $this->Form->select('deadline_category_id', $dcat_list, array('id' => 'deadline_category_id', "class" => "form-control validate[required]", 'empty' => "Select Course")); ?>
                                            <span id="menu_slug-error" class="help-block"></span>
                                        </div>
                                    </div>
                                <?php } ?>


                                <div class="col-md-12"> 

                                    <div class="form-group">
                                        <label class="control-label">Question <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('question', array('type' => 'textarea', 'rows' => 3, 'class' => 'form-control', 'id' => 'question', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="question-error" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-12"> 

                                    <div class="form-group">
                                        <label class="control-label">Answer <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('answer', array('type' => 'textarea', 'rows' => 6, 'class' => 'form-control', 'id' => 'answer', 'div' => false, 'label' => false, 'required' => true)); ?>
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
    editor = CKEDITOR.replace('answer',
            {
                height: 400,
                //width: 800,
                //enterMode: CKEDITOR.ENTER_BR,

                extraPlugins: 'imageuploader',
                filebrowserBrowseUrl: '<?php echo WEBSITE_URL; ?>admin/js/ckeditor/plugins/imageuploader/imgbrowser.php?unique_id=<?php echo $unique_id; ?>',
                                filebrowserUploadUrl: '<?php echo WEBSITE_URL; ?>albums/<?php echo $unique_id; ?>/',
                                filebrowserImageBrowseUrl: '<?php echo WEBSITE_URL; ?>admin/js/ckeditor/plugins/imageuploader/imgbrowser.php?unique_id=<?php echo $unique_id; ?>',
                                                filebrowserImageUploadUrl: '<?php echo WEBSITE_URL; ?>albums/<?php echo $unique_id; ?>/',
                                            });
                                    //]]>	

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

