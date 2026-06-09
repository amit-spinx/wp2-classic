var $ = jQuery.noConflict();
$(document).on("ready", function () {

    var counted = false;
    $(window).on("scroll load", function () {
        if (counted) return;

        $(".counter-section").each(function () {
            var $counter = $(this);
            var elementTop = $counter.offset().top;
            var elementBottom = elementTop + $counter.outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();
            // Check if element is visible on screen
            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $counter.find("[data-count]").each(function () {
                    var $this = $(this);
                    var raw = $this.attr("data-count");
                    var decimals = (raw.split('.')[1] || "").length; // detect decimal places
                    var countTo = parseFloat(raw);

                    $({ countNum: 0 }).animate(
                        { countNum: countTo },
                        {
                            duration: 2000,
                            easing: "swing",
                            step: function () {
                                $this.text(this.countNum.toFixed(decimals));
                            },
                            complete: function () {
                                $this.text(this.countNum.toFixed(decimals));
                            }
                        }
                    );
                });
                counted = true; // Run only once
            }
        });
    });

});