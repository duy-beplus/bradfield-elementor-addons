<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Upcoming_Events extends \Elementor\Widget_Base {
  public function get_name() {
      return 'upcoming-events-widget';
  }

  public function get_title() {
      return __( 'Upcoming Events');
  }

  public function get_icon() {
      return 'eicon-calendar';
  }

  public function get_categories() {
      return [ 'custom-category' ];
  }

  public function get_keywords() {
    return [ 'upcoming', 'events' ];
  }

  protected function register_controls() {

    $this->start_controls_section(
    'content_section',
      [
        'label' => esc_html__( 'Content', 'community-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
			'event_per_page',
			[
				'label' => esc_html__( 'Event per page', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 3,
			]
		);

    $this->end_controls_section();

  }

  protected function render() {
      // generate the final HTML on the frontend using PHP
      $settings = $this->get_settings_for_display();
      $postMeta = get_post_meta( get_the_ID());

      $current_date_unix = strtotime(date("F d, Y H:i:s"));
      // print_r($current_date_unix);
      $now = current_time('timestamp');


      $args = array(
            'post_type'       => 'ajde_events',
            'posts_per_page'	=> $settings['event_per_page'],
	          'order'		      	=> 'ASC',
            'meta_key'			=> 'evcal_srow',
	          'orderby'			=> 'meta_value',
            'meta_query' => array(
                array(
                    'key' => 'evcal_srow',
                    'value' => $now,
                    'compare' => '>',
                ) ,
            ) ,
         );
        $the_query = new WP_Query( $args );
        $count_event = $the_query->post_count;

        if ($count_event == 2) {
          $passed_event_per_page = 1;
        }
        elseif ($count_event == 1)
        {
          $passed_event_per_page = 2;
        }
        elseif ($count_event == 0)
        {
          $passed_event_per_page = 3;
        }

         $args_event_pased = array(
               'post_type'       => 'ajde_events',
               'posts_per_page'	=> $passed_event_per_page,
   	           'order'		      	=> 'DESC',
               'meta_key'			=> 'evcal_srow',
   	           'orderby'			=> 'meta_value',
               'meta_query' => array(
                   array(
                       'key' => 'evcal_srow',
                       'value' => $now,
                       'compare' => '<',
                   ) ,
               ) ,
            );
          $query_passed_event = new WP_Query( $args_event_pased );
      ?>
      <div class="upcoming-event-wrapper">
        <!-- Upcoming events -->
      <?php
      // The Loop
      if ( $the_query->have_posts() ) :
      while ( $the_query->have_posts() ) : $the_query->the_post();
        // Do Stuff
        ?>
        <div class="upcoming-event-item" style="background: url('<?php the_post_thumbnail_url(); ?>') top center;">
        <a class="upcoming-event-link" href="<?php echo get_permalink(); ?>">
        <div class="upcoming-event-item-block" >
          <span class="event-type">Upcoming events</span>
          <span class="event-meta-date">
          <?php
            $event_meta_date = get_post_meta( get_the_ID(), 'evcal_srow', true);
            echo gmdate("F d, Y - g:i a", $event_meta_date);
           ?>
         </span>
          <h3 class="upcoming-event-title"> <?php echo the_title(); ?></h3>
        </div>
        </a>
        <?php
          $get_event = get_post_meta( get_the_ID());
          if ($get_event['evotx_tix'][0] == 'yes'): ?>
          <a href="<?php echo get_permalink($get_event['tx_woocommerce_product_id'][0]); ?>" class="upcomming-btn-buy-ticket">
            Buy Ticket
          </a>
        <?php endif; ?>
      </div>
      <?php
      endwhile;
      endif;
      // Reset Post Data
      wp_reset_postdata();
      ?>
      <!-- Passed events -->
      <?php
      if ($count_event < 3):
      // The Loop
      if ( $query_passed_event->have_posts() ) :
      while ( $query_passed_event->have_posts() ) : $query_passed_event->the_post();
        // Do Stuff
        ?>
        <div class="upcoming-event-item" style="background: url('<?php the_post_thumbnail_url(); ?>') top center;">
        <a class="upcoming-event-link" href="<?php echo get_permalink(); ?>">
        <div class="upcoming-event-item-block" >
          <span class="event-type" style="background-color: #c7443a;">Passed events</span>
          <span class="event-meta-date">
          <?php
            $event_meta_date = get_post_meta( get_the_ID(), 'evcal_srow', true);
            echo gmdate("F d, Y - g:i a", $event_meta_date);
           ?>
         </span>
          <h3 class="upcoming-event-title"> <?php echo the_title(); ?></h3>
        </div>
        </a>
      </div>
        <?php
      endwhile;
      endif;
      endif;
      // Reset Post Data
      wp_reset_postdata();
      ?>
      </div>
      <?php

  }
}