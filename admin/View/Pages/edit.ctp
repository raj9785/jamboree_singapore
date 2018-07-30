<?php
echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'), null, array('inline' => false));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'), array('inline' => false));
?>
<?php echo $this->Html->script('ckeditor/ckeditor.js', array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'pages', 'action' => 'index')); ?>';
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
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Edit Page</h1>                            
                        </div>     
                        <div class="col-sm-4 text-align-right">	
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to page List', true) . "", array('plugin' => false, 'controller' => 'Pages', "action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
                        <div class="col-md-12">   
                            <?php echo $this->Form->create('Page', array('method' => 'post', 'class' => 'form', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>                    
                            <br/>
                            <?php echo $this->Form->input('Page.id', array('type' => 'hidden')) ?>
                            <?php //echo $this->Form->input('meta_title', array('type' => 'hidden', 'value' => $users_data['Menu']['name'], 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                            <?php echo $this->Form->input('slug', array('type' => 'hidden', 'value' => $users_data['Menu']['slug'], 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Page Title (Default) <span class="symbol required"></span></label> 
                                            <?php echo $this->Form->input('title', array('type' => 'text', 'value' => $users_data['Menu']['name'], 'readonly' => true, 'class' => 'form-control', 'id' => 'name', 'div' => false, 'label' => false, 'required' => true)); ?>
                                            <span id="name-error" class="help-block"></span>
                                        </div>   
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Meta Title </label> 
                                            <?php echo $this->Form->input('meta_title', array('type' => 'text', 'value' => $users_data["Page"]['meta_title'] ? $users_data["Page"]['meta_title'] : $users_data['Menu']['name'], 'class' => 'form-control', 'id' => 'meta_title', 'div' => false, 'label' => false)); ?>
                                            <span id="name-error" class="help-block"></span>
                                        </div>   
                                    </div>
                                </div>
                                <?php
                                if ($users_data["Page"]['only_meta'] != 1) {
                                    ?>
                                    <div class="col-md-12 " > 
                                        <div class="col-md-6"> 

                                            <div class="form-group">
                                                <label class="control-label">Banner Image </label>
                                                <?php echo $this->Form->file('image', array('id' => "image")); ?>
                                                <span id="image-error" class="help-block"></span></br>
                                                <?php
                                                $file_name = $users_data["Page"]['image'];
                                                if (is_file(BANNER_IMAGE_PATH . $file_name)) {
                                                    $images = $this->Html->image(BANNER_IMAGE_HTTP_PATH . $file_name, array('alt' => $file_name, 'height' => 75, 'title' => $file_name));
                                                    ?>
                                                    <a id="single_1" href="<?php echo BANNER_IMAGE_HTTP_PATH . $file_name; ?>"
                                                       title='<?php echo ucfirst($file_name); ?>'>
                                                           <?php echo $images; ?>
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php
                                if ($users_data["Page"]['has_sub_points'] == 1) {
                                    ?>
                                    <div class="col-md-12">
                                        <div class="col-md-6"> 
                                            <div class="form-group">
                                                <label class="control-label">Sub Points Heading  </label>
                                                <?php echo $this->Form->input('sub_points_heading', array('type' => 'text', 'maxlength' => '255', 'class' => 'form-control', 'id' => 'sub_points_heading', 'div' => false, 'label' => false)); ?>
                                                <span id="email-error" class="help-block"></span>                                        
                                            </div>
                                        </div>

                                    </div>
                                <?php } ?>
                                <div class="col-md-12">
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label class="control-label">Sample Test Google doc iframe URL  </label>
                                            <?php echo $this->Form->input('sample_test_url', array('type' => 'text', 'maxlength' => '255', 'class' => 'form-control', 'id' => 'sample_test_url', 'div' => false, 'label' => false)); ?>
                                            <span id="email-error" class="help-block"></span>                                        
                                        </div>
                                    </div>
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label class="control-label">Video List Title  </label>
                                            <?php echo $this->Form->input('video_list_title', array('type' => 'text', 'maxlength' => '255', 'class' => 'form-control', 'id' => 'video_list_title', 'div' => false, 'label' => false)); ?>
                                            <span id="video_list_title-error" class="help-block"></span>                                        
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label class="control-label">Meta Keywords </label>
                                            <?php echo $this->Form->input('meta_keywords', array('type' => 'textarea', 'rows' => 3, 'maxlength' => '1600', 'class' => 'form-control', 'id' => 'icon_image', 'div' => false, 'label' => false)); ?>
                                            <span id="email-error" class="help-block"></span>                                        
                                        </div>
                                    </div>
                                    <div class="col-md-6">                                    
                                        <div class="form-group">
                                            <label class="control-label">Meta Description </label>
                                            <?php echo $this->Form->input('meta_description', array('type' => 'textarea', 'rows' => 3, 'class' => 'form-control', 'id' => 'icon_image', 'div' => false, 'label' => false)); ?>
                                            <span id="email-error" class="help-block"></span>                                        
                                        </div>
                                    </div> 
                                </div>
                                <?php
                                if ($users_data["Page"]['only_meta'] != 1) {
                                    ?>
                                    <div class="col-md-12">
                                        <div class="col-md-12">                                    
                                            <div class="form-group">
                                                <label class="control-label">Content <span class="symbol required"></span></label>
                                                <?php echo $this->Form->input('content', array('type' => 'textarea', 'class' => 'form-control ckeditor', 'id' => 'content', 'div' => false, 'label' => false)); ?>
                                                <span id="testimonial-error" class="help-block"></span>
                                            </div>
                                        </div>  
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <span class="symbol required"></span>Required Fields
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">                                        
                                </div>
                                <div class="col-md-4">
                                    <?php echo $this->Form->button('Save ', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'submit_button', 'style' => 'margin-left:58px')) ?>
                                    <?php echo $this->Form->button('Cancel ', array('class' => 'btn btn-primary btn-wide pull-right', 'type' => 'button', 'id' => 'cancel_button')) ?>
                                </div>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
                <!-- end: FORM VALIDATION EXAMPLE 1 -->
            </div>
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