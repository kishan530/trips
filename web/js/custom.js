! function(e) {
    "use strict";

    function t(t) {
        e(t.target).prev(".panel-heading").find("i.indicator").toggleClass("icon-minus icon-plus")
    }

    function t(t) {
        e(t.target).prev(".panel-heading").find("i.indicator").toggleClass("icon-minus icon-plus")
    }
    var a = window.location;
    e("ul.nav a").filter(function() {
        return this.href == a
    }).addClass("active"), e(window).load(function() {
        e("#loader").delay(600).fadeOut("slow"), e("#loader-container").delay(600).fadeOut("slow"), e("body").delay(600).css({
            overflow: "visible"
        })
    }), e(".header .dropdown").hover(function() {
        e(".dropdown-menu", this).stop(!0, !0).slideDown("fast"), e(this).toggleClass("open")
    }, function() {
        e(".dropdown-menu", this).stop(!0, !0).slideUp("fast"), e(this).toggleClass("open")
    }), e("#accordion").on("hidden.bs.collapse", t), e("#accordion").on("shown.bs.collapse", t), e("#accordion1").on("hidden.bs.collapse", t), e("#accordion1").on("shown.bs.collapse", t), e("#circle1").circleProgress({
        value: .36,
        size: 200,
        thickness: 10,
        fill: {
            color: "#ffc926"
        }
    }), e("#circle2").circleProgress({
        value: .58,
        size: 200,
        thickness: 10,
        fill: {
            color: "#ffc926"
        }
    }), e("#circle3").circleProgress({
        value: .7,
        size: 200,
        thickness: 10,
        fill: {
            color: "#ffc926"
        }
    }), e("#circle4").circleProgress({
        value: .9,
        size: 200,
        thickness: 10,
        fill: {
            color: "#ffc926"
        }
    }), e(".progress .progress-bar").progressbar({
        transition_delay: 800
    }), jQuery("a[data-gal]").each(function() {
        jQuery(this).attr("rel", jQuery(this).data("gal"))
    }), jQuery("a[data-gal^='prettyPhoto']").prettyPhoto({
        animationSpeed: "slow",
        slideshow: !1,
        overlay_gallery: !1,
        theme: "light_square",
        social_tools: !1,
        deeplinking: !1
    }), e("#testimonials").owlCarousel({
        loop: !0,
        margin: 30,
        nav: !1,
        dots: !0,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1e3: {
                items: 1
            }
        }
    }), e(".owl-fullwidth").owlCarousel({
        loop: !0,
        margin: 0,
        nav: !0,
        dots: !1,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1e3: {
                items: 2
            }
        }
    }), e("#trip_search_date").datepicker({
        dateFormat: "dd/mm/yy",
        numberOfMonths: 2,
        minDate: 0,
        onSelect: function(t) {
            var a = $("#trip_search_date").datepicker("getDate");
            a.setDate(a.getDate() + 1), $("#trip_search_returnDate").datepicker("option", "minDate", a), e("#roundtrip").is(":checked") && e("#trip_search_returnDate").focus()
        }
    }),
       //  var a = new Date();
    //a.setDate(a.getDate() + 1), $("#trip_search_returnDate").datepicker("option", "minDate", a),
        
        e("#trip_search_returnDate").datepicker({
        dateFormat: "dd/mm/yy",
        numberOfMonths: 2,
        onSelect: function(t, a) {
            e("#roundtrip").is(":checked") || e("#dailyRent").is(":checked") || e("#roundtrip").trigger("click")
        }
    }), e(".preferDate").datepicker({
        dateFormat: "dd/mm/yy",
        numberOfMonths: 2,
        minDate: 0
    }), e("#trip_hotel_search_date").datepicker({
        dateFormat: "dd/mm/yy",
        numberOfMonths: 2,
        minDate: 0
    }), e("#trip_hotel_search_returnDate").datepicker({
        dateFormat: "dd/mm/yy",
        numberOfMonths: 2,
        minDate: 0
    }), e("#trip_search_multiple_0_date").datepicker({
        dateFormat: "dd/mm/yy",
        numberOfMonths: 2,
        minDate: 0
    }), e("#trip_search_multiple_1_date").datepicker({
        dateFormat: "dd/mm/yy",
        numberOfMonths: 2,
        minDate: 0
    }), e("#trip_search_multiple_2_date").datepicker({
        dateFormat: "dd/mm/yy",
        numberOfMonths: 2,
        minDate: 0
    }), e("#trip_search_multiple_3_date").datepicker({
        dateFormat: "dd/mm/yy",
        numberOfMonths: 2,
        minDate: 0
    }), e("#trip_search_multiple_4_date").datepicker({
        dateFormat: "dd/mm/yy",
        numberOfMonths: 2,
        minDate: 0
    }), e("#trip_search_multiple_5_date").datepicker({
        dateFormat: "dd/mm/yy",
        numberOfMonths: 2,
        minDate: 0
    }), e("#trip_search_multiple_6_date").datepicker({
        dateFormat: "dd/mm/yy",
        numberOfMonths: 2,
        minDate: 0
    }), e("#trip_search_multiple_7_date").datepicker({
        dateFormat: "dd/mm/yy",
        numberOfMonths: 2,
        minDate: 0
    }), e("#trip_booking_search_start_date").datepicker({
        dateFormat: "dd/mm/yy",
        numberOfMonths: 2
    }), e("#trip_booking_search_end_date").datepicker({
        dateFormat: "dd/mm/yy",
        numberOfMonths: 2
    }), e(".chosen-select").chosen({
        no_results_text: "Oops, nothing found!"
    });
    
}(jQuery);