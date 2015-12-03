<?php /* Template Name: Page Testimonial */ get_header(); ?>

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
              <img src="<?php echo ($image); ?>" alt="" class="img-responsive">
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
      <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    		<div class="container">
        
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="header-content text-center">
                <h1><?php the_title(); ?></h1>
                <span><?php the_field('sechond_title'); ?></span>
                <?php get_template_part( 'template-parts/icon-menu' ); ?>
              </div>
            </div>
            <div class="col-md-12  col-sm-12 col-xs-12 line">
              <img src="<?php echo get_template_directory_uri(); ?>/images/hrpink.png" class="full center-block">
            </div>
          </div>

          <div class="row content">
            <div class="col-md-offset-8 col-md-3">
            <button type="button" class="btn btn-pink btn-lg testi-but" data-toggle="modal" data-target="#myModal">
              Add Testimonial
            </button>
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Form Comment</h4>
                    </div>
                    <div class="modal-body">

                   <?php do_action("comment_form_before");?>
<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>"  method="post" class="form-horizontal"<?php echo $html5 ? ' novalidate' : ''; ?>>

<?php if ( $user_ID ) : ?>

<p><?php _e('Logged in as', 'wpzoom'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out', 'wpzoom'); ?> &raquo;</a></p>

<?php else : ?>
<div id="formLabels">
  <div class="form-group">
    <label for="author" class="col-sm-3 control-label"><?php _e('Full Name', 'wpzoom'); ?> <?php if ($req) _e('required', 'wpzoom'); ?>:</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /><br />
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-3 control-label"><?php _e('E-Mail', 'wpzoom'); ?> <?php if ($req) _e('required', 'wpzoom'); ?>:</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /><br />
    </div>
  </div>
</div>
<?php endif; ?>
<div id="formContent">
  <div class="form-group">
    <label for="comment" class="col-sm-3 control-label"><?php _e('Comment', 'wpzoom'); ?>:</label>
    <div class="col-sm-9">
        <textarea name="comment" rows="6" class="form-control" id="comment" tabindex="4"></textarea><br />
    </div>
  </div>

            <input type='hidden' name='comment_post_ID' value='1' id='comment_post_ID' />
            <input type='hidden' name='comment_parent' id='comment_parent' value='0' />
<input name="submit" class="btn btn-primary pull-right" type="submit" id="submit" value="<?php _e('Add Comment', 'wpzoom'); ?>" />
</div>
<div class="cleaner">&nbsp;</div>
<?php comment_id_fields(); ?>
</form>
<?php do_action("comment_form_after"); ?>    
                      

                    </div>
                    <div class="modal-footer">
<!--                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                  </div>
                </div>
              </div>              
            </div>
            <?php the_content(); ?>
            <?php foreach (get_comments(array('status' => 'approve')) as $comment): ?>
            <div class="col-md-12">
              <div class="col-md-3">
               <img src="<?php echo get_template_directory_uri(); ?>/images/avatar.png" height="150" width="150" class="img-rounded img-testimonial center-block">
              </div>
              <div class="col-md-8">
                <div class="triangle-border left">
                  <p class="text-justify"><?php echo $comment->comment_content ; ?></p>
                  <span class="testi-week">
                    <i>Reviewed by <?php echo $comment->comment_author; ?></i>
                  </span>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>

        </div>
      <?php endwhile; endif; wp_reset_query(); ?>
    	</div>
    <?php get_footer(); ?>
