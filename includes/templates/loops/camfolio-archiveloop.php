<?php 


  $args = array('post_type'=>array('posts', 'camfolio'));
		  $the_query = new WP_Query( $args );
		  $count = $the_query->post_count; 

if ( $the_query->have_posts() ) {

	while ( $the_query->have_posts() ) {
		$the_query->the_post();
	//echo '<h2>hi</h2>';
		echo "<div class='camfolio-work camfolio-col-3 camfolio-flex-item'>";
		if (has_post_thumbnail(  ) ){
		echo "<figure class = 'camfolio-img'>";
		the_post_thumbnail();
		echo "<figcaption>";
		echo "<h5>".get_the_title()."</h5>";
			if($camfolio_text = get_post_meta($post->ID, 'camfolio-thumbnail-text',true)){
				
			echo '<p>'.$camfolio_text.'</p>';
				
			}
		echo "<a href='".get_permalink()."' class='camfolio-button'>View Project </a>";
		echo "</figcaption>";
		echo "</figure>";
		}
		else{
			echo 'hello??';
		}
		
	 echo "</div>";
	

	}
		wp_reset_postdata();

}
	while($count%4 != 0){
		echo "<div class='camfolio-work camfolio-col-3 camfolio-flex-item'>";
		echo "</div>";
		$count++;
	}

