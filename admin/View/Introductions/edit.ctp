<?php
echo $this->Html->script(array('introduction_edit'));
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
                        <div class="col-sm-8">
                            <h1 class="mainTitle"><?php echo $title_for_layout; ?></h1>                            
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
                            <?php echo $this->Form->create('Introduction', array('method' => 'post', 'class' => 'form', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>                    
                            <br/>
                            <?php echo $this->Form->input('Introduction.id', array('type' => 'hidden')) ?>
                            <div class="row">
                                <div class="col-md-6">                                    
                                    <div class="form-group">
                                        <label class="control-label">Introduction <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('description', array('type' => 'textarea', 'rows' => 10, 'class' => 'form-control', 'id' => 'description', 'div' => false, 'label' => false)); ?>
                                        <span id="description-error" class="help-block"></span>                                        
                                    </div>
                                </div> 


                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Youtube URL <span class="symbol required"></span></label> 
                                        <?php echo $this->Form->input('you_tube_url', array('type' => 'text', 'class' => 'form-control', 'id' => 'you_tube_url', 'div' => false, 'label' => false)); ?>
                                        <span id="you_tube_url-error" class="help-block"></span>
                                    </div>   
                                </div>
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