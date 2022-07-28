<?php

/*******
 *
 *
 *
 ****/

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use ElementorPro\Modules\MotionFX\Controls_Group;

class UpcomingEventWidget extends Widget_Base
{
    public function get_name()
    {
        return 'upcoming_event';
    }

    public function get_title()
    {
        return 'Upcoming Event';
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
        wp_register_script('upcoming_event_script', plugins_url('assets/js/upcoming-event.js', __FILE__), array(), rand(1, 9999));
        return [
            'upcoming_event_script'
        ];
    }

    public function get_style_depends()
    {
        wp_register_style('upcoming_event_style', plugins_url('assets/css/upcoming-event.css', __FILE__), array(), rand(1, 9999));
        return [
            'upcoming_event_style'
        ];
    }

    protected function register_query_controls()
    {
        $this->start_controls_section(
            'upcoming_query',
            [
                'label' => 'Query',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $getPosts = get_posts(
            array(
                'numberposts' => -1,
                'post_type' => 'ajde_events'
            )
        );
        $optionEvents = [];
        foreach ($getPosts as $getPost) {
            $optionEvents[$getPost->ID] = $getPost->post_title;
        }
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'event_list',
            [
                'label' => 'Event List',
                'type' => Controls_Manager::SELECT,
                'options' => $optionEvents
            ]
        );
        $this->add_control(
            'upcoming_event',
            [
                'label' => 'Select Upcoming Event',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls()
            ]
        );
        $this->end_controls_section();
    }

    protected function register_controls()
    {
        $this->register_query_controls();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $upcomingEvent = $settings['upcoming_event'];
?>
        <div class="upcoming-event">
            <?php
            foreach ($upcomingEvent as $items) :
                $item = get_post($items['event_list']);
                print_r($item);
            ?>
                <div class="upcoming-item">
                    <div class="event-thumbnail">
                        <?php echo get_the_post_thumbnail($item->ID, 'full') ?>
                    </div>
                    <div class="event-info">
                        <?php echo get_the_title($item->ID); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
<?php
    }
}
