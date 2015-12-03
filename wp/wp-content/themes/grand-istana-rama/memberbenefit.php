<?php
/* Template Name: Benefit */
get_header();
?>
      <div class="row box-shadow">
        <div id="grandistanaramabanner" class="carousel slide carousel-fade" data-ride="carousel" data-interval="10000">
          <?php if(have_rows('banner')): ?>

          <div class="carousel-inner" role="listbox">
          <?php
          $i =0;
          while(have_rows('banner')): the_row();
          //vars
          $image = get_sub_field('image');
          ?>
            <div class="item <?php if ($i===0): echo('active'); endif; ?>">
              <img src="<?php echo ($image); ?>" alt="">
            </div>
          <?php $i++; endwhile; ?>
          </div> 

        <?php endif; ?>

          <a class="left carousel-control" href="#grandistanaramabanner" role="button" data-slide="prev">
            <span class="glyphicon" aria-hidden="true"><img src="<?php echo get_template_directory_uri(); ?>/images/previous.png" class="img-responsive"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#grandistanaramabanner" role="button" data-slide="next">
            <span class="glyphicon" aria-hidden="true"><img src="<?php echo get_template_directory_uri(); ?>/images/next.png" class="img-responsive"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    	<div class="row content">
      <?php while (have_posts()) : the_post(); ?>
    		<div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="header-content text-center">
                            <h1><?php the_title(); ?></h1>
                            <span>APPLY ON ALL SERVICE</span>
                            <?php get_template_part( 'template-parts/icon-menu' ); ?>
                        </div>
                    </div>
                    <div class="col-md-12  col-sm-12 col-xs-12 line">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/hrpink.png" class="full center-block">
                    </div>
                </div>
                <div class="row content">
               <!--  <?php echo do_shortcode("[benefit]"); ?> -->
               <?php the_content() ?>
                </div>
            </div>
          <?php endwhile; ?>
    	</div>
    	<div class="row bg-pink">
    		<?php include_once 'footer.php'; ?>
    	</div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>