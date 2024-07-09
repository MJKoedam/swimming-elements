<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Elementor_Swimming_Element_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'swimming_element';
    }

    public function get_title() {
        return __( 'Swimming Element', 'swimming-elements' );
    }

    public function get_icon() {
        return 'eicon-animation';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    protected function _register_controls() {

        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'swimming-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Fish Content
        $this->add_control(
            'fish_content',
            [
                'label' => __( 'Fish Icon', 'swimming-elements' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '<h1><b> <*͜𒅋 </b></h1>',
                'label_block' => true,
            ]
        );

        $this->end_controls_section(); // End Content Section

        // Animation Settings Section
        $this->start_controls_section(
            'animation_settings_section',
            [
                'label' => __( 'Animation Settings', 'swimming-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Mirrored Animation
        $this->add_control(
            'mirrored_animation',
            [
                'label' => __( 'Mirrored Animation', 'swimming-elements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'swimming-elements' ),
                'label_off' => __( 'No', 'swimming-elements' ),
                'default' => '',
                'description' => __( 'Enable this to mirror the swimming animation.', 'swimming-elements' ),
                'label_block' => true,
            ]
        );

        // Animation Speed
        $this->add_control(
            'animation_speed',
            [
                'label' => __( 'Animation Speed (s)', 'swimming-elements' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0.8,
                'step' => 0.1, // Step increment of 0.1
                'description' => __( 'Set the animation speed in seconds.', 'swimming-elements' ),
            ]
        );

        $this->end_controls_section(); // End Animation Settings Section

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Determine animation class based on mirrored animation setting
        $animation_class = '';
        if ( 'yes' === $settings['mirrored_animation'] ) {
            $animation_class = 'mirrored';
        }

        // Inline styles for animation
        $custom_styles = sprintf(
            'style="--animation-speed: %ss;"',
            esc_attr( $settings['animation_speed'] )
        );

        echo '<div class="swimming-container ' . $animation_class . '" ' . $custom_styles . '>';
        echo '<div class="fish-icon">' . $settings['fish_content'] . '</div>';
        echo '</div>';
    }

    protected function _content_template() {
        ?>
        <#
        var animationClass = settings.mirrored_animation ? 'mirrored' : '';
        var customStyles = `style="--animation-speed: ${settings.animation_speed}s;"`;
        #>
        <div class="swimming-container {{ animationClass }}" {{{ customStyles }}}>
            <div class="fish-icon">
                {{{ settings.fish_content }}}
            </div>
        </div>
        <?php
    }

}
?>
