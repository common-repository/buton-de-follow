<?php

/**

 * Plugin Name: Buton de Follow

 * Plugin URI: http://cristimirt.ro/2011/06/buton-de-follow-pentru-bloguri-plugin/

 * Description: Un widget care îi oferă vizitatorului posibilitatea să te urmărească pe Twitter.

 * Version: 1.5

 * Author: Cristi Mirt

 * Author URI: http://cristimirt.ro

 */

add_action( 'widgets_init', 'follow_button_load_widgets' );



function follow_button_load_widgets() {

	register_widget( 'Twitter_Follow_Button' );

}



class Twitter_Follow_Button extends WP_Widget {



	/**

	 * Widget setup.

	 */

	function Twitter_Follow_Button() {

		/* Widget settings. */

		$widget_ops = array( 'classname' => 'follow-button', 'description' => __('Un widget care afișează butonul de Follow pe Twitter în sidebar', 'follow-button') );



		/* Widget control settings. */

		$control_ops = array( 'width' => 300, 'height' => 20, 'id_base' => 'twitter-follow' );



		/* Create the widget. */

		$this->WP_Widget( 'twitter-follow', __('Buton de Follow', 'follow-button'), $widget_ops, $control_ops );

	}



	/**

	 * Display

	 */

	function widget( $args, $instance ) {

		extract( $args );



		/* Variables */

		$title = apply_filters('widget_title', $instance['title'] );

		$username = $instance['username'];

		$button_color = $instance['button_color'];
		
		$text_color = $instance['text_color'];
		
		$link_color = $instance['link_color'];

		$show_followers = isset( $instance['show_followers'] ) ? $instance['show_followers'] : false;
		
		$data_width = $instance['data_width'];
		
		$data_align = $instance['data_align'];

		$language = $instance['language'];

        if ($button_color == 'Închis') $button = 'grey';

                                      else $button = 'blue';

        if (isset ($instance['show_followers'])) $followers = 'true';

                                           else $followers = 'false';
										   
		if ($data_align == 'Stânga') $align = 'left';
                          
                                           else $align = 'right';						  

                

                
													



                

             

		

	    



		/* Before widget (defined by themes). */

		echo $before_widget;

                /* Title */

             echo $before_title; echo $title; echo $after_title;

                 /* Body */

        echo '<a href="http://twitter.com/'.$username.'" class="twitter-follow-button" data-width="'.$data_width.'" data-align="'.$data_align.'" data-text-color="'.$text_color.'" data-link-color="'.$link_color.'" data-show-count="'.$followers.'" data-button="'.$button.'" data-lang="'.$language.'"  >Follow @'.$username.'</a>

<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>';

		



		/* After widget (defined by themes). */

		echo $after_widget;

	}



	/**

	 * Update the widget settings.

	 */

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;



		/* Strip tags for title and name to remove HTML (important for text inputs). */

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['username'] = strip_tags( $new_instance['username'] );



		/* No need to strip tags for sex and show_sex. */

		$instance['show_followers'] = $new_instance['show_followers'];

		$instance['button_color'] = $new_instance['button_color'];

		$instance['language'] = $new_instance['language'];
		
		$instance['text_color'] = $new_instance['text_color'];
		
		$instance['link_color'] = $new_instance['link_color'];
		
		$instance['data_align'] = $new_instance['data_align'];
		
		$instance['data_width'] = $new_instance['data_width'];

                


