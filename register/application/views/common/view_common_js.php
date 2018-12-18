<script>base_url = <?php echo json_encode(base_url()); ?>;</script><!--

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url('js/front/jquery.min.js');?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url('js/front/bootstrap.min.js');?>"></script>
<!-- Flex Nav Script -->
<script src="<?php echo base_url('js/front/jquery.flexnav.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/front/navigation.js');?>"></script>

<script src="<?php echo base_url('js/front/owl.carousel.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/front/thumbnail-slider.js');?>"></script>

<script src="<?php echo base_url('js/front/jquery.sticky.js');?>"></script>
<script src="<?php echo base_url('js/front/header-sticky.js');?>"></script>

<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
    var myCenter = new google.maps.LatLng(23.0203458, 72.5797426);

    function initialize() {
        var mapProp = {
            center: myCenter,
            zoom: 9,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

        var marker = new google.maps.Marker({
            position: myCenter,

            icon: 'images/pinkball.png'
        });

        marker.setMap(map);
        var infowindow = new google.maps.InfoWindow({
            content: "Hello Address"
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url('js/front/price-slider.js');?>"></script>



<script type="text/javascript" src="<?php echo base_url('assets/plugins/lobibox/notifications.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/lobibox/lobibox.js');?>"></script>


<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/flot/jquery.flot.time.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/plugins/common/jquery.form.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/common/jquery.validate.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/common/formValidations.js?v=1.1');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/common/http.js?v=1.1');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/common/common-scripts.js');?>"></script>








