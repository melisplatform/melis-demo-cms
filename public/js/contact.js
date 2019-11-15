(function($) {
    "use strict";
    var $contactForm = $('#contact-us');
    var $mapBox = $('#mapBox');
    var $mapLat = $('#map-lat');
    var $mapLong = $('#map-long');

    // override lat and long
    var lat = $mapLat.text().trim();
    if (lat.length > 0) {
        $mapBox.data('lat', $mapLat.text());
        $mapBox.data('mlat', $mapLat.text());
    }

    var long = $mapLong.text().trim();
    if (long.length > 0) {
        $mapBox.data('lon', $mapLong.text());
        $mapBox.data('mlon', $mapLong.text());
    }

    // initialize map
    if ( $mapBox.length ) {
        var $lat = $mapBox.data('lat');
        var $lon = $mapBox.data('lon');
        var $zoom = $mapBox.data('zoom');
        var $marker = $mapBox.data('marker');
        var $info = $mapBox.data('info');
        var $markerLat = $mapBox.data('mlat');
        var $markerLon = $mapBox.data('mlon');
        var map = new GMaps({
            el: '#mapBox',
            lat: $lat,
            lng: $lon,
            scrollwheel: false,
            scaleControl: true,
            streetViewControl: false,
            panControl: true,
            disableDoubleClickZoom: true,
            mapTypeControl: false,
            zoom: $zoom,
        });
        map.addMarker({
            lat: $markerLat,
            lng: $markerLon,
            icon: $marker,
            infoWindow: {
                content: $info
            }
        })
    }

    // validate contactForm form
    $contactForm.on('submit', function (e) {
        var dataString = $(this).serializeArray();
        var url = window.location.href;

        $.ajax({
            type: 'POST',
            url : url,
            data : dataString,
            dataType : 'json',
            encode : true,
            success: function (data) {
                if (data.success) {
                    $('.success').removeClass('hidden');
                    $contactForm[0].reset();
                } else {
                    $('.error').removeClass('hidden');
                    showErrors(data.errors)
                }
            }
        });

        e.preventDefault();
    });

    function showErrors (errors) {
        $.each (errors, function (key, error) {
            var $element = $('#' + key);
            var errorTexts = '';

            try {
                $.each( error, function( key, value ) {
                    if (key !== 'label') {
                        errorTexts = value;
                    }
                });
            } catch (Tryerror) {
                if (key !== 'label') {
                    errorTexts = error;
                }
            }

            var label = '<label for="' + key + '" class="error" style="color: red;">' + errorTexts + '</label>';
            $element.parent().after().append(label);
        });
    }
})(jQuery);
