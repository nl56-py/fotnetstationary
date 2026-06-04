<?php

if(get_theme_mod('counter_area_disable') != 'on' ){
	?>
	<?php 
		if( get_theme_mod('counter_areaTpadding',true) ) {
			$counter_areaTpadding = 'padding-top:'.esc_attr(get_theme_mod('counter_areaTpadding')).';';
		}
		if( get_theme_mod('counter_areaBpadding',true) ) {
			$counter_areaBpadding = 'padding-bottom:'.esc_attr(get_theme_mod('counter_areaBpadding')).';';
		}
		
	?>		
	<div class="counter-area " id="counter" style="<?php echo esc_attr($counter_areaTpadding); ?>" "<?php echo esc_attr($counter_areaBpadding); ?>">
		<div class="ovly"></div>
		 <?php
	          $showStatic = true;
	          for( $i = 1; $i < 9; $i++ ){
	            $counter_page_id = get_theme_mod('counter_page_icon'.$i); 
	            if(!empty($counter_page_id)){
	              $showStatic = false;
	              break;
	            }
	          }
         ?>

		<div class="container">  
			<div class="counter-single-area">  
				<?php
				$cols = get_theme_mod('counter_npp_count', 3);
				$cols++;
							// echo '$cold: '.$cols;
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
					case 9:
					case 11:
					case 13:
					case 15:
					$colCls = 'col-md-3 col-sm-6 col-xs-12';
					break;
					default: 
					$colCls = 'col-md-3 col-sm-3 col-xs-12';
					break;
				}
				$icons = array(1=>'heart', 2=>'star', 3=>'flash', 4=>'bell',5=>'heart', 6=>'star', 7=>'flash', 8=>'bell');
				?>
 				<div class="row">
                      <?php
                      for( $i = 1; $i <= $cols; $i++ ){
                        if($showStatic === false){
                         	$counter_page_id = get_theme_mod('counter_page'.$i);
                          	$counter_page_title = get_theme_mod('counter_page_title'.$i, 'HAPPY CUSTOMER');
                          	$counter_page_num = get_theme_mod('counter_page_num'.$i, '160');
                          	
	                      	$counter_page_icon = get_theme_mod('counter_page_icon'.$i);
							if($counter_page_icon){
                          ?>

	            <div class="<?php echo $colCls;?> couneter-box  <?php echo esc_attr(get_theme_mod('logoicalthemes_couneter_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
			            <div class="cd-single">
					            <div class="count-box">
							             <div class="Col-xl-5 col-md-5 col-sm-5 col-xs-12 pd-0">
							             	<div class="cd-icon">
									                <i class="<?php echo $counter_page_icon; ?> fill-gradient-icon"></i>
									            </div>							             			
							            </div>
					                <div class="Col-xl-7 col-md-7 col-sm-7 col-xs-12 pd-0">
						              			<div class="cd-num inner-area-title counter" data-target="<?php echo $counter_page_num; ?> ">
						              				
						              			</div>
					              	</div>
					              	<div class="clearfix"></div>
					              	 <?php if($counter_page_title){ ?>
					              	<div class="cd-title inner-area-title">
						              		<?php echo $counter_page_title; ?>
						              </div>
						              <?php }?> 
					              	<div class="clearfix"></div>
					            </div>	            	
				        	</div>
			          <div class="clearfix"></div>
	          	</div>
                <?php
          }
              
          }else{?>
					    <div class="<?php echo $colCls;?> couneter-box <?php echo esc_attr(get_theme_mod('logoicalthemes_couneter_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
	                <div class="cd-single">
		                	 <div class="count-box " >        
					                <div class="Col-xl-5 col-md-5 col-sm-5 col-xs-12 pd-0">
							               	<div class="cd-icon">
						                      <i class="fa fa-thumbs-o-up fill-gradient-icon"></i>
											</div>
						              </div>
					                <div class="Col-xl-7 col-md-7 col-sm-7 col-xs-12 pd-0">
					               
						                <div class="cd-num inner-area-title counter" data-target="160"></div>
				                 </div>  
				                 <div class="clearfix"></div>   
					                <div class="cd-title inner-area-title">HAPPY CUSTOMER</div>
					                <div class="clearfix"></div>
			                </div>
	              	</div>
					        <div class="clearfix"></div>
					    </div>
				        <?php }
				      }?>
				      <div class="clearfix"></div>
			    </div>
			</div>
		</div>
	</div> 

<script type="text/javascript">
const counters = document.querySelectorAll(".counter");

counters.forEach((counter) => {
  counter.innerText = "0";
  const updateCounter = () => {
    const target = +counter.getAttribute("data-target");
    const count = +counter.innerText;
    const increment = target / 200;
    if (count < target) {
      counter.innerText = `${Math.ceil(count + increment)}`;
      setTimeout(updateCounter, 1);
    } else counter.innerText = target;
  };
  updateCounter();
});
</script>


	
<?php } 