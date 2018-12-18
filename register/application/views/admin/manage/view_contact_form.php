<?php $this->load->view('admin/common/view_header');?>

<body class="fixed-top">
<?php $this->load->view('admin/common/view_topbar');?>
<div id="container" class="row-fluid">
    <?php $this->load->view('admin/common/view_sidebar'); ?>

    <div id="main-content">
        <!-- BEGIN PAGE CONTAINER-->
        <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            <div class="row-fluid">
                <div class="span12">
                    <h3 class="page-title"><?php echo $pagetitle; ?></h3>
                    <ul class="breadcrumb">
                        <li>Dashboard <span class="divider">/</span></li>
                        <li class="active"><?php echo $pagetitle ?></li>
                    </ul>
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="message">
                <?php
                    if(isset($status)){
                        if($status){
                            $this->functions->success_message($message);
                        }else{
                            $this->functions->failed_message($message);
                        }
                    }
                ?>
            </div>




            <div class="row-fluid">
                <div class="span12">
                    <div class="widget blue">
                        <div class="widget-title">
                            <h4><i class="icon-table"></i> List of Added <?php echo $pagetitle;?></h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                            </span>
                        </div>
                        <div class="widget-body">
                            <table class="table table-striped table-bordered" id="sample_1">
                                <thead>
                                <tr>
                                    <th class="hidden-phone">Sn. no</th>
                                    <th class="hidden-phone">Form Name</th>
                                    <th class="hidden-phone">First Name</th>
                                    <th class="hidden-phone">Last Name</th>
                                    <th class="hidden-phone">Date Added</th>
                                    <th class="hidden-phone">Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i=1;
                                if($rows) {
                                    foreach ($rows as $row) {
                                        $formContent = unserialize($row['formContent']);
                                ?>
                                        <tr class="odd gradeX">
                                            <td class="hidden-phone"><?php echo $i++; ?></td>
                                            <td class="hidden-phone"><?php echo $row['formName'];?></td>
                                            <td class="hidden-phone"><?php echo $formContent['firstname']; ?></td>
                                            <td class="hidden-phone"><?php echo $formContent['lastname']; ?></td>
                                            <td class="hidden-phone"><?php echo $row['date_added']; ?></td>
                                            <td class="hidden-phone">
                                                <a target="_blank" href="<?php echo base_url($this->config->item('admin_folder') . $page . '/view?id='. $row['id']); ?>"
                                                   class="btn btn-mini btn-success"><i class="icon-ok"></i> View</a>
                                                <a href="<?php echo base_url($this->config->item('admin_folder') . $page . '/delete?id='. $row['id']); ?>" class="btn btn-mini btn-info" onclick="return confirm('Are You Sure You Want To Delete This Remember The Action Is Irreversible');"><i
                                                        class="icon-remove"></i> Delete</a>

                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>

<?php $this->load->view('admin/common/view_footer'); ?>
<?php $this->load->view('admin/common/view_data_tables');?>

<script type="text/javascript">
    $("#charges_status").on("change", function(){
        if($(this).val() == 1){
            $("#charges_amount").removeAttr("disabled");
        }else{
            $("#charges_amount").attr("disabled", "disabled");
        }
    });
</script>
</body>
</html>