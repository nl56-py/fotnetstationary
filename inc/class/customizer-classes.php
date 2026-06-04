<?php 

if(class_exists('WP_Customize_Control')){

    class luzuk_Switch_Control extends WP_Customize_Control{
        public $type = 'switch';
        public $on_off_label = array();

        public function __construct($manager, $id, $args = array() ){
            $this->on_off_label = $args['on_off_label'];
            parent::__construct( $manager, $id, $args );
        }

        public function render_content(){
            ?>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>
            <?php if($this->description){ ?>
            <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
            </span>
            <?php } ?>
            <?php
            $switch_class = ($this->value() == 'on') ? 'switch-on' : '';
            $on_off_label = $this->on_off_label;
            ?>
            <div class="onoffswitch <?php echo $switch_class; ?>">
                <div class="onoffswitch-inner">
                    <div class="onoffswitch-active">
                        <div class="onoffswitch-switch"><?php echo esc_html($on_off_label['on']) ?></div>
                    </div>

                    <div class="onoffswitch-inactive">
                        <div class="onoffswitch-switch"><?php echo esc_html($on_off_label['off']) ?></div>
                    </div>
                </div>  
            </div>
            <input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr($this->value()); ?>"/>
            <?php
        }
    }

    class luzuk_Customize_Heading extends WP_Customize_Control {
        public $type = 'heading';

        public function render_content() {
            if ( !empty( $this->label ) ) : ?>
            <h3 class="total-accordion-section-title"><?php echo esc_html( $this->label ); ?></h3>
        <?php endif;

        if($this->description){ ?>
        <span class="description customize-control-description">
            <?php echo wp_kses_post($this->description); ?>
        </span>
        <?php }
    }
}

class luzuk_Fontawesome_Icon_Chooser extends WP_Customize_Control{
    public $type = 'icon';

    public function render_content(){
        ?>
        <label>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>

            <?php if($this->description){ ?>
            <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
            </span>
            <?php } ?>

            <div class="total-selected-icon">
                <i class="fa <?php echo esc_attr($this->value()); ?>"></i>
                <span><i class="fa fa-angle-down"></i></span>
            </div>
            <ul class="total-icon-list clearfix">
                <?php
                $luzuk_font_awesome_icon_array = luzuk_font_awesome_icon_array();
                foreach ($luzuk_font_awesome_icon_array as $luzuk_font_awesome_icon) {
                    $icon_class = $this->value() == $luzuk_font_awesome_icon ? 'icon-active' : '';
                    echo '<li class='.$icon_class.'><i class="'.$luzuk_font_awesome_icon.'"></i></li>';
                }
                ?>
            </ul>
            <input type="hidden" value="<?php $this->value(); ?>" <?php $this->link(); ?> />
        </label>
        <?php
    }
}

class luzuk_Dropdown_Chooser extends WP_Customize_Control{
    public $type = 'dropdown_chooser';

    public function render_content(){
        if ( empty( $this->choices ) )
            return;
        ?>
        <label>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>

            <?php if($this->description){ ?>
            <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
            </span>
            <?php } ?>

            <select class="hs-chosen-select" <?php $this->link(); ?>>
                <?php
                foreach ( $this->choices as $value => $label )
                    echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html( $label ) . '</option>';
                ?>
            </select>
        </label>
        <?php
    }
}

class luzuk_Display_Gallery_Control extends WP_Customize_Control{
    public $type = 'gallery';

    public function render_content() {
        ?>
        <label>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>

            <?php if($this->description){ ?>
            <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
            </span>
            <?php } ?>

            <div class="gallery-screenshot clearfix">
                <?php
                {
                    $ids = explode( ',', $this->value() );
                    foreach ( $ids as $attachment_id ) {
                        $img = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
                        echo '<div class="screen-thumb"><img src="' . esc_url($img[0]) . '" /></div>';
                    }
                }
                ?>
            </div>

            <input id="edit-gallery" class="button upload_gallery_button" type="button" value="<?php _e('Add/Edit Gallery','total') ?>" />
            <input id="clear-gallery" class="button upload_gallery_button" type="button" value="<?php _e('Clear','total') ?>" />
            <input type="hidden" class="gallery_values" <?php echo $this->link() ?> value="<?php echo esc_attr( $this->value() ); ?>">
        </label>
        <?php
    }
}

class luzuk_Customize_Checkbox_Multiple extends WP_Customize_Control {
    public $type = 'checkbox-multiple';
    public function render_content() {
        if ( empty( $this->choices ) )
            return; ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php if ( !empty( $this->description ) ) : ?>
            <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
        <?php endif; ?>
        <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>
        <ul>
            <?php foreach ( $this->choices as $value => $label ) : ?>
                <li>
                    <label>
                        <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /> 
                        <?php echo esc_html( $label ); ?>
                    </label>
                </li>
            <?php endforeach; ?>
        </ul>
        <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
        <?php }
    }

    class luzuk_Dropdown_Multiple_Chooser extends WP_Customize_Control{
        public $type = 'dropdown_multiple_chooser';
        public $placeholder = '';
        public function __construct($manager, $id, $args = array()){
            $this->placeholder = $args['placeholder'];
            unset($args['placeholder']);
            parent::__construct( $manager, $id, $args );
        }
        public function render_content(){
            if ( empty( $this->choices ) ){
                return;
            }
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html( $this->label ); ?>
                </span>
                <?php if($this->description){ ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php } ?>
                <select data-placeholder="<?php echo esc_html( $this->placeholder ); ?>" multiple="multiple" class="hs-chosen-select" <?php $this->link(); ?>>
                    <?php
                    foreach ( $this->choices as $value => $label ){
                        $selected = '';
                        if(in_array($value, $this->value())){
                            $selected = 'selected="selected"';
                        }
                        echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . esc_html($label) . '</option>';
                    }
                    ?>
                </select>
            </label>
            <?php
        }
    }

    class luzuk_Category_Dropdown extends WP_Customize_Control{
        private $cats = false;

        public function __construct($manager, $id, $args = array(), $options = array()){
            $this->cats = get_categories($options);

            parent::__construct( $manager, $id, $args );
        }

        public function render_content(){
            if(!empty($this->cats)){
                ?>
                <label>
                    <span class="customize-control-title">
                        <?php echo esc_html( $this->label ); ?>
                    </span>

                    <?php if($this->description){ ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                    <?php } ?>

                    <select <?php $this->link(); ?>>
                       <?php
                       foreach ( $this->cats as $cat )
                       {
                        printf('<option value="%s" %s>%s</option>', esc_attr($cat->term_id), selected($this->value(), $cat->term_id, false), esc_html($cat->name));
                    }
                    ?>
                </select>
            </label>
            <?php
        }
    }
}

class luzuk_Info_Text extends WP_Customize_Control{
    public function render_content(){
        ?>
        <span class="customize-control-title">
            <?php echo esc_html( $this->label ); ?>
        </span>

        <?php if($this->description){ ?>
        <span class="description customize-control-description">
            <?php echo wp_kses_post($this->description); ?>
        </span>
        <?php }
    }

}

class luzuk_Font_Chooser extends WP_Customize_Control{
    public $type = 'dropdown_chooser';

    public function render_content(){
        if ( empty( $this->choices ) )
            return;
        $font = getFonts(false);
        ?>
        <label>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>

            <?php if($this->description){ ?>
            <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
            </span>
            <?php } ?>

            <select class="" <?php $this->link(); ?>>
                <?php
                foreach ( $this->choices as $value => $label )
                    echo '<option style="font-family:'.$font[$value].';" value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html( $label ) . '</option>';
                ?>
            </select>
        </label>
        <?php
    }
}
}

