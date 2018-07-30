
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'pages', 'action' => 'index')); ?>';
        });
        $(".addmore").on("click", function () {
            var ids = $(this).attr("id");
            var page_ids = ids.split("_");
            var page_id = page_ids[1];
            var htmls = '<div class="col-md-12">';
            htmls += '<div class="col-sm-11">';
            htmls += '<input name="data[text_point][' + page_id + '][]" class="form-control" id="textpoint_' + page_id + '" type="text">';
            htmls += '</div>';
            htmls += '<div class="col-sm-1"><a class="btn btn-red removethis"><i class="fa fa-times"></i></a></div>';
            htmls += '</div>'
            $("#" + page_id).append(htmls);
        });
        $(document).on("click", ".removethis", function () {
            $(this).parent().parent().remove();
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
                            <h1 class="mainTitle"><?php echo $title_for_layout; ?></h1>                            
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
                            <?php echo $this->Form->create('PageTab', array('method' => 'post', 'class' => 'form', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>                    
                            <br/>
                            <?php echo $this->Form->input('PageTab.page_id', array('type' => 'hidden', 'value' => $page_id)) ?>


                            <div class="row">
                                <?php
                                if (!empty($page_list)) {
                                    foreach ($page_list as $pdata) {
                                        ?>
                                        <div class="col-md-7">
                                            <h4><?php echo $pdata['Page']['title']; ?></h4>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Sub Heading </label> 
                                                    <?php echo $this->Form->input('heading.' . $pdata['Page']['id'], array('type' => 'text', 'class' => 'form-control', 'id' => 'heading_' . $pdata['Page']['id'], 'div' => false, 'label' => false)); ?>
                                                    <span id="name-error" class="help-block"></span>
                                                </div>   
                                            </div>
                                            <div class="col-md-12"><h5>Points</h5></div>
                                            <div id="<?php echo $pdata['Page']['id']; ?>">
                                                <?php
                                                $p = @$pts[$pdata['Page']['id']];
                                                if (!empty($p)) {
                                                    foreach ($p as $i => $text) {
                                                        ?>
                                                        <div class="col-md-12">
                                                            <div class="col-sm-11">
                                                                <?php echo $this->Form->input('text_point.' . $pdata['Page']['id'] . ".", array('type' => 'text','value'=>$text ,'class' => 'form-control', 'id' => 'textpoint_' . $pdata['Page']['id'], 'div' => false, 'label' => false)); ?>
                                                            </div>
                                                            <div class="col-sm-1"><a class="btn btn-red removethis"><i class="fa fa-times"></i></a></div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>


                                                <?php } ?>

                                                <div class="col-md-12">
                                                    <div class="col-sm-11">
                                                        <?php echo $this->Form->input('text_point.' . $pdata['Page']['id'] . ".", array('type' => 'text', 'class' => 'form-control', 'id' => 'textpoint_' . $pdata['Page']['id'], 'div' => false, 'label' => false)); ?>
                                                    </div>
                                                    <div class="col-sm-1"><a class="btn btn-red removethis"><i class="fa fa-times"></i></a></div>
                                                </div>
                                            </div>
                                            <div class="col-md-9"></div>
                                            <div class="col-md-2"><a class="pull-right addmore btn btn-green" id="addmore_<?php echo $pdata['Page']['id']; ?>" href="javascript:void(0)"><i class="fa fa-plus"></i> More</a></div>

                                        </div>

                                        <?php
                                    }
                                }
                                ?>

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
