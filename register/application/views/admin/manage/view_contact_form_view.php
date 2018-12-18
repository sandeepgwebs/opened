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

            <div class="row-fluid ">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                    <div class="widget blue">
                        <div class="widget-title">
                            <h4><i class="icon-file"></i><?php echo $pagetitle;?></h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <!-- BEGIN FORM-->
                            <form name="form1" id="form1" class="form-vertical" method="post" enctype="multipart/form-data" action="#">
                                <div class="row-fluid">
                                    <div class="span3">
                                        <div class="control-group">
                                            <label class="control-label">Form Name</label>
                                            <div class="controls controls-row">
                                                <span class="help-inline"><?php echo $row['formName'];?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row-fluid">
                                    <?php
                                        $formContent = unserialize($row['formContent']);
                                        $count = 1;
                                        foreach($formContent as $key_form => $formValue){
                                    ?>
                                            <div class="span3">
                                                <div class="control-group">
                                                    <label class="control-label"><strong><?php echo ucwords($key_form);?></strong></label>
                                                    <div class="controls controls-row">
                                                        <span class="help-inline"><?php echo $formValue;?></span>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                            $count++;
                                            if($count == 5){
                                                echo '</div><div class="row-fluid">';
                                                $count = 1;
                                            }
                                        }
                                    ?>

                            </form>
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