/**
 * Manage the bacbround for the home page sections
 * 
 **/function backgroundManager($wp_customize, $id, $section, $color='#fff', $img='', $imgOrColor = 'img'){
    // Manage the background SECTION
    
    $wp_customize->add_setting(
        'luzuk_'.$id.'_title_heading1',
        array(
            'sanitize_callback' => 'luzuk_sanitize_text'
        )
    );
    $wp_customize->add_control(
        new luzuk_Customize_Heading(
            $wp_customize,
            'luzuk_'.$id.'_title_heading1',
            array(
                'settings'      => 'luzuk_'.$id.'_title_heading1',
                'section'       => $section,
                'label'         => __( 'Manage Background', 'Luzuk Premium' ),
            )
        )
    );
    $def = ($imgOrColor == 'img')?'off':'on';
    $wp_customize->add_setting(
        'luzuk_premium_'.$id.'_section_background',
        array(
            'sanitize_callback' => 'luzuk_sanitize_text',
            'default'=> $def,
        )
    );
    
    $wp_customize->add_control(
        new luzuk_Switch_Control(
            $wp_customize,
            'luzuk_premium_'.$id.'_section_background',
            array(
                'settings'      => 'luzuk_premium_'.$id.'_section_background',
                'section'       => $section,
                'label'         => __( 'Manage background by', 'Luzuk Premium' ),
                'on_off_label'  => array(
                    'on' => __( 'Image', 'Luzuk Premium' ),
                    'off' => __( 'Color', 'Luzuk Premium' )
                ),
            )
        )
    );
    
    //colour
    $wp_customize->add_setting(
        'luzuk_'.$id.'_bg_color',
        array(
            'default'           => $color,
            'sanitize_callback' => 'sanitize_hex_color',
            'priority' => 1
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'luzuk_'.$id.'_bg_color',
            array(
                'settings'      => 'luzuk_'.$id.'_bg_color',
                'section'       => $section,
                'label'         => __( 'Background Color ', 'luzuk Premium' ),
            )
        )
    );
    // bg image
    $img = empty($img)?get_template_directory_uri().'/images/default-gray.png':$img;
    $wp_customize->add_setting(
        'luzuk_'.$id.'_bg_image',
        array(
            'default'           => $img,
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'luzuk_'.$id.'_bg_image',
            array(
                'section' => $section,
                'settings' => 'luzuk_'.$id.'_bg_image',
                'label' => __( 'Background Image ', 'Luzuk Premium' ),
                'description' => __('Recommended Image Size: 1900X600px', 'Luzuk Premium')
            )
        )
    );
}



