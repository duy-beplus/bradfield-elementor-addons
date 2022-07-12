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
            <a href="#" id="event-btn-buy-ticket">
              buy ticket now
            </a>
          </div>
          <!-- /heading -->
          <!-- Event Date & time -->
          <div class="bradfield-event-date">
            <?php echo do_shortcode('[add_single_eventon id="'.$event_id.'" event_parts="yes" ep_fields="time,organizer,addtocal," ]'); ?>
          </div>
        </div>
        <div class="bradfield-event-thumbnail">
          <?php echo do_shortcode('[add_single_eventon id="'.$event_id.'" event_parts="yes" ep_fields="ftimage,"]'); ?>
        </div>
        <div class="bradfield-event-detail">
          <?php echo do_shortcode('[add_single_eventon id="'.$event_id.'" event_parts="yes" ep_fields="eventdetails,"]'); ?>
        </div>

        <!-- <i class="fas fa-phone-alt"></i> -->
      </div>

  <?php
  }

}
