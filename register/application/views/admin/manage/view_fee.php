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
                            <form name="form1" id="form1" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url($this->config->item('admin_folder') . $page . '/save');?>">
                                <input type="hidden" value="<?php echo $row['id'];?>" id="id" name="id" />
                                <input type="hidden" id="unique" name="unique" value="" />
                                <input type="hidden" id="ieee_member" name="ieee_member" value="2" />

                                <div class="control-group">
                                    <label class="control-label">Category</label>
                                    <div class="controls">
                                        <select name="category" id="category" >
                                            <option value="">-- select category --</option>
                                            <option value="author"      <?php echo $row['category'] == "author"       ? "selected='selected'" : "";?>>Author</option>
                                            <option value="delegate"   <?php echo $row['category'] == "delegate"    ? "selected='selected'" : "";?>>Delegate</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Type</label>
                                    <div class="controls">
                                        <select name="type" id="type" >
                                            <option value="">-- select type--</option>
                                            <option value="student"      <?php echo $row['type'] == "student"       ? "selected='selected'" : "";?>>Student</option>
                                            <option value="academician"   <?php echo $row['type'] == "academician"    ? "selected='selected'" : "";?>>Academician</option>
                                            <option value="industry"   <?php echo $row['type'] == "industry"    ? "selected='selected'" : "";?>>Industry</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Nationality</label>
                                    <div class="controls">
                                        <select name="nationality" id="nationality" >
                                            <option value="">-- select type--</option>
                                            <option value="indian"      <?php echo $row['nationality'] == "indian"       ? "selected='selected'" : "";?>>Indian</option>
                                            <option value="nonindian"   <?php echo $row['nationality'] == "nonindian"    ? "selected='selected'" : "";?>>Non Indian</option>
                                        </select>
                                    </div>
                                </div>




                                <div class="control-group">
                                    <label class="control-label">Fees</label>
                                    <div class="controls">
                                        <input type="text" class="input-xxlarge m-wrap" name="fees" id="fees"  value="<?php echo $row['fees'];?>" required />
                                        <span class="help-inline"></span>
                                    </div>
                                </div>


                                <div class="form-actions">
                                    <button type="submit" name="submit" id="submit"  class="btn blue" value="<?php echo $btncaption;?>"><i class="icon-ok"></i> <?php echo $btncaption;?></button>
                                    <button type="reset" name="cancel" id="cancel" value="Cancel" class="btn"><i class=" icon-remove"></i> Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

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
                                    <th class="hidden-phone">Category</th>
                                    <th class="hidden-phone">Type</th>
                                    <th class="hidden-phone">Nationality</th>
                                    <th class="hidden-phone">Fees</th>
                                    <th class="hidden-phone">Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i=1;
                                if($rows) {
                                    foreach ($rows as $row) {
                                ?>
                                        <tr class="odd gradeX">
                                            <td class="hidden-phone"><?php echo $i++; ?></td>
                                            <td class="hidden-phone"><?php echo $row['category']; ?></td>
                                            <td class="hidden-phone"><?php echo $row['type']; ?></td>
                                            <td class="hidden-phone"><?php echo $row['nationality']; ?></td>
                                            <td class="hidden-phone"><?php echo $row['fees']; ?></td>
                                            <td class="hidden-phone">
                                                <a href="<?php echo base_url($this->config->item('admin_folder') . $page . '/edit?id='. $row['id']); ?>"
                                                   class="btn btn-mini btn-success"><i class="icon-ok"></i> Edit</a>
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