<?php 
if(is_archive()){	
$camfolio_image = wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) );
}
else if (has_post_thumbnail( $post->ID ) ): 
 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
 $camfolio_image = $image[0];
 endif;
 ?>


  </div>

	  <section id="camfolio-cover-section" style="background-image: url('<?php echo $camfolio_image; ?>')">
<!-- 	<section id="cover-section" class="background-img" style='background:url("<?php get_post_meta( $post->ID, 'title_field', true );?>");'> -->
		<div class="camfolio-container">
			<div class="camfolio-content-container camfolio-title .camfolio-white">
					<h1><?php wp_title(); ?></h1>
			</div>
		</div>
	</section>
