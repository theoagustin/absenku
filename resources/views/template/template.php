 <?php include "header.php";?>
 <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
      <?php 
	  include "part/nav-header.php";
	  include "part/layout-settings.php";
	  ?>
      
      <div class="app-main">
        <?php include "part/nav-menu.php";?>
        <div class="app-main__outer">
          <div class="app-main__inner">
            <?php //include "part/breadcrum.php";?>
              <?php //include "part/content.php";?>
			  <?php eval($CONTENT_["main"]);?>
          </div>
          <div class="app-wrapper-footer">
            <?php include "part/nav-bottom.php";?>
          </div>
        </div>
      </div>
    </div>
    <?php include "part/nav-right.php";?>
 <?php include "footer.php";?>