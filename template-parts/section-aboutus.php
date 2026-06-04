<?php
if(get_theme_mod('luzuk_about_area_disable') != 'on' ){
  ?>
  <!-- About Area Start -->
  <?php 
        if( get_theme_mod('about_areaTpadding',true) ) {
          $about_areaTpadding = 'padding-top:'.esc_attr(get_theme_mod('about_areaTpadding')).';';
        }
        if( get_theme_mod('about_areaBpadding',true) ) {
          $about_areaBpadding = 'padding-bottom:'.esc_attr(get_theme_mod('about_areaBpadding')).';';
        }
        if( get_theme_mod('about_areawave',true) ) {
          $about_areawave = 'top:'.esc_attr(get_theme_mod('about_areawave')).';';
        }
        ?>      

  <div class="about-area bg-img-1" id="about">  
     <div class="container">
      <?php
      $about_page_id = get_theme_mod('about_page');
      $about_subtitle = get_theme_mod('about_subtitle', 'ABOUT US');
      $abouttitle = get_theme_mod('about_title', 'Highly Catchy Green Printing');

      $abouttext = get_theme_mod('about_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspen
disse ultrices gravida. Risus commodo viverra maecenas accumsan lacu
s vel facilisis.');
     
      ?>

  
      <div class="col-md-6 col-sm-12 pd-0 col-xs-12  <?php echo esc_attr(get_theme_mod('logoicalthemes_aboutus_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
        <div class="row about-rhs">
           <?php if($about_subtitle || $abouttitle){ ?>
            <div class="section-title">
                <div class="sub-title"><?php echo ($about_subtitle);  ?></div>
                <?php if($abouttitle ){ ?>
                  <h2><?php echo ($abouttitle);  ?></h2>                 
              <?php }?>
            </div>
            <?php }?>
          <div class="htext"><?php echo ($abouttext);  ?></div>      
         
          
        
        <div class="clearfix"></div>

      <?php
        $showStatic = true;
        for( $i = 1; $i < 11; $i++ ){
          $aboutus_page_id = get_theme_mod('aboutus_page_icon'.$i); 
          if(!empty($aboutus_page_id)){
            $showStatic = false;
           break;
          }
        }
        ?>

        <div class="aboutus-post-wrap">
          <?php
          $cols = get_theme_mod('aboutus_npp_count', 1);
          $cols++;
          //echo '$cold: '.$cols;
          switch($cols){
            case 1:
            $colCls = 'col-md-12 col-sm-12 col-xs-12';
            break;
            case 2:
            case 4:
            case 8:
            case 7:
            case 10:
            case 11:
            case 12:
            $colCls = 'col-md-12 col-sm-12 col-xs-12';
            break;
            default: 
            $colCls = 'col-md-12 col-sm-12 col-xs-12';
            break;
          }
          $icons = array(1=>'heart', 2=>'star', 3=>'flash', 4=>'bell',5=>'heart', 6=>'star', 7=>'flash', 8=>'bell');
          ?>
          <div class="row aboutus-post-boxes">
            <?php
            for( $i = 1; $i <= $cols; $i++ ){
                if($showStatic === false){
                  $aboutus_page_id = get_theme_mod('aboutus_page'.$i); 
                  $aboutus_page_title = get_theme_mod('aboutus_page_title'.$i, 'Satisfied Service');
                  
                  $aboutus_11text = get_theme_mod('aboutus_11text'.$i, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
sed do eiusmod tempor inc');
                  
                  $aboutus_page_icon = get_theme_mod('aboutus_page_icon'.$i);
                 if($aboutus_page_icon){
                    
                  ?>
                  <div class="<?php echo $colCls;?> pd-0">
                    <?php if($aboutus_page_title || $aboutus_11text ){ ?>
                      <div class="aboutus-single">
                        <div class="col-md-1 col-sm-1 col-xs-2 pd-0">
                            <div class="hi-icon">
                                <span class="<?php echo $aboutus_page_icon; ?>"></span>
                            </div>
                        </div>  
                        <div class="col-md-11 col-sm-11 col-xs-10 ">
                            <div class="about-area-data">
                                <h4 class="inner-area-title"><?php echo $aboutus_page_title; ?></h4>
                                <p><?php echo $aboutus_11text; ?></p>
                            </div>
                        </div>
                      <div class="clearfix"></div>
                      </div>
                      <?php  } ?>
                      <div class="clearfix"></div>
                  </div>
                  <?php
                      
                  }
               }else{?>
                  <div class="<?php echo $colCls;?> pd-0">
                      <div class="aboutus-single">
                          <div class="col-md-1 col-sm-1 col-xs-2 pd-0">
                              <div class="hi-icon">
                                  <span class="fa fa-headphones"></span>
                              </div>
                          </div>
                          <div class="col-md-11 col-sm-11 col-xs-10 ">
                            <div class="about-area-data">
                                  <h4 class="inner-area-title">Satisfied Service</h4>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor inc<p>
                            </div>
                          </div>
                          <div class="clearfix"></div>            
                      </div>
                      <div class="clearfix"></div>
                  </div>
                <?php }
            }?>
            <div class="clearfix"></div>
          </div>
        </div>
        </div>
        <div class="clearfix"></div>
        <!--New Slider-->



          <?php
        $showStatic = true;
        for( $i = 1; $i < 11; $i++ ){
          $aboutus_page_id = get_theme_mod('aboutus_page_icon'.$i); 
          if(!empty($aboutus_page_id)){
            $showStatic = false;
           break;
          }
        }
        ?>



          <!--End New Slider-->
      </div>


          <div class="col-md-6 col-sm-12 col-xs-12 pd-0 abtimg  <?php echo esc_attr(get_theme_mod('logoicalthemes_aboutus_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
        <div class="col-md-12 col-sm-12 col-xs-12 pd-0">
            <div class="abou-img3">              
              <?php 
                  $about_image3 = get_theme_mod('about_image3');
                  if(!empty($about_image3)){
                    echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($about_image3).'" class="img-responsive secondry-bg-img" />';
                  }else{
                    echo '<img alt="About us" src="'.get_template_directory_uri().'/images/About3.jpg" class="img-responsive" />';
                  }
              ?>
            
              <div class="clearfix"></div>
            </div>

          </div>
              
      </div>
       <div class="clearfix"></div>
 <div class="slider-box">
        <div class="owl-carousel owl-theme">
          <?php
          $cols = get_theme_mod('featuraboutus_npp_count', 11);
          $cols++;
          //echo '$cold: '.$cols;
          switch($cols){
            case 1:
            $colCls = 'col-md-4 col-sm-4 col-xs-4';
            break;
            case 2:
            case 4:
            case 8:
            case 7:
            case 10:
            case 11:
            case 12:
            $colCls = 'col-md-4 col-sm-4 col-xs-4';
            break;
            default: 
            $colCls = 'col-md-4 col-sm-4 col-xs-4';
            break;
          }
          $icons = array(1=>'heart', 2=>'star', 3=>'flash', 4=>'bell',5=>'heart', 6=>'star', 7=>'flash', 8=>'bell');
          ?>
     
            <?php
            for( $i = 1; $i <= $cols; $i++ ){
                if($showStatic === false){
                  $aboutus_page_id = get_theme_mod('aboutus_page'.$i); 
                  $aboutusfeaturesaboutus_page_title = get_theme_mod('aboutusfeatures_page_title'.$i, 'Printing Suggestions');                                   
                  
                  $feaaboutus_page_icon = get_theme_mod('feaaboutus_page_icon'.$i);
                 if($feaaboutus_page_icon){
                    
                  ?>
                  
                  <div class="item">
                    <?php if($aboutusfeaturesaboutus_page_title ){ ?>
                      <div class="aboutus-slider text-center <?php echo esc_attr(get_theme_mod('logoicalthemes_aboutus_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">                       
                            <div class="slider-icon">
                                <span class="<?php echo $feaaboutus_page_icon; ?>"></span>
                            </div>
                            <h4 class="inner-area-title"><?php echo $aboutusfeaturesaboutus_page_title; ?></h4>    
                         
                      <div class="clearfix"></div>
                      </div>
                      <?php  } ?>
                      <div class="clearfix"></div>
                  </div>
                
                  <?php
                      
                  }
               }else{?>
                  <div class="item">
                      <div class="aboutus-slider text-center <?php echo esc_attr(get_theme_mod('logoicalthemes_aboutus_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">                        
                              <div class="slider-icon">
                                  <span class="fa fa-shopping-bag"></span>
                              </div>
                              <h4 class="inner-area-title">Printing Suggestions</h4>                         
                          <div class="clearfix"></div>            
                      </div>
                      <div class="clearfix"></div>
                  </div>
               
                <?php }
            }?>
        </div>
        </div>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div> 
  </div>

<script type="text/javascript"></script>

  <!-- About Area End -->
<?php }  