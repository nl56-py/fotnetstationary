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
                $cols = get_theme_mod('faq_section_npp_count', 4);
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
                     <div class="Accordions">
                        <div class="Accordion_item">
                    <div class="title_tab">
                        <h3 class="title"><?php the_title(); ?><span class="icon"></span></h3>                        
                     </div>                         
                           <div class="inner_content"> 
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
            <div class="Accordions">
                <div class="Accordion_item">
                     <div class="title_tab">
                        <h3 class="title">Contrary to popular belief, Lorem Ipsum text ?<span class="icon"></span></h3>
                
                </div>
                <div class="inner_content">
                    <p><?php
                    if(!empty($isHome) && $isHome==1){
                        ?>
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        <?php
                                // if(!empty($faqPageId)){
                                //     echo '<a href="'.get_permalink($faqPageId).'">Read More..</a>';
                                // }else{
                                //     echo '<a href="'.get_permalink($faqPageId).'">Read More..</a>';
                                // }
                    }else{
                        ?>
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        <?php
                    }?>
                </p>
            </div>  
        </div>
        </div>
    </div>
    <?php
}
}
echo '</div>';
?>



<script>

</script>
<?php
$text = ob_get_contents();
ob_clean();
ob_end_flush();
wp_reset_postdata();
    // echo $text;
return $text;
}



//team shortcode
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
        $colCls = 'col-md-6 col-sm-6 col-xs-12';
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
        $colCls = 'col-md-4 col-sm-6 col-xs-12';
        break;
    } 

    // } 
 $text = '';
 $query = new WP_Query($args);
  //echo '<ul class="list-members">';
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
        
       

        ?>
        <div class="<?php echo $colCls;?> newteam-inner">
             <div class="single-team-member">
                    <div class="img-holder">
                         <?php
                            if (has_post_thumbnail()) {
                                $image_url = $team_area_image[0];
                            } else {
                                $image_url = get_template_directory_uri() . '/images/team-animate.jpg';
                            }
                         ?>                  
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>" />
                    </div>
                            <div  class="title-holder">
                                <div class="inner" data-match-height>
                                    <div class="left">
                                        <h3><?php the_title(); ?></h3>
                                         <?php if($team_area_designation){ ?>
                                         <h6 class="designation"><?php echo ($team_area_designation); ?></h6>
                                          <?php } ?>
                                        <div class="social-links">           
                                            <?php if ($team_area_facebook || $team_area_twitter || $team_area_instagram || $team_area_linkedin || $team_area_pinterest) { ?>
                                        <ul class="social-links-style1">
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
                                            </ul>
                                            
                                        </div>
                                    </div>
                                    <div class="right">
                                        <a href="#"><span class="flaticon-plus"></span></a>
                                    </div>
                                </div>    
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
/**
testimonial section
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
            <div class="feedback-slider-item <?php echo esc_attr(get_theme_mod('logoicalthemes_testimonial_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">                
            <div class="col-md-5 pd-0">
                <div class="img-overlay" style="<?php echo get_theme_mod('testimonial_ImageOpacity') ?>;"></div>
                 <img src="<?php echo (!empty($lz_fitness_image[0])) ? $lz_fitness_image[0] : get_template_directory_uri() . '/images/team-thumb.png' ?>" class="img-responsive" alt="<?php the_title(); ?>" /> 
            </div>
             <div class="col-md-7 pd-0">
                <div class="quote">
                <p><?php
                    if (has_excerpt()) {
                        echo get_the_excerpt( 20 );
                    } else {
                        echo get_the_content( 20 );
                    }
                    ?></p>
                    <div class="clearfix"></div>
               <h3 class="customer-name"><?php the_title(); ?></h3>               
                <div class="text-designation">
                     <?php
                         $name2 = get_post_meta($post->ID, 'testimonial_Sub_Title', false);
                         echo (!empty($name2[0])) ? $name2[0] : '';
                     ?> 
                </div>
             </div>  
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
  


/*==
  testimonial innerpage
  ==*/
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
           <!--  <div class="col-md-6 col-sm-6 col-xs-12"> -->
        <div class="innfeedback-item ">                
            <div class="col-md-3 col-sm-3 col-xs-12 pd-0 img-box">
                <div class="img-overlay"></div>
                 <img src="<?php echo (!empty($lz_fitness_image[0])) ? $lz_fitness_image[0] : get_template_directory_uri() . '/images/team-thumb.png' ?>" class="img-responsive" alt="<?php the_title(); ?>" /> 
            </div>
             <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="quote">
                <p><?php
                    if (has_excerpt()) {
                        echo get_the_excerpt( 20 );
                    } else {
                        echo get_the_content( 20 );
                    }
                    ?></p>
                    <div class="clearfix"></div>
               <h3 class="customer-name"><?php the_title(); ?></h3>               
                <div class="text-designation">
                     <?php
                         $name2 = get_post_meta($post->ID, 'testimonial_Sub_Title', false);
                         echo (!empty($name2[0])) ? $name2[0] : '';
                     ?> 
                </div>
             </div>  
            </div>            
      
        <div class="clearfix"></div>
    </div>
<!-- </div> -->
<script>
                jQuery.noConflict();
                $(function(){
                    function tsareasingleHeight(){
                        var ht = 0;
                        $('#innerpage-box .ts-area-single').each(function(i){
                            var tHt = $(this).height();
                            if(ht<tHt){
                                ht=tHt;
                            }
                        });
                        $('#innerpage-box .ts-area-single').height(ht+'px');
                    }
                    tsareasingleHeight();
                });
                $( window ).resize(function(){
                    tsareasingleHeight();
                });
            </script>   

    <!-- inner page end-->
        <?php
    endwhile;
    $text = ob_get_contents();
    ob_clean();
endif;
wp_reset_postdata();
return $text;
}

