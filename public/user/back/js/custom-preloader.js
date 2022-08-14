(function($) {

    "use strict";


    // caching selectors
    var mainWindow = $(window),
        mainBody = $('body'),
        mainpreStatus = $('#preloader-status'),
        mainPreloader = $('#preloader');

    mainWindow.on('load', function() {

        // Preloader
        mainPreloader.fadeOut();
        mainpreStatus.delay(1000).fadeOut('slow');
        mainBody.delay(1000).css({
            'overflow-x': 'hidden'
        });

    });

})(jQuery);