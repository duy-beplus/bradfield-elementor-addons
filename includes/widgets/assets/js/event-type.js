jQuery(function ($) {
    /**
       * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var EventTypeWidget = function ($scope, $) {
        var preloader = $scope.find(".term-section-preload")
        preloader.hide()
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/event_type.default', EventTypeWidget);
        });
    }
    $(document).ready(function () {
        var sizeItem = $(".term-section .term-items").length
        var itemPerPage = 4
        $(".term-section .term-items").hide()
        $(".term-section .term-items:lt(" + itemPerPage + ")").fadeIn('slow')
        $(".term-section-preload").hide()
        if (sizeItem <= itemPerPage) {
            $(".term-section-loader").hide()
        } else {
            $(".term-section-loader").show()
        }
        $("#load-more").click(function (e) {
            e.preventDefault();
            $(".term-section-preload").show()
            setTimeout(function () {
                itemPerPage = (itemPerPage + 4 <= sizeItem) ? itemPerPage + 4 : sizeItem
                console.log(itemPerPage)
                if (itemPerPage === sizeItem) {
                    $(".term-section .term-items:lt(" + itemPerPage + ")").fadeIn('slow')
                    $(".term-section-loader").hide()
                } else {
                    $(".term-section .term-items:lt(" + itemPerPage + ")").fadeIn('slow')
                }
                $(".term-section-preload").hide()
            }, 1000)
        })
    })
})