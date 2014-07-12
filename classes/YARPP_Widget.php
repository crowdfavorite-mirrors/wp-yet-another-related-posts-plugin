<?php
/*
 * Vaguely based on code by MK Safi
 * http://msafi.com/fix-yet-another-related-posts-plugin-yarpp-widget-and-add-it-to-the-sidebar/
 */
class YARPP_Widget extends WP_Widget {

	public function __construct() {
<<<<<<< HEAD
		parent::WP_Widget(false, $name = __('Related Posts (YARPP)','yarpp'));
	}

	public function widget($args, $instance) {
		global $yarpp;

		if (!is_singular()) return;

=======
		parent::WP_Widget(false, 'Related Posts (YARPP)', array('description' => 'Related Posts and/or Sponsored Content'));
        wp_enqueue_style('yarppWidgetCss', YARPP_URL.'/style/widget.css');
	}

	public function widget($args, $instance) {
        if (!is_singular()) return;

		global $yarpp;
>>>>>>> 4.2.2
		extract($args);

		/* Compatibility with pre-3.5 settings: */
		if (isset($instance['use_template'])) {
			$instance['template'] = ($instance['use_template']) ? ($instance['template_file']) : false;
        }

		if ($yarpp->get_option('cross_relate')){
			$instance['post_type'] = $yarpp->get_post_types();
        } else if (in_array(get_post_type(), $yarpp->get_post_types())) {
			$instance['post_type'] = array(get_post_type());
        } else {
			$instance['post_type'] = array('post');
        }

		$title = apply_filters('widget_title', $instance['title']);
<<<<<<< HEAD

		echo $before_widget;
		if ( !$instance['template'] ) {
			echo $before_title;
			echo $title;
			echo $after_title;
		}

		$instance['domain'] = 'widget';
		$yarpp->display_related(null, $instance, true);
		echo $after_widget;
	}

	public function update($new_instance, $old_instance) {
		if ( $new_instance['use_template'] == 'builtin' )
			$template = false;
		if ( $new_instance['use_template'] == 'thumbnails' )
			$template = 'thumbnails';
		if ( $new_instance['use_template'] == 'custom' )
			$template = $new_instance['template_file'];

		$instance = array(
			'promote_yarpp' => isset($new_instance['promote_yarpp']),
			'template' => $template
		);

		$choice = false === $instance['template'] ? 'builtin' :
			( $instance['template'] == 'thumbnails' ? 'thumbnails' : 'custom' );

		if ((bool) $instance['template'] ) // don't save the title change.
			$instance['title'] = $old_instance['title'];
		else // save the title change:
			$instance['title'] = $new_instance['title'];

		if ((bool) $instance['thumbnails_heading'] ) // don't save the title change.
			$instance['thumbnails_heading'] = $old_instance['thumbnails_heading'];
		else // save the title change:
			$instance['thumbnails_heading'] = $new_instance['thumbnails_heading'];
=======
        $output = $before_widget;
        if ($instance['use_pro']) {
            if((isset($yarpp->yarppPro['active']) && $yarpp->yarppPro['active']) &&
               (isset($yarpp->yarppPro['aid']) && isset($yarpp->yarppPro['v']))  &&
               ($yarpp->yarppPro['aid'] && $yarpp->yarppPro['v'])) {

                $aid  = $yarpp->yarppPro['aid'];
                $v    = $yarpp->yarppPro['v'];
                $dpid = $instance['pro_dpid'];
                $ru   = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

                /* TODO: Put this on a template */
                $output .=
                    "\n".
                    '<div id="adkengage_ssp_div"></div>'.
                    '<script type="text/javascript" '.
                    'src="http://adkengage.com/pshandler.js?aid='.$aid.'&v='.$v.'&dpid='.$dpid.'&ru='.$ru.'">'.
                    '</script>'.
                    "\n";
            }
        } else {
            if (!$instance['template']) {
                $output .= $before_title;
                $output .= $title;
                $output .= $after_title;
            }
            $instance['domain'] = 'widget';
            $output .= $yarpp->display_related(null, $instance, false);
        }

        $output .= $after_widget;
        echo $output;
	}

	public function update($new_instance, $old_instance) {
        $instance = array(
            'template'           => false,
            'title'              => $new_instance['title'],
            'thumbnails_heading' => $new_instance['thumbnails_heading'],
            'use_pro'            => (isset($new_instance['use_pro']))  ? $new_instance['use_pro']  : false,
            'pro_dpid'           => (isset($new_instance['pro_dpid'])) ? $new_instance['pro_dpid'] : null,
            'promote_yarpp'      => false,
        );

		if ($new_instance['use_template'] === 'thumbnails')   $instance['template'] = 'thumbnails';
        else if ($new_instance['use_template'] === 'custom' ) $instance['template'] = $new_instance['template_file'];
>>>>>>> 4.2.2
		
		return $instance;
	}

