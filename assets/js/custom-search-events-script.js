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

// hide event after load page 1.5s
const myTimeout = setTimeout(hideEvent, 1500);
function hideEvent(){
  $('.search-result .date_row').each(function() {
    let number_row = $(this).children().length;
    if (number_row > 3) {
      $(".search-result .date_row .row:nth-of-type(n + 4)").hide();
      $(this).append("<span class='btn-view-all'>View all "+number_row+" events</span>");
    }
  });

  $(".search-result .btn-view-all").click(function() {
    let wrapper = $(this).closest('.search-result .date_row');
    wrapper.children(".row:nth-of-type(n + 4)").slideToggle();
  });

  // let evosv_grid_items = $('.search-result .evosv_grid .date_row').length;
  // console.log(evosv_grid_items);
  // if (evosv_grid_items > 3) {
  //   $(".search-result .evosv_grid .date_row:nth-of-type(n + 4)").hide();
  //   $(".search-result .evosv_grid").append("<div class='btn-load-more'>load more</div>");
  // }
};

// hide event when ajax load stop
$(document).ajaxStop(function (e) {
  $('.search-result .date_row').each(function() {
    let number_row = $(this).children().length;
    if (number_row > 3) {
      $(".search-result .date_row .row:nth-of-type(n + 4)").hide();
      $(this).append("<span class='btn-view-all'>View all "+number_row+" events</span>");
    }
  });

  $(".search-result .btn-view-all").click(function() {
    let wrapper = $(this).closest('.search-result .date_row');
    wrapper.children(".row:nth-of-type(n + 4)").slideToggle();
  });
});

});
