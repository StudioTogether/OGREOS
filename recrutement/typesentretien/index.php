<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
    
    <head>
        <?php include_once("../../common/template_head.php"); ?>
        <?php include_once("../../common/template_css.php"); ?>
    </head>

    <body>

      <section id="container" class="">
      
          <!-- ################# -->
          <!-- HEADER DE LA PAGE -->
          <!-- ################# -->
          <?php include("../../common/HEAD.php"); ?>
      
          <!-- ############ -->
          <!-- MENU DU SITE -->
          <!-- ############ -->
          <?php include_once("../../common/menu.php"); ?>
      
          <!-- ################## -->
          <!-- CONTENU DE LA PAGE -->
          <!-- ################## -->
          <section id="main-content">
              <section class="wrapper">
                  <?php include_once("content.php"); ?>
              </section>
          </section>
        </section>

      <?php include_once("../../common/template_js.php"); ?>
    
    </body>
</html>
