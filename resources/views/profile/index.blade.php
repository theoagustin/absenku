@include('../template/headersite') 
 <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

      
 @include('../template/part/nav-header')
  <!--@include('../template/part/layout-setting');-->
      
        
          <div class="app-main__inner m-0 p-1">
            <?php //include "part/breadcrum.php";?>
              <?php //include "part/content.php";?>
			  <?php //eval($CONTENT_["main"]);?>
              
              @include('../profile/data')
          </div>
          <div class="app-wrapper-footer">
 
 @include('../template/part/nav-bottom')
          </div>
    </div>
    
 <!--@include('../template/part/nav-right');-->
@include('../template/footersite') 
 