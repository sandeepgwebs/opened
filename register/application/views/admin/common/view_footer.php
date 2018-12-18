<div id="footer">
    Developed by <a href="https://www.ishmeetnarula.in/" target="_blank">Ishmeet Narula</a>
</div>

<script type="text/javascript">base_url = <?php echo json_encode(base_url());?></script>
<!-- BEGIN JAVASCRIPTS -->
<!-- Load javascripts at bottom, this will reduce page load time -->
<!--<script src="<?php /*echo base_url();*/?>js/admin/jquery-1.8.3.min.js"></script>-->
<script src="https://code.jquery.com/jquery-1.8.3.min.js"></script>

<script src="<?php echo base_url();?>js/admin/jquery.nicescroll.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url();?>assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/admin/formValidations.js');?>"></script>

<!-- ie8 fixes -->
<!--[if lt IE 9]>
<script src="<?php echo base_url();?>js/excanvas.js"></script>
<script src="<?php echo base_url();?>js/respond.js"></script>
<![endif]-->



<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/uniform/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>assets/fancybox/source/jquery.fancybox.pack.js"></script>


<script src="<?php echo base_url();?>js/admin/ajaxsubmit.js"></script>
<script src="<?php echo base_url();?>js/admin/jquery.mjs.nestedSortable.js"></script>

<script src="<?php echo base_url();?>assets/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo base_url();?>js/admin/form-wizard.js"></script>


<script src="<?php echo base_url();?>assets/date-time-picker/jquery.datetimepicker.full.js"></script>


<script src="<?php echo base_url('js/plugin/lobibox.js');?>"></script>
<script src="<?php echo base_url('js/plugin/notifications.js');?>"></script>


<script src="<?php echo base_url('assets/nestable/jquery.nestable.js');?>"></script>


<script src="<?php echo base_url();?>js/admin/common-scripts.js"></script>
<script src="<?php echo base_url();?>js/admin/http.js"></script>
<script src="<?php echo base_url();?>js/admin/jquery.selectlistactions.js"></script>


<script type="text/javascript">
    <?php
    if(isset($mode)){
        if($mode == 'list'){
            echo '$(".divForm").hide();';
            echo '$(".divList").show();';
        }else if($mode == 'edit'){
            echo '$(".divForm").show();';
            echo '$(".divList").hide();';
        }
    }
    ?>
</script>