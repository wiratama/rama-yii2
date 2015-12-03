<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( 	"name" 		=> "Home Settings",
						"type" 		=> "heading"
				);
					

$of_options[] = array( 	"name" 		=> "Logo",
						"desc" 		=> "Upload your company logo.",
						"id" 		=> "logo_img",
						// Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
						"std" 		=> "",
						"type" 		=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Icon menu Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Icon Room",
						"id" 		=> "room_text",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Icon Restaurant",
						"id" 		=> "restaurant_text",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Icon Bar",
						"id" 		=> "bar_text",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Icon Pool",
						"id" 		=> "pool_text",
						"std" 		=> "",
						"type" 		=> "text"
				);
/*$of_options[] = array( 	"name" 		=> "Homepage Box content",
						"desc" 		=> "Unlimited box Content with drag and drop sortings.",
						"id" 		=> "box_content",
						"std" 		=> "",
						"type" 		=> "slider"
				);*/
			

$of_options[] = array( 	"name" 		=> "Social Media Settings",
						"type" 		=> "heading"
				);
$of_options[] = array( 	"name" 		=> "Facebook link",
						"desc" 		=> "Facebook link in footer bar.",
						"id" 		=> "facebook_text",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Twitter link",
						"desc" 		=> "Twitter link in footer bar.",
						"id" 		=> "twitter_text",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Instagram link",
						"desc" 		=> "Instagram link in footer bar.",
						"id" 		=> "instagram_text",
						"std" 		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Trip Advisor link",
						"desc" 		=> "Trip Advisor link in footer bar.",
						"id" 		=> "tripav_text",
						"std" 		=> "",
						"type" 		=> "text"
				);




$of_options[] = array( 	"name" 		=> "Footer Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Footer Text",
						"desc" 		=> "You can use the following shortcodes in your footer text",
						"id" 		=> "footer_text",
						"std" 		=> "",
						"type" 		=> "textarea"
				);							
// $of_options[] = array( 	"name" 		=> "Tracking Code",
// 						"desc" 		=> "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
// 						"id" 		=> "google_analytics",
// 						"std" 		=> "",
// 						"type" 		=> "textarea"
// 				);
				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
