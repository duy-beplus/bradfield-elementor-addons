jQuery(function ($) {
$(document).ready(function(){
    var phone_number = $('.bradfield-event-date .evo_card_organizer_contact').text();
    $('.bradfield-event-date .evo_card_organizer_contact').wrap("<a href='tel:"+phone_number+"'></a>");

    var month = $('.bradfield-event-date .evo_start .month').text();
    var date = $('.bradfield-event-date .evo_start .date').text();
    var time = $('.bradfield-event-date .evo_eventcard_time_t').text();
    // get date time event in a month
    date_time = date + " " + time.split(date) ;
    // get date time event lasted for many months
    month_date_time = month + " " + date_time.split(month);
    format_month_date_time = month_date_time.replace(/, /g, '');
    $('.bradfield-event-date .evo_eventcard_time_t').html(format_month_date_time);
  });

});
