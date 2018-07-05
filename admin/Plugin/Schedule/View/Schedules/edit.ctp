<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'schedule', 'controller' => 'schedules', 'action' => 'index')); ?>';
        });
        $('#start_date').datepicker({
            dateFormat: "yy-mm-dd",
            //dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
        });

    });
</script>
<?php //echo $this->Html->script('ckeditor/ckeditor.js', array('inline' => false)); ?>
<?php
echo $this->Html->script(array('schedules'));
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
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'schedule', 'controller' => 'schedules', "action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
                        echo $this->Form->create('Schedule', array(array('method' => 'post', 'class' => 'form', 'role' => 'form'), 'enctype' => 'multipart/form-data'));
                        ?>
                        <?php echo $this->Form->input('Schedule.id', array('type' => 'hidden')); ?>
                        <input type="hidden" name="course_id_sel" id="course_id_sel" value="<?php echo $users_data['Schedule']['course_id']; ?>">
                        <div class="row">


                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Course <span class="symbol required"></span></label>
                                        <?php echo $this->Form->select('course_id', $cat_list, array('id' => 'course_id', "class" => "form-control validate[required]", 'empty' => "Select Course",)); ?>
                                        <span id="course_id-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Schedule Type <span class="symbol required"></span></label>
                                        <?php echo $this->Form->select('schedule_type', $schedules_types, array('id' => 'schedule_type', "class" => "form-control validate[required]", 'empty' => false)); ?>
                                        <span id="schedule_type-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12"> 
                                <div class="col-md-6"> 

                                    <div class="form-group">
                                        <label class="control-label">Date <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('start_date', array('type' => 'text', 'class' => 'form-control', 'id' => 'start_date', 'div' => false, 'label' => false)); ?>
                                        <span id="start_date-error" class="help-block"></span>
                                    </div>


                                </div>


                            </div>



                            <div class="col-md-12 marks"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Duration (Ex:8 Weeks) <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('duration', array('type' => 'text', 'class' => 'form-control', 'id' => 'duration', 'div' => false, 'label' => false)); ?>
                                        <span id="marks-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 marks"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Timings (Ex:01.30 PM - 4.30 PM) <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('timings', array('type' => 'text', 'class' => 'form-control', 'id' => 'timings', 'div' => false, 'label' => false)); ?>
                                        <span id="marks-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 marks"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label">Days (Ex:(Q - Sat) - (V - Sun))  <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('days', array('type' => 'text', 'class' => 'form-control', 'id' => 'days', 'div' => false, 'label' => false)); ?>
                                        <span id="days-error" class="help-block"></span>
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



