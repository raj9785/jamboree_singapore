
<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
?>

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#add_new_user").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'university_deadline', 'controller' => 'university_deadlines', 'action' => 'add')); ?>';
        });


        $('#UniversityDeadlineFromDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,

            onSelect: function (selectedDate) {
                $('#UniversityDeadlineToDate').datepicker("option", {
                    minDate: new Date(selectedDate),

                });
            },
        });
        $('#UniversityDeadlineToDate').datepicker({
            dateFormat: "yy-mm-dd",
            //dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,

            onClose: function (selectedDate) {
                $("#UniversityDeadlineFromDate").datepicker("option", "maxDate", selectedDate);
            }

        });





        $(".my_status").on('click', function () {
            var id = $(this).attr('id');
            var main_status_id = id.split("_");
            var status_id = main_status_id[1];
            var status_current = main_status_id[2];
            if (status_current == 1) {
                var heading = "SEO Script will be inactivated";
                var title_resp = "Inactivated";
            } else {
                var heading = "SEO Script will be activated";
                var title_resp = "Activated";
            }


            swal({
                title: "Are you sure?",
                text: heading,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Ok',
                closeOnConfirm: false,
            },
                    function () {
                        $.ajax({
                            type: 'post',
                            url: '<?php echo $this->Html->url(array('plugin' => 'university_deadline', 'controller' => 'university_deadlines', 'action' => 'status_ajax')); ?>',
                            data: 'id=' + status_id,
                            dataType: 'json',
                            success: function (data) {
                                if (data == 1) {
                                    swal({
                                        title: title_resp + "!",
                                        text: title_resp,
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonColor: '#d6e9c6',
                                        confirmButtonText: 'OK',
                                        closeOnConfirm: false,
                                    }, function () {
                                        window.location.reload();
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
<!--                        <div class="col-sm-3 text-align-right">
                            <button class="btn btn-green add-row" id='add_new_user'>
                                <i class="fa fa-plus"></i>&nbsp;Add Admission Procedure
                            </button>
                        </div>-->

                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <?php
                    echo $this->Form->create('Lead', array('type' => 'get', 'class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));
                    ?>
                    <div class="row">
                        <div class="col-md-12 space20">
                            
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
                                        <th class="hidden-xs">Course</th>
                                        <th class="hidden-xs">Title</th>
                                        <th class="hidden-xs">Created On</th>
<!--                                        <th class="hidden-xs">Status</th>-->
                                        <th class="hidden-xs">Action</th>
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
                                                <td>
                                                    <?php
                                                    echo @$list['DeadlineCategory']['name'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $list[$model]['title'];
                                                    ?>
                                                </td>
                                                <td><?php echo date("d-m-y h:i A", strtotime($list[$model]['created_on'])); ?></td>
                                               

                                                <td>

                                                    <div class="dropdown" style='float:left'>
                                                        <a class="btn btn-info dropdown-toggle" id="dLabel" role="button"
                                                           data-toggle="dropdown" data-target="#" href="javascript:void(0)"
                                                           style='text-decoration:none'>
                                                            <?php echo __('Action'); ?> <span class="caret"></span>
                                                        </a>
                                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">

                                                            <li>
                                                                <?php
                                                                echo $this->Html->link('Edit', array('plugin' => 'university_deadline', 'controller' => 'university_deadlines', 'action' => 'edit', '?' => array('id' => $list['UniversityDeadline']['id'])), array('class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Edit', 'escape' => false));
                                                                ?>							
                                                            </li>


                                                        </ul>
                                                    </div>


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
