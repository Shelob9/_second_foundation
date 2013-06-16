<?php
/**
 * Add Controls
 * since _sf 1.0.5.1
 */
class _sf_Controls extends WP_Customize_Control
	{
	    public $tc;
	    public $link;
	    public $label;
	    public $type;
	    public $buttontext;
	    public $settings;
	    public $hr_after;
	    public $notice;
	    //number vars
	    public $step;
	    public $min;

	    public function render_content()
	    {
	        switch ($this -> tc) {
	        	case 'hr':
	        		echo '<hr style="border-color: white;margin-top:15px" />';
	        		break;
	        	
	        	case 'button':
	        		echo '<a class="button-primary" href="'.admin_url($this -> link ).'" target="_blank">'.$this -> buttontext.'</a>';
	        		if ($this -> hr_after == true)
	        			echo '<hr style="border-color: white;margin-top:15px">';
	        		break;

	        	case 'number':
	        		?>
	        		<label>
	        		<span class="customize-control-title"><?php echo esc_html( $this->label ) ?></span>
		        		<input <?php $this->link() ?> type="number" step="<?php echo $this-> step ?>" min="<?php echo $this-> min ?>" id="posts_per_page" value="<?php echo $this->value() ?>" class="small-text">
		        		<?php if(!empty($this -> notice)) : ?>
			        		<i><?php echo esc_html( $this-> notice ) ?></i>
			        	<?php endif; ?>
		        	</label>
		        	<?php
	        		break;

	        	case 'checkbox':
				?>
				<label>
					<input type="checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?> />
					<?php echo esc_html( $this->label ); ?>
				</label><br />
				<?php if(!empty($this -> notice)) : ?>
			        	<i><?php echo esc_html( $this-> notice ) ?></i>
			        <?php endif; ?>
				<?php
				break;

	        	case 'textarea':
	        		?>
					<label>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<span style="color: #999;font-size:11px"><?php echo esc_html( $this-> notice); ?></span>
						<textarea class="widefat" rows="3" cols="10" <?php $this->link(); ?>><?php echo esc_html( $this->value() ); ?></textarea>
					</label>
					<?php
		        	break;

	        	case 'url':
	        		?>
					<label>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<input type="text" value="<?php echo esc_url( $this->value() ); ?>"  <?php $this->link(); ?> />
					</label>
					<?php
		        	break;
	        	
	        	case 'slider-check':
		        	//retrieve all sliders in option array
			        $options                   	= get_option('_sf_theme_options');
			        $sliders 					= array();
			        if(isset($options['_sf_sliders'])) {
			        	$sliders                = $options['_sf_sliders'];
			    	}
	        	
		            if(empty($sliders )) {
		               echo '<div style="width:99%; padding: 5px;">';
		                  echo '<p class="description">'.__("You haven't create any slider yet. Go to the media library, edit your images and add them to your sliders.", "customizr" ).'<br/><a class="button-primary" href="'.admin_url( 'upload.php').'" target="_blank">'.__('Create a slider','customizr').'</a></p>
		              </div>';
		            }	
	        	break;

	        	default:
	        		screen_icon( $this -> tc );
	        		break;
	        }
	    }
	}

/**
 * adds sanitization callback funtion : textarea
 * @since _sf 1.0.5.1
 */
 if(!function_exists('_sf_sanitize_textarea')) :
	function _sf_sanitize_textarea($value) {
		$value = esc_textarea( $value);
		return $value;
	}
endif;


/**
 * adds sanitization callback funtion : number
 * @since _sf 1.0.5.1
 */
 if(!function_exists('_sf_sanitize_number')) :
	function _sf_sanitize_number($value) {
		$value = esc_attr( $value); // clean input
		$value = (int) $value; // Force the value into integer type.
   		return ( 0 < $value ) ? $value : null;
	}
endif;

/**
 * adds sanitization callback funtion : url
 * @since _sf 1.0.5.1
 */
if(!function_exists('_sf_sanitize_url')) :
	function _sf_sanitize_url($value) {
		$value = esc_url( $value);
		return $value;
	}
endif;


?>