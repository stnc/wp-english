<?php
function stnc_wp_floor_adminMenu_stnc_map_homepage()
{
?> <style>
    .stnc-header-page #adminmenumain,
    .stnc-header-page #wpadminbar,
    .stnc-header-page #adminmenuback,
    .stnc-header-page #adminmenuwrap,
    .stnc-header-page #wpfooter {
      display: none;
    }

    #wpcontent,
    #wpfooter {
      margin-left: auto !important;
    }

    html.wp-toolbar {
      padding-top: 0 !important;
    }
  </style>
  <header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-secondary fixed-top bg-black">
      <div class="stnc-container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/wp-admin/admin.php?page=stnc_map_homepage"><?php esc_html_e('Kelimator Homepage', 'the-stnc-map') ?></a>
            </li>

            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/wp-admin/admin.php?page=stnc_building_list"><?php esc_html_e('Kelime Listesi', 'the-stnc-map') ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/wp-admin"><?php esc_html_e('Wordpress Panel', 'the-stnc-map') ?></a>
            </li>
          </ul>
          <div class="text-center">
            <h1 class="stnc-title fw-bold"><?php esc_html_e('STNC building floors', 'the-stnc-map') ?></h1>
          </div>
        </div>
      </div>


    </nav>
  </header>
  <main class="flex-shrink-0" style="margin-top:88px">
    <div class="stnc-container-fluid">
      <div class="stnc-row">
        <a href="/wp-admin/admin.php?page=stnc_building_company&st_trigger=new">EKLE</a>
  </main>
  <script type="text/javascript">
    function handleSelect(elm) {
      window.location = elm.value;
    }
  </script>
  <footer class="footer mt-auto py-3 bg-light stnc-footer">
    <div class="container">
      <span class="text-muted"></span>
    </div>
  </footer> <?php

          }
