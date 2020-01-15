(function($) {
    // resets the dates filter
    $('#news-refresh-filter').on('click', function (e) {
        e.preventDefault();

        $('#date-min').val('');
        $('#date-max').val('');
        $('#news-dates-submit').trigger('click');
    })
})(jQuery);