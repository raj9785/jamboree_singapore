<?php
echo $this->Html->script(array('contact_edit'));
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
                            <?php echo $this->Form->create('Contact', array('method' => 'post', 'class' => 'form', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>                    
                            <br/>
                            <?php echo $this->Form->input('Contact.id', array('type' => 'hidden')) ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Contact No (Comma Separated for multiple) <span class="symbol required"></span></label> 
                                        <?php echo $this->Form->input('phone_numbers', array('type' => 'text', 'class' => 'form-control', 'id' => 'phone_numbers', 'div' => false, 'label' => false)); ?>
                                        <span id="phone_numbers-error" class="help-block"></span>
                                    </div>   
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email (Comma Separated for multiple) <span class="symbol required"></span></label> 
                                        <?php echo $this->Form->input('emails', array('type' => 'text', 'class' => 'form-control', 'id' => 'emails', 'div' => false, 'label' => false)); ?>
                                        <span id="emails-error" class="help-block"></span>
                                    </div>   
                                </div>
                            </div>
                            
                            
                            
                            
                            <div class="row">
                                <div class="col-md-6">                                    
                                    <div class="form-group">
                                        <label class="control-label">Availability <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('availability', array('type' => 'textarea', 'rows' => 3, 'class' => 'form-control', 'id' => 'availability', 'div' => false, 'label' => false)); ?>
                                        <span id="availability-error" class="help-block"></span>                                        
                                    </div>
                                </div> 


                            </div>
                            <div class="row">
                                <div class="col-md-6">                                    
                                    <div class="form-group">
                                        <label class="control-label">Address <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('adress', array('type' => 'textarea', 'rows' => 3, 'class' => 'form-control', 'id' => 'adress', 'div' => false, 'label' => false)); ?>
                                        <span id="adress-error" class="help-block"></span>                                        
                                    </div>
                                </div> 


                            </div>
                            <div class="row">
                                <div class="col-md-6">                                    
                                    <div class="form-group">
                                        <label class="control-label">Map iframe src <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('map_iframe_src', array('type' => 'textarea', 'rows' => 5, 'class' => 'form-control', 'id' => 'map_iframe_src', 'div' => false, 'label' => false)); ?>
                                        <span id="map_iframe_src-error" class="help-block"></span>                                        
                                    </div>
                                </div> 


                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">                                    
                                    <div class="form-group">
                                        <label class="control-label"></label>
                                        <iframe class="mapdiv" src="<?php echo $users_data['Contact']['map_iframe_src']; ?>" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>                                       
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