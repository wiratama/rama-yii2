<?php
/*
  Plugin Name: Grand Istana Rama
  Version: 1.0
 */

require_once 'inc/CPT.php';


$benefit = new CPT('Benefit', array(
    'supports' => array('title', 'editor', 'thumbnail', 'comments')
));

$benefit->columns(array(
    'cb' => '<input type="checkbox" />',    
    'title' => __('Title'),
    'date' => __('Date')
));

$benefit->menu_icon("dashicons-media-document");

$new = new CPT('New', array(
    'supports' => array('title', 'editor', 'thumbnail', 'comments')
));

$new->columns(array(
    'cb' => '<input type="checkbox" />',    
    'title' => __('Title'),
    'date' => __('Date')
));

$new->menu_icon("dashicons-pressthis");


$award = new CPT('Award', array(
    'supports' => array('title', 'editor', 'thumbnail', 'comments')
));

$award->columns(array(
    'cb' => '<input type="checkbox" />',    
    'title' => __('Title'),
    'date' => __('Date')
));

$award->menu_icon("dashicons-pressthis");

// $testimonial = new CPT('Testimonial', array(
//     'supports' => array('title', 'editor', 'thumbnail', 'comments')
// ));

// $testimonial->columns(array(
//     'cb' => '<input type="checkbox" />',    
//     'title' => __('Title'),
//     'date' => __('Date')
// ));

// $testimonial->menu_icon("dashicons-pressthis");


?>