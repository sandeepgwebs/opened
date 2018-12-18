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

                                <div class="control-group">
                                    <label class="control-label">Template</label>
                                    <div class="controls">
                                        <input type="text" class="input-xxlarge m-wrap" name="template" id="template"  value="<?php echo $row['template'];?>" required />
                                        <span class="help-inline"></span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Subject</label>
                                    <div class="controls">
                                        <input type="text" class="input-xxlarge m-wrap" name="subject" id="subject"  value="<?php echo $row['subject'];?>" required />
                                        <span class="help-inline"></span>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">Message</label>
                                    <div class="controls">
                                        <textarea name="message" id="message" class="ckeditor"><?php echo $row['message'];?></textarea>

                                        <span class="help-inline"></span>
                                    </div>
                                </div>


                                <div class="form-actions">
                                    <button type="submit" name="submit" id="submit"  class="btn blue" value="<?php echo $btncaption;?>"><i class="icon-ok"></i> <?php echo $btncaption;?></button>
<!--                                    <button type="reset" name="cancel" id="cancel" value="Cancel" class="btn"><i class=" icon-remove"></i> Cancel</button>-->
                                    <a href="<?php echo base_url ($this->config->item
                                        ('admin_folder') . $page);?>" name="cancel" id="cancel" value="Cancel" class="btn"><i class="icon-remove"></i>Cancel</a>
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
                        </div>
                        <div class="widget-body">
                            <table class="table table-striped table-bordered" id="sample_1">
                                <thead>
                                <tr>
                                    <th class="hidden-phone"></th>
                                    <th class="hidden-phone">Sn. no</th>
                                    <th class="hidden-phone">Template</th>
                                    <th class="hidden-phone">Subject</th>
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
                                            <td class="hidden-phone"></td>
                                            <td class="hidden-phone"><?php echo $i++; ?></td>
                                            <td class="hidden-phone"><?php echo $row['template']; ?></td>
                                            <td class="hidden-phone"><?php echo $row['subject']; ?></td>
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
</body>
</html>