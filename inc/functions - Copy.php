<?php
 //faq
           function faqShortcode($isHome = 0) {
            global $query;
            $args = array('post_type' => 'our-faq');

            if (!empty($pageId)) {
                $args['page_id'] = absint($pageId);
            } else {
                $args['paged'] = max(1, get_query_var('paged'));
            }

            if(!empty($isHome) && $isHome == 1){
                $cols = get_theme_mod('faq_section_npp_count', 2);
                $cols++;
                $args['posts_per_page'] = $cols;
            }else{
                $args['posts_per_page'] = (!empty($args['posts_per_page'])) ? $args['posts_per_page'] : -1;
         // $cols = 5;
            }
            $faqPageId = get_theme_mod('faq_section_page_link');
            $query = new WP_Query($args);
            ob_start();
    // print_r($query); ?>              
        <?php  echo '<div class="faq innerfaqpagehome">';
            if ($query->have_posts()){
                while ($query->have_posts()) : $query->the_post();
                    $post = get_post();
                    ?>
                    <div class="row">
                     <div class="col-md-12 faq-content pd-0 wow fadeInDown" data-wow-duration="3s">
                         <button class="accordion"><h3 class="faq-title accordion"><?php the_title(); ?></h3></button>
                         <div class="panel">
                           <div class="faq-description"> 
                            <p><?php
                           if(!empty($isHome) && $isHome==1){
                            if (has_excerpt()) {
                                echo get_the_excerpt();
                            } else {
                                    //echo luzuk_excerpt(get_the_content(),300);
                               echo get_the_content();
                           }
                                // if(!empty($faqPageId)){
                                //     echo '<a href="'.get_permalink($faqPageId).'">Read More..</a>';
                                // }else{
                                //     echo '<a href="'.get_permalink($faqPageId).'">Read More..</a>';
                                // }
                       }else{
                        echo get_the_content();
                    }?></p>
                </div>
            </div>
        </div>

    </div>
    <?php
endwhile;
}else{
    for($i=0; $i<$cols; $i++){
        ?>
        <div class="row">
            <div class="col-md-12 faq-content">
                <h6 class="faq-title">Lorem Ipsum is simply dummy text of the printing and typesetting industry?</h6>
                <div class="faq-description">
                    <p><?php
                    if(!empty($isHome) && $isHome==1){
                        ?>
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing  typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                        <br>
                        <?php
                                // if(!empty($faqPageId)){
                                //     echo '<a href="'.get_permalink($faqPageId).'">Read More..</a>';
                                // }else{
                                //     echo '<a href="'.get_permalink($faqPageId).'">Read More..</a>';
                                // }
                    }else{
                        ?>
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing  typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.

                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing  typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                        <?php
                    }?>
                </p>
            </div>  
        </div>
    </div>
    <?php
}
}
echo '</div>';
?>

<!--faq inner page-->

<?php  

      $faqs_innertitle1 = get_theme_mod('faqs_innertitle1', 'HAVE ANY QUESTION');
      $faqs_innersubtitle1 = get_theme_mod('faqs_innersubtitle1', 'Frequently Asked Questions');
      $faqs_innersubtext1 = get_theme_mod('faqs_innersubtext1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luc tusnec ullamcorper mattis, pulvinar. Ut elit tellus, luc tusnec ullamcorper mattis, pulvinar.ullamcorper mattis, pulvinar. Ut elit tellus, luc tusnec.');
      ?>
        <?php  echo '        
            <div class="row justify-content-center innerfaqpage">                                
                  <div class="section-title">';?>
                    
                   <?php  echo ' <div class="sub-title">-- ';?>
                      <?php echo ($faqs_innertitle1);  ?>
                   <?php  echo ' --</div>                                
                          <h2>';?> <?php echo ($faqs_innersubtitle1);  ?> <?php  echo '</h2>
                          <p> ';?><?php echo ($faqs_innersubtext1);  ?> <?php  echo '</p> ';?> 
                                 
                 <?php  echo ' </div>
                </div>
        <div class="col-md-12 col-sm-12 col-xs-12 pd-0 innerfaqpage">
        <div class="col-md-6 col-sm-6 col-xs-12 faqinner-image">
        ';?>
           <?php 
                  $faqinner_image = get_theme_mod('faqinner_image');
                  if(!empty($faqinner_image)){
                    echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($faqinner_image).'" class="img-responsive secondry-bg-img" />';
                  }else{
                    echo '<img alt="Faq" src="'.get_template_directory_uri().'/images/faqinnerimg.jpg" class="img-responsive" />';
                  }
              ?>             
        <?php echo '
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 innerfaqpage">  
            <div class="faq">';
            if ($query->have_posts()){
                while ($query->have_posts()) : $query->the_post();
                    $post = get_post();
                    ?>
                    <div class="row">
                     <div class="col-md-12 faq-content pd-0 wow fadeInDown" data-wow-duration="3s">
                         <button class="accordion"><h3 class="faq-title accordion"><?php the_title(); ?></h3></button>
                         <div class="panel">
                           <div class="faq-description"> 
                            <p><?php
                           if(!empty($isHome) && $isHome==1){
                            if (has_excerpt()) {
                                echo get_the_excerpt();
                            } else {
                                    //echo luzuk_excerpt(get_the_content(),300);
                               echo get_the_content();
                           }
                                // if(!empty($faqPageId)){
                                //     echo '<a href="'.get_permalink($faqPageId).'">Read More..</a>';
                                // }else{
                                //     echo '<a href="'.get_permalink($faqPageId).'">Read More..</a>';
                                // }
                       }else{
                        echo get_the_content();
                    }?></p>
                </div>
            </div>
        </div>

    </div>
    <?php
endwhile;
}else{
    for($i=0; $i<$cols; $i++){
        ?>
        <div class="row">
            <div class="col-md-12 faq-content">
                <h6 class="faq-title">Lorem Ipsum is simply dummy text of the printing and typesetting industry?</h6>
                <div class="faq-description">
                    <p><?php
                    if(!empty($isHome) && $isHome==1){
                        ?>
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing  typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                        <br>
                        <?php
                                // if(!empty($faqPageId)){
                                //     echo '<a href="'.get_permalink($faqPageId).'">Read More..</a>';
                                // }else{
                                //     echo '<a href="'.get_permalink($faqPageId).'">Read More..</a>';
                                // }
                    }else{
                        ?>
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing  typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.

                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing  typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                        <?php
                    }?>
                </p>
            </div>  
        </div>
    </div>
    <?php
}
}
echo '</div></div>
</div>
';
?>
<!-- end-->

<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function(){
            this.classList.toggle("active");
            this.nextElementSibling.classList.toggle("show");
        }
    }
