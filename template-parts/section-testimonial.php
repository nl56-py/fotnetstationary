<?php 
/**
 *
 * @package 
 */

if(get_theme_mod('testimonials_area_disable') != 'on' ){ ?> 


    <?php 
    if( get_theme_mod('testimonials_areaTpadding',true) ) {
      $testimonials_areaTpadding = 'padding-top:'.esc_attr(get_theme_mod('testimonials_areaTpadding')).';';
    }
    if( get_theme_mod('testimonials_areaBpadding',true) ) {
      $testimonials_areaBpadding = 'padding-bottom:'.esc_attr(get_theme_mod('testimonials_areaBpadding')).';';
    } 

    if( get_theme_mod('testimonials_nextprevbuttonHeight',true) ) {
      $testimonials_nextprevbuttonHeight = 'height:'.esc_attr(get_theme_mod('testimonials_nextprevbuttonHeight')).';';
    }   

    if( get_theme_mod('testimonial_ImageOpacity',true) ) {
          $testimonial_ImageOpacity = 'opacity:'.esc_attr(get_theme_mod('testimonial_ImageOpacity')).';';
        }
    if( get_theme_mod('testimonial_thumbimgOpacity',true) ) {
          $testimonial_thumbimgOpacity = 'opacity:'.esc_attr(get_theme_mod('testimonial_thumbimgOpacity')).';';
        }
  
  
    ?>  
  <div class="testimonials-area " id="testimonials" style="<?php echo esc_attr($testimonials_areaTpadding);?>" "<?php echo esc_attr($testimonials_areaBpadding);?>">

    
    <?php
      $testimonials_page_id = get_theme_mod('testimonials_page'); 
      $testimonials_maintitle = get_theme_mod('testimonials_maintitle', 'OUR');
      $testimonials_subtitle2 = get_theme_mod('testimonials_subtitle2', 'TESTIMONIAL');
      ?>
  <div class="container">


    <section>
  <div class="customer-feedback <?php echo esc_attr(get_theme_mod('logoicalthemes_testimonial_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">

        <div class="container">
          <?php if($testimonials_maintitle || $testimonials_subtitle2){ ?>
        <div class="head_white head_center">
           <?php if($testimonials_subtitle2 ){ ?> 
          <div class="title-dot"></div>
           <?php }?> 
            <div class="section-title">
              <div class="sub-title">
                <?php echo ($testimonials_maintitle);  ?>
              </div>                                            
                  <h2><?php echo ($testimonials_subtitle2);  ?></h2>              
            </div>
        </div>
        <?php }?>
      </div>


 

 
      <!--   <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8"> -->
            <div class=" col-md-8 col-md-offset-2 col-sm-12">
          <div class="owl-carousel feedback-slider">
             <?php 
      $showStatic = true;
      $cols = get_theme_mod('test_npp_count', 1);
      $cols++;
      switch($cols){
        case 1:
          $colCls = 'col-md-12 col-sm-12 col-xs-12';
          break;
        case 2:
          $colCls = 'col-md-6 col-sm-6 col-xs-12';
          break;
        case 3:
        case 5:
        case 6:
        case 7:
        case 8:
        case 9:
        case 10:
        case 11:
        case 12:
          $colCls = 'col-md-4 col-sm-6 col-xs-12';
          break;
        default:
          $colCls = 'col-md-3 col-sm-6 col-xs-12';
          break;
      }
      $icons = array(1=>'heart', 2=>'star', 3=>'flash', 4=>'bell',5=>'heart', 6=>'star', 7=>'flash', 8=>'bell'); 

      for( $i = 1; $i <= $cols; $i++ ){
        $testimonials_page_id = get_theme_mod('testimonials_page'.$i); 
        $testimonials_page_icon = get_theme_mod('testimonials_page_icon'.$i);
        if($testimonials_page_id){
          $showStatic = false;
          echo testimonialShortCode($testimonials_page_id, $isCustomizer=true, $i);
        }
      }
      // adding the static content
      if($showStatic === true){
        for( $i = 1; $i <= $cols; $i++ ){ ?>

            <!-- slider item -->
            <div class="feedback-slider-item <?php echo esc_attr(get_theme_mod('logoicalthemes_testimonial_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
              <div class="col-md-5 pd-0">
                <div class="img-overlay" style="<?php echo get_theme_mod('testimonial_ImageOpacity') ?>;"></div>
                 <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/testimonial1.jpg" alt="">
              </div>
              <div class="col-md-7 pd-0"> 
              <div class="quote">              
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>
              
               <div class="clearfix"></div>
                 <h3 class="customer-name">william son</h3>
                <div class="text-designation">
                    (Designer)
                </div>
             </div>
             </div>

             <div class="clearfix"></div>
            </div>
             <!-- /slider item -->
 <?php 
        }
      } ?>
   

          </div><!-- /End feedback-slider -->

          <!-- side thumbnail -->
          <div class="feedback-slider-thumb hidden-xs">
            <div class="thumb-prev <?php echo esc_attr(get_theme_mod('logoicalthemes_testimonial_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
              
              <span> Previous </span>             
               <div class="img-overlay1" style="<?php echo get_theme_mod('testimonial_thumbimgOpacity') ?>;"></div>
                <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/testimonial2.jpg" alt="">
                <div class="clearfix"></div>
            </div>

            <div class="thumb-next <?php echo esc_attr(get_theme_mod('logoicalthemes_testimonial_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
              <div class="img-overlay2" style="<?php echo get_theme_mod('testimonial_thumbimgOpacity') ?>;"></div>
              <span> Next </span>             
                 <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/testimonial3.jpg" alt=""> 
                   <div class="clearfix"></div>                         
            </div>
          </div>
          <!-- /side thumbnail -->

        </div><!-- /End col -->


  </div><!-- /End customer-feedback -->
</section>


   </div>
       </div><!--testimonials-area-->

 <script>
  jQuery(document).ready(function ($) {
  var feedbackSlider = $("#testimonials .feedback-slider");
  feedbackSlider.owlCarousel({
    items: 1,
    nav: true,
    dots: true,
    autoplay: true,
    loop: true,
    mouseDrag: true,
    touchDrag: true,
    navText: [
      "<i class='fa fa-long-arrow-left'></i>",
      "<i class='fa fa-long-arrow-right'></i>"
    ],
    responsive: {
      // breakpoint from 767 up
      767: {
        nav: true,
        dots: false
      }
    }
  });

  // feedbackSlider.on("translate.owl.carousel", function () {
  //   $(".feedback-slider-item h3")
  //     .removeClass("animated fadeIn")
  //     .css("opacity", "0");
  //   $(".feedback-slider-item img, .feedback-slider-thumb img, .customer-rating")
  //     .removeClass("animated ")
  //     .css("opacity", "0");
  // });

  // feedbackSlider.on("translated.owl.carousel", function () {
  //   $(".feedback-slider-item h3").addClass("animated fadeIn").css("opacity", "1");
  //   $(".feedback-slider-item img, .feedback-slider-thumb img, .customer-rating")
  //     .addClass("animated ")
  //     .css("opacity", "1");
  // });
  feedbackSlider.on("changed.owl.carousel", function (property) {
    var current = property.item.index;
    var prevThumb = $(property.target)
      .find(".owl-item")
      .eq(current)
      .prev()
      .find("img")
      .attr("src");
    var nextThumb = $(property.target)
      .find(".owl-item")
      .eq(current)
      .next()
      .find("img")
      .attr("src");
    var prevRating = $(property.target)
      .find(".owl-item")
      .eq(current)
      .prev()
      .find("span")
      .attr("data-rating");
    var nextRating = $(property.target)
      .find(".owl-item")
      .eq(current)
      .next()
      .find("span")
      .attr("data-rating");
    $(".thumb-prev").find("img").attr("src", prevThumb);
    $(".thumb-next").find("img").attr("src", nextThumb);
    $(".thumb-prev")
      .find("span")
      .next()
      //.html(prevRating + '<i class="fa fa-star"></i>');
    $(".thumb-next")
      .find("span")
      .next()
      //.html(nextRating + '<i class="fa fa-star"></i>');
  });
  $(".thumb-next").on("click", function () {
    feedbackSlider.trigger("next.owl.carousel", [300]);
    return false;
  });
  $(".thumb-prev").on("click", function () {
    feedbackSlider.trigger("prev.owl.carousel", [300]);
    return false;
  });
}); //end ready
      </script>




      <script>
    jQuery.noConflict();
   jQuery(document).ready(function () {
      function tsareasingleHeight(){
        var ht = 0;
        $('#testimonials .ts-area-single').each(function(i){
          var tHt = $(this).height();
          if(ht<tHt){
            ht=tHt;
          }
        });
        $('#testimonials .ts-area-single').height(ht+'px');
      }
      tsareasingleHeight();
    });
     jQuery( window ).resize(function(){
      tsareasingleHeight();
    });
  </script>
    <?php }