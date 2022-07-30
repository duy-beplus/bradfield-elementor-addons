jQuery(function ($) {
    /**
       * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var LoadEventByOptions = function ($scope, $) {
        var preloader = $scope.find(".event-section-preload")
        preloader.hide()
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/load_event_by_options.default', LoadEventByOptions);
        });
    }
    $(document).ready(function () {
        var sizeItem = $(".event-section .event-items").length
        var itemPerPage = 4
        $(".event-section .event-items").hide()
        $(".event-section .event-items:lt(" + itemPerPage + ")").fadeIn('slow')
        $(".event-section-preload").hide()
        if (sizeItem <= itemPerPage) {
            $(".event-section-loader").hide()
        } else {
            $(".event-section-loader").show()
        }
        $("#load-more").click(function (e) {
            e.preventDefault();
            $(".event-section-preload").show()
            setTimeout(function () {
                itemPerPage = (itemPerPage + 4 <= sizeItem) ? itemPerPage + 4 : sizeItem
                if (itemPerPage === sizeItem) {
                    $(".event-section .event-items:lt(" + itemPerPage + ")").fadeIn('slow')
                    $(".event-section-loader").hide()
                } else {
                    $(".event-section .event-items:lt(" + itemPerPage + ")").fadeIn('slow')
                }
                $(".event-section-preload").hide()
            }, 1000)
        })
    })
})