		return $instance;

	}



	/**

	 * Displays the widget settings controls on the widget panel.

	

	 */

	function form( $instance ) {



		/* Set up some default widget settings. */

		
		
		$defaults = array( 'title' => __('Urmărește-mă pe Twitter', 'follow-button'), 'username' => __('CristiMirt', 'follow-button'), 'button_color' => 'Albastru', 'show_followers' => __('true', 'follow-button'), 'language' => __('en', 'follow-button'), 'data_align' => 'Stânga' );

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>



		<!-- Widget Title: Text Input -->

		<p>

			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Titlu:', 'hybrid'); ?></label>

			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />

		</p>



		<!-- Your Username: Text Input -->

		<p>

			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Contul de twitter:', 'follow-button'); ?></label>

			<input id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" style="width:100%;" />

		</p>



		<!-- Button Color: Select Box -->

		<p>

			<label for="<?php echo $this->get_field_id( 'button_color' ); ?>"><?php _e('Fundal:', 'follow-button'); ?></label> 

			<select id="<?php echo $this->get_field_id( 'button_color' ); ?>" name="<?php echo $this->get_field_name( 'button_color' ); ?>" class="widefat" style="width:80%;">

				<option <?php if ( 'Deschis' == $instance['button_color'] ) echo 'selected="selected"'; ?>>Deschis</option>

				<option <?php if ( 'Închis' == $instance['button_color'] ) echo 'selected="selected"'; ?>>Închis</option>

			</select>

		</p>
		
		<!-- Link Color: Text Input -->

		<p>

			<label for="<?php echo $this->get_field_id( 'link_color' ); ?>"><?php _e('Culoarea link-ului: #', 'follow-button'); ?></label>

			<input id="<?php echo $this->get_field_id( 'link_color' ); ?>" name="<?php echo $this->get_field_name( 'link_color' ); ?>" value="<?php echo $instance['link_color']; ?>" style="width:50%;" />

		</p>
		
		<!-- Text Color: Text Input -->

		<p>

			<label for="<?php echo $this->get_field_id( 'text_color' ); ?>"><?php _e('Culoarea textului: #', 'follow-button'); ?></label>

			<input id="<?php echo $this->get_field_id( 'text_color' ); ?>" name="<?php echo $this->get_field_name( 'text_color' ); ?>" value="<?php echo $instance['text_color']; ?>" style="width:50%;" />

		</p>

<center><EMBED src="<?php get_bloginfo(url);?>/wp-content/plugins/buton-de-follow/color.swf" quality=high  HEIGHT="270"  NAME="Color Box" ALIGN="center" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED> </OBJECT></center><p>
		
		<!-- Data Width: Text Input -->

		<p>

			<label for="<?php echo $this->get_field_id( 'data_width' ); ?>"><?php _e('Lățime:', 'follow-button'); ?></label>

			<input id="<?php echo $this->get_field_id( 'data_width' ); ?>" name="<?php echo $this->get_field_name( 'data_width' ); ?>" value="<?php echo $instance['data_width']; ?>" style="width:50%;" />

		</p>

		<!-- Data Align: Select Box -->

		<p>

			<label for="<?php echo $this->get_field_id( 'data_align' ); ?>"><?php _e('Alinierea textului:', 'follow-button'); ?></label> 

			<select id="<?php echo $this->get_field_id( 'data_align' ); ?>" name="<?php echo $this->get_field_name( 'data_align' ); ?>" class="widefat" style="width:60%;">

				<option <?php if ( 'Stânga' == $instance['data_align'] ) echo 'selected="selected"'; ?>>Stânga</option>

				<option <?php if ( 'Dreapta' == $instance['data_align'] ) echo 'selected="selected"'; ?>>Dreapta</option>

			</select>

		</p>

		<!-- Language: Select Box -->

		<p>

			<label for="<?php echo $this->get_field_id( 'language' ); ?>"><?php _e('Limba:', 'follow-button'); ?></label> 

			<select id="<?php echo $this->get_field_id( 'language' ); ?>" name="<?php echo $this->get_field_name( 'language' ); ?>" class="widefat" style="width:80%;">

				<option value="en"<?php selected('en', $instance['language']); ?>><?php _e('Engleză', 'follow-button'); ?></option>
				<option value="fr"<?php selected('fr', $instance['language']); ?>><?php _e('Franceză', 'follow-button'); ?></option>
				<option value="de"<?php selected('de', $instance['language']); ?>><?php _e('Germană', 'follow-button'); ?></option>
				<option value="it"<?php selected('it', $instance['language']); ?>><?php _e('Italiană', 'follow-button'); ?></option>
				<option value="ja"<?php selected('ja', $instance['language']); ?>><?php _e('Japoneză', 'follow-button'); ?></option>
				<option value="ko"<?php selected('ko', $instance['language']); ?>><?php _e('Koreeană', 'follow-button'); ?></option>
				<option value="pt"<?php selected('pt', $instance['language']); ?>><?php _e('Portugheză', 'follow-button'); ?></option>
				<option value="ru"<?php selected('ru', $instance['language']); ?>><?php _e('Rusă', 'follow-button'); ?></option>
				<option value="es"<?php selected('es', $instance['language']); ?>><?php _e('Spaniolă', 'follow-button'); ?></option>
				<option value="tr"<?php selected('tr', $instance['language']); ?>><?php _e('Turcă', 'follow-button'); ?></option>
				
			</select>

		</p>



		<!-- Show Followers: Checkbox -->

		<p>
			<input class="checkbox" type="checkbox" <?php if (isset ($instance['show_followers'])) echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show_followers' ); ?>" name="<?php echo $this->get_field_name( 'show_followers' ); ?>" /> 

			<label for="<?php echo $this->get_field_id( 'show_followers' ); ?>"><?php _e('Afișează numărul de followers', 'follow-button'); ?></label>

		</p>



	<?php

	}

}



?>