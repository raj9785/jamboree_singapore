
<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
?>

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#add_new_user").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'career', 'controller' => 'careers', 'action' => 'add')); ?>';
        });

        $('#ResumeFromDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,

            onSelect: function (selectedDate) {
                $('#ResumeToDate').datepicker("option", {
                    minDate: new Date(selectedDate),

                });

                //$("#ResumeToDate").datepicker("option", "minDate", selectedDate);
            },
        });
        $('#ResumeToDate').datepicker({
            dateFormat: "yy-mm-dd",
            //dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,

            onClose: function (selectedDate) {
                $("#ResumeFromDate").datepicker("option", "maxDate", selectedDate);
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
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-9">
                            <h1 class="mainTitle"><?php echo $title_for_layout; ?></h1>
                        </div>  


                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <?php
                    echo $this->Form->create('Lead', array('type' => 'get', 'class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));
                    ?>
                    <div class="row">
                        <div class="col-md-12 space20">
                            <div class="pull-left1 driver_index1">

                                <?php
                                echo $this->Form->select('Resume.career_category_id', $cat_list, array('value' => @$career_category_id, 'class' => 'textbox form-control input-sm', 'empty' => "Select Area", 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('Resume.name', array('placeholder' => 'Name', 'value' => @$name, 'class' => 'form-control input-sm')) . "&nbsp;&nbsp;";
                                echo $this->Form->text('Resume.from_date', array('placeholder' => __('From Date', true), 'value' => @$from_date, 'autocomplete' => 'off', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('Resume.to_date', array('placeholder' => __('To Date', true), 'value' => @$to_date, 'autocomplete' => 'off', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary new-style', 'escape' => false, 'type' => 'submit', 'name' => 'submit_button', 'value' => 'Search')) . '&nbsp;&nbsp;';
                                ?>
                                <a class="btn btn-green add-row" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Reset</a>


                            </div>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                    <div class="clear"></div>
                    <div class="row">
                        <div class="col-md-12">                           
                            <table class="table table-striped table-bordered table-full-width">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs">S.No.</th>
                                        <th class="hidden-xs">Area</th>
                                        <th class="hidden-xs">Nme</th>
                                        <th class="hidden-xs">Mobile</th>
                                        <th class="hidden-xs">Email</th>
                                        <th class="hidden-xs">Location</th>
                                        <th class="hidden-xs">CTC</th>
                                        <th class="hidden-xs">Applied On</th>
                                        <th class="hidden-xs">Resume</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($records)) {
                                        $count_total = $this->Paginator->counter(array('format' => '%count%'));
                                        if ($page == 0 || $page == 1) {
                                            $i = $count_total;
                                        } else {
                                            //echo $count_new_enquiries.' '.$limit.' '.$page;
                                            $i = $count_total - $limit * ($page - 1);
                                        }
                                        ?>

                                        <?php foreach ($records as $list) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>

                                                <td><?php
                                                    echo $list['CareerCategory']['name'];
                                                    ?>
                                                </td>
                                                <td><?php
                                                    echo $list['Resume']['name'];
                                                    ?>
                                                </td>
                                                <td><?php
                                                    echo $list['Resume']['mobile'];
                                                    ?>
                                                </td>
                                                <td><?php
                                                    echo $list['Resume']['email'];
                                                    ?>
                                                </td>
                                                <td><?php
                                                    echo $list['Resume']['location'];
                                                    ?>
                                                </td>
                                                <td><?php
                                                    echo $list['Resume']['ctc'];
                                                    ?>
                                                </td>








                                                <td><?php echo date(DATETIME_FORMAT, strtotime($list[$model]['created_on'])); ?></td>


                                                <td>


                                                    <a class="btn btn-default" href="<?php echo WEBSITE_URL; ?>admin/resume/resumes/download_resume/<?php echo $list['Resume']['resume']; ?>">Download</a>

                                                </td>


                                            </tr>
                                            <?php
                                            $i--;
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="20"><?php echo $this->element('pagination'); ?></td>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="20" style="text-align: center">No Record Found</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>
<?php echo $this->Html->script('ckeditor/ckeditor.js', array('inline' => false)); ?>

