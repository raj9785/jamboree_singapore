<script src="<?php echo WEBSITE_ADMIN_JS_URL; ?>datetimepicker/build/jquery.datetimepicker.full.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo WEBSITE_ADMIN_JS_URL; ?>datetimepicker/jquery.datetimepicker.css"/>
<?php
echo $this->Html->script(array('jquery-ui.min'));
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'event', 'controller' => 'events', 'action' => 'index')); ?>';
        });
        $('#event_date').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
        });
        $('#event_start_time').datetimepicker({
            datepicker: false,
            format: 'H:i',
            step: 15,
            timeOnly: true,

        });
        $('#event_end_time').datetimepicker({
            datepicker: false,
            format: 'H:i',
            step: 15,
            timeOnly: true,

        });

    });

</script>

<script src="//cdn.ckeditor.com/4.10.0/basic/ckeditor.js"></script>
<?php
echo $this->Html->script(array('add_event'));
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
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'event', 'controller' => 'events', "action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
                        echo $this->Form->create('Event', array(array('method' => 'post', 'class' => 'form', 'role' => 'form'), 'enctype' => 'multipart/form-data'));
                        ?>
                        <div class="row">
                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Title <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('title', array('type' => 'text', 'maxlength' => '200', 'class' => 'form-control', 'id' => 'title', 'div' => false, 'label' => false)); ?>
                                        <span id="title-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Event Location <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('location', array('type' => 'text', 'maxlength' => '200', 'class' => 'form-control', 'id' => 'location', 'div' => false, 'label' => false)); ?>
                                        <span id="location-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12"> 
                                <div class="col-md-2"> 
                                    <div class="form-group">
                                        <label class="control-label">Date <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('event_date', array('type' => 'text', 'autocomplete' => 'off', 'maxlength' => '200', 'class' => 'form-control', 'id' => 'event_date', 'div' => false, 'label' => false)); ?>
                                        <span id="event_date-error" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="form-group">
                                        <label class="control-label">Start Time (24 HRS) <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('event_start_time', array('type' => 'text', 'maxlength' => '200', 'autocomplete' => 'off', 'class' => 'form-control', 'id' => 'event_start_time', 'div' => false, 'label' => false)); ?>
                                        <span id="event_start_time-error" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="form-group">
                                        <label class="control-label">End Time (24 HRS) <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('event_end_time', array('type' => 'text', 'maxlength' => '200', 'autocomplete' => 'off', 'class' => 'form-control', 'id' => 'event_end_time', 'div' => false, 'label' => false)); ?>
                                        <span id="event_end_time-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">URL </label>
                                        <?php echo $this->Form->input('event_url', array('type' => 'text', 'maxlength' => '200', 'class' => 'form-control', 'id' => 'event_url', 'div' => false, 'label' => false)); ?>
                                        <span id="event_url-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-12 " > 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Event Image </label>
                                        <?php echo $this->Form->file('EventImage.image.', array('id' => "image", 'multiple' => 'multiple')); ?>
                                        <span id="image-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-12"> 
                                <div class="col-md-6"> 

                                    <div class="form-group">
                                        <label class="control-label">Description <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('description', array('type' => 'textarea', 'rows' => 8, 'class' => 'form-control', 'id' => 'description', 'div' => false, 'label' => false)); ?>
                                        <span id="description-error" class="help-block"></span>
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
<script type="text/javascript">
    // <![CDATA[
    editor = CKEDITOR.replace('description',
            {
                //height: 300,
                //width: 800,
                //enterMode: CKEDITOR.ENTER_BR,

              
                                            });
                                    //]]>	

                                    
                                    

</script>

