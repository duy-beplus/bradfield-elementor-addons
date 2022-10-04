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

    // Start Style Tab
    $this->start_controls_section(
      'content_style_section',
      [
        'label' => esc_html__( 'Style Content', 'bradfield-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    // margin event info block
    $this->add_control(
			'event_info_block_margin',
			[
				'label' => esc_html__( 'Margin', 'bradfield-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .event-info-block' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
    // padding date time block
    $this->add_control(
			'event_info_block_padding',
			[
				'label' => esc_html__( 'Padding', 'bradfield-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .event-info-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

    $this->end_controls_section();
    // End Style Tab
  }

  protected function render() {
      // generate the final HTML on the frontend using PHP
      $settings = $this->get_settings_for_display();
      $event_id = get_the_ID();
      $now = current_time('timestamp');
      $curent_year = date("Y");
      $get_event = get_post_meta( $event_id );
      $event_repeat_intervals = get_post_meta(get_the_ID(), 'repeat_intervals', true);
      $event_start_time = get_post_meta(get_the_ID(), 'evcal_srow', true);
      $event_end_time = get_post_meta(get_the_ID(), 'evcal_erow', true);
      $event_repeat = get_post_meta(get_the_ID(), 'evcal_repeat', true);
      $get_ticket_status = get_post_meta(get_the_ID(), 'evotx_tix', true);

        if ($event_repeat !== 'yes') {
          ?>
          <style media="screen">
            .bradfield-event-date .evocard_box.time{
              border-bottom: 1px solid #D9D9D9;
            }
          </style>
          <?php
        }
      ?>
      <div id="content-single-event" class="content-single-container">
        <?php //print_r($get_event); ?>
          <div class="event-info-block">
            <!-- heading -->
            <div class="event-info-heading">
              <h1 class="event-title"><?php echo the_title(); ?></h1>
              <?php if ($get_ticket_status == 'yes'): ?>
                <a href="<?php echo get_permalink($get_event['tx_woocommerce_product_id'][0]); ?>" id="event-btn-buy-ticket">
                  buy ticket now
                </a>
              <?php endif; ?>
            </div>
            <!-- /heading -->

            <!-- Event Date & time -->
            <div class="bradfield-event-date">
              <?php echo do_shortcode('[add_single_eventon id="'.$event_id.'" event_parts="yes" ep_fields="time,repeats,organizer,addtocal" ]'); ?>
            </div>
          </div>

          <!-- Event Thumbnail -->
          <div class="bradfield-event-thumbnail">
            <?php echo do_shortcode('[add_single_eventon id="'.$event_id.'" event_parts="yes" ep_fields="ftimage,"]'); ?>
          </div><!-- /Event Thumbnail -->

          <!-- Event Detail -->
          <div class="bradfield-event-detail">
            <?php echo do_shortcode('[add_single_eventon id="'.$event_id.'" event_parts="yes" ep_fields="eventdetails,"]'); ?>
          </div><!-- /Event Detail -->

      </div>

  <?php
  }
}
