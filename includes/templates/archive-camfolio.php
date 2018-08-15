<?php
/**
 * The template for displaying single portfolio pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hii
 * @subpackage Cam
 * @since 0.1
 * @version 0.1
 */	
get_header(); 
include_once(CAMFOLIO_DIR.'/includes/templates/sections/cover-section.php');

?>

<div class = "camfolio-in-grid camfolio-row">
	<div class="">
		<div class="opening-text">
			<p>	<?php echo get_option( 'camfolio_intro_text' ) ;?></p>
		</div>
	</div>
	
	<div id="camfolio-archive" class= "">
		
		<div class="camfolio-row">
			<?php include_once(CAMFOLIO_DIR.'/includes/templates/loops/camfolio-archiveloop.php');?>
			 		
		</div>
	</div>

</div>
<?php get_footer(); ?>

