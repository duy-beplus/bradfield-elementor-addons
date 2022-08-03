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
        'label' => esc_html__( 'Content', 'bradfield-elementor-addon' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
			'show_events_ticket',
			[
				'label' => esc_html__( 'Show Only Event Ticket', 'bradfield-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'your-plugin' ),
				'label_off' => esc_html__( 'No', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

    $this->add_control(
			'show_feature_events',
			[
				'label' => esc_html__( 'Show Feature Events', 'bradfield-elementor-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'your-plugin' ),
				'label_off' => esc_html__( 'No', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

    $this->add_control(
			'event_per_page',
			[
				'label' => esc_html__( 'Event per page', 'bradfield-elementor-addon' ),
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
      $now = current_time('timestamp');
      $show_events_option = $settings['show_events_ticket'];

      if ($settings['show_feature_events'] == 'yes') {
      $args_featured = array(
            'post_type'       => 'ajde_events',
            'posts_per_page'	=> 3,
            'order'		      	=> 'ASC',
            'meta_key'			=> 'evcal_srow',
            'orderby'			=> 'meta_value',
            'meta_query' => array(
              'relation' => 'AND',
                array(
                    'key' => 'evcal_srow',
                    'value' => $now,
                    'compare' => '>',
                ),
                array(
                    'key' => 'evotx_tix',
                    'value' => 'yes',
                ),
                array(
                    'key' => '_featured',
                    'value' => 'yes',
                ),
            ),
         );

         $the_featured_query = new WP_Query( $args_featured );
         $count_featured = $the_featured_query->post_count;

         if ($count_featured == 2) {
           $upcoming_event_per_page = 1;
         }
         elseif ($count_featured == 1)
         {
           $upcoming_event_per_page = 2;
         }
         elseif ($count_featured == 0)
         {
           $upcoming_event_per_page = 3;
         }
       }

      if ($settings['show_events_ticket'] == 'yes') {
        $args = array(
              'post_type'       => 'ajde_events',
              'posts_per_page'	=> $upcoming_event_per_page,
  	          'order'		      	=> 'ASC',
              'meta_key'			=> 'evcal_srow',
  	          'orderby'			=> 'meta_value',
              'meta_query' => array(
                  'relation' => 'AND',
                  array(
                      'key' => 'evcal_srow',
                      'value' => $now,
                      'compare' => '>',
                  ),
                  array(
                      'key' => 'evotx_tix',
                      'value' => 'yes',
                  ),
              ),
           );
      }
      else {
        $args = array(
              'post_type'       => 'ajde_events',
              'posts_per_page'	=> $upcoming_event_per_page,
  	          'order'		      	=> 'ASC',
              'meta_key'			=> 'evcal_srow',
  	          'orderby'			=> 'meta_value',
              'meta_query' => array(
                  array(
                      'key' => 'evcal_srow',
                      'value' => $now,
                      'compare' => '>',
                  ),
              ),
           );
      }

        $the_query = new WP_Query( $args );
        $count_upcoming = $the_query->post_count;

        if ($count_upcoming == 2) {
          $passed_event_per_page = 1;
        }
        elseif ($count_upcoming == 1)
        {
          $passed_event_per_page = 2;
        }
        elseif ($count_upcoming == 0)
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
        <!-- Featured events -->
        <?php
        if ($settings['show_feature_events'] == 'yes'):
        // The Loop
        if ( $the_featured_query->have_posts() ) :
        while ( $the_featured_query->have_posts() ) : $the_featured_query->the_post();
          // Do Stuff
          ?>
          <div class="upcoming-event-item" style="background: url('<?php the_post_thumbnail_url(); ?>') top center;">
          <a class="upcoming-event-link" href="<?php echo get_permalink(); ?>">
          <div class="upcoming-event-item-block" >
            <?php
              $events_meta = get_post_meta( get_the_ID());
             if ($events_meta['_featured'][0] == 'yes'): ?>
              <span class="event-type" style="background-color: orange;"><i aria-hidden="true" class="fas fa-star"></i> Featured event</span>
            <?php else:?>
              <span class="event-type">Upcoming event</span>
              <?php endif; ?>
            <span class="event-meta-date">
            <?php
              $event_meta_date = get_post_meta( get_the_ID(), 'evcal_srow', true);
              echo gmdate("F d, Y - g:i a", $event_meta_date);
             ?>
           </span>

            <h3 class="upcoming-event-title">
               <?php echo the_title(); ?>
             </h3>
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
        endif;
        // Reset Post Data
        wp_reset_postdata();
        ?>

        <!-- Upcoming events -->
      <?php
      if ($count_featured < 3):
      // The Loop
      if ( $the_query->have_posts() ) :
      while ( $the_query->have_posts() ) : $the_query->the_post();
        // Do Stuff
        ?>
        <div class="upcoming-event-item" style="background: url('<?php the_post_thumbnail_url(); ?>') top center;">
        <a class="upcoming-event-link" href="<?php echo get_permalink(); ?>">
        <div class="upcoming-event-item-block" >
          <?php
            $events_meta = get_post_meta( get_the_ID());
           if ($events_meta['_featured'][0] == 'yes'): ?>
            <span class="event-type" style="background-color: orange;">Featured event</span>
          <?php else:?>
            <span class="event-type">Upcoming event</span>
            <?php endif; ?>
          <span class="event-meta-date">
          <?php
            $event_meta_date = get_post_meta( get_the_ID(), 'evcal_srow', true);
            echo gmdate("F d, Y - g:i a", $event_meta_date);
           ?>
         </span>

          <h3 class="upcoming-event-title">
             <?php echo the_title(); ?>
           </h3>
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
      endif;
      // Reset Post Data
      wp_reset_postdata();
      ?>

      <!-- Passed events -->
      <?php
      if ($count_upcoming < 3 && $count_featured == 0):
      // The Loop
      if ( $query_passed_event->have_posts() ) :
      while ( $query_passed_event->have_posts() ) : $query_passed_event->the_post();
        // Do Stuff
        ?>
        <div class="upcoming-event-item" style="background: url('<?php the_post_thumbnail_url(); ?>') top center;">
        <a class="upcoming-event-link" href="<?php echo get_permalink(); ?>">
        <div class="upcoming-event-item-block" >
          <span class="event-type" style="background-color: #c7443a;">Passed event</span>
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
