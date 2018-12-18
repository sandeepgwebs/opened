
<div class="tp-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ol class="breadcrumb">
                    <?php
                        foreach($breadcrumbs as $key_breadcrumb => $breadcrumb){
                            $activeClass = "";
                            if($key_breadcrumb >= sizeof($breadcrumbs)){
                                $activeClass = 'class="active"';
                            }
                            echo '<li '. $activeClass .'><a href="'. $breadcrumb[1] .'">'. $breadcrumb[0] .'</a></li>';
                        }
                    ?>
                </ol>
            </div>
        </div>
    </div>
</div>