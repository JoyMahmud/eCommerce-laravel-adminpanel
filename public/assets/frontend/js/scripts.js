! function(t) {
    "use strict";
    t(document).ready(function() {
        function a() {
            d ? t(u + " .caption .fadeIn-1, " + u + " .caption .fadeIn-2, " + u + " .caption .fadeIn-3").css({
                opacity: 0
            }) : t(u + " .caption .fadeIn-1, " + u + " .caption .fadeIn-2, " + u + " .caption .fadeIn-3").stop().delay(800).animate({
                opacity: 0
            }, {
                duration: 400,
                easing: "easeInCubic"
            })
        }

        function e() {
            d ? t(u + " .caption .fadeInDown-1, " + u + " .caption .fadeInDown-2, " + u + " .caption .fadeInDown-3").css({
                opacity: 0,
                top: "-15px"
            }) : t(u + " .caption .fadeInDown-1, " + u + " .caption .fadeInDown-2, " + u + " .caption .fadeInDown-3").stop().delay(800).animate({
                opacity: 0,
                top: "-15px"
            }, {
                duration: 400,
                easing: "easeInCubic"
            })
        }

        function i() {
            d ? t(u + " .caption .fadeInUp-1, " + u + " .caption .fadeInUp-2, " + u + " .caption .fadeInUp-3").css({
                opacity: 0,
                top: "15px"
            }) : t(u + " .caption .fadeInUp-1, " + u + " .caption .fadeInUp-2, " + u + " .caption .fadeInUp-3").stop().delay(800).animate({
                opacity: 0,
                top: "15px"
            }, {
                duration: 400,
                easing: "easeInCubic"
            })
        }

        function n() {
            d ? t(u + " .caption .fadeInLeft-1, " + u + " .caption .fadeInLeft-2, " + u + " .caption .fadeInLeft-3").css({
                opacity: 0,
                left: "15px"
            }) : t(u + " .caption .fadeInLeft-1, " + u + " .caption .fadeInLeft-2, " + u + " .caption .fadeInLeft-3").stop().delay(800).animate({
                opacity: 0,
                left: "15px"
            }, {
                duration: 400,
                easing: "easeInCubic"
            })
        }

        function o() {
            d ? t(u + " .caption .fadeInRight-1, " + u + " .caption .fadeInRight-2, " + u + " .caption .fadeInRight-3").css({
                opacity: 0,
                left: "-15px"
            }) : t(u + " .caption .fadeInRight-1, " + u + " .caption .fadeInRight-2, " + u + " .caption .fadeInRight-3").stop().delay(800).animate({
                opacity: 0,
                left: "-15px"
            }, {
                duration: 400,
                easing: "easeInCubic"
            })
        }

        function s() {
            t(u + " .active .caption .fadeIn-1").stop().delay(500).animate({
                opacity: 1
            }, {
                duration: 800,
                easing: "easeOutCubic"
            }), t(u + " .active .caption .fadeIn-2").stop().delay(700).animate({
                opacity: 1
            }, {
                duration: 800,
                easing: "easeOutCubic"
            }), t(u + " .active .caption .fadeIn-3").stop().delay(1e3).animate({
                opacity: 1
            }, {
                duration: 800,
                easing: "easeOutCubic"
            })
        }

        function c() {
            t(u + " .active .caption .fadeInDown-1").stop().delay(500).animate({
                opacity: 1,
                top: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            }), t(u + " .active .caption .fadeInDown-2").stop().delay(700).animate({
                opacity: 1,
                top: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            }), t(u + " .active .caption .fadeInDown-3").stop().delay(1e3).animate({
                opacity: 1,
                top: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            })
        }

        function p() {
            t(u + " .active .caption .fadeInUp-1").stop().delay(500).animate({
                opacity: 1,
                top: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            }), t(u + " .active .caption .fadeInUp-2").stop().delay(700).animate({
                opacity: 1,
                top: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            }), t(u + " .active .caption .fadeInUp-3").stop().delay(1e3).animate({
                opacity: 1,
                top: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            })
        }

        function l() {
            t(u + " .active .caption .fadeInLeft-1").stop().delay(500).animate({
                opacity: 1,
                left: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            }), t(u + " .active .caption .fadeInLeft-2").stop().delay(700).animate({
                opacity: 1,
                left: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            }), t(u + " .active .caption .fadeInLeft-3").stop().delay(1e3).animate({
                opacity: 1,
                left: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            })
        }

        function r() {
            t(u + " .active .caption .fadeInRight-1").stop().delay(500).animate({
                opacity: 1,
                left: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            }), t(u + " .active .caption .fadeInRight-2").stop().delay(700).animate({
                opacity: 1,
                left: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            }), t(u + " .active .caption .fadeInRight-3").stop().delay(1e3).animate({
                opacity: 1,
                left: "0"
            }, {
                duration: 800,
                easing: "easeOutCubic"
            })
        }
        var d = !0,
            u = "#owl-main";
        t(u).owlCarousel({
            autoPlay: 5e3,
            stopOnHover: !0,
            navigation: !0,
            pagination: !0,
            singleItem: !0,
            addClassActive: !0,
            transitionStyle: "fade",
            navigationText: ["<i class='icon fa fa-angle-left'></i>", "<i class='icon fa fa-angle-right'></i>"],
            afterInit: function() {
                s(), c(), p(), l(), r()
            },
            afterMove: function() {
                s(), c(), p(), l(), r()
            },
            afterUpdate: function() {
                s(), c(), p(), l(), r()
            },
            startDragging: function() {
                d = !0
            },
            afterAction: function() {
                a(), e(), i(), n(), o(), d = !1
            }
        }), t(u).hasClass("owl-one-item") && t(u + ".owl-one-item").data("owlCarousel").destroy(), t(u + ".owl-one-item").owlCarousel({
            singleItem: !0,
            navigation: !1,
            pagination: !1
        }), t("#transitionType li a").click(function() {
            t("#transitionType li a").removeClass("active"), t(this).addClass("active");
            var a = t(this).attr("data-transition-type");
            return t(u).data("owlCarousel").transitionTypes(a), t(u).trigger("owl.next"), !1
        }), t(".home-owl-carousel").each(function() {
            var a = t(this),
                e = a.data("item");
            e || (e = 4), a.owlCarousel({
                items: e,
                itemsTablet: [768, 2],
                navigation: !0,
                pagination: !1,
                navigationText: ["", ""]
            })
        }), t(".homepage-owl-carousel").each(function() {
            var a = t(this),
                e = a.data("item");
            e || (e = 4), a.owlCarousel({
                items: e,
                itemsTablet: [768, 2],
                itemsDesktop: [1199, 2],
                navigation: !0,
                pagination: !1,
                navigationText: ["", ""]
            })
        }), t(".blog-slider").owlCarousel({
            items: 3,
            itemsDesktopSmall: [979, 2],
            itemsDesktop: [1199, 2],
            navigation: !0,
            slideSpeed: 300,
            pagination: !1,
            navigationText: ["", ""]
        }), t(".best-seller").owlCarousel({
            items: 3,
            navigation: !0,
            itemsDesktopSmall: [979, 2],
            itemsDesktop: [1199, 2],
            slideSpeed: 300,
            pagination: !1,
            paginationSpeed: 400,
            navigationText: ["", ""]
        }), t(".sidebar-carousel").owlCarousel({
            items: 1,
            itemsTablet: [768, 2],
            itemsDesktopSmall: [979, 2],
            itemsDesktop: [1199, 1],
            navigation: !0,
            slideSpeed: 300,
            pagination: !1,
            paginationSpeed: 400,
            navigationText: ["", ""]
        }), t(".brand-slider").owlCarousel({
            items: 6,
            navigation: !0,
            slideSpeed: 300,
            pagination: !1,
            paginationSpeed: 400,
            navigationText: ["", ""]
        }), t("#advertisement").owlCarousel({
            items: 1,
            itemsDesktopSmall: [979, 2],
            itemsDesktop: [1199, 1],
            navigation: !0,
            slideSpeed: 300,
            pagination: !0,
            paginationSpeed: 400,
            navigationText: ["", ""]
        });
        var f = t(".owl-controls-custom");
        t(".owl-next", f).click(function(a) {
            var e = t(this).data("owl-selector"),
                i = t(e).data("owlCarousel");
            return i.next(), !1
        }), t(".owl-prev", f).click(function(a) {
            var e = t(this).data("owl-selector"),
                i = t(e).data("owlCarousel");
            return i.prev(), !1
        }), t(".owl-next").click(function() {
            return t(t(this).data("target")).trigger("owl.next"), !1
        }), t(".owl-prev").click(function() {
            return t(t(this).data("target")).trigger("owl.prev"), !1
        })
    }), t(document).ready(function() {
        echo.init({
            offset: 100,
            throttle: 250,
            unload: !1
        })
    }), t(document).ready(function() {
        t(".rating").rateit({
            max: 5,
            step: 1,
            value: 4,
            resetable: !1,
            readonly: !0
        })
    }), t(document).ready(function() {
        t("#owl-single-product").owlCarousel({
            items: 1,
            itemsTablet: [768, 2],
            itemsDesktop: [1199, 1]
        }), t("#owl-single-product-thumbnails").owlCarousel({
            items: 4,
            pagination: !0,
            rewindNav: !0,
            itemsTablet: [768, 4],
            itemsDesktop: [1199, 3]
        }), t("#owl-single-product2-thumbnails").owlCarousel({
            items: 6,
            pagination: !0,
            rewindNav: !0,
            itemsTablet: [768, 4],
            itemsDesktop: [1199, 3]
        }), t(".single-product-slider").owlCarousel({
            stopOnHover: !0,
            rewindNav: !0,
            singleItem: !0,
            pagination: !0
        }), t(".slider-next").click(function() {
            var a = t(t(this).data("target"));
            return a.trigger("owl.next"), !1
        }), t(".slider-prev").click(function() {
            var a = t(t(this).data("target"));
            return a.trigger("owl.prev"), !1
        }), t(".single-product-gallery .horizontal-thumb").click(function() {
            var a = t(this),
                e = t(a.data("target")),
                i = a.data("slide");
            return e.trigger("owl.goTo", i), a.addClass("active").parent().siblings().find(".active").removeClass("active"), !1
        })
    }), t(".quant-input .arrows .plus").click(function() {
        var a = t(this).parent().next().val();
        a = parseInt(a) + 1, t(this).parent().next().val(a)
    }), t(".quant-input .arrows .minus").click(function() {
        var a = t(this).parent().next().val();
        a > 0 && (a = parseInt(a) - 1, t(this).parent().next().val(a))
    }), t(document).ready(function() {
        (new WOW).init()
    }), t("[data-toggle='tooltip']").tooltip(), t("#transitionType li a").click(function() {
        t("#transitionType li a").removeClass("active"), t(this).addClass("active");
        var a = t(this).attr("data-transition-type");
        return t(owlElementID).data("owlCarousel").transitionTypes(a), t(owlElementID).trigger("owl.next"), !1
    })
}(jQuery);