<?php
/*
Plugin Name: SilutesKC Contact Cards
Description: Custom Gutenberg block for Contact Card.
Version: 1.0
*/
if(!defined('ABSPATH')) exit; //Exit if accessed directly

class SilutesKcContactCards {
    function __construct(){
        add_action('init', array($this, 'adminAssets'));
    }

    function adminAssets(){
        wp_register_style('siluteskccontactcardscss', plugin_dir_url(__FILE__) . 'build/index.css');
        wp_register_script('siluteskccontactcards', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element', 'wp-editor'));
        register_block_type('siluteskc/contact-cards-container', array(
            'editor_script' => 'siluteskccontactcards',
            'editor_style' => 'siluteskccontactcardscss',
            'render_callback' => array($this, 'theHtml')
        ));
    }

    function theHtml($attributes){
        if(!is_admin()){
            wp_enqueue_style('siluteskccontactcardscss', plugin_dir_url(__FILE__). 'build/index.css', array('wp-element'));
        }
        ob_start(); ?>
        <div class="fe-contact-card">
            <div class="fe-contact-card__image">
                <img class="block-image" src="<?php if(isset($attributes['imgUrl'])){echo esc_html($attributes['imgUrl']);}; ?>">
                <img class="cover-image" src="<?php if(isset($attributes['imgUrl2'])){echo esc_html($attributes['imgUrl2']);}; ?>" >
            </div>
            <!--
            <div class="fe-contact-card__cover-image">
                <img src="<?php if(isset($attributes['imgUrl2'])){echo esc_html($attributes['imgUrl2']);}; ?>" >
            </div>
    -->
            <div class="fe-contact-card__title"><?php if(isset($attributes['nameSurname'])){echo esc_html($attributes['nameSurname']);}; ?></div>
            <div class="fe-contact-card__position">
                <?php if(isset($attributes['jobPosFileUrl'])){echo "<a href=".$attributes['jobPosFileUrl']." target='_blank'>";}; ?>
                <?php if(isset($attributes['jobPosition'])){echo esc_html($attributes['jobPosition']);}; ?>
                <?php if(isset($attributes['jobPosFileUrl'])){echo "</a>";};?>
            </div>
            <?php
                if(isset($attributes['cvFileUrl'])){
                    echo '<div class="fe-contact-card__position" style="margin-top:10px;"><a target="_blank" href='. $attributes['cvFileUrl'] .'>Peržiūrėti CV</a></div>';
                };
            ?>
            <div class="fe-contact-card__rest">
                <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.8822 9.1894C12.0247 9.1894 11.1828 9.05534 10.3849 8.79178C9.99396 8.65849 9.51337 8.78077 9.27476 9.02573L7.69999 10.2141C5.8737 9.23956 4.74874 8.11541 3.78718 6.30354L4.94099 4.77039C5.24075 4.47114 5.34827 4.03401 5.21945 3.62385C4.95466 2.82213 4.82015 1.98093 4.82015 1.12343C4.82019 0.503963 4.31603 0 3.69636 0H1.12432C0.504648 0 0.000488281 0.503964 0.000488281 1.12339C0.000488281 8.22365 5.77913 14 12.8822 14C13.5018 14 14.006 13.496 14.006 12.8766V10.3127C14.0059 9.69336 13.5018 9.1894 12.8822 9.1894Z" fill="#FFB23F"/>
                </svg>
                <p>
                    <a href="tel:<?php if(isset($attributes['phoneNumber'])){echo $attributes['phoneNumber'];}; ?>"><?php if(isset($attributes['phoneNumber'])){echo esc_html($attributes['phoneNumber']);}; ?></a>
                </p>
            </div>
            <div class="fe-contact-card__rest">
                <svg width="15" height="12" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.5381 0.0234375H1.43941C1.21296 0.0234375 1.00269 0.0719428 0.808594 0.168953L7.48877 5.58537L14.1689 0.168953C13.9748 0.0719428 13.7808 0.0234375 13.5381 0.0234375Z" fill="#FFB23F"/>
                <path d="M7.94175 7.07294C7.81235 7.18611 7.65061 7.23462 7.48886 7.23462C7.32711 7.23462 7.16537 7.18611 7.03597 7.07294L0 1.36548C0 1.39782 0 1.41398 0 1.46249V10.2419C0 11.0342 0.646986 11.6809 1.43954 11.6809H13.5544C14.3469 11.6809 14.9939 11.0342 14.9939 10.2419V1.46249C14.9939 1.43015 14.9939 1.41398 14.9939 1.36548L7.94175 7.07294Z" fill="#FFB23F"/>
                </svg>
                <p>
                    <a href="mailto:<?php if(isset($attributes['emailAddress'])){echo $attributes['emailAddress'];}; ?>"><?php if(isset($attributes['emailAddress'])){echo esc_html($attributes['emailAddress']);}; ?></a>
                </p>
            </div>
        </div>
        <?php return ob_get_clean();
    }
}

$silutesKcContactCards = new SilutesKcContactCards();