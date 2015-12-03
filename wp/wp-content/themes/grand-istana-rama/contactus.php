<?php
/* Template Name: Contact Us */
get_header(); ?>

  <div class="row box-shadow">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3943.7450253221823!2d115.1671567142642!3d-8.71574509125959!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd246bf0af0eb65%3A0xcd9a6ee9943613ff!2sGrand+Istana+Rama!5e0!3m2!1sid!2s!4v1445843519067" class="maps" frameborder="0" style="border:0" allowfullscreen></iframe>
  </div>
  <div class="row content">
  <?php while (have_posts()) : the_post(); ?>
    <div class="container">
      <div class="col-md-12">
        <h2 class="text-center more-space">CONTACT US</h2>
      </div>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php echo do_shortcode( '[contact-form-7 id="49" title="contact us" html_id="contact-form-49" html_class="form contact-form form-horizontal"]' ); ?>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12">
      <?php the_content(); ?>
      </div>
    </div>
  <?php endwhile; ?>
  </div>
<?php get_footer(); ?>