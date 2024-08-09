@include('../template/headersite') 
 <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

      
 @include('../template/part/nav-header')
  <!--@include('../template/part/layout-setting');-->
      
      <div class="app-main p-t-1 m-0 ">
        
 @include('../template/part/nav-menu')
        
        <div class="app-main__outer p-t-0 m-t-0">
          <div class="app-main__inner m-0 p-1">
            <?php //include "part/breadcrum.php";?>
              <?php //include "part/content.php";?>
			  <?php //eval($CONTENT_["main"]);?>
              
              @include('../admin/welcome')
          </div>
          <div class="app-wrapper-footer">
 
 @include('../template/part/nav-bottom')
          </div>
        </div>
      </div>
    </div>
    
 <!--@include('../template/part/nav-right');-->
@include('../template/footersite') 
 