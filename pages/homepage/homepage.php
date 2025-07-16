<?php
function helix_admin_homepage()
{
?> <style>
    .helix-header-page #adminmenumain,
    .helix-header-page #wpadminbar,
    .helix-header-page #adminmenuback,
    .helix-header-page #adminmenuwrap,
    .helix-header-page #wpfooter {
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
      <div class="helix-container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/wp-admin/admin.php?page=helix_homepage"><?php esc_html_e('Kelimator Homepage', 'helix-lng') ?></a>
            </li>

            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/wp-admin/admin.php?page=helix_word_list"><?php esc_html_e('Kelime Listesi', 'helix-lng') ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/wp-admin"><?php esc_html_e('Wordpress Panel', 'helix-lng') ?></a>
            </li>
          </ul>
          <div class="text-center">
            <h1 class="helix-title fw-bold"><?php esc_html_e('Kelime Generator', 'helix-lng') ?></h1>
          </div>
        </div>
      </div>


    </nav>
  </header>
  <main class="flex-shrink-0" style="margin-top:88px">
    <div class="helix-container-fluid">
      <div class="helix-row">
        <a href="/wp-admin/admin.php?page=helix_building_company&trigger=new">EKLE</a>
  </main>
  <script type="text/javascript">
    function handleSelect(elm) {
      window.location = elm.value;
    }
  </script>
  <footer class="footer mt-auto py-3 bg-light helix-footer">
    <div class="container">
      <span class="text-muted"></span>
    </div>
  </footer> <?php

          }