</script>
<?php
$text = ob_get_contents();
ob_clean();
ob_end_flush();
wp_reset_postdata();
    // echo $text;
return $text;
}

//team
function teamShortCode($pageId = null, $isCustomizer = false, $i = null) { 

    ob_start();

    $args = array('post_type' => 'our-team');
    if (!empty($pageId)) {
        $args['page_id'] = absint($pageId);
    }
    $args['posts_per_page'] = -1;
    $colCls = '';
    // if($isCustomizer == true){
    $cols = get_theme_mod('team_area_npp_count', 6);
    $cols++;
    switch($cols){
         case 1:
        $colCls = 'col-md-12 col-sm-12 col-xs-12';
        break;
        case 2: 
        $colCls = 'col-md-12 col-sm-12 col-xs-12';
        break;
        case 3:
        case 5:
        case 6:
        case 9:
        case 11:
        case 13:
        case 15:
        $colCls = 'col-md-12 col-sm-12 col-xs-12';
        break;
        default: 
        $colCls = 'col-md-12 col-sm-12 col-xs-12';
        break;
    } 

    // } 
 $text = '';
 $query = new WP_Query($args);
 if ($query->have_posts()):
    $postN = 0;

    while ($query->have_posts()) : $query->the_post();
        $team_area_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-team-thumb');
        if ($isCustomizer === true) {
            $team_area_designation = get_theme_mod('team_area_designation' . $i);
            $team_area_facebook = get_theme_mod('team_area_facebook' . $i);
            $team_area_twitter = get_theme_mod('team_area_twitter' . $i);
            $team_area_linkedin = get_theme_mod('team_area_linkedin' . $i);
            $team_area_instagram = get_theme_mod('team_area_instagram' . $i);
            $team_area_pinterest = get_theme_mod('team_area_pinterest' . $i);
        } else {
            $team_area_facebook = '';
            $team_area_twitter = '';
            $team_area_linkedin = '';
            $team_area_instagram = '';
            $team_area_pinterest = '';
            $team_area_designation = '';
        }

        $post = get_post();
            //Social media urls
        $teamFacebook = get_post_meta($post->ID, 'teamFacebook', false);
        $team_area_facebook = !empty($teamFacebook[0]) ? $teamFacebook[0] : '';

        $teamTwitter = get_post_meta($post->ID, 'teamTwitter', false);
        $team_area_twitter = !empty($teamTwitter[0]) ? $teamTwitter[0] : '';

        $teamInstagram = get_post_meta($post->ID, 'teamInstagram', false);
        $team_area_instagram = !empty($teamInstagram[0]) ? $teamInstagram[0] : '';

        $teamlinkedIn = get_post_meta($post->ID, 'teamlinkedIn', false);
        $team_area_linkedin = !empty($teamlinkedIn[0]) ? $teamlinkedIn[0] : '';

         $teamPinterest = get_post_meta($post->ID, 'teamPinterest', false);
        $team_area_pinterest = !empty($teamPinterest[0]) ? $teamPinterest[0] : '';

            //designation
        $designation = get_post_meta($post->ID, 'designation', false);
        $team_area_designation = !empty($designation[0]) ? $designation[0] : '';

        
        $teamphone = get_theme_mod('teamphone','999 555 66 66');
        $teamemail = get_theme_mod('teamemail','yourmail@domain.com');

        ?>

        <div class="<?php echo $colCls;?> single-team">
            <div class="our-team">
                <div class="col-md-12 pd-0 ">
                    <div class="col-md-2 pd-0">
                         <?php if ($team_area_facebook || $team_area_twitter || $team_area_instagram || $team_area_linkedin || $team_area_pinterest) { ?>
                            <div class="team-social-icon">
                                <?php if ($team_area_facebook) { ?>
                                <a target="_blank" href="<?php echo esc_url($team_area_facebook) ?>">
                                    <i class="fa fa-facebook"></i></a>
                                <?php } ?>
                                <?php if ($team_area_twitter) { ?>
                                    <a target="_blank" href="<?php echo esc_url($team_area_twitter) ?>" ><i class="fa fa-twitter"></i></a>
                                <?php } ?>
                                <?php if ($team_area_instagram) { ?>
                                    <a target="_blank" href="<?php echo esc_url($team_area_instagram) ?>" ><i class="fa fa-instagram"></i></a> 
                                <?php } ?>
                                   <?php if ($team_area_pinterest) { ?>
                                    <a target="_blank" href="<?php echo esc_url($team_area_pinterest) ?>"><i class="fa fa-pinterest"></i></a>
                                    <?php } ?>
                                  <?php if ($team_area_linkedin) { ?>
                                    <a target="_blank" href="<?php echo esc_url($team_area_linkedin) ?>" ><i class="fa fa-linkedin"></i></a> 
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                        <?php } ?> 
                        </div>
                        <div class="col-md-10 pd-0">
                            <div class="single-team-img">
                                <?php
                                if (has_post_thumbnail()) {
                                    $image_url = $team_area_image[0];
                                } else {
                                    $image_url = get_template_directory_uri() . '/images/team-thumb.png';
                                }
                                ?>                  
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>" />

                            </div>
                        </div>
                </div>
                <div class="clearfix"></div>
                <div class="team-con">
                    <div class="team-text">
                       <!--  <a href="<?php the_permalink(); ?>">  -->
                            <h4 class="inner-area-title wow fadeInLeft" data-wow-duration="1s"><?php the_title(); ?></h4>
                       <!--   </a>  -->
                        <div class="team-designation wow fadeInLeft" data-wow-duration="2s">
                            <?php echo ($team_area_designation); ?>
                        </div>
                        <p>
                            <?php
                                if(has_excerpt()){
                                  echo get_the_excerpt();
                                 }else{
                                  echo luzuk_excerpt( get_the_content() , 100 );
                                 } 
                            ?>
                        </p>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
             <div class="clearfix"></div>
        </div>
         <div class="col-md-12 col-sm-12 col-xs-12 single-team-inn">
            <!-- teampage -->
            <div class="teaminn-page">
                <div class="col-md-5 col-sm-5 col-xs-5 pd-0">
                <div class="single-team-img">
                    <?php
                    if (has_post_thumbnail()) {
                        $image_url = $team_area_image[0];
                    } else {
                        $image_url = get_template_directory_uri() . '/images/team-thumb.png';
                    }
                    ?>                  
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>" />
                     
                </div>
            </div><!--col 4 -->
               <div class="col-md-7 col-sm-7 col-xs-7 pd-0">
                <div class="team-con">
                    <div class="team-text">
                        <!-- <a href="<?php the_permalink(); ?>">  -->
                            <h4 class="inner-area-title wow fadeInLeft" data-wow-duration="1s"><?php the_title(); ?></h4>
                        <!--  </a>  -->
                        <div class="team-designation wow fadeInLeft" data-wow-duration="2s">
                            <?php echo ($team_area_designation); ?>
                        </div>
                    <div class="email-phone-box">
                    <p>
                    <i class="fa fa-phone" aria-hidden="true"></i> <?php echo ($teamphone); ?></p>
                    <p>
                    <i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:<?php echo ($teamemail); ?>"><?php echo ($teamemail); ?></a> 
                    </p>                            
                    </div>
                    <div class="clearfix"></div>
                        <?php if ($team_area_facebook || $team_area_twitter || $team_area_instagram || $team_area_linkedin || $team_area_pinterest) { ?>
                        <div class="team-social-icon">
                           
                            <?php if ($team_area_facebook) { ?>
                                <li><a target="_blank" href="<?php echo esc_url($team_area_facebook) ?>">
                                    <i class="fa fa-facebook"></i></a></li>
                                <?php } ?>
                                <?php if ($team_area_twitter) { ?>
                                   <li> <a target="_blank" href="<?php echo esc_url($team_area_twitter) ?>" ><i class="fa fa-twitter"></i></a></li>
                                <?php } ?>
                                <?php if ($team_area_instagram) { ?>
                                   <li> <a target="_blank" href="<?php echo esc_url($team_area_instagram) ?>" ><i class="fa fa-instagram"></i></a> </li>
                                <?php } ?>
                                   <?php if ($team_area_pinterest) { ?>
                                   <li> <a target="_blank" href="<?php echo esc_url($team_area_pinterest) ?>"><i class="fa fa-pinterest"></i></a></li>
                                    <?php } ?>
                                  <?php if ($team_area_linkedin) { ?>
                                   <li> <a target="_blank" href="<?php echo esc_url($team_area_linkedin) ?>" ><i class="fa fa-linkedin"></i></a> </li>
                                <?php } ?>
                            </div>
                        <?php } ?> 
                        
                          
                      <div class="clearfix"></div>  
                    </div>
                     <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div><!--col 8 -->
                <div class="clearfix"></div>
            </div><!--team page-->
             <div class="clearfix"></div>
              </div>
            
    <script>
        jQuery.noConflict();
        $(function(){
            function teamtextHeight(){
                var ht = 0;
                $('#innerpage-box .our-team').each(function(i){
                    var tHt = $(this).height();
                    if(ht<tHt){
                        ht=tHt;
                    }
                });
                $('#innerpage-box .our-team').height(ht+'px');
            }
            teamtextHeight();
        });
        $( window ).resize(function(){
            teamtextHeight();
        });
    </script>
        
   
            

            <?php
        endwhile;
        $text = ob_get_contents();
        ob_clean();
    endif;
    wp_reset_postdata();
    return $text;
}
/**
 * Use for the show the testimonials at home page and in testimonial page with shortcode
 * @param int $pageId default is null the id of a post
 * @param boolean $isCustomizer default is false if set to true it mean the output is set for the home page
 * @param int $i default null
 * @param boolean $showStaticVals default is false
 * @return string
 * @author Luzuk <support@luzuk.com>
 * */
function testimonialShortCode($pageId = null, $isCustomizer = false, $i = null) {

    ob_start();

    $args = array('post_type' => 'our-testimonial');
    if (!empty($pageId)) {
        $args['page_id'] = absint($pageId);
    }
    $colCls = '';
    // if($isCustomizer == true){
    $cols = get_theme_mod('test_npp_count', 2);
    $cols++;
    switch($cols){
        
            }
           $icons = array(1=>'heart', 2=>'star', 3=>'flash', 4=>'bell',5=>'heart', 6=>'star', 7=>'flash', 8=>'bell');     
    // }
    $text = '';
    $query = new WP_Query($args);
    if ($query->have_posts()):
        $postN = 0;

        while ($query->have_posts()) : $query->the_post();
            $lz_fitness_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-team-thumb');
        $post = get_post();

            if (($postN % 3) == 0 && $isCustomizer == false) {
                ?>
                
            
           
                <?php
            }
            ++$postN;
            ?>
            <div class="<?php echo $colCls; ?> item innertest-item wow zoomIn">                
              <div class="ts-area-single text-center col-md-12 col-sm-12 col-xs-12 pd-0">
              <div class="col-md-6 col-sm-6 col-xs-6 pd-0">
                  <div class="ts-area-thumb">
                    <div class="col-md-12 col-sm-12 col-xs-12 pd-0">
                      <div class="col-md-2 col-sm-2 col-xs-2 pd-0">
                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                      </div>
                   
                    <div class="col-md-10 col-sm-10 col-xs-10 pd-0">
                    <img src="<?php echo (!empty($lz_fitness_image[0])) ? $lz_fitness_image[0] : get_template_directory_uri() . '/images/team-thumb.png' ?>" class="img-responsive" alt="<?php the_title(); ?>" /> 
                    </div>
                  </div>
              </div>
          </div>
             <div class="ts-area-content text-center col-md-6 col-sm-6 col-xs-6 pd-0">       
              <div class="ts-area-c section-area-text"> 
                <h6 class="ts-area-title"><?php the_title(); ?></h6>               
                
                <div class="text-designation">
                     <?php
                         $name2 = get_post_meta($post->ID, 'testimonial_Sub_Title', false);
                         echo (!empty($name2[0])) ? $name2[0] : '';
                     ?> 
                </div>
                <?php
          $facebookt = get_theme_mod('testi_fb', '//facebook.com/');
          $twittert = get_theme_mod('testi_tw', '//twitter.com/');          
          $instagramt = get_theme_mod('testi_insta', 'https://www.instagram.com/');
                  ?>
                <div class="tstshare-btn">
                  <ul>
                    <?php if(!empty($facebookt)){ ?>
                      <li><a href="<?php echo $facebookt ?>" title="Facebook" class="site-button sharp" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <?php }?>
                    <?php if(!empty($instagramt)){ ?>
                      <li><a href="<?php echo $instagramt ?>" title="Instagram" class="site-button sharp" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <?php }?> 
                    <?php if(!empty($twittert)){ ?>
                      <li><a href="<?php echo $twittert ?>" title="Twitter" class="site-button sharp" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <?php }?>                    
                                       
                    <div class="clearfix"></div>
                  </ul>
                </div>
                <p><?php
                    if (has_excerpt()) {
                        echo get_the_excerpt();
                    } else {
                        echo get_the_content( 30 );
                    }
                    ?> 
                </p>
              </div><!-- ts-area-c-->              
              <div class="clearfix"></div>
            </div><!-- ts-area-content-->
        </div>
        <div class="clearfix"></div>
    </div>
   
<?php
    endwhile;
    $text = ob_get_contents();
    ob_clean();
endif;
wp_reset_postdata();
return $text;
}
?>
  <!-- inner page start-->  
 <?php   
function testimonialInnerpageShortCode($pageId = null, $isCustomizer = false, $i = null) {

    ob_start();

    $args = array('post_type' => 'our-testimonial');
    if (!empty($pageId)) {
        $args['page_id'] = absint($pageId);
    }
    $colCls = '';
    // if($isCustomizer == true){
    $cols = get_theme_mod('test_npp_count', 5);
    $cols++;
    switch($cols){
        
            }
           $icons = array(1=>'heart', 2=>'star', 3=>'flash', 4=>'bell',5=>'heart', 6=>'star', 7=>'flash', 8=>'bell');     
    // }
    $text = '';
    $query = new WP_Query($args);
    if ($query->have_posts()):
        $postN = 0;

        while ($query->have_posts()) : $query->the_post();
            $lz_fitness_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-team-thumb');
        $post = get_post();

            if (($postN % 3) == 0 && $isCustomizer == false) {
                ?>
                
            
        
                <?php
            }
            ++$postN;
            ?>

 <div class="col-md-6 col-sm-6 col-xs-12  innerpage-item wow zoomIn">                
        <div class="ts-area-single">              
            <!-- <div class="ts-area-content">  -->      
            <div class="ts-area-c section-area-text"> 
                <h6 class="ts-area-title"><?php the_title(); ?></h6> 
                <p><?php
                    if (has_excerpt()) {
                        echo get_the_excerpt();
                    } else {
                        echo get_the_content();
                    }
                    ?> 
                </p>  
            </div><!-- ts-area-c-->              
                
            <div class="col-md-12 col-sm-12 col-xs-12 pd-0">
                <div class="col-md-2 col-sm-3 col-xs-3 pd-0">
                    <div class="ts-area-thumb">
                    <img src="<?php echo (!empty($lz_fitness_image[0])) ? $lz_fitness_image[0] : get_template_directory_uri() . '/images/team-thumb.png' ?>" class="img-responsive" alt="<?php the_title(); ?>" /> 
                    </div>                        
                </div>
                <div class="col-md-7 col-sm-9 col-xs-9 pd-0">
                    <div class="text-designation">
                     <?php
                         $name2 = get_post_meta($post->ID, 'testimonial_Sub_Title', false);
                         echo (!empty($name2[0])) ? $name2[0] : '';
                     ?> 
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12 pd-0">                
        <?php
          $facebookt = get_theme_mod('testi_fb', '//facebook.com/');
          $twittert = get_theme_mod('testi_tw', '//twitter.com/');          
          $instagramt = get_theme_mod('testi_insta', 'https://www.instagram.com/');
         ?>
                 <div class="tstshare-btn">
                  <ul>
                    <?php if(!empty($facebookt)){ ?>
                      <li><a href="<?php echo $facebookt ?>" title="Facebook" class="site-button sharp" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <?php }?>
                    <?php if(!empty($instagramt)){ ?>
                      <li><a href="<?php echo $instagramt ?>" title="Instagram" class="site-button sharp" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <?php }?> 
                    <?php if(!empty($twittert)){ ?>
                      <li><a href="<?php echo $twittert ?>" title="Twitter" class="site-button sharp" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <?php }?>                    
                                       
                    <div class="clearfix"></div>
                  </ul>
                </div> <!-- tstshare-btn-->
                </div>
                
            </div>
                
                           
              <div class="clearfix"></div>
            <!-- </div> --><!-- ts-area-content-->
        </div><!-- ts-area-single-->
<div class="clearfix"></div>
    </div>

    <!-- inner page end-->
        <?php
    endwhile;
    $text = ob_get_contents();
    ob_clean();
endif;
wp_reset_postdata();
return $text;
}

/*services*/
function serviceShortCode($pageId = null, $isCustomizer = false, $i = null) {
    ob_start();

    $args = array('post_type' => 'our-services');
    if (!empty($pageId)) {
        $args['page_id'] = absint($pageId);
    }
    $args['posts_per_page'] = 1;
    $colCls = '';
    // if($isCustomizer == true){
    $cols = get_theme_mod('service_npp_count',2);  
    $services_page_icon1 = get_theme_mod('services_page_icon1'.$i);

    ++$cols;
    switch ($cols) {
       case 1:
                        $colCls = 'col-md-12 col-sm-12 col-xs-12';
                        break;
                        case 2: 
                        $colCls = 'col-md-4 col-sm-12 col-xs-12';
                        break;
                        case 3:
                        case 5:
                        case 6:
                        case 9:
                        case 11:
                        case 13:
                        case 15:
                        $colCls = 'col-md-4 col-sm-12 col-xs-12';
                        break;
                        default: 
                        $colCls = 'col-md-4 col-sm-12 col-xs-12';
                        break;
        }
    // }
        $text = '';
        $query = new WP_Query($args);
        if ($query->have_posts()):
            $postN = 0;

            while ($query->have_posts()) : $query->the_post();
                $luzuk_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-service-thumb');
                $post = get_post();

                 $servicesNum = get_post_meta($post->ID, 'servicesNum', false);
                    $services_Num = !empty($servicesNum[0]) ? $servicesNum[0] : '';
                ?>
        <div class="<?php echo $colCls;?> pd-1 service-mainbox"> 
        
            <div class="single-tringle">
            <div class="single-service-bx">
                <div class="single-service">
                    <div class="service-icon">
                    <i class="<?php echo $services_page_icon1 ?>" aria-hidden="true"></i>
                    </div>                      
                   
                    <div class="service-title-box">
                        <a href="<?php the_permalink(); ?>"> <h4 class="inner-area-title "><?php the_title(); ?></h4></a>
                        <p class="inner-area-text">
                            <?php
                                if(has_excerpt()){
                                  echo get_the_excerpt();
                                 }else{
                                  echo luzuk_excerpt( get_the_content() , 80 );
                                 } 
                             ?>
                        </p> 
                    </div>
                     <?php
                        $ser_button1 = get_theme_mod('ser_button1', 'Read More');
                    ?>
                    
                    <?php if($ser_button1) { ?>
                        <div class="btn5">  
                            <a href="<?php echo esc_url(get_permalink()); ?>">
                                <?php echo $ser_button1 ?><i class="fa fa-arrow-right"></i>
                            </a>
                        </div> 
                    <?php }?>
                        <div class="clearfix"></div>
                    <?php
                        if (has_post_thumbnail()) {
                            $image_url = $luzuk_image[0];
                        } else {
                            $image_url = get_template_directory_uri() . '/images/roofing-services2.jpg';
                        }
                        ?>
                        <div class="ser-img">
                            <a href="<?php the_permalink(); ?>">                              
                            <img class="img-responsive" src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>" />                                
                            </a>
                        </div><!--ser-img -->
                </div><!--single-service -->
                <div class="clearfix"></div> 
            </div>
            </div>             
        </div>


                <?php
            endwhile;
            $text = ob_get_contents();
            ob_clean();
        endif;
        wp_reset_postdata();
        return $text;
    }


function serviceInnerpageShortCode($pageId = null, $isCustomizer = false, $i = null) {
    ob_start();

    $args = array('post_type' => 'our-services');
    if (!empty($pageId)) {
        $args['page_id'] = absint($pageId);
    }
    $args['posts_per_page'] = -1;
    $colCls = '';
    // if($isCustomizer == true){
    $cols = get_theme_mod('serviceinner_npp_count',2);  
    //$services_page_icon1 = get_theme_mod('services_page_icon1'.$i);

    ++$cols;
    switch ($cols) {
       case 1:
                        $colCls = 'col-md-12 col-sm-12 col-xs-12';
                        break;
                        case 2: 
                        $colCls = 'col-md-6 col-sm-6 col-xs-12';
                        break;
                        case 3:
                        case 5:
                        case 6:
                        case 9:
                        case 11:
                        case 13:
                        case 15:
                        $colCls = 'col-md-4 col-sm-6 col-xs-12';
                        break;
                        default: 
                        $colCls = 'col-md-3 col-sm-6 col-xs-12';
                        break;
        }
    // }
        $text = '';
        $query = new WP_Query($args);
        if ($query->have_posts()):
            $postN = 0;

            while ($query->have_posts()) : $query->the_post();
                $luzuk_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-service-thumb');
                $post = get_post();

                 $servicesNum = get_post_meta($post->ID, 'servicesNum', false);
                    $services_Num = !empty($servicesNum[0]) ? $servicesNum[0] : '';
                ?>
        <!-- <div class="<?php //echo $colCls;?> single-service-bx"> -->
        <div class="item inser">
<!--inner page  -->
        <div ser-match-height="groupName" class="servicesinn">
            <div class="single-service">
                <div class="service-icon padding0">
                   <?php
                        if (has_post_thumbnail()) {
                            $image_url = $luzuk_image[0];
                        } else {
                            $image_url = get_template_directory_uri() . '/images/services.jpg';
                        }
                    ?>
                    <div class="ser-img">
                        <a href="<?php the_permalink(); ?>">
                            <div class="ser-icn">
                                <i class="fa fa-university"></i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
  <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
</svg>

                               
                               <div class="clearfix"></div> 
                            </div>
                            <img class="img-responsive" src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>" />
                             <div class="ovrly"></div> 
                             </a>
                     <?php
                        $ser_button = get_theme_mod('ser_button', 'Read More');
                    ?>
                        <?php if($ser_button) { ?>
                            <div class="btn5">  
                                <a href="<?php echo esc_url(get_permalink()); ?>">
                                    <span><?php echo $ser_button ?> </span>
                                </a>
                            </div> 
                        <?php }?>

                        
                    </div> 
                </div>                
                <div class="service-title-box">
                    <a href="<?php the_permalink(); ?>"> <h4 class="post-title inner-area-title wow fadeInDown"><?php the_title(); ?></h4></a>
                    <p class="post-text inner-area-text wow fadeInDown"> <?php
                        if(has_excerpt()){
                          echo get_the_excerpt();
                         }else{
                          echo luzuk_excerpt( get_the_content() , 100 );
                         } 
                        ?>
                    </p> 
                    
                </div>
               
            <div class="clearfix"></div>
            </div>  
        </div>
        <div class="clearfix"></div>
         </div>

        <!--inner page  --> 
        <script>
                jQuery.noConflict();
                $(function(){
                    function singleserviceHeight(){
                        var ht = 0;
                        $('#innerpage-box .single-service').each(function(i){
                            var tHt = $(this).height();
                            if(ht<tHt){
                                ht=tHt;
                            }
                        });
                        $('#innerpage-box .single-service').height(ht+'px');
                    }
                    singleserviceHeight();
                });
                $( window ).resize(function(){
                    singleserviceHeight();
                });
            </script>   


   
                <?php
            endwhile;
            $text = ob_get_contents();
            ob_clean();
        endif;
        wp_reset_postdata();
        return $text;
    }



/*---projects*/
function projectShortCode($pageId = null, $isCustomizer = false, $i = null) {

    ob_start();

    $args = array('post_type' => 'our-projects');
    if (!empty($pageId)) {
        $args['page_id'] = absint($pageId);
    }
    $args['posts_per_page'] = -1;
    $colCls = '';
    // if($isCustomizer == true){
    $cols = get_theme_mod('project_npp_count',7);  
    $projects_page_icon1 = get_theme_mod('projects_page_icon1'.$i);

    ++$cols;
    switch ($cols) {
        case 1:
        $colCls = 'col-md-12 col-sm-12';
        break;
        case 2: 
        $colCls = 'col-md-3 col-sm-6 col-xs-12';
        break;
        case 3:
        case 5:
        case 6:
        case 9:
        case 11:
        case 13:
        case 15:
        $colCls = 'col-md-3 col-sm-6 col-xs-12';
        break;
        default: 
        $colCls = 'col-md-3 col-sm-6 col-xs-12';
        break;
        }
    // }
        $text = '';
        $query = new WP_Query($args);
        if ($query->have_posts()):
            $postN = 0;

            while ($query->have_posts()) : $query->the_post();
                $luzuk_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-project-thumb');
                $post = get_post();

                // $projectsNum = get_post_meta($post->ID, 'projectsNum', false);
                //$projects_Num = !empty($projectsNum[0]) ? $projectsNum[0] : '';
                ?>
        <div class="<?php echo $colCls;?> single-project-bx">
            <div class="single-project">
                <div project-match-height="groupName" class="project-icon">
                       <?php
                            if (has_post_thumbnail()) {
                                $image_url = $luzuk_image[0];
                            } else {
                                $image_url = get_template_directory_uri() . '/images/projects.jpg';
                            }
                        ?>
                        
                        <a href="<?php echo esc_url(get_permalink()); ?>">
                                <!-- <img class="img-responsive" src="<?php echo esc_url(get_template_directory_uri().'/images/projects.jpg');?>" alt="project" /> -->
                                <img class="img-responsive" src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>" />
           
                                <div class="ovrly"></div>
                                        
                            <div class="projects-dateicon">                               
                            <i class="fa fa-circle" aria-hidden="true"></i><span class="fa fa-circle" aria-hidden="true"></span><h3><?php echo get_the_date( 'j M'); ?></h3>
                            </div>  
                    
                            <div class="overlay">
                                <div class="projects-dateiconhov">                               
                                <i class="fa fa-circle" aria-hidden="true"></i><span class="fa fa-circle" aria-hidden="true"></span><h3><?php echo get_the_date( 'j M'); ?></h3>
                                </div>  
                            </div>
                        </a>          
                
            </div>
            </div>  
<!-- <script>
    $(function () {
    "use strict";
    
    $(".popup img").click(function () {
        var $src = $(this).attr("src");
        $(".show").fadeIn();
        $(".img-show img").attr("src", $src);
    });
    
    $("span, .video").click(function () {
        $(".popup").fadeOut();
    });
    
});
</script> -->
            <script>
                jQuery.noConflict();
                $(function(){
                    function singleprojectHeight(){
                        var ht = 0;
                        $('#innerpage-box .single-project').each(function(i){
                            var tHt = $(this).height();
                            if(ht<tHt){
                                ht=tHt;
                            }
                        });
                        $('#innerpage-box .single-project').height(ht+'px');
                    }
                    singleprojectHeight();
                });
                $( window ).resize(function(){
                    singleprojectHeight();
                });
            </script>
        </div>


                <?php
            endwhile;
            $text = ob_get_contents();
            ob_clean();
        endif;
        wp_reset_postdata();
        return $text;
    }

function projectInnerpageShortCode($pageId = null, $isCustomizer = false, $i = null) {

    ob_start();

    $args = array('post_type' => 'our-projects');
    if (!empty($pageId)) {
        $args['page_id'] = absint($pageId);
    }
    $args['posts_per_page'] = -1;
    $colCls = '';
    // if($isCustomizer == true){
    $cols = get_theme_mod('project_npp_count',1);  
    $projects_page_icon1 = get_theme_mod('projects_page_icon1'.$i);

    ++$cols;
    switch ($cols) {
        case 1:
        $colCls = 'col-md-12 col-sm-12';
        break;
        case 2: 
        $colCls = 'col-md-6 col-sm-6 col-xs-12';
        break;
        case 3:
        case 5:
        case 6:
        case 9:
        case 11:
        case 13:
        case 15:
        $colCls = 'col-md-6 col-sm-6 col-xs-12';
        break;
        default: 
        $colCls = 'col-md-6 col-sm-6 col-xs-12';
        break;
        }
    // }
        $text = '';
        $query = new WP_Query($args);
        if ($query->have_posts()):
            $postN = 0;

            while ($query->have_posts()) : $query->the_post();
                $luzuk_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-project-thumb');
                $post = get_post();

                // $projectsNum = get_post_meta($post->ID, 'projectsNum', false);
                //$projects_Num = !empty($projectsNum[0]) ? $projectsNum[0] : '';
                ?>
<!--Inner page shortcode -->
        <div class="<?php echo $colCls;?> single-project-bx">
            <div class="single-project">
                <div class="main_box">
                    <div class="front">
                       <?php
                            if (has_post_thumbnail()) {
                                $image_url = $luzuk_image[0];
                            } else {
                                $image_url = get_template_directory_uri() . '/images/projects.jpg';
                            }
                        ?>
                        <div class="project-img">
                            <div class="overlay"></div>
                            <div class="project-link">
                              <a class="zmicn1" href="<?php the_permalink(); //echo $project_link ?>"> <i class="fa fa-eye"></i>
                              </a>                             
                            </div>
                            <a href="<?php the_permalink(); ?>">
                            <img class="img-responsive" src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>" />
                            </a>
                        </div> 
                    </div>
                    <div class="right">
                        <a href="<?php the_permalink(); ?>"> <h4 class="inner-area-title "><?php the_title(); ?></h4></a>
                        <p> <?php
                            if(has_excerpt()){
                              echo get_the_excerpt();
                             }else{
                              echo luzuk_excerpt( get_the_content() , 55 );
                             } 
                            ?>
                        </p>
                    </div>
                </div>
            </div>  
<script>
                jQuery.noConflict();
                $(function(){
                    function singleprojectHeight(){
                        var ht = 0;
                        $('#innerpage-box .single-project').each(function(i){
                            var tHt = $(this).height();
                            if(ht<tHt){
                                ht=tHt;
                            }
                        });
                        $('#innerpage-box .single-project').height(ht+'px');
                    }
                    singleprojectHeight();
                });
                $( window ).resize(function(){
                    singleprojectHeight();
                });
</script>
        </div>


                <?php
            endwhile;
            $text = ob_get_contents();
            ob_clean();
        endif;
        wp_reset_postdata();
        return $text;
    }

//===============================
/**
 * Use for the show the gallery at home page and in gallery page with shortcode
 * @param int $pageId default is null the id of a post
 * @param boolean $isCustomizer default is false if set to true it mean the output is set for the home page
 * @param int $i default null
 * @param boolean $showStaticVals default is false
 * @return string
 * @author Luzuk <support@luzuk.com>
 * */


/*gallery*/ 

function galleryShortCode($pageId = null, $isCustomizer = false, $i = null) {

    ob_start();

    $args = array('post_type' => 'our-gallery');
    if (!empty($pageId)) {
        $args['page_id'] = absint($pageId);
    }
    $args['posts_per_page'] = -1;
    $colCls = '';
    // if($isCustomizer == true){
    $cols = get_theme_mod('luzuk_gallery_npp_count', 7);  
    ++$cols;
    switch ($cols) {
                    case 1:
                    $colCls = 'col-md-12 col-sm-12 col-xs-12'; 
                    break;
                    case 2:
                    $colCls = 'col-md-6 col-sm-6 col-xs-12';
                    break;
                    case 3:
                    case 5:
                    case 6:
                    case 9:
                    $colCls = 'col-md-4 col-sm-6 col-xs-12';
                    break;
                    case 4:
                    case 7:
                    case 8:
                    case 10:
                    case 11:
                    case 12:
                    $colCls = 'col-md-4 col-sm-6 col-xs-12';
                    break;
                    default:
                    $colCls = 'col-md-4 col-sm-6 col-xs-12';
                    break;
    }
    // }
    $text = '';
    $query = new WP_Query($args);
    if ($query->have_posts()):
        $postN = 0;

        while ($query->have_posts()) : $query->the_post();
            $luzuk_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
            $post = get_post();
            ?> 

        <div class="<?php echo $colCls; ?>">
            <div class="lz-gallery-images">
                <!-- <figure class="spa-gall"> -->
                    <?php
                        if (has_post_thumbnail()) {
                            $image_url = $luzuk_image[0];
                        } else {
                            $image_url = get_template_directory_uri() . '/images/about1.jpg';
                        }
                    ?>
            <a href="<?php echo esc_url($image_url); ?>" title="<?php the_title(); ?>">  
                <img class="secondry-bg img-responsive" src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>" />
            </a> 
            <div class="gallery-content">
                    <div class="gallery-content-inner">
                        <a href="<?php echo esc_url($image_url); ?>" title="<?php the_title(); ?>"><i class="fas fa-search"></i></a>
                        <h3 class="item-title"><?php the_title(); ?></h3>
                    </div>
            </div>
                    <!-- <div class="overlay"></div>
            <a href="<?php echo esc_url($image_url); ?>" title="<?php the_title(); ?>"></a> -->
                <!-- </figure> -->
            </div>
        </div> 
                <?php
            endwhile;
            $text = ob_get_contents();
            ob_clean();
        endif;
        wp_reset_postdata();
        return $text;
    }
// theme inner page shortcode 
add_shortcode('TEAMLIST', 'teamShortCode');
add_shortcode('TESTIMONIALS', 'testimonialInnerpageShortCode');
add_shortcode('GALLERY', 'galleryShortcode'); 
add_shortcode('SERVICES', 'serviceInnerpageShortCode');
add_shortcode('FAQS', 'faqShortcode');
add_shortcode('PROJECT', 'projectInnerpageShortCode');