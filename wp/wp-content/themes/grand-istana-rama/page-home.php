<?php
/* Template Name: Page Home */
get_header(); ?>

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
    		<div class="container">
            <?php
                $rows = get_field('content');/*<img src="<?php echo get_template_directory_uri(); ?>/images/logosamudera.png" class="img-responsive center-block">*/
                if($rows){
                foreach ($rows as $key => $row) { 
                  $_row = '';
                  if ($key % 2 == 0){
                    // $_row .= '<div class="row box-black no-margin-row content-home">';
                    // $_row .= '<div class="col-md-4 col-sm-4 col-xs-12">';   
                    if($row['image_title']){ 
                    echo '<div class="row box-black no-margin-row content-home">
                          <div class="col-md-4 col-sm-4 col-xs-12">
                          <div class="col-md-12 logo-content"><img src="'.$row['image_title'].'" class="img-responsive center-block"></div>
                          <div class="col-md-12 text-center"><h2>GET BEST OFFER<br>RIGHT NOW!</h2><i>'.$row['description'].'</i></div>
                          <div class="col-md-12"><a href="'.$row['link_reserve'].'"><button class="btn btn-default btn-reserve center-block">RESERVE NOW</button></a></div>
                          </div>
                          <div class="col-md-8 col-sm-8 col-xs-12 no-padding">
                          <img src="'.$row['image'].'" class="img-responsive full">
                          <div class="content-image-home"> 
                            <div class="content-image-home-in">
                              <p> 
                                '.$row['image_description'].'
                               </p>
                             </div>
                           </div>
                          </div>
                          </div>';
                    }

                     else{ 
                    echo '<div class="row box-black no-margin-row content-home">
                          <div class="col-md-4 col-sm-4 col-xs-12">
                          <div class="col-md-12 logo-content text-center text-yellow"><h1>'.$row['title'].'</h1></div>
                          <div class="col-md-12 text-center"><h2>GET BEST OFFER<br>RIGHT NOW!</h2><i>'.$row['description'].'</i></div>
                          <div class="col-md-12"><a href="'.$row['link_reserve'].'"><button class="btn btn-default btn-reserve center-block">RESERVE NOW</button></a></div>
                          </div>
                          <div class="col-md-8 col-sm-8 col-xs-12 no-padding">
                          <img src="'.$row['image'].'" class="img-responsive full">
                          <div class="content-image-home"> 
                            <div class="content-image-home-in">
                              <p> 
                                '.$row['image_description'].'
                               </p>
                             </div>
                           </div>
                          </div>
                          </div>';
                    }

                  } else{
                    if($row['image_title']){ 
                    echo '<div class="row box-black no-margin-row content-home">
                          <div class="col-md-8 col-sm-8 col-xs-12 no-padding">
                          <img src="'.$row['image'].'" class="img-responsive full">
                          <div class="content-image-home"> 
                            <div class="content-image-home-in">
                              <p> 
                                '.$row['image_description'].'
                               </p>
                             </div>
                           </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                          <div class="col-md-12 logo-content"><img src="'.$row['image_title'].'" class="img-responsive center-block"></div>
                          <div class="col-md-12 text-center"><h2>GET BEST OFFER<br>RIGHT NOW!</h2><i>'.$row['description'].'</i></div>
                          <div class="col-md-12"><a href="'.$row['link_reserve'].'"><button class="btn btn-default btn-reserve center-block">RESERVE NOW</button></a></div>
                          </div>
                          </div>';
                    }

                     else{ 
                    echo '<div class="row box-black no-margin-row content-home">
                          <div class="col-md-8 col-sm-8 col-xs-12 no-padding">
                          <img src="'.$row['image'].'" class="img-responsive full">
                          <div class="content-image-home"> 
                            <div class="content-image-home-in">
                              <p> 
                                '.$row['image_description'].'
                               </p>
                             </div>
                           </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                          <div class="col-md-12 logo-content text-center text-yellow"><h1>'.$row['title'].'</h1></div>
                          <div class="col-md-12 text-center"><h2>GET BEST OFFER<br>RIGHT NOW!</h2><i>'.$row['description'].'</i></div>
                          <div class="col-md-12"><a href="'.$row['link_reserve'].'"><button class="btn btn-default btn-reserve center-block">RESERVE NOW</button></a></div>
                          </div>
                          </div>';
                  }
                }
                  echo $_row;
                }
              }
  
            ?>


  <!--   			<div class="row box-black no-margin-row content-home">
    				<div class="col-md-4 col-sm-4 col-xs-12">
    					<div class="col-md-12 logo-content"><img src="<?php echo get_template_directory_uri(); ?>/images/logosamudera.png" class="img-responsive center-block"></div>
    					<div class="col-md-12 text-center"><h2>GET BEST OFFER<br>RIGHT NOW!</h2><i>SPECIAL PRICE IN ALL LOCATION <br>OF OUR FOODS!</i></div>
    					<div class="col-md-12"><a href="'.$row['link_reserve'].'"><button class="btn btn-default btn-reserve center-block">RESERVE NOW</button></a></div>
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
    					<div class="col-md-12"><a href="'.$row['link_reserve'].'"><button class="btn btn-default btn-reserve center-block">RESERVE NOW</button></a></div>
    				</div>
    			</div>
    			<div class="row box-black no-margin-row content-home">
    				<div class="col-md-4 col-sm-4 col-xs-12">
    					<div class="col-md-12 logo-content text-center text-yellow"><h1>Ayodya<br>POOL BAR</h1></div>
    					<div class="col-md-12 text-center"><h2>GET BEST OFFER<br>RIGHT NOW!</h2><i>SPECIAL PRICE IN ALL LOCATION <br>OF OUR POOLBAR!</i></div>
    					<div class="col-md-12"><a href="'.$row['link_reserve'].'"><button class="btn btn-default btn-reserve center-block">RESERVE NOW</button></a></div>
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
    					<div class="col-md-12"><a href="'.$row['link_reserve'].'"><button class="btn btn-default btn-reserve center-block">RESERVE NOW</button></a></div>
    				</div>
    			</div>
    			<div class="row box-black no-margin-row content-home">
    				<div class="col-md-4 col-sm-4 col-xs-12">
    					<div class="col-md-12 logo-content text-center text-yellow"><h1>ROOM</h1></div>
    					<div class="col-md-12 text-center"><h2>GET BEST OFFER<br>RIGHT NOW!</h2><i>SPECIAL PRICE IN ALL LOCATION <br>OF OUR ROOMS!</i></div>
    					<div class="col-md-12"><a href="'.$row['link_reserve'].'"><button class="btn btn-default btn-reserve center-block">RESERVE NOW</button></a></div>
    				</div>
    				<div class="col-md-8 col-sm-8 col-xs-12 no-padding">
    					<img src="<?php echo get_template_directory_uri(); ?>/images/rooms.jpg" class="img-responsive full">
    				</div>
    			</div> -->
    		</div>
    	</div>
<?php get_footer(); ?>

