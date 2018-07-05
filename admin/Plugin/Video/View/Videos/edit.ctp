
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'video', 'controller' => 'videos', 'action' => 'index')) . '?title=' . $title . '&video_category_id=' . $video_category_id; ?>';
        });

    });
</script>

<?php
echo $this->Html->script(array('videos'));
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
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'video', 'controller' => 'videos', "action" => "index", '?' => array("video_category_id" => $video_category_id, 'title' => $title)), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
                        echo $this->Form->create('Video', array(array('method' => 'post', 'class' => 'form', 'role' => 'form'), 'enctype' => 'multipart/form-data'));
                        ?>
                        <?php echo $this->Form->input('Video.id', array('type' => 'hidden')); ?>
                        <div class="row">
                            <?php
                            if ($video_category_id == 3) {
                                ?>
                                <div class="col-md-12"> 
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label class="control-label">Course <span class="symbol required"></span></label>
                                            <?php echo $this->Form->select('course_id', $cat_list, array('id' => 'course_id', "class" => "form-control validate[required]", 'empty' => "Select Course",)); ?>
                                            <span id="course_id-error" class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-12"> 
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