/**
 * Add the color option for the sections palate 
 * @param object $wpCustomizer an object of a WP customizer object
 * @param string $id an id for an element and the name that will be used at front end
 * @param string $section name of the section where the option will list
 * @param string $label The label for the color option default is "Choose Color"
 * @param string $color a default colour code for the color option, Default colour code is "#fff"
 * @return void
 * @author Logical <support@logicalthemes.com>
 * @since Since V1.0
 *
 **/
function addColorPalatOption($wpCustomizer, $id, $section, $label="Choose Color", $color = '#ffffff'){
    $wpCustomizer->add_setting(
        $id,
        array(
            'default'           => $color,
            'sanitize_callback' => 'sanitize_hex_color',
            'priority' => 1
        )
    );
    $wpCustomizer->add_control(
        new WP_Customize_Color_Control(
            $wpCustomizer,
            $id,
            array(
                'settings'      => $id,
                'section'       => $section,
                'label'         => __( $label, 'Luzuk Premium' ),
            )
        )
    );
}


/**
 * Add the Radio buttons with graphical html for the sections palate 
 * @param object $wpCustomizer an object of a WP customizer object
 * @param string $id an id for an element and the name that will be used at front end
 * @param string $section name of the section where the option will list
 * @param string $label The label for the color option default is "Label"
 * @return void
 * @author Logical <support@logicalthemes.com>
 * @since Since V1.0
 *
 **/
