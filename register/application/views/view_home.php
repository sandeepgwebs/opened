<!DOCTYPE html>

<head>
<?php $this->load->view('common/view_include');?>
</head>

<body id="index" class="index hide-left-column hide-right-column lang_en">
<div id="page">
  <?php $this->load->view('common/view_header');?>
  <div class="columns-container">
    <div id="slider_row" class="">
      <div id="top_column" class="center_column col-xs-12 col-sm-12"> 
        <!-- Menu -->
        <!-- Module TmHomeSlider -->
        
        <?php $this->load->view('common/view_slider');?>
        
        <!-- /Module TmHomeSlider --> 
        <!-- MODULE TM - CMS SLIDER BOTTOM BLOCK  -->
        <div id="tmcmssliderbottomblock">
          <div class="container">
            <div class="box-content-cms">
              <div class="inner-cms">
                <div class="box-cms-content">
                  <div class="first-content">
                    <div class="inner-content">
                      <div class="service-content">
                        <div class="cms-icon icon-left1"></div>
                        <div class="service-right">
                          <div class="service-title">UGC Indexed Journal</div>
                          <div class="service-desc">see Journals list</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="second-content">
                    <div class="inner-content">
                      <div class="service-content">
                        <div class="cms-icon icon-left3"></div>
                        <div class="service-right">
                          <div class="service-title">Index Copernicus, ICV</div>
                          <div class="service-desc">see all Journals</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="third-content">
                    <div class="inner-content">
                      <div class="service-content">
                        <div class="cms-icon icon-left4"></div>
                        <div class="service-right">
                          <div class="service-title">Cosmos Impact Factor</div>
                          <div class="service-desc">see all Journals</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="fourth-content">
                    <div class="inner-content">
                      <div class="service-content">
                        <div class="cms-icon icon-left2"></div>
                        <div class="service-right">
                          <div class="service-title">Global Impact Factor</div>
                          <div class="service-desc">see all Journals</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /MODULE Block cmstmcmssliderbottomblockinfo --> 
      </div>
    </div>
    <div id="columns" class="container">
      <div class="row" id="columns_inner">
        <div id="center_column" class="center_column col-xs-12" style="width:100%;">
          <div class="clearfix">
            <div id="tmproductstab" class="block products_block clearfix">
              <div class="tab-main-title">
                <h2 class="tab_title">Our Journals</h2>

              </div>
              <div class="tab-content">
                <div id="tab_feature_product" class="tab_content tab-pane"> 
                  <!-- Custom start --> 
                  <!-- Define Number of product for SLIDER -->
                  
                  <!--<div class="customNavigation"> <a class="btn prev tabproduct_prev"></a> <a class="btn next tabproduct_next"></a> </div>-->
                  
                  <!-- Custom End -->
                  
                  <div class="block_content row"> 
                    <!-- Custom start -->
                    <ul id="tm_feature_product1" class="tm-carousel product_list">
                      <?php
                                if($journals){
                                    foreach($journals as $key_journal => $journal){
                            ?>
                                      <li class="item   first-in-line first-item-of-tablet-line first-item-of-mobile-line">
                                        <div class="product-container" itemscope itemtype="">
                                          <div class="left-block">
                                            <div class="product-image-container">

                                                <a class="product_img_link" href="<?php echo base_url('journal/' . $journal['slug']);?>" title="" itemprop="url">

                                                    <?php if($journal['logo_2'] != ''){ ?>
                                                        <img class="replace-2x img-responsive" src="<?php echo base_url($this->config->item('dir_images') . $journal['logo_2']);?>" alt="<?php echo $journal['title'];?>" title="<?php echo $journal['title'];?>"  width="225" height="294" itemprop="image" />

                                                        <img class="replace-2x img_1 img-responsive" src="<?php echo base_url($this->config->item('dir_images') . $journal['logo_2']);?>" alt="<?php echo $journal['title'];?>" title="<?php echo $journal['title'];?>" itemprop="image" />

                                                    <?php } else { ?>
                                                        <img class="replace-2x img-responsive" src="images/noimage.jpg"  width="225" height="294" itemprop="image" />
                                                        <img class="replace-2x img_1 img-responsive" src="images/noimage.jpg" title="<?php echo $journal['title'];?>" itemprop="image" />
                                                    <?php }?>
                                                </a>
                                            </div>

                                            <div class="right-block">
                                              <h5 itemprop="name"> <a class="product-name" href="<?php echo base_url('journal/' . $journal['slug']);?>" title="Title Name" itemprop="url" ><?php echo $journal['title'];?></a> </h5>

                                              <div class="button-container">
                                                  <a href="<?php echo base_url('journal/' . $journal['slug'] . '/submission');?>" class="btn btn-primary">Online Submission</a>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <!-- .product-container> -->

                                      </li>
                      <?php
                                    }
                                }
                            ?>
                    </ul>
                    </ul>
                  </div>
                  <script>
						$(document).ready(function() {
							var owlfeature_product = $("#tm_feature_product");
							owlfeature_product.owlCarousel({
								items : 5, //10 items above 1000px browser width
								itemsDesktop : [1200,4], 
								itemsDesktopSmall : [991,3], 
								itemsTablet: [767,2], 
								itemsMobile : [480,1],
                                autoPlay: true,
                                autoplaySpeed: 2000
                            });
							$("#tab_feature_product .tabproduct_next").click(function(){
								owlfeature_product.trigger('owl.next');
							})
							$("#tab_feature_product .tabproduct_prev").click(function(){
								owlfeature_product.trigger('owl.prev');
							})
						});
				</script> 
                </div>
              </div>
            </div>
            <script type="text/javascript"> 
	$(document).ready(function() {
		$('#tmproduct-tabs li:first, #tmproductstab .tab-content div:first').addClass('active');
	});
