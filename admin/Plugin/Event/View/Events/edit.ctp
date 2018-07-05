<?php
echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'), null, array('inline' => false));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'), array('inline' => false));
?>
<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
?>
<script src="<?php echo WEBSITE_ADMIN_JS_URL; ?>datetimepicker/build/jquery.datetimepicker.full.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo WEBSITE_ADMIN_JS_URL; ?>datetimepicker/jquery.datetimepicker.css"/>
<?php
echo $this->Html->script(array('jquery-ui.min'));
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $("#single_1").fancybox({
            helpers: {
                title: {
                    type: 'float'
                }
            }
        });
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

        $(".remove_this").on("click", function () {
            var this_id = $(this).attr("id");

            swal({
                title: "Are you sure?",
                text: 'You want to delete image',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Ok',
                closeOnConfirm: false,
            },
                    function () {
                        $.ajax({
                            type: 'post',
                            url: '<?php echo $this->Html->url(array('plugin' => 'event', 'controller' => 'events', 'action' => 'remove_image')) ?>',
                            data: 'image_id=' + this_id,
                            dataType: 'html',
                            success: function (data) {
                                if (data == 1) {
                                    swal({
                                        title: "Image deleted successfully!",
                                        text: 'Image deleted',
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonColor: '#d6e9c6',
                                        confirmButtonText: 'OK',
                                        closeOnConfirm: true,
                                    }, function () {
                                        $("#R_" + this_id).remove();
                                    });
                                } else {
                                    swal({
                                        title: "Error!",
                                        text: "Error!",
                                        type: "error",
                                        showCancelButton: false,
                                        confirmButtonColor: '#d6e9c6',
                                        confirmButtonText: 'OK',
                                        closeOnConfirm: false,
                                    }, function () {
                                        window.location.reload();
                                    });
                                }
                            }
                        });
                    });


        });

    });




</script>

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
                        <?php echo $this->Form->input('Event.id', array('type' => 'hidden')); ?>
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


                            <?php
                            $PropertyImage = $users_data['EventImage'];
                            if (!empty($PropertyImage)) {
                                ?>
                                <div class="col-md-12"> 
                                    <div class="col-md-6"> 
                                        <label>Uploaded Image</label>
                                        <ul class="list-inline listAmenities">
                                            <?php
                                            foreach ($PropertyImage as $img) {
                                                ?>

                                                <li class="checkbox" id='R_<?php echo $img['id']; ?>'>

                                                    <div class="imageuploadify-details"></div>
                                                    <img width="175px" height="100px" src="<?php echo EVENT_IMAGE_HTTP_PATH . $img['image'] ?>"></br>
                                                    <a id='<?php echo $img['id']; ?>'  class="btn btn-red remove_this">Remove</a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div><!-- end of form-group -->
                            <?php } ?>



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
