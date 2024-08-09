@include('../template/headersite') 
 <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

      
 @include('../template/part/nav-header');
  @include('../template/part/layout-setting');
      
      <div class="app-main">
        
 @include('../template/part/nav-menu');
        <div class="app-main__outer">
          <div class="app-main__inner">
            <?php //include "part/breadcrum.php";?>
              <?php //include "part/content.php";?>
			  <?php //eval($CONTENT_["main"]);?>
              @include('../posts/data');
          </div>
          <div class="app-wrapper-footer">
 
 @include('../template/part/nav-bottom');
          </div>
        </div>
      </div>
    </div>
    <?php //include "part/nav-right.php";?>
    
 @include('../template/part/nav-right');
@include('../template/footersite') 
 