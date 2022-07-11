jQuery(function ($) {
// Add text to Search result heading
$(document).ready(function(){
    $(".search-result #evcal_cur").prepend("<span>Events for </span>");
});
// Add Date to input block
$(document).ready(function(){
    var currentYear = (new Date).getFullYear();
    var currentMonth = (new Date).getMonth() + 1;
    if (currentMonth < 10) {
      currentMonth = "0"+currentMonth;
    }
    var currentDay = (new Date).getDate();
    $(".search-result .evo_cal_above").prepend("<p><b class='current_date'>"+ currentMonth +"</b> | <b class='current_year'>"+ currentYear +"</b></p>");
});
//hide Date option drop down
$(document).ready(function(){
    $('.search-result .evo_j_container').css('display','none');
});

$(".search-result .evo_j_months .legend a").click(function() {
  var data_month = $(this).text();
  $(".search-result .evo_cal_above .current_date").html(data_month)
});

$(".search-result .evo_j_years .legend a").click(function() {
  var data_year = $(this).text();
  $(".search-result .evo_cal_above .current_year").html(data_year)
});

$(".search-result .evo_j_months .legend a").click(function() {
  $(".search-result .evo_j_container").hide();
});

$(document).mouseup(function (e) {
    if ($(e.target).closest(".search-result .evo_j_container").length === 0) {
        $(".search-result .evo_j_container").hide();
    }
});
});
