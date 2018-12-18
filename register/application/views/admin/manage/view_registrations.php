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
                                    <label class="control-label">Firstname</label>
                                    <div class="controls">
                                        <input type="text" class="input-xxlarge m-wrap" name="firstname" id="firstname"  value="<?php echo $row['firstname'];?>" />
                                        <span class="help-inline"></span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Lastname</label>
                                    <div class="controls">
                                        <input type="text" class="input-xxlarge m-wrap" name="lastname" id="lastname"  value="<?php echo $row['lastname'];?>"  />
                                        <span class="help-inline"></span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Country</label>
                                    <div class="controls">
                                        <input type="text" class="input-xxlarge m-wrap" name="country" id="country"  value="<?php echo $row['country'];?>"  />
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">State</label>
                                    <div class="controls">
                                        <input type="text" class="input-xxlarge m-wrap" name="state" id="state"  value="<?php echo $row['state'];?>"  />
                                        <span class="help-inline"></span>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">Organization</label>
                                    <div class="controls">
                                        <input type="text" class="input-xxlarge m-wrap" name="organization" id="organization"  value="<?php echo $row['organization'];?>"  />
                                        <span class="help-inline"></span>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">Qualification</label>
                                    <div class="controls">
                                        <input type="text" class="input-xxlarge m-wrap" name="qualification" id="qualification"  value="<?php echo $row['qualification'];?>"  />
                                        <span class="help-inline"></span>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">Email</label>
                                    <div class="controls">
                                        <input type="text" class="input-xxlarge m-wrap" name="email_id" id="email_id"  value="<?php echo $row['email_id'];?>"  />
                                        <span class="help-inline"></span>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">Phone</label>
                                    <div class="controls">
                                        <input type="text" class="input-xxlarge m-wrap" name="phone" id="phone"  value="<?php echo $row['phone'];?>"  />
                                        <span class="help-inline"></span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Category</label>
                                    <div class="controls">
                                        <select name="category" id="category">
                                            <option value="author" <?php echo ($row['category'] == "author" ? 'selected="selected"' : "") ;?>>Author</option>
                                            <option value="delegate" <?php echo ($row['category'] == "delegate" ? 'selected="selected"' : "") ;?>>Delegate</option>
                                            <option value="poster" <?php echo ($row['category'] == "poster" ? 'selected="selected"' : "") ;?>>Poster</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Type</label>
                                    <div class="controls">
                                        <select name="type" id="type">
                                            <option value="student" <?php echo ($row['type'] == "student" ? 'selected="selected"' : "") ;?>>Student / Research Scholar(Full Time)</option>
                                            <option value="academician" <?php echo ($row['type'] == "academician" ? 'selected="selected"' : "") ;?>>Academician</option>
                                            <option value="industry" <?php echo ($row['type'] == "industry" ? 'selected="selected"' : "") ;?>>industry</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">Amount</label>
                                    <div class="controls">
                                        <input type="text" class="input-xxlarge m-wrap" name="amount" id="amount"  value="<?php echo $row['amount'];?>"  />
                                        <span class="help-inline"></span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Currency</label>
                                    <div class="controls">
                                        <input type="text" class="input-xxlarge m-wrap" name="currency" id="currency"  value="<?php echo $row['currency'];?>"  />
                                        <span class="help-inline"></span>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">Status</label>
                                    <div class="controls">
                                        <select name="status" id="status">
                                            <option value="1" <?php echo ($row['status'] == "1" ? 'selected="selected"' : "") ;?>>Enable</option>
                                            <option value="0" <?php echo ($row['status'] == "0" ? 'selected="selected"' : "") ;?>>Disabled</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Payment Status</label>
                                    <div class="controls">
                                        <select name="payment_status" id="payment_status">
                                            <option value="1" <?php echo ($row['status'] == "1" ? 'selected="selected"' : "") ;?>>Pending</option>
                                            <option value="2" <?php echo ($row['status'] == "2" ? 'selected="selected"' : "") ;?>>Complete</option>
                                            <option value="3" <?php echo ($row['status'] == "3" ? 'selected="selected"' : "") ;?>>Failed</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-actions">
                                    <button type="submit" name="submit" id="submit"  class="btn blue" value="<?php echo $btncaption;?>"><i class="icon-ok"></i> <?php echo $btncaption;?></button>
                                    <a href="<?php echo base_url ($this->config->item('admin_folder') . $page);?>" name="cancel" id="cancel" value="Cancel" class="btn"><i class="icon-remove"></i>Cancel</a>
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
                                    <th class="hidden-phone">Sn. no</th>
                                    <th class="hidden-phone">Name</th>
                                    <th class="hidden-phone">Email ID</th>
                                    <th class="hidden-phone">Payment Status</th>
                                    <th class="hidden-phone">Payment Method</th>
                                    <th class="hidden-phone">Paper</th>
                                    <th class="hidden-phone">Copyright</th>
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
                                            <td class="hidden-phone"><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                                            <td class="hidden-phone"><?php echo $row['email_id']; ?></td>
                                            <td class="hidden-phone"><?php echo ($row['payment_status'] == '1' ? "Pending" : ($row['payment_status'] == '2' ? 'Complete' : 'Failed')); ?></td>
                                            <td class="hidden-phone"><?php echo $row['payment_method']; ?></td>
                                            <td class="hidden-phone"><?php echo ($row['file_paper'] != "" ? '<a href="'. base_url($this->config->item('dir_download') . $row['file_paper']) .'"><i class="fa fa-download"></i></a>' : '' ); ?></td>
                                            <td class="hidden-phone"><?php echo ($row['file_copyright'] != "" ? '<a href="'. base_url($this->config->item('dir_download') . $row['file_copyright']) .'"><i class="fa fa-download"></i></a>': '' ); ?></td>
                                            <td class="hidden-phone">
                                                <a href="<?php echo base_url($this->config->item('admin_folder') . $page . '/edit?id='. $row['id']); ?>" class="btn btn-mini btn-info"><i class="icon-pencil"></i> Edit</a>
                                                <a href="<?php echo base_url($this->config->item('admin_folder') . $page . '/delete?id='. $row['id']); ?>" class="btn btn-mini btn-danger" onclick="return confirm('Are You Sure You Want To Delete This Remember The Action Is Irreversible');"><i class="icon-remove"></i> Delete</a>
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

            <div class="row-fluid">
                <div class="pull-left"><a href="<?php echo base_url($this->config->item('admin_folder') . $page . '/download');?>" class="btn btn-info"><i class="fa fa-download"></i> Download</a></div>
                <div class="pull-right"><a href="<?php echo base_url($this->config->item('admin_folder') . $page . '/downloadEmail');?>" class="btn btn-info"><i class="fa fa-download"></i> Primary Emails</a></div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>

<?php $this->load->view('admin/common/view_footer'); ?>
<?php $this->load->view('admin/common/view_data_tables');?>

</body>
</html>