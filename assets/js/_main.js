/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

    // Use this variable to set up the common and page specific functions. If you 
    // rename this variable, you will also need to rename the namespace below.
    var Roots = {
        // All pages
        common: {
            init: function() {
                // JavaScript to be fired on all pages
                // cache the window object
                $window = $(window);

                $('[data-type="background"]').each(function() {
                    // declare the variable to affect the defined data-type
                    var $scroll = $(this);

                    $(window).scroll(function() {
                        // HTML5 proves useful for helping with creating JS functions!
                        // also, negative value because we're scrolling upwards                             
                        var yPos = -($window.scrollTop() / $scroll.data('speed'));

                        // background position
                        var coords = '50% ' + yPos + 'px';

                        // move the background
                        $scroll.css({
                            backgroundPosition: coords
                        });
                    }); // end window scroll
                }); // end section function
            }
        },
        // Home page
        home: {
            init: function() {
                // JavaScript to be fired on the home page
                var $hero_container = $('#hero_container');
                var hero_init_yPos = $hero_container.offset().top - 32;
                $(window).scroll(function(e) {
                    var yPos = ($window.scrollTop() / $hero_container.data("speed")) - hero_init_yPos;
                    $hero_container.css({
                        top: yPos,
                    });
                });

            }
        },
        // About us page, note the change from about-us to about_us.
        about_us: {
            init: function() {
                // JavaScript to be fired on the about us page
            }
        },
        fwddc_events: {
            init: function() {
                console.log("This worked");
            }
        }
    };

    // The routing fires all common scripts, followed by the page specific scripts.
    // Add additional events for more control over timing e.g. a finalize event
    var UTIL = {
        fire: function(func, funcname, args) {
            var namespace = Roots;
            funcname = (funcname === undefined) ? 'init' : funcname;
            if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
                namespace[func][funcname](args);
            }
        },
        loadEvents: function() {
            UTIL.fire('common');

            $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
                UTIL.fire(classnm);
            });
        }
    };

    $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.