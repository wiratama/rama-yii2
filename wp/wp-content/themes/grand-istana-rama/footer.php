<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Grand_Istama_Rama
 */
global $data;
?>

    	<div class="row bg-pink">
    		<?php get_template_part( 'template-parts/menu-footer' ); ?>
    	</div>
        <div class="row">
          <div class="col-md-12 text-center sticky-foot bg-white">
           <?php echo $data['footer_text']; ?>
          </div>
        </div>
    </div>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
  </body>
</html>