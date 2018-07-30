<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('select2.min.js', 'jquery.dataTables.min.js', 'table-data.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        UINotifications.init();
        //TableData.init();
        jQuery("#add_new_user").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'pages', 'action' => 'add')); ?>';
        });
        jQuery('a[id ^= delete_customer_]').click(function () {
            var thisID = $(this).attr('id');
            var breakID = thisID.split('_');
            var record_id = breakID[2];
            swal({
                title: "Are you sure?",
                text: "Page will be deleted permanently",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false,
            },
                    function () {
                        $.ajax({
                            type: 'get',
                            url: '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'pages', 'action' => 'delete')) ?>',
                            data: 'id=' + record_id,
                            dataType: 'json',
                            success: function (data) {
                                if (data.succ == '1') {
                                    swal({
                                        title: "Deleted!",
                                        text: data.msg,
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
                                        text: data.msg,
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
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Pages List</h1>                            
                        </div>                        
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <!--<div class="row">
                        <div class="col-md-12 space20">
                            <button class="btn btn-green add-row" id='add_new_user'>
                                Add Page <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="col-md-12">                           
                            <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($users_list)) ? 'id="sample_1"' : '' ?>">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs" width="5%">S.No.</th>
                                        <th class="hidden-xs" width="35%">Page </th>
                                        <th class="hidden-xs">Created On</th>

                                        <th class="hidden-xs">Modified On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($users_list)) {
                                        $i = 1;
                                        ?>
                                        <?php foreach ($users_list as $user) { ?>  
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $user['Menu']['name']; ?></td>
                                                <td> <?php echo date(DATE_FORMAT, strtotime($user['Page']['created'])); ?></td>




                                                <td> <?php echo date(DATE_FORMAT, strtotime($user['Page']['modified'])); ?></td>


                                                <td><div class="dropdown" style='float:left'>
                                                        <a class="btn btn-info dropdown-toggle" id="dLabel" role="button"
                                                           data-toggle="dropdown" data-target="#" href="javascript:void(0)"
                                                           style='text-decoration:none'>
                                                            <?php echo __('Action'); ?> <span class="caret"></span>
                                                        </a>
                                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                                            <li>
                                                                <?php
                                                                echo $this->Html->link('Edit Page', array('plugin' => false, 'controller' => 'pages', 'action' => 'edit', '?' => array('id' => $user['Page']['id'])), array('class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Edit', 'escape' => false));
                                                                ?>							
                                                            </li>


                                                            <?php
                                                            if ($user['Page']['is_program_detail'] == 1) {
                                                                ?>
                                                                <li>
                                                                    <?php
                                                                    echo $this->Html->link("Program Details", array('plugin' => 'page_program_detail', 'controller' => 'page_program_details', 'action' => 'index', $user['Page']['id']), array('class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Edit', 'escape' => false));
                                                                    ?>							
                                                                </li>
                                                            <?php } ?>



                                                            <?php
                                                            if ($user['Page']['has_sub_points'] == 1) {
                                                                ?>

                                                                <li>
                                                                    <?php
                                                                    echo $this->Html->link($user['Page']['sub_points_heading'], array('plugin' => false, 'controller' => 'pages', 'action' => 'manage_points', $user['Page']['id']), array('class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Edit', 'escape' => false));
                                                                    ?>							
                                                                </li>
                                                            <?php } ?>

                                                        </ul>
                                                    </div>
                                                    <?php
                                                    /* if ($user['Page']['status'] == 'A') {
                                                      echo $this->Html->link('Inactive', array('controller' => 'pages', 'action' => 'status', 'id' => $user['Page']['id'], 'status' => 'D'), array('title' => 'Click here to inactive.', 'escape' => false, 'class' => 'btn btn-transparent btn-xs', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to inactive.'));
                                                      } else {
                                                      echo $this->Html->link('Active', array('controller' => 'pages', 'action' => 'status', 'id' => $user['Page']['id'], 'status' => 'A'), array('title' => 'Click here to active.', 'escape' => false, 'class' => 'btn btn-transparent btn-xs', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to active.'));
                                                      } */

                                                    //echo $this->Html->link('<i class="fa fa-times fa fa-white"></i>', 'javascript:void(0)', array('class' => 'btn btn-transparent btn-xs tooltips', 'tooltip-placement' => 'top', 'tooltip' => 'Remove', 'id' => 'delete_customer_' . $user['Page']['id'], 'escape' => false));
                                                    ?>

                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>

                                        <tr>
                                            <td colspan="20"><?php echo $this->element('pagination'); ?></td>
                                        </tr>

                                    <?php } else {
                                        ?>
                                        <tr>
                                            <td colspan="9">No Record Found.</td>
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
