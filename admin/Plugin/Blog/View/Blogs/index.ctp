<?php
echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'), null, array('inline' => false));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'), array('inline' => false));
?>
<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
?>

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#add_new_user").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'blog', 'controller' => 'blogs', 'action' => 'add')); ?>';
        });

        $(".super-raj-pop").fancybox({
            type: 'ajax',
            helpers: {
                overlay: {
                    closeClick: false,
                    locked: false,
                },
                closeBtn: false,
            },
//            closeBtn: false, // hide close button
//            closeClick: false,
        });

        $("#single_1").fancybox({
            helpers: {
                title: {
                    type: 'float'
                }
            }
        });



        $('#BlogFromDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,

            onSelect: function (selectedDate) {
                $('#BlogToDate').datepicker("option", {
                    minDate: new Date(selectedDate),

                });

                //$("#BlogToDate").datepicker("option", "minDate", selectedDate);
            },
        });
        $('#BlogToDate').datepicker({
            dateFormat: "yy-mm-dd",
            //dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,

            onClose: function (selectedDate) {
                $("#BlogFromDate").datepicker("option", "maxDate", selectedDate);
            }

        });





        $(".my_status").on('click', function () {
            var id = $(this).attr('id');
            //$('#' + id).hide();
            var main_status_id = id.split("_");
            var status_id = main_status_id[1];
            var status_current = main_status_id[2];
            if (status_current == 1) {
                var heading = "Blog will be inactivated";
                var title_resp = "Inactivated";
            } else {
                var heading = "Blog will be activated";
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
                            url: '<?php echo $this->Html->url(array('plugin' => 'blog', 'controller' => 'blogs', 'action' => 'status_ajax')); ?>',
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
                        <div class="col-sm-3 text-align-right">
                            <button class="btn btn-green add-row" id='add_new_user'>
                                <i class="fa fa-plus"></i>&nbsp;Post New Blog
                            </button>
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
                                //echo $this->Form->select('Blog.category_id', $cat_list, array('value' => @$category_id, 'class' => 'textbox form-control input-sm', 'empty' => "Select Share Type", 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('Blog.heading', array('placeholder' => 'Heading', 'value' => @$heading, 'class' => 'form-control input-sm')) . "&nbsp;&nbsp;";
                                echo $this->Form->select('Blog.is_active', array("1" => "Active", "0" => "Inactive"), array('value' => @$is_active, 'empty' => __('Blog Status', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('Blog.from_date', array('placeholder' => __('From Date', true), 'value' => isset($from_date) ? $from_date : '', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('Blog.to_date', array('placeholder' => __('To Date', true), 'value' => isset($to_date) ? $to_date : '', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';

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
                                        <th class="hidden-xs">Heading</th>
                                        
                                        <th class="hidden-xs">Image</th>
                                        <th class="hidden-xs">Created On</th>
                                        <th class="hidden-xs">Status</th>
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


                                                <td><?php
                                                    echo $list['Blog']['heading'];
                                                    ?>
                                                </td>
                                               



                                                <td>
                                                    <?php
                                                    $file_name = $list[$model]['image'];
                                                    if ($file_name) {
                                                        $images = $this->Html->image(BLOG_LARGE_IMAGE_HTTP_PATH . $file_name, array('alt' => $file_name, 'width' => "200px", 'title' => $file_name));
                                                        ?>
                                                        <a id="single_1" href="<?php echo BLOG_LARGE_IMAGE_HTTP_PATH . $file_name; ?>"
                                                           title='<?php echo ucfirst($file_name); ?>'>
                                                               <?php echo $images; ?>
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>   

                                                </td>




                                                <td><?php echo date("d-m-y", strtotime($list[$model]['created_on'])); ?></td>
                                                <td style="text-align: center;">
                                                    <?php
                                                    if ($list[$model]['is_active'] == 1) {
                                                        $status_img = 'active.png';
                                                        $chang = "Active";
                                                        $title = "Inactivate";
                                                    } else {
                                                        $status_img = 'inactive.png';
                                                        $chang = "Inactive";
                                                        $title = "Activate";
                                                    }
                                                    ?>

                                                    <img style="cursor:pointer;" id="changestatus_<?php echo $list[$model]['id'] . "_" . $list[$model]['is_active']; ?>" title="Clik here to <?php echo $title; ?>" class="my_status" src="<?php echo WEBSITE_URL . "admin/img/" . $status_img; ?>" width="20" height="20" />
                                                </td>

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
                                                                echo $this->Html->link('Edit', array('plugin' => 'blog', 'controller' => 'blogs', 'action' => 'edit', '?' => array('id' => $list['Blog']['id'])), array('class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Edit', 'escape' => false));
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
<?php echo $this->Html->script('ckeditor/ckeditor.js', array('inline' => false)); ?>

