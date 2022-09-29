<?php

/*******
 *
 *
 *
 ****/

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

class LoadEventByOptions extends Widget_Base
{
    public function get_name()
    {
        return 'load_event_by_options';
    }

    public function get_title()
    {
        return 'Load Events By Options';
    }

    public function get_icon()
    {
        return 'eicon-elementor';
    }

    public function get_categories()
    {
        return ['custom-category'];
    }

    public function get_keywords()
    {
        return ['key', 'value'];
    }
    // Register Script
    public function get_script_depends()
    {
        wp_register_script('event_option_script', plugins_url('assets/js/event-option.js', __FILE__));
        return [
            'event_option_script'
        ];
    }

    public function get_style_depends()
    {
        wp_register_style('event_option_style', plugins_url('assets/css/event-option.css', __FILE__));
        return [
            'event_option_style'
        ];
    }

    protected function register_query_control()
    {
        $this->start_controls_section(
            'query_control',
            [
                'label' => 'Query',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
            'select_options',
            [
                'label' => 'Select Event Options',
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'all' => 'All',
                    'ticket' => 'By have Ticket',
                    'upcoming' => 'By Upcoming',
                ],
                'default' => 'all',
                'label_block' => 'false'
            ]
        );
        $this->add_control(
            'sort_date',
            [
                'label' => 'Sort Event',
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );
        $this->end_controls_section();
    }

    protected function register_style_control()
    {
        $this->start_controls_section(
            'event_title_style',
            [
                'label' => 'Event title',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs(
            'title_style'
        );
        $this->start_controls_tab(
            'event_title_style_normal',
            [
                'label' => 'Normal'
            ]
        );
        $this->add_control(
            'title_color_normal',
            [
                'label' => 'Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-info-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'event_title_style_hover',
            [
                'label' => 'Hover'
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => 'Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-info-title:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .event-info-title',
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .event-info-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .event-info-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'event_desc_style',
            [
                'label' => 'event desc',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'desc_color',
            [
                'label' => 'Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-info-desc' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'selector' => '{{WRAPPER}} .event-info-desc',
            ]
        );
        $this->add_responsive_control(
            'desc_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .event-info-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'desc_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .event-info-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'date_style',
            [
                'label' => 'Event Date',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'date_color',
            [
                'label' => 'Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-date' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'date_typography',
                'selector' => '{{WRAPPER}} .event-date',
            ]
        );
        $this->add_responsive_control(
            'date_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .event-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'date_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .event-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'loadmore_style',
            [
                'label' => 'Loadmore Button',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs(
            'loadmore_style_tab'
        );
        $this->start_controls_tab(
            'loadmore_style_normal',
            [
                'label' => 'Normal'
            ]
        );
        $this->add_control(
            'loadmore_color_normal',
            [
                'label' => 'Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-section-loadmore input' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'loadmore_bgcolor_normal',
            [
                'label' => 'Background Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-section-loadmore input' => 'background: {{VALUE}} !important',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'loadmore_style_hover',
            [
                'label' => 'Hover'
            ]
        );
        $this->add_control(
            'loadmore_color_hover',
            [
                'label' => 'Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-section-loadmore input:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'loadmore_bgcolor_hover',
            [
                'label' => 'Background Color',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .event-section-loadmore input:hover' => 'background: {{VALUE}} !important',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'loadmore_typography',
                'selector' => '{{WRAPPER}} .event-section-loadmore input',
            ]
        );
        $this->add_responsive_control(
            'loadmore_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .event-section-loadmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'loadmore_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .event-section-loadmore input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function register_controls()
    {
        $this->register_query_control();
        $this->register_style_control();
    }

    protected function bradfield_get_events_repeat_intervals(){
      // $event_repeat_intervals = get_post_meta(get_the_ID(), 'repeat_intervals', true);
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $now = current_time('timestamp');
        $all = array(
            'post_type'       => 'ajde_events',
            'posts_per_page'  => -1,
            'order'           => $settings['sort_date'],
            'orderby'            => 'meta_value',
            'meta_key' => 'evcal_srow',
            'meta_query' => array(
              'relation' => 'OR',
                array(
                    'key' => 'evcal_srow',
                    'value' => $now,
                    'compare' => '>',
                ),
                array(
                    'key' => 'repeat_intervals',
                    'value' => $now,
                    'compare' => '>',
                ),
                array(
                    'key' => 'evcal_repeat',
                    'value' => 'yes',
                    'compare' => '=',
                ),
            ),
        );
        $ticket = array(
            'post_type'       => 'ajde_events',
            'posts_per_page'  => -1,
            'order'           => $settings['sort_date'],
            'orderby'            => 'meta_value',
            'meta_key' => 'evcal_srow',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'evotx_tix',
                    'value' => 'yes',
                ),
                array(
                    'key'     => 'evcal_srow',
                    'value' => $now,
                    'compare' => '>',
                ),
            ),
        );
        $upcoming = array(
            'post_type'       => 'ajde_events',
            'posts_per_page'  => -1,
            'order'           => $settings['sort_date'],
            'orderby'            => 'meta_value',
            'meta_key' => 'evcal_srow',
            'meta_query' => array(
              'relation' => 'OR',
                array(
                    'key' => 'evcal_srow',
                    'value' => $now,
                    'compare' => '>',
                ),
                array(
                    'key' => 'repeat_intervals',
                    'value' => $now,
                    'compare' => '>',
                ),
                array(
                    'key' => 'evcal_repeat',
                    'value' => 'yes',
                    'compare' => '=',
                ),

            ),
        );
        if ($settings['select_options'] === 'all') {
            $query = new WP_Query($all);
        } elseif ($settings['select_options'] === 'ticket') {
            $query = new WP_Query($ticket);
        } elseif ($settings['select_options'] === 'upcoming') {
            $query = new WP_Query($upcoming);
        }
?>
        <section class="event-section">
            <div class="event-section-wrap">
                <?php
                $event_array_time = [];

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();

                    $event_repeat = get_post_meta(get_the_ID(), 'evcal_repeat', true);

                    $event_repeat_intervals = get_post_meta(get_the_ID(), 'repeat_intervals', true);

                    $event_timestamp = get_post_meta(get_the_ID(), 'evcal_srow', true);

                    if ($event_repeat == 'yes' && $event_repeat_intervals) {
                      $repeat_interval_num = get_post_meta(get_the_ID(), 'evcal_rep_num', true);
                      $interval_rp_times = get_post_meta(get_the_ID(), 'repeat_intervals')[0];

                      for ($i = 0; $i <= $repeat_interval_num ; $i++) {
                          $start_time = $interval_rp_times[$i][0];
                          $event_item = array(
                              'id' => get_the_ID(),
                              'title' => get_the_title(),
                              'start_time' => $start_time,
                            );
                          array_push($event_array_time, $event_item);
                      }
                    } else {
                           $event_item = array(
                               'id' => get_the_ID(),
                               'title' => get_the_title(),
                               'start_time' => get_post_meta(get_the_ID(), 'evcal_srow', true),
                             );
                           array_push($event_array_time, $event_item);
                    }
                  endwhile;
                endif;
                wp_reset_postdata();

                // Sort events array by timestamp
                usort($event_array_time, function ($item1, $item2) {
                  if ($item1['start_time'] == $item2['start_time']) return 0;
                  return $item1['start_time'] < $item2['start_time'] ? -1 : 1;
                });

                foreach ($event_array_time as $event_time):
                  if ($event_time['start_time'] > $now) {
                  ?>
                    <a href="<?php echo get_the_permalink($event_time['id']); ?>" class="event-items">
                        <div class="event-items-thumbnail">
                          <?php
                          if ( has_post_thumbnail($event_time['id']) ) {
                            echo get_the_post_thumbnail($event_time['id'], 'full');
                          }
                          else { ?>
                            <img src="<?php echo plugins_url(); ?>/bradfield-elementor-addons/assets/imgs/calendar-thumnail-default.png" alt="">
                          <?php  }  ?>
                        </div>
                        <div class="event-items-info">
                            <div class="event-info-title"><?php echo $event_time['title']; ?></div>
                            <div class="event-info-desc"><?php echo get_post_meta($event_time['id'], 'evcal_subtitle', true) ?></div>
                        </div>
                        <div class="event-date">
                            <?php
                            if ($settings['select_options'] === 'ticket') {
                                echo '<div class="warning">Ticket</div>';
                            } elseif ($settings['select_options'] === 'upcoming') {
                                echo '<div class="warning">Upcoming Event</div>';
                            }
                            ?>
                            <?php echo gmdate("F d, Y - g:i:a", $event_time['start_time']); ?>
                        </div>
                    </a>
                    <?php
                    }
                endforeach;
                ?>
            </div>
            <div class="event-section-loader">
                <div class="event-section-loadmore">
                    <input type="submit" value="Load more" id="load-more">
                </div>
                <div class="event-section-preload">
                    <img src="<?php echo site_url() ?>/wp-content/uploads/2022/07/Ellipse-loadmore.png" alt="">
                </div>
            </div>
        </section>

<?php
    }
}
