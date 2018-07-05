
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'seo_script', 'controller' => 'seo_scripts', 'action' => 'index')); ?>';
        });

    });
</script>

<?php
echo $this->Html->script(array('add_seo_script'));
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
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'seo_script', 'controller' => 'seo_scripts', "action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
                        echo $this->Form->create('SeoScript', array(array('method' => 'post', 'class' => 'form', 'role' => 'form'), 'enctype' => 'multipart/form-data'));
                        ?>
                        <?php echo $this->Form->input('SeoScript.id', array('type' => 'hidden')); ?>
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="col-md-12"> 
                                    <div class="form-group">
                                        <label class="control-label">Position <span class="symbol required"></span></label>
                                        <?php echo $this->Form->select('position_type', $pos_list, array('id' => 'position_type', "class" => "form-control validate[required]", 'empty' => "Select Position",)); ?>
                                        <span id="position_type-error" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-12"> 

                                    <div class="form-group">
                                        <label class="control-label">Script Name <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('script_title', array('type' => 'text', 'maxlength' => '200', 'class' => 'form-control', 'id' => 'script_title', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="script_title-error" class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-12"> 

                                    <div class="form-group">
                                        <label class="control-label">Script <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('script_body', array('type' => 'textarea', 'rows' => 12, 'class' => 'form-control', 'id' => 'script_body', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="script_body-error" class="help-block"></span>
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

