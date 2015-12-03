<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Grand_Istama_Rama
 */

get_header(); ?>

    	<div class="row box-shadow">
			<div id="grandistanaramabanner" class="carousel slide carousel-fade" data-ride="carousel" data-interval="10000">
			  <div class="carousel-inner" role="listbox">
			    <div class="item active">
			      <img src="<?php echo get_template_directory_uri(); ?>/images/banner1.jpg" alt="">
			    </div>
			    <div class="item">
			      <img src="<?php echo get_template_directory_uri(); ?>/images/banner2.jpg" alt="">
			    </div>
			    <div class="item">
			      <img src="<?php echo get_template_directory_uri(); ?>/images/banner3.jpg" alt="">
			    </div>
			    <div class="item">
			      <img src="<?php echo get_template_directory_uri(); ?>/images/banner4.jpg" alt="">
			    </div>
			    <div class="item">
			      <img src="<?php echo get_template_directory_uri(); ?>/images/banner5.jpg" alt="">
			    </div>
			  </div>
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
    		<div class="container">
    			<div class="row box-black no-margin-row content-home">
    				<div class="col-md-4 col-sm-4 col-xs-12">
    					<div class="col-md-12 logo-content"><img src="<?php echo get_template_directory_uri(); ?>/images/logosamudera.png" class="img-responsive center-block"></div>
    					<div class="col-md-12 text-center"><h2>GET BEST OFFER<br>RIGHT NOW!</h2><i>SPECIAL PRICE IN ALL LOCATION <br>OF OUR FOODS!</i></div>
    					<div class="col-md-12"><button class="btn btn-default btn-reserve center-block">RESERVE NOW</button></div>
    				</div>
    				<div class="col-md-8 col-sm-8 col-xs-12 no-padding">
    					<img src="<?php echo get_template_directory_uri(); ?>/images/samudera.jpg" class="img-responsive full">
    				</div>
    			</div>
    			<div class="row box-black no-margin-row content-home">
    				<div class="col-md-8 col-sm-8 col-xs-12 no-padding">
    					<img src="<?php echo get_template_directory_uri(); ?>/images/bar.jpg" class="img-responsive full">
    				</div>
    				<div class="col-md-4 col-sm-4 col-xs-12">
    					<div class="col-md-12 logo-content"><img src="<?php echo get_template_directory_uri(); ?>/images/logobar.png" class="img-responsive center-block"></div>
    					<div class="col-md-12 text-center"><h2>GET BEST OFFER<br>RIGHT NOW!</h2><i>SPECIAL PRICE IN ALL LOCATION <br>OF OUR 69 BAR</i></div>
    					<div class="col-md-12"><button class="btn btn-default btn-reserve center-block">RESERVE NOW</button></div>
    				</div>
    			</div>
    			<div class="row box-black no-margin-row content-home">
    				<div class="col-md-4 col-sm-4 col-xs-12">
    					<div class="col-md-12 logo-content text-center text-yellow"><h1>Ayodya<br>POOL BAR</h1></div>
    					<div class="col-md-12 text-center"><h2>GET BEST OFFER<br>RIGHT NOW!</h2><i>SPECIAL PRICE IN ALL LOCATION <br>OF OUR POOLBAR!</i></div>
    					<div class="col-md-12"><button class="btn btn-default btn-reserve center-block">RESERVE NOW</button></div>
    				</div>
    				<div class="col-md-8 col-sm-8 col-xs-12 no-padding">
    					<img src="<?php echo get_template_directory_uri(); ?>/images/ayodya.jpg" class="img-responsive full">
    				</div>
    			</div>
    			<div class="row box-black no-margin-row content-home">
    				<div class="col-md-8 col-sm-8 col-xs-12 no-padding">
    					<img src="<?php echo get_template_directory_uri(); ?>/images/treatment.jpg" class="img-responsive full">
    				</div>
    				<div class="col-md-4 col-sm-4 col-xs-12">
    					<div class="col-md-12 logo-content text-center text-yellow"><h1>TREATMENT</h1></div>
    					<div class="col-md-12 text-center"><h2>GET BEST OFFER<br>RIGHT NOW!</h2><i>SPECIAL PRICE IN ALL LOCATION <br>OF OUR TREATMENT</i></div>
    					<div class="col-md-12"><button class="btn btn-default btn-reserve center-block">RESERVE NOW</button></div>
    				</div>
    			</div>
    			<div class="row box-black no-margin-row content-home">
    				<div class="col-md-4 col-sm-4 col-xs-12">
    					<div class="col-md-12 logo-content text-center text-yellow"><h1>ROOM</h1></div>
    					<div class="col-md-12 text-center"><h2>GET BEST OFFER<br>RIGHT NOW!</h2><i>SPECIAL PRICE IN ALL LOCATION <br>OF OUR ROOMS!</i></div>
    					<div class="col-md-12"><button class="btn btn-default btn-reserve center-block">RESERVE NOW</button></div>
    				</div>
    				<div class="col-md-8 col-sm-8 col-xs-12 no-padding">
    					<img src="<?php echo get_template_directory_uri(); ?>/images/rooms.jpg" class="img-responsive full">
    				</div>
    			</div>
    		</div>
    	</div>
<?php get_footer(); ?>

