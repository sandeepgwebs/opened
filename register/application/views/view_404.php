<!DOCTYPE html>

<head>
    <?php $this->load->view('common/view_include');?>
</head>

<body itemscope>
<div class="theme-layout">
    <?php $this->load->view('common/view_header');?>

    <div class="tp-dashboard-head">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="page-header text-center">
                        <h1>Error Page</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="error-block mb80">
                        <h1>404</h1>
                        <h2><i class="fa fa-warning"></i>oooopppss! page was not found, Sorry! it looks like that page has gone missing.</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php $this->load->view('common/view_footer');?>



</div>



<?php $this->load->view('common/view_common_js')?>
</body>