function lzAddCustomRadio($wpCustomizer, $id, $section, $label="Label"){
    $wpCustomizer->add_setting($id,array('sanitize_callback' => 'luzuk_sanitize_text','default' => 'off'));
    $wpCustomizer->add_control(
        new luzuk_Switch_Control($wpCustomizer,$id,
            array(
                'settings'=> $id,
                'section'=> $section,
                'label'=> __( $label, 'Luzuk Premium' ),
                'on_off_label' => array(
                    'on' => __( 'Yes', 'Luzuk Premium' ),
                    'off' => __( 'No', 'Luzuk Premium' )
                )
            )
        )
    );
}

/**
 * Add the label for the sections palate 
 * @param object $wpCustomizer an object of a WP customizer object
 * @param string $id an id for an element and the name that will be used at front end
 * @param string $section name of the section where the option will list
 * @param string $label The label for the color option default is "Label"
 * @return void
 * @author Logical <support@logicalthemes.com>
 * @since Since V1.0
 *
 **/
function lzAddElement($wpCustomizer, $id, $section, $type = 'text', $label="Label", $callback ='luzuk_sanitize_text', $default='Add description here'){
    addSetting($wpCustomizer, $id, $callback, $default);
    $wpCustomizer->add_control(
        $id,
        array(
            'settings'      => $id,
            'section'       => $section,
            'type'          => $type,
            'label'         => __( $label, 'Luzuk Premium' )
        )
    );
}

/**
 * Adding the setting for an option
 * @param object $wpCustomizer an object of a WP customizer object
 * @param string $id an id for an element and the name that will be used at front end
 * @param string $callback callback function default is "luzuk_sanitize_text"
 * @param string $default Set the default value for the control default is 'Add description here'
 * @return void
 * @author Logical <support@logicalthemes.com>
 * @since Since V1.0
 *
 **/
function addSetting($wpCustomizer, $id, $callback ='luzuk_sanitize_text', $default='Add description here'){
    $params = array('sanitize_callback' => $callback);
    if($default != ""){
        $params['default']= __( $default, 'Luzuk Premium' );
    }
    $wpCustomizer->add_setting($id, $params);
}

/**
 * Add the label for the sections palate 
 * @param object $wpCustomizer an object of a WP customizer object
 * @param string $id an id for an element and the name that will be used at front end
 * @param string $section name of the section where the option will list
 * @param string $label The label for the color option default is "Label"
 * @return void
 * @author Logical <support@logicalthemes.com>
 * @since Since V1.0
 *
 **/
function lzCustomLable($wpCustomizer, $id, $section, $label="Label"){
    // echo 'section: '.$section;
    addSetting($wpCustomizer, $id.'1', 'luzuk_sanitize_text', $default='');
    $wpCustomizer->add_control(
        new luzuk_Customize_Heading(
            $wpCustomizer,
            $id.'1',
            array(
                'settings' => $id.'1',
                'section' => $section,
                'label' => __( $label, 'Luzuk Premium' ),
            )
        )
    );
}

/**
 * Add the image element for the sections palate 
 * @param object $wpCustomizer an object of a WP customizer object
 * @param string $id an id for an element and the name that will be used at front end
 * @param string $section name of the section where the option will list
 * @param string $label The label for the color option default is "Label"
 * @return void
 * @author Logical <support@logicalthemes.com>
 * @since Since V1.0
 *
 **/
function lzAddImageElement($wpCustomizer, $id, $section, $label="Recommended Image Size: 400X300px"){
    addSetting($wpCustomizer, $id, 'esc_url_raw', $default='');
    $wpCustomizer->add_control(
        new WP_Customize_Image_Control(
            $wpCustomizer,
            $id,
            array(
                'settings' => $id,
                'section' => $section,
                'description' => __($label, 'Luzuk Premium')
            )
        )
    );
}







