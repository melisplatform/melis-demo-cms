/**
 * Init function for the plugin to be rendered
 * This function is used when reloading a plugin in the back office after
 * changing parameters or drag/dropping it.
 * This function is automatically called and must be nammed PluginName_init
 * It will always receive the id of the plugin as a parameter, in case multiple
 * same plugin are on the page.
 */
    function MelisCmsSliderShowSliderPlugin_init (idPlugin) {
        var idPlugin = typeof idPlugin != "undefined" ? idPlugin : '';
        var	$plugin = $('#'+idPlugin);

        if ($plugin.length) {
            if ($plugin.hasClass('home-carousel-slider')) {
                /*===========Start app_testimonial_slider js ===========*/
                function appScreenshot() {
                    var app_screenshotSlider = $(".app_screenshot_slider");

                    if ( app_screenshotSlider.length ) {
                        app_screenshotSlider.owlCarousel({
                            loop:false,
                            margin:10,
                            items: 5,
                            autoplay: false,
                            smartSpeed: 2000,
                            responsiveClass:false,
                            nav: false,
                            dots: true,
                            responsive:{
                                0:{
                                    items: 1
                                },
                                650:{
                                    items:2,
                                },
                                776:{
                                    items:4,
                                },
                                1199:{
                                    items:5,
                                },
                            },
                        })
                    }
                }
                appScreenshot();
                /*===========End app_testimonial_slider js ===========*/
            }
        }
    }