<header class="header white-bg">
    
    <!-- Icône pour l'affichage du menu -->
    <div class="sidebar-toggle-box">
        <div data-original-title="Afficher / Masquer le Menu" data-placement="right" class="icon-reorder tooltips"></div>
    </div>
          
    <!-- Affichage du titre de l'outil -->
    <a href="#" class="logo" >OGR<span>EOS</span> <small>- Outil de Gestion du Recutement</small></a>
    
    <div class="top-nav ">
        
        <!-- Champ de recherche de données -->
        <ul class="nav pull-right top-menu">
            <li>      
                <input type="text" class="form-control search" placeholder="Rechercher">
            </li>
            
            <!-- Affichage utilisateur avec son menu -->      
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img alt="" src="<?php echo $_SESSION['OGR_PHOTO']; ?>" width="25" height="25">
                    <span class="username"><?php echo $_SESSION['OGR_NAME']; ?></span>
                        <b class="caret"></b>
                </a>
                      
                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>
                    <li><a href="MonProfil.html"><i class="icon-suitcase"></i> Profil</a></li>
                    <li><a href="MesMessages.html"><i class="icon-envelope-alt"></i> Messages</a></li>
                    <li><a href="MesNotifications.html"><i class="icon-bell-alt"></i> Notifications</a></li>
                    <li><a href="logout.html"><i class="icon-key"></i> Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </div>
      
</header>