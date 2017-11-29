
<?php
  
?>
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url("assets/img/user2-160x160.jpg"); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $ctlUsername; ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form --> 

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU UTAMA</li>
        <!-- Optionally, you can add icons to the links -->

        <?php foreach($ctlArrMenu as $key => $arrVal) { ?>

          <?php if ($arrVal["class"] == "header") { ?>

          <li class="<?php echo $arrVal["class"] ?>"
            style="<?php echo isset($arrVal["style"]) ? $arrVal["style"] : ""; ?>" >
              <span><?php echo $arrVal["title"]; ?></span>
          </li>

          <?php } else { ?>
          <li class="<?php echo $arrVal["class"] ?>"
            style="<?php echo isset($arrVal["style"]) ? $arrVal["style"] : ""; ?>" >
            <a href="<?php echo $arrVal["href"]; ?>">
              <i class="fa <?php echo $arrVal["icon"] ?>"></i>
              <span><?php echo $arrVal["title"]; ?></span>
              
              <?php if (isset($arrVal["sub"])) { ?>
                  <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                  </span>
              <?php } ?>

            </a>

            <?php if (isset($arrVal["sub"])) { ?>

              <ul class="treeview-menu">
                  <?php foreach($arrVal["sub"] as $key => $arrVal2) { ?>
                    <li class="<?php echo $arrVal2["class"]; ?>">
                      <a href="<?php echo $arrVal2["href"]; ?>">
                        <i class="fa <?php echo $arrVal2["icon"]; ?>"></i>
                        <?php echo $arrVal2["title"]; ?>
                      </a>
                    </li>
                  <?php } ?>
              </ul>
            <?php  } ?>

            <?php } ?>
          </li>

          <?php } ?>

      </ul>
      <!-- /.sidebar-menu -->