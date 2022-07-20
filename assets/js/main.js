jQuery(function ($) {
    $("a[href='#top']").click(function () {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });

    $(document).ready(function () {
        $("table").wrap("<div class='wrapper-table'></div>")
    })
})