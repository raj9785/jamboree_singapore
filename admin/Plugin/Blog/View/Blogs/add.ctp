<script type="text/javascript">
    jQuery(document).ready(function () {
        $("#blog_type").on("change", function () {
            if ($(this).val() == 1) {
                $(".bg_share").hide();
                $(".vd_share").show();
            } else {
                $(".bg_share").show();
                $(".vd_share").hide();
            }
        });


        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'blog', 'controller' => 'blogs', 'action' => 'index')); ?>';
        });



    });
</script>
<?php echo $this->Html->script('ckeditor/ckeditor.js', array('inline' => false)); ?>
<?php
echo $this->Html->script(array('add_blog'));
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
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'blog', 'controller' => 'blogs', "action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
                        echo $this->Form->create('Blog', array(array('method' => 'post', 'class' => 'form', 'role' => 'form'), 'enctype' => 'multipart/form-data'));
                        ?>
                        <div class="row">
                            <div class="col-md-12"> 
                                <div class="col-md-6"> 

                                    <div class="form-group">
                                        <label class="control-label">Heading <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('heading', array('type' => 'text', 'maxlength' => '200', 'class' => 'form-control', 'id' => 'heading', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="heading-error" class="help-block"></span>
                                    </div>


                                </div>


                            </div>
                            <div class="col-md-12 " > 
                                <div class="col-md-6"> 

                                    <div class="form-group">
                                        <label class="control-label">Blog Image </label>
                                        <?php echo $this->Form->file('image', array('id' => "image", 'class' => " validate[required]")); ?>
                                        <span id="image-error" class="help-block"></span>
                                    </div>



                                </div>


                            </div>

                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Alt Tag </label>
                                        <?php echo $this->Form->input('alt_tag', array('type' => 'text', 'maxlength' => '255', 'class' => 'form-control', 'id' => 'alt_tag', 'div' => false, 'label' => false)); ?>
                                        <span id="alt_tag-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Meta Keywords </label>
                                        <?php echo $this->Form->input('meta_keywords', array('type' => 'text', 'maxlength' => '255', 'class' => 'form-control', 'id' => 'meta_keywords', 'div' => false, 'label' => false)); ?>
                                        <span id="heading-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12"> 


                                <div class="col-md-6"> 

                                    <div class="form-group">
                                        <label class="control-label">Meta Description </label>
                                        <?php echo $this->Form->input('meta_description', array('type' => 'textarea', 'rows' => 3, 'maxlength' => '2000', 'class' => 'form-control', 'id' => 'meta_description', 'div' => false, 'label' => false)); ?>
                                        <span id="heading-error" class="help-block"></span>
                                    </div>


                                </div>


                            </div>




                            <div class="col-md-12 bg_share"> 
                                <div class="col-md-12"> 

                                    <div class="form-group">
                                        <label class="control-label">Blog Content <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('blog_body', array('type' => 'textarea', 'class' => 'form-control ckeditor', 'id' => 'blog_body', 'div' => false, 'label' => false)); ?>
                                        <span id="blog_body-error" class="help-block"></span>
                                    </div>


                                </div>

                            </div>
<!--                            <div class="col-md-12" style="margin-top: 30px;"> 
                                <div class="col-md-12"> 
                                    <a href="javascript:void(0)" id="prv" style="font-size: 30px;">Preview</a>


                                </div>
                                <div class="col-md-12 preview_data"> 



                                </div>
                            </div>-->





                            <div class="col-md-12"> 
                                <div class="col-md-12">

                                    <span class="symbol required"></span>Required Fields
                                    <hr>

                                </div>
                            </div>

                            <div class="col-md-12"> 
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <?php echo $this->Form->button('Share', array('class' => 'btn btn-primary btn-wide', 'type' => 'submit', 'id' => 'submit_button')) ?>
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
    editor = CKEDITOR.replace('blog_body',
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

