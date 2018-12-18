<!DOCTYPE html>

<head>
    <?php $this->load->view('common/view_include');?>
</head>

<body itemscope>
<div class="theme-layout">
    <?php $this->load->view('common/view_header');?>

    <div class="section-space80">
        <div class="container">
            <div class="row">
                <div class="col-md-12 st-tabs">
                    <div class="well-box">
                        <h1 class="text-center"><span class="underlineHeading">REGISTRATION</span></h1>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <?php echo $content['content'];?>
                            </div>
                        </div>


                        <form class="ajaxForm" method="post" name="registrationForm" action="<?php echo base_url('registration/confirm');?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="firstname">First Name<span class="required">*</span></label>
                                        <input id="firstname" name="firstname" type="text" class="form-control input-md" required tabindex="1">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="organization">Address 1<span class="required">*</span></label>
                                        <input id="organization" name="organization" type="text" class="form-control input-md" required tabindex="3">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="country">Country of Residence<span class="required">*</span></label>
                                        <select id="country" name="country" class="form-control selectpicker" rel='ajaxUpdate' data-source="country" data-output="state" data-href="<?php echo base_url('ajax/getStates');?>" required tabindex="5">
                                            <?php
                                            if(isset($countries)){
                                                foreach($countries as $key_country => $country){
                                                    echo '<option>'. $country['name'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="email">E-mail<span class="required">*</span></label>
                                        <input id="email_id" name="email_id" type="text" class="form-control input-md" required tabindex="7">
                                    </div>

                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="lastname">Last Name<span class="required">*</span></label>
                                        <input id="lastname" name="lastname" type="text" class="form-control input-md" required tabindex="2">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="qualification">Address 2</label>
                                        <input id="qualification" name="qualification" type="text" class="form-control input-md" required tabindex="4">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="state">State<span class="required">*</span></label>
                                        <select id="state" name="state" class="form-control selectpicker" required tabindex="6">
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="phone">Phone Number (Without country code)<span class="required">*</span></label>
                                        <input id="phone" name="phone" type="text" class="form-control input-md" required tabindex="8">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Are you a?: <sup>*</sup> </label>
                                        <div class="">
                                            <input name="category" class="" id="category_author" required="required" value="author" checked="checked" type="radio">
                                            <label for="category_author">Author</label>

                                            <input name="category" class="" id="category_delegate" required="required" value="delegate" type="radio">
                                            <label for="category_delegate">Delegate</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Are you a: <sup>*</sup> </label>
                                        <div class="">
                                            <input name="type" class="" id="type_student" required="required" value="student" type="radio">
                                            <label for="type_student">Student / Research Scholar(Full Time)</label>

                                            <input name="type" class="" id="type_academician" required="required" value="academician" type="radio"  checked="checked" >
                                            <label for="type_academician">Academician / Industry</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row paperDetails">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Paper ID <sup>*</sup></label>
                                        <input id="paper_id" name="paper_id" type="text" class="form-control input-md" >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Paper Title <sup>*</sup></label>
                                        <input id="paper_title" name="paper_title" type="text" class="form-control input-md" >
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">Paper Author <sup>*</sup></label>
                                        <input id="paper_authors" name="paper_authors" type="text" class="form-control input-md" >
                                    </div>
                                </div>
                            </div>

                            <div class="row paperDetails">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Camera Ready Paper (Upload doc or docx) <sup>*</sup></label>
                                        <input id="file_paper" name="file_paper" type="file" class="form-control input-md" required >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Copyright Form (Jpg/Pdf/doc) <sup>*</sup></label>
                                        <input id="file_copyright_form" name="file_copyright_form" type="file" class="form-control input-md" required >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Total Paper Pages <sup>*</sup></label>
                                        <input id="paper_pages" name="paper_pages" type="text" class="form-control input-md" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Payment Mode <sup>*</sup></label>
                                        <div class="">
                                            <div class="payment_option_payu" style="display: inline-block;">
                                                <input name="payment_method" class="payment_method" id="payment_method_cc" required="required" value="payu" checked="checked" type="radio">
                                                <label for="payment_method_cc">PayU(Credit / Debit Card, Net Banking)</label>
                                            </div>

                                            <div class="payment_option_paypal" style="display: inline-block;">
                                                <input name="payment_method" class="payment_method" id="payment_method_pp" required="required" value="paypal" type="radio">
                                                <label for="payment_method_pp">PayPal</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group text-center">
                                <button id="submit" name="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php $this->load->view('common/view_footer');?>



</div>



<?php $this->load->view('common/view_common_js')?>

<script type="text/javascript">
    $("input[name='category']").on("change", function(e){
        var category = this.value;

        if(category == "author"){
            $(".paperDetails").show();
        }else{
            $(".paperDetails").hide();
        }
    });
</script>
</body>
 