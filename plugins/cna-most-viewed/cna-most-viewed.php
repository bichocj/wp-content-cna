<?php
/*
Plugin Name: Lo más visto en CNA
Plugin URI: None
Description: Muestra las 4 ultimas entradas de CNA
Author: JHA
Version: 1.0
Author URI: http://atixplus.com/
*/


// La nueva clase debe heredar de WP_Widget
class most_viewed_widget extends WP_Widget {
    function most_viewed_widget() {
        $options = array('classname' => 'widget-most-viewed',
                        'description' => 'Muestra las 4 ultimas entradas de CNA');
        $this->WP_Widget('most_viewed_widget', 'Lo más visto en CNA', $options);
    }
    function form($instance) {
         $defaults = array('titulo' => 'Lo más visto en CNA', 'posts'=> '4');
         $instance = wp_parse_args((array)$instance, $defaults);
         $titulo = $instance['titulo'];
         $posts = $instance['posts'];
         // Mostramos el formulario
         ?>
         <p>
             Titulo
             <input class="widefat" type="text" name="<?php echo $this->get_field_name('titulo');?>"
                    value="<?php echo esc_attr($titulo);?>"/>
         </p>
         <p>
             Nro de Posts
             <input class="widefat" type="text" name="<?php echo $this->get_field_name('posts');?>"
                    value="<?php echo esc_attr($posts);?>"/>
         </p>
         <?php
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['titulo'] = sanitize_text_field($new_instance['titulo']);
        $instance['posts'] = sanitize_text_field($new_instance['posts']);
        return $instance;
    }
    function widget($args, $instance) {
        extract($args);
        $titulo = apply_filters('widget_title', $instance['titulo']);
        
        $posts = ( ! empty( $instance['posts'] ) ) ? absint( $instance['posts'] ) : 4;
		if ( ! $posts )
			$posts = 4;
        

        /**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$news_Query = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $posts,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($news_Query->have_posts()) :
        ?>
        
		<?php echo $args['before_widget']; ?>
		<?php if ( $titulo ) {
			echo $args['before_title'] . $titulo . $args['after_title'];
		} ?>
		<ul class="lnList clearfix">
		<?php while ( $news_Query->have_posts() ) : $news_Query->the_post(); ?>
            <li>
                <?php 
                        $thumbID = get_post_thumbnail_id( $post->ID );
                        $imgDestacada = wp_get_attachment_image_src( $thumbID, 'thumbnail' ); // Thumbnail, medium, large, full
                        $imgTitle = get_the_title();
                        $urlNews = get_permalink();
                        echo '<a class="nImage" href="'. $urlNews .'"> <img width="150" height="150" class="entry-thumb" src="'.$imgDestacada[0].'"
                        alt="" title="'.$imgTitle.'"> </a>'
                ?>
                <div class="nTitle">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </div>
            </li>
		<?php endwhile; ?>
		</ul>
		<?php echo $args['after_widget']; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();
		endif;
    }
 }



// registrar el widget 
add_action('widgets_init', create_function('', 'return register_widget("most_viewed_widget");'));
?>

