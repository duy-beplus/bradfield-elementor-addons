jQuery(function ($) {
$(document).ready(function(){
    var phone_number = $('.bradfield-event-date .evo_card_organizer_contact').text();
    $('.bradfield-event-date .evo_card_organizer_contact').wrap("<a href='tel:"+phone_number+"'></a>");
  });
});
