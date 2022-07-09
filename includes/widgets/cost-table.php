<?php

/*******
 *
 *
 *
 ****/

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

class CostTableWidget extends Widget_Base
{
    public function get_name()
    {
        return "cost_table";
    }

    public function get_title()
    {
        return "Costs Table";
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
        wp_register_script('cost_table_script', plugins_url('assets/js/cost-table.js', __FILE__));
        return [
            'cost_table_script'
        ];
    }

    public function get_style_depends()
    {
        wp_register_style('cost_table_style', plugins_url('assets/css/cost-table.css', __FILE__));
        return [
            'cost_table_style'
        ];
    }

    protected function register_control_content()
    {
        $this->start_controls_section(
            'heading-section',
            [
                'label' => 'Heading',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control(
            'heading',
            [
                'label' => 'Heading',
                'type' => Controls_Manager::TEXT,
                'default' => 'Costs',
                'label_block' => 'false',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'content_table',
            [
                'label' => 'Content Table',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'column_name',
            [
                'label' => 'Column name',
                'type' => Controls_Manager::TEXT,
                'label_block' => 'false'
            ]
        );
        $repeater->add_control(
            'column_content',
            [
                'label' => 'Column content',
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => 'false'
            ]
        );
        $this->add_control(
            'table_repeater',
            [
                'label' => 'Create Table',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ column_name }}}',
                'default' => [
                    [
                        'column_name' => 'Column #1',
                        'column_content' => 'Content column #1',
                    ],
                    [
                        'column_name' => 'Column #2',
                        'column_content' => 'Content column #2',
                    ],
                    [
                        'column_name' => 'Column #3',
                        'column_content' => 'Content column #3',
                    ],
                ]
            ]
        );
        $this->end_controls_section();
    }

    protected function register_control_style()
    {
        $this->start_controls_section(
            'settings_table',
            [
                'label' => 'Setting Table',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'heading_color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cost_table-heading h2' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .cost_table-heading h2',
            ]
        );
        $this->add_control(
            'heading_alignment',
            [
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label' => 'Alignment',
                'options' => [
                    'left' => [
                        'title' => 'Left',
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => 'Center',
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => 'Right',
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cost_table-heading h2' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'heading_padding',
            [
                'label' => 'Padding',
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cost_table-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'first_width',
            [
                'label' => 'First column width',
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 48,
                ],
                'selectors' => [
                    '{{WRAPPER}} .cost_table-section tr th:first-child' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .cost_table-section tr td:first-child' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'child_width',
            [
                'label' => 'Child column width',
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 27,
                ],
                'selectors' => [
                    '{{WRAPPER}} .cost_table-section tr th' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .cost_table-section tr td' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'table_border_radius',
            [
                'label' => 'Border radius',
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cost_table-section table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'column_name_style',
            [
                'label' => 'Column name style',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'column_name_color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cost_table-section tr th' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'column_name_bgcolor',
            [
                'label' => 'Background color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cost_table-section tr th' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'column_name_typography',
                'selector' => '{{WRAPPER}} .cost_table-section tr th',
            ]
        );
        $this->add_control(
            'column_name_alignment',
            [
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label' => 'Alignment',
                'options' => [
                    'left' => [
                        'title' => 'Left',
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => 'Center',
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => 'Right',
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cost_table-section tr th' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'column_name_padding',
            [
                'label' => 'Padding',
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cost_table-section tr th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'column_content_style',
            [
                'label' => 'Column content style',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control(
            'column_content_color',
            [
                'label' => 'Color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cost_table-section tr td' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'column_content_bgcolor',
            [
                'label' => 'Background color',
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cost_table-section tr td' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'column_content_typography',
                'selector' => '{{WRAPPER}} .cost_table-section tr td',
            ]
        );
        $this->add_control(
            'column_content_alignment',
            [
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label' => 'Alignment',
                'options' => [
                    'left' => [
                        'title' => 'Left',
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => 'Center',
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => 'Right',
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cost_table-section tr td' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'column_content_padding',
            [
                'label' => 'Padding',
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cost_table-section tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function register_controls()
    {
        $this->register_control_content();
        $this->register_control_style();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <section class="cost_table-section">
            <div class="cost_table-heading">
                <h2><?php echo $settings['heading'] ?></h2>
            </div>
            <div class="cost_table-body">
                <table>
                    <thead>
                        <tr>
                            <?php foreach ($settings['table_repeater'] as $item) : ?>
                                <th><?php echo $item['column_name'] ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach ($settings['table_repeater'] as $item) : ?>
                                <td><?php echo $item['column_content'] ?></td>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
<?php
    }
}
