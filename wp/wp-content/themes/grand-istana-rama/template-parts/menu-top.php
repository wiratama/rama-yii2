<div class="container">
	<div class="row">
		<nav class="navbar navbar-default navigation">
		  	<div class="container-fluid">
			    <div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#grandistanaramamenu">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
			    </div>
			    <div class="collapse navbar-collapse" id="grandistanaramamenu">
	                <?php
                        wp_nav_menu( array(
                        'menu'             => 'primary',
                        'theme_location'   => 'primary',
                        'depth'            => 2,
                        'container'        => '',
                        'container_class'  => '',
                        'menu_class'       => 'nav navbar-nav navbar-right',
                        'fallback_cb'      => 'wp_bootstrap_navwalker::fallback',
                        'walker'           => new wp_bootstrap_navwalker())
                        );
                    ?>
<!-- 					<ul class="nav navbar-nav navbar-right">
						<li class="link"><a href="index.php">HOME</a><hr class="menu-divider"></li>
						<li class="navigation-divider">|</li>
						<li class="link"><a href="memberbenefit.php">MEMBER BENEFIT</a><hr class="menu-divider"></li>
						<li class="navigation-divider">|</li>
						<li class="link"><a href="aboutus.php">ABOUT US</a><hr class="menu-divider"></li>
						<li class="navigation-divider">|</li>
						<li class="link"><a href="quotations.php">QUOTATIONS</a><hr class="menu-divider"></li>
						<li class="navigation-divider">|</li>
						<li class="link"><a href="contactus.php">CONTACT US</a></li>
					</ul> -->
			    </div>
		  	</div>
		</nav>
	</div>
</div>