/**
 * Init function for the plugin to be rendered
 * This function is used when reloading a plugin in the back office after
 * changing parameters or drag/dropping it.
 * This function is automatically called and must be nammed PluginName_init
 * It will always receive the id of the plugin as a parameter, in case multiple
 * same plugin are on the page.
 */
function MelisFrontShowListFromFolderPlugin_init (idPlugin) {
    var idPlugin = typeof idPlugin != "undefined" ? idPlugin : '';
    var	$plugin = $('#'+idPlugin);

    if ($plugin.length) {
        if ($plugin.hasClass('erp_testimonial_area')) {
            /*===========Start app_testimonial_slider js ===========*/
            function erpTestimonial() {
                var erpT = jQuery_3_2_1(".erp_testimonial_info");
                console.log('test');
                if( erpT.length ){
                    erpT.owlCarousel({
                        loop: true,
                        margin: 0,
                        items: 2,
                        nav:true,
                        dots: false,
                        autoplay: false,
                        smartSpeed: 2000,
                        stagePadding: 0,
                        responsiveClass:true,
                        navText: ['<i class="arrow_left"></i>','<i class="arrow_right"></i>'],
                        responsive:{
                            0:{
                                items:1,
                            },
                            776:{
                                items:2,
                            },
                            1199:{
                                items:2,
                            }
                        },
                        onInitialized: function () {
                            $('.erp_testimonial_info .owl-nav').removeClass('disabled');
                        },
                        onChanged: function () {
                            $('.erp_testimonial_info .owl-nav').removeClass('disabled');
                        }
                    })
                }
            }
            erpTestimonial();
            /*===========End app_testimonial_slider js ===========*/
        }
    }
}