<?php

get_header(); 
include_once(CAMFOLIO_DIR.'/includes/templates/sections/cover-section.php');
$writeup = "";
?>


<div class = "camfolio-in-grid camfolio-row">
	<div id="camfolio-display" class= "camfolio-col-8 camfolio-flex-item camfolio-images">
	<?php	
		if( have_posts() ) :
			while(have_posts()):
			the_post();
			if(!empty($images = get_post_meta($post->ID, 'camfolio-image-attachment'))){
			
				foreach ($images[0] as $key=>$value){
					echo "<img src ='$value'/>";
				}
			}
			endwhile; 
		endif;
	?>
	</div>
	<div class="camfolio-col-3 camfolio-flex-item">
		<div class = "camfolio_sidebar">
			<div class = "camfolio_sidebar_area camfolio_meta">
				<h4><?php $post_title; ?> </h4>
				<p> DATE <?php 
				if($camfolio_date = get_post_meta($post->ID, 'camfolio_textdate_timestamp',true)){
				
					echo $camfolio_date;
				}
				else{
					echo 'N/A';
				}	
				
			?></p>
			</div>
			
			<div class = "camfolio_sidebar_area camfolio_category">
				<h4>CATEGORY</h4>
				<?php
					if(has_term('', 'Category')){
						$camfolio_category = (get_the_terms($post, 'Category'));
						foreach ( $camfolio_category as $camfolio_c ) {
						echo $camfolio_c->name.' ';
						}
					}
					else{
						echo "N/A";
					}
				?>
			</div>
			
			<div class = "camfolio_sidebar_area camfolio_team">
				<h4>PROJECT TEAM</h4>
			
				
					<?php
// 					$camfolio_cont = get_post_meta($post->ID, 'camfolio-contributors',true);
						if(!empty($camfolio_cont = get_post_meta($post->ID, 'camfolio-contributors',true))){
							foreach ($camfolio_cont as $contributor){
								echo 'Name: <a href="'.$contributor['camfolio-website'].'">'.$contributor['camfolio-name'].'</a>'; 
								echo '<br/>';
								
							}
						}
						else{
							echo 'N/A';
						}

							
					?>
			
			</div>
			<div class = "camfolio_sidebar_area camfolio_info">
				<h4>ABOUT THIS PROJECT</h4>
				<p>
				<?php
					the_content();
				?>	
				</p>
			
			</div>			
			
					<div class = "camfolio_sidebar_area camfolio_social">
				<h5>SHARE</h5>
				<p>
					<a href="#"><i class="fab fa-twitter"></i></a>
					<a href="#"><i class="fab fa-facebook"></i></a>
					<a href="#"><i class="fab fa-instagram"></i></a>
					<a href="#"><i class="fab fa-pinterest"></i></a>
					
				</p>
			
			</div>	
		</div>
	</div>

</div>
<div class= "camfolio-recent-works camfolio-row camfolio-in-grid">
	<?php 
		$count = 0;		

  $args = array('post_type'=>array('posts', 'camfolio'),'post_not_in' => array( $post->ID ));
		  $the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {

	while ( $the_query->have_posts() ) {
		$the_query->the_post();
	//echo '<h2>hi</h2>';
		echo "<div class='camfolio-work camfolio-col-3 camfolio-flex-item'>";
		if (has_post_thumbnail(  ) ){
		echo "<figure class = 'camfolio-img'>";
		the_post_thumbnail();
		echo "<figcaption>";
		$camfolio_title = get_the_title();
		echo "<h5>".$camfolio_title."</h5>";
		
		if($camfolio_text = get_post_meta($post->ID, 'camfolio-thumbnail-text',true)){
				
			echo '<p>'.$camfolio_text.'</p>';
				
			}
		echo "<a href='".get_permalink()."' class='camfolio-button'>View Project</a>";
		echo "</figcaption>";
		echo "</figure>";
			$count++;
			if($count >3){
				break;
			}
		}
		
		
	 echo "</div>";
	

	}
	
	while($count < 4 ){
		echo "<div class='camfolio-work camfolio-col-3 camfolio-flex-item'></div>";
			$count++;
	}
		
		wp_reset_postdata();

} 
?>
</div>
</div>
<?php get_footer(); 