	public function form($instance) {
		global $yarpp;
<<<<<<< HEAD
	
		$instance = wp_parse_args(
            $instance,
            array(
                'title'                 => __('Related Posts (YARPP)','yarpp'),
                'thumbnails_heading'    => $yarpp->get_option('thumbnails_heading'),
                'template'              => false,
                'promote_yarpp'         => false
            )
        );
	
		// compatibility with pre-3.5 settings:
		if (isset($instance['use_template'])) {
			$instance['template'] = $instance['template_file'];
        }
	
		$choice = ($instance['template'] === false)
            ? 'builtin'
            : (($instance['template'] === 'thumbnails') ? 'thumbnails' : 'custom');

		// if there are YARPP templates installed...
		$templates = $yarpp->get_templates();

		if (!$yarpp->diagnostic_custom_templates() && $choice === 'custom') $choice = 'builtin';
		
		?>

		<p class='yarpp-widget-type-control'>
			<label style="padding-right: 10px; display: inline-block;" for="<?php echo $this->get_field_id('use_template_builtin'); ?>">
                <input id="<?php echo $this->get_field_id('use_template_builtin'); ?>" name="<?php echo $this->get_field_name('use_template'); ?>" type="radio" value="builtin" <?php checked($choice === 'builtin' ) ?>/>
                <?php _e("List",'yarpp'); ?>
            </label>
		    <br/>
			<label style="padding-right: 10px; display: inline-block;" for="<?php echo $this->get_field_id('use_template_thumbnails'); ?>">
                <input id="<?php echo $this->get_field_id('use_template_thumbnails'); ?>" name="<?php echo $this->get_field_name('use_template'); ?>" type="radio" value="thumbnails" <?php checked($choice === 'thumbnails') ?>/>
                <?php _e("Thumbnails", 'yarpp'); ?>
            </label>
		    <br/>
			<label style="padding-right: 10px; display: inline-block;" for="<?php echo $this->get_field_id('use_template_custom'); ?>">
                <input id="<?php echo $this->get_field_id('use_template_custom'); ?>" name="<?php echo $this->get_field_name('use_template'); ?>" type="radio" value="custom" <?php checked($choice === 'custom'); disabled(!count($templates)); ?>/>
                <?php _e("Custom", 'yarpp'); ?>
            </label>
		</p>

		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php _e('Title:'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>"/>
            </label>
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('thumbnails_heading'); ?>">
                <?php _e('Heading:', 'yarpp'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('thumbnails_heading'); ?>" name="<?php echo $this->get_field_name('thumbnails_heading'); ?>" type="text" value="<?php echo esc_attr($instance['thumbnails_heading']); ?>"/>
            </label>
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('template_file'); ?>">
                <?php _e("Template file:",'yarpp');?>
            </label>
            <select name="<?php echo $this->get_field_name('template_file'); ?>" id="<?php echo $this->get_field_id('template_file'); ?>">
			<?php foreach ($templates as $template): ?>
			    <option value='<?php echo esc_attr($template['basename']); ?>' <?php selected($template['basename'], $instance['template']);?>>
                    <?php echo esc_html($template['name']); ?>
                </option>
			<?php endforeach; ?>
		</select>
        <p>

		<script type="text/javascript">
            jQuery(function($) {
                function ensureTemplateChoice(e) {
                    if (typeof e === 'object' && 'type' in e) {
                        e.stopImmediatePropagation();
                    }

                    var this_form = $(this).closest('form'),
                        widget_id = this_form.find('.widget-id').val();

                    // if this widget is just in staging:
                    if (/__i__$/.test(widget_id)) return;

                    var builtin     = !! $('#widget-'+widget_id+'-use_template_builtin').prop('checked'),
                        thumbnails  = !! $('#widget-'+widget_id+'-use_template_thumbnails').prop('checked'),
                        custom      = !! $('#widget-'+widget_id+'-use_template_custom').prop('checked');

                    $('#widget-' + widget_id + '-title').closest('p').toggle(builtin);
                    $('#widget-' + widget_id + '-thumbnails_heading').closest('p').toggle(thumbnails);
                    $('#widget-' + widget_id + '-template_file').closest('p').toggle(custom);

                    //console.log(widget_id, custom, builtin);
                }

                $('#wpbody').on('change', '.yarpp-widget-type-control input', ensureTemplateChoice);
                $('.yarpp-widget-type-control').each(ensureTemplateChoice);

            });
		</script>

		<p>
            <input class="checkbox" id="<?php echo $this->get_field_id('promote_yarpp'); ?>" name="<?php echo $this->get_field_name('promote_yarpp'); ?>" type="checkbox" <?php checked($instance['promote_yarpp']) ?> />
            <label for="<?php echo $this->get_field_id('promote_yarpp'); ?>">
                <?php _e("Help promote Yet Another Related Posts Plugin?",'yarpp'); ?>
            </label>
        </p>
		<?php
=======
        $id = rtrim($this->get_field_id(null), '-');
		$instance = wp_parse_args(
            $instance,
            array(
                'title'                 => 'Related Posts (YARPP)',
                'thumbnails_heading'    => $yarpp->get_option('thumbnails_heading'),
                'template'              => false,
                'use_pro'               => false,
                'pro_dpid'              => null,
                'promote_yarpp'         => false,
            )
        );
	
		/* TODO: Deprecate
		 * Compatibility with pre-3.5 settings
		 */
		if (isset($instance['use_template'])) $instance['template'] = $instance['template_file'];
	
		$choice = ($instance['template']) ? (($instance['template'] === 'thumbnails') ? 'thumbnails' : 'custom') : 'builtin';

		/* Check if YARPP templates are installed */
		$templates = $yarpp->get_templates();

		if (!$yarpp->diagnostic_custom_templates() && $choice === 'custom') $choice = 'builtin';

		include(YARPP_DIR.'/includes/phtmls/yarpp_widget_form.phtml');
>>>>>>> 4.2.2
	}
}

/**
 * @since 2.0 Add as a widget
 */
function yarpp_widget_init() {
    register_widget('YARPP_Widget');
}

add_action('widgets_init', 'yarpp_widget_init');