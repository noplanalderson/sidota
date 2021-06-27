<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

    <div class="az-navbar">
      <div class="container">
        <div class="az-navbar-search pd-15">
          <?php if(!empty($this->app_m->getContentMenu('search-result'))) :?>
          <?= form_open('search', 'class="formSearchLeft" method="post" accept-charset="utf-8"');?>
            <input type="text" name="query" class="query_left" pattern="([A-z0-9À-ž\s]){2,}" placeholder="Search activities or jobs..." title="Only alphanumeric and Space Allowed" required>
            <button type="submit" name="submit" class="btn mt-3"><i class="fas fa-search"></i></button>
          </form>
          <?php endif;?>
        </div><!-- az-navbar-search -->
        <ul class="nav">
          <li class="nav-label">Main Menu</li>
          	<?php
				foreach ($this->menus as $menu) :
				$submenus = $this->app_m->getSubMenu($menu['menu_id']);
			?>
          <li class="nav-item">
            <a href="<?= base_url($menu['menu_link']);?>" class="nav-link <?php if(!empty($submenus)) :?>with-sub<?php endif;?>"><i class="<?= $menu['menu_icon'];?>"></i><?= $menu['menu_label'];?></a>
            <?php if(!empty($submenus)) :?>

            <nav class="nav-sub">
              <?php foreach ($submenus as $submenu) :?>

              <a href="<?= base_url($submenu['menu_link']);?>" class="nav-sub-link"><?= $submenu['menu_label'];?></a>
              <?php endforeach; ?>
            </nav>
            <?php endif;?>

          </li>
          <?php endforeach;?>

        </ul>
      </div>
    </div>