/*section services*/
function serviceShortCode($pageId = null, $isCustomizer = false, $i = null) {
    ob_start();

    $args = array('post_type' => 'our-services');
    if (!empty($pageId)) {
        $args['page_id'] = absint($pageId);
    }
    $args['posts_per_page'] = 1;
    $colCls = '';
    // if($isCustomizer == true){
    $cols = get_theme_mod('service_npp_count',7);  
    $services_page_icon1 = get_theme_mod('services_page_icon1'.$i);

    ++$cols;
    switch ($cols) {
       case 1:
                        $colCls = 'col-md-3 col-sm-6 col-xs-12';
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
                $luzuk_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-service-thumb');
                $post = get_post();

                 $servicesNum = get_post_meta($post->ID, 'servicesNum', false);
                    $services_Num = !empty($servicesNum[0]) ? $servicesNum[0] : '';
                ?>
        <div class="<?php echo $colCls;?>  service-mainbox  <?php echo esc_attr(get_theme_mod('logoicalthemes_services_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s"> 
        
            
            <div class="single-service-bx">
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
                         <div class="clearfix"></div>                                         
                   
                    <div class="service-title-box">
                        <div class="service-icon">
                        <i class="<?php echo $services_page_icon1 ?>" aria-hidden="true"></i>
                    </div>
                        <a href="<?php the_permalink(); ?>"> <h4 class="inner-area-title "><?php the_title(); ?></h4></a>                       
                    </div>                 
               
                <div class="clearfix"></div> 
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


//page services
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
        <!-- <div class="item inser"> -->
    <div class="<?php echo $colCls;?> grid-item-inner">    
        <div class="item--featured">     
            <a href="<?php the_permalink(); ?>">
             <?php
                 if (has_post_thumbnail()) {
                                $image_url = $luzuk_image[0];
                            } else {
                                $image_url = get_template_directory_uri() . '/images/services.jpg';
                            }
                ?>
                <img class="img-responsive" src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>" />
            </a>
        </div>
    <div class="item--holder" data-match-height>
        <div class="item--meta">
            <h3 class="item--title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <!--       <div class="item--content">
                <?php
                            ///if(has_excerpt()){
                              //echo get_the_excerpt();
                            // }else{
                             // echo luzuk_excerpt( get_the_content() , 20 );
                             //} 
                           // ?>
                                
            </div> -->
        </div>
         <div class="item--readmore"> <a href="<?php the_permalink(); ?>"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        </div>
    </div>
    <div class="clearfix"></div>
</div>


        <script>
                jQuery.noConflict();
                $(function(){
                    function servicesinnHeight(){
                        var ht = 0;
                        $('#innerpage-box .servicesinn').each(function(i){
                            var tHt = $(this).height();
                            if(ht<tHt){
                                ht=tHt;
                            }
                        });
                        $('#innerpage-box .servicesinn').height(ht+'px');
                    }
                    servicesinnHeight();
                });
                $( window ).resize(function(){
                    servicesinnHeight();
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

/*---projects-----*/
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
        $colCls = 'col-md-4 col-sm-6 col-xs-12';
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
        $colCls = 'col-md-4 col-sm-6 col-xs-12';
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
        <div class="<?php echo $colCls;?>">
            <div class="project-post" data-match-height>
                <div class="image">
                     <?php
                            if (has_post_thumbnail()) {
                                $image_url = $luzuk_image[0];
                            } else {
                                $image_url = get_template_directory_uri() . '/images/projects.jpg';
                            }
                        ?>
                    <a class="d-block" href="<?php the_permalink(); ?>">
                      <img class="img-responsive" src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>" />
                    </a>
                        <span class="date"><?php echo get_the_date( 'j' ); ?> <?php echo get_the_date( 'M' ); ?> <?php echo get_the_date( 'Y' ); ?></span>
                </div>
                <div class="content">
                    <h3><a href="/blog-details/"><?php $title = the_title('','',FALSE); echo substr($title, 0, 25); ?></a></h3>
                    <p><?php
                            if(has_excerpt()){
                              echo get_the_excerpt();
                             }else{
                              echo luzuk_excerpt( get_the_content() , 140 );
                             } 
                            ?></p>
                    <a class="default-btn" href="<?php the_permalink(); ?>">
                        <span class="fa fa-angle-right" aria-hidden="true"></span>Read More</a>
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


// For Homepage section Gallery
function gprojectShortCode($pageId = null, $isCustomizer = false, $i = null) {
  ob_start();

  $args = array('post_type' => 'our_gallery'); 
  if (!empty($pageId)) {
    $args['page_id'] = absint($pageId);
  }
  $args['posts_per_page'] = -1;
  $colCls = '';
    // if($isCustomizer == true){
  $cols = get_theme_mod('cw_gallery_page_npp_count',4);  
  ++$cols;
  $icons = array(1=>'heart', 2=>'star', 3=>'flash', 4=>'bell',5=>'heart', 6=>'star', 7=>'flash', 8=>'bell');  
    // }
  $text = '';
  $query = new WP_Query($args);
  if ($query->have_posts()):
    $postN = 0;

    while ($query->have_posts()) : $query->the_post();
      $sb_cw_gallery_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'total-service-thumb');
      $post = get_post();
      ?> 

      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 portfolio_item_post <?php echo esc_attr(get_theme_mod('logoicalthemes_gallery_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
       <?php
       if (has_post_thumbnail()) {
        $image_url = $sb_cw_gallery_image[0];
      } else {
        $image_url = get_template_directory_uri() . '/images/gallery.jpg';
      }
      ?>      

<div class="img-wrapper post_media post_post_media post_posts_grid_post_media"> 
          <a href="<?php echo esc_url($image_url); ?>"><img src="<?php echo esc_url($image_url); ?>"></a>
          <div class="img-overlay">
            <div class="cwsportfolio_content_wrap">
                        <!-- <a href="" class="links area fancy">
                        </a> -->
                        <div class="hover-effect">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16"> <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" fill="white"></path> <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" ></path> </svg>
                        </div>
                      </div>
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


/*gallery innerpage*/ 

function galleryShortCode($pageId = null, $isCustomizer = false, $i = null) {

    ob_start();

    $args = array('post_type' => 'our_gallery');
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
 <div class="<?php echo $colCls;?> ">
        <div class="gallery">
            <div class="gallery-item">             
                             
                    <div class="gallery-item-image"> 
                    <?php
                        if (has_post_thumbnail()) {
                            $image_url = $luzuk_image[0];
                        } else {
                            $image_url = get_template_directory_uri() . '/images/about1.jpg';
                        }
                    ?>  
                     <img class="secondry-bg img-responsive" src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>" />
                    </div>            
                   <a class="group1 hover" href="<?php echo esc_url($image_url); ?>" title="<?php the_title(); ?>">
                    <span class="view">
                    <hr class="hr1">
                     <hr class="hr2">
                         <!--   <span class="fa fa-plus" aria-hidden="true"></span> -->

                    </span>  
                </a>               
            </div>                 
              <div class="clearfix"></div>

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
add_shortcode('GALLERY', 'galleryShortCode'); 
add_shortcode('SERVICES', 'serviceInnerpageShortCode');
add_shortcode('FAQS', 'faqShortcode');
add_shortcode('PROJECT', 'projectInnerpageShortCode');