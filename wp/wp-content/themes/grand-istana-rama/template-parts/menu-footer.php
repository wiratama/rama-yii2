<?php global$data; ?>
<div class="container">
	<div class="row footer">
		<div class="col-md-12">
			<div class="socmed">
				<a href="<?php echo $data['facebook_text']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/fb.png"></a>
				<a href="<?php echo $data['twitter_text']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/tw.png"></a>
				<a href="<?php echo $data['instagram_text']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/itgrm.png"></a>
				<a href="<?php echo $data['tripav_text']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ta.png"></a>
			</div>
		</div>
		<div class="col-md-12 line">
			<img src="<?php echo get_template_directory_uri(); ?>/images/hrwhite.png" class="full center-block">
		</div>
		<div class="col-md-12">
<!-- 			<div class="bottom-menu">
				<a href="">News</a>&nbsp;&nbsp;|&nbsp;&nbsp;
				<a href="">Careers</a>&nbsp;&nbsp;|&nbsp;&nbsp;
				<a href="">Testimonial</a>&nbsp;&nbsp;|&nbsp;&nbsp;
				<a href="">Sitemap</a>&nbsp;&nbsp;|&nbsp;&nbsp;
				<a href="">Awards</a>
			</div> -->
			<div class="bottom-menu">
			    <?php 
                    $menuParameters = array(
                      'container'       => '',
                      'echo'            => '',
                      'items_wrap'      => '%3$s',
                      'depth'           => 0,
                      'menu_id'         => 'nav-10',
                      'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                      'menu'            => 'sechond',
                      'theme_location'  => 'sechond'
                    );

                    echo strip_tags(wp_nav_menu( $menuParameters ), '<a><div>' ); 
                ?>
            </div>      
<!-- 	                <?php
                        wp_nav_menu( array(
                        'menu'             => 'sechond',
                        'theme_location'   => 'sechond',
                        'depth'            => 2,
                        'container'        => '',
                        'container_class'  => '',
                        'menu_class'       => 'navbar-nav bottom-menu',
                        'fallback_cb'      => 'wp_bootstrap_navwalker::fallback',
                        'walker'           => new wp_bootstrap_navwalker())
                        );
                    ?> -->
		</div>
	</div>
</div>