</script>
            <div id="tmcmssubbannerblock" class="container">
              <div class="subbanner-cms">
                <div class="leftpart">
                  <div class="subbanner4"><a href="<?php echo base_url('new-journal-proposal');?>"><img class="img-respo" alt="Subbanner1" src="<?php echo base_url() ?>images/sub6.jpg" /></a> </div>
                </div>
                <div class="upper">
                  <div class="subbanner1"><a href="<?php echo base_url('apply-editor-in-chief');?>"><img class="img-respo" alt="Subbanner1" src="<?php echo base_url() ?>images/sub2.jpg" /></a> </div>
                  <div class="subbanner2"><a href="<?php echo base_url('apply-guest-editor');?>"><img class="img-respo" alt="Subbanner2" src="<?php echo base_url() ?>images/sub4.jpg" /></a> </div>
                  <div class="subbanner3">
                    <div class="inner-content1">
                      <div class="text-main"><a href="#">Special issue <span class="highlight"></span></a></div>
                      <div class="text-sub"><a href="#">See details</a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <script type="text/javascript"> 
	$(document).ready(function() {
		$('#tmcategory-tabs li:first, #tmcategoryslider .tab-content div:first').addClass('active');
	});
</script> <!-- MODULE Block cmsinfo --> 
            
          </div>
        </div>
      </div>
      <!-- .row --> 
    </div>
    <!-- #columns --> 
  </div>
  <div class="row"></div>
  <div id="clientlogos" class="clearfix">
    <div  class="clientinner">
      <div  class="container">
        <div class="tab-main-title">
          <h2 class="tab_title" style="padding:0 0 10px 0; text-align:center">Indexed By </h2>
        </div>
        <ul id="tm_test" class="tm-carousel product_list">
          <?php
                    if($indexes){
                        foreach($indexes as $key_index => $index){
                            ?>
          <li class="item ">
            <div class="cliebtimg">
              <?php
                                    if($index['link'] == "" || $index['link'] == "#"){
                                        echo '<img src="'. base_url($this->config->item('dir_download') . $index['logo']) .'" class="img-responsive" height="50" />';
                                    }else{
                                        $menuLink = str_replace('webroot/', base_url(), $index['link']);
                                        echo '<a href="'. $menuLink .'"><img src="'. base_url($this->config->item('dir_download') . $index['logo']) .'" class="img-responsive" height="50" /></a>';
                                    }
                                    ?>
            </div>
          </li>
          <?php
                        }
                    }
                    ?>
        </ul>
        <div class="customNavigation"> <a class="btn prev tmcategory_prev"></a> <a class="btn next tmcategory_next"></a> </div>
        
        <!-- Custom End --> 
        <script>
                $(document).ready(function() {
                    var owl3 = $("#tm_test");
                    owl3.owlCarousel({
                        items : 6, //10 items above 1000px browser width
                        itemsDesktop : [1200,5],
                        itemsDesktopSmall : [991,4],
                        itemsTablet: [767,3],
                        itemsMobile : [480,2]
                    });
                    $("#tm_test .tmcategory_next").click(function(){
                        owl3.trigger('owl.next');
                    })
                    $("#tm_test .tmcategory_prev").click(function(){
                        owl3.trigger('owl.prev');
                    })
                });
        </script>
      </div>
    </div>
  </div>
  <div class="row"></div>
  <div  class="container">
    <div id="tmcmsbannerblock1" class="container">
      <div class="fashion-cms">
        <div class="subbanner-one">
          <div class="inner-content2"><a href="<?php echo base_url('apply-editorial-board');?>"><img class="img-respo" src="<?php echo base_url() ?>images/sub7.jpg" alt="sub7.jpg" width="610" height="115" /></a></div>
        </div>
        <div class="subbanner-two">
          <div class="inner-content2"><a href="<?php echo base_url('conference');?>"><img class="img-respo" src="<?php echo base_url() ?>images/sub8.jpg" alt="sub8.jpg" width="610" height="115" /></a></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row"></div>
  <div id="testimonals" class="clearfix">
    <div  class="container">
      <div class="tab-main-title">
        <h2 class="tab_title" style="padding:0 0 10px 0; text-align:center">What they say </h2>
      </div>
      <div class="row"></div>
      <ul id="tm_testimgg" class="tm-carousel product_list">
        <?php
                        if($testimonials){
                            foreach($testimonials as $key_testimonial => $testimonial){
                    ?>
        <li class="item">
          <div class="testimonals">
            <p><img class="img-responsive img-circle" src="<?php echo base_url('images/client-img.jpg');?>" alt=""></p>
            <div class="testtext"> <?php echo $testimonial['testimonial'];?> By <a href="#"><?php echo $testimonial['name'];?></a> </div>
          </div>
        </li>
        <?php
                            }
                        }
                    ?>
      </ul>
    </div>
  </div>
  
  <!-- Custom End --> 
  <script>
        $(document).ready(function() {
            var owl3 = $("#tm_testimgg");
            owl3.owlCarousel({
                items : 3, //10 items above 1000px browser width
                itemsDesktop : [1200,3],
                itemsDesktopSmall : [991,2],
                itemsTablet: [767,2],
                itemsMobile : [480,1]
            });
            $("#tm_testimgg .tmcategory_next").click(function(){
                owl3.trigger('owl.next');
            })
            $("#tm_testimgg .tmcategory_prev").click(function(){
                owl3.trigger('owl.prev');
            })
        });
</script>
</div>
<?php $this->load->view('common/view_footer');?>
<?php $this->load->view('common/view_common_js')?>
</body>
