<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Content_single_Event extends \Elementor\Widget_Base {
  public function get_name() {
      return 'content-single-event-widget';
  }

  public function get_title() {
      return __( 'Content Single Event');
  }

  public function get_icon() {
      return 'eicon-single-post';
  }

  public function get_categories() {
      return [ 'custom-category' ];
  }

  public function get_keywords() {
    return [ 'single', 'event' ];
  }

  protected function register_controls() {

  }

  protected function render() {
      // generate the final HTML on the frontend using PHP
      $settings = $this->get_settings_for_display();
      $event_id = get_the_ID();

      ?>
      <div id="content-single-event" class="content-single-container">
        <div class="event-info-block">
          <!-- heading -->
          <div class="event-info-heading">
            <h1 class="event-title"><?php echo the_title(); ?></h1>
            <div id="event-btn-buy-ticket">
              buy ticket now
            </div>
          </div>
          <!-- /heading -->
          <!-- Event Date & time -->
          <div class="event-date">
            <div class="calendar-icon">
              <span><i class="fas fa-calendar-alt"></i></span>
            </div>
            <?php echo do_shortcode('[add_single_eventon id="'.$event_id.'" ]'); ?>
            <div class="event-date-time">
              <?php echo do_shortcode('[add_single_eventon id="'.$event_id.'" event_parts="yes" ep_fields="time,"]'); ?>
            </div>
          </div>
          <!-- /Event Date & time -->
          <!-- Event Organizer -->
          <div class="event-organizer-block">
            <div class="event-organizer">
              <!-- <span><i class="far fa-user"></i></span> -->
              <?php echo do_shortcode('[add_single_eventon id="'.$event_id.'" event_parts="yes" ep_fields="organizer,"]'); ?>
            </div>
          </div>
          <!-- /Event Organizer -->
        </div>



        <!-- <i class="fas fa-phone-alt"></i> -->
      </div>

  <?php
  }

}