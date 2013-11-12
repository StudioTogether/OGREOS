<?php
    include_once("../../classes/global.class.php");
    $global = new Ogreos();

    if (isset($_POST['FRM']))
    {
        switch ($_POST['FRM'])
        {
            case "1" :  $global->updateMyInfos($_POST['f-prenom'], $_POST['f-nom'], $_POST['f-email'], $_POST['f-telephone'], $_SESSION['OGR_ID']);
                        break;
            case "2" :  $global->updateMyPassword($_POST['c_pwd'], $_SESSION['OGR_ID']);
                        break;
            case "3" :  $repertoireDestination = "../../img/" . $_SESSION['OGR_ID'] . "/";
                        $nomDestination        = $_FILES["InputFile"]["name"];
                        if (is_dir($repertoireDestination) == false)
                            mkdir($repertoireDestination);
                        if (is_uploaded_file($_FILES["InputFile"]["tmp_name"])) 
                        {
                            if (rename($_FILES["InputFile"]["tmp_name"], $repertoireDestination.$nomDestination)) 
                            {
                                $_SESSION['OGR_PHOTO'] = "../../img/" . $_SESSION['OGR_ID'] . "/" . $_FILES["InputFile"]["name"];
                                $global->updatePhoto($_SESSION['OGR_PHOTO'], $_SESSION['OGR_ID']);
                            }
                            else
                            {
                                echo "Erreur avec le répertoire " . $repertoireDestination;
                            }          
                        }
                        else
                        {
                            echo "Le fichier est trop volumineux.";
                        }
                        break;
        }
    }
?>
<!-- #################################################### -->
<!-- ENT-TETE DE LA PAGE POUR SPECIFIER OU L'ON SE TROUVE -->
<!-- #################################################### -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li> <i class="icon-suitcase"></i> &nbsp;Mon Profil</li>
        </ul>
    </div>
</div>

<div class="row">
    
    <!-- ######################## -->
    <!-- IMAGE DU PROFIL ET REUME -->
    <!-- ######################## -->
    <div class="col-lg-4">
        
        <!-- INFORMATION GENERALE DU PROFIL -->
        <section class="panel">
            <div class="twt-feed blue-bg">
                <h1><?php echo $_SESSION['OGR_NAME']; ?></h1>
                <p>Membre du groupe '<?php echo $_SESSION['OGR_GROUP']; ?>'</p>
                <a href="#">
                    <img src="<?php echo $_SESSION['OGR_PHOTO']; ?>" alt="">
                </a>
            </div>
            <div class="weather-category twt-category">
                <ul>
                    <li class="active">
                        <h5>???</h5>
                        Actions à Réaliser
                    </li>
                    <li>
                        <h5>???</h5>
                        Notifications
                    </li>
                    <li>
                        <h5>???</h5>
                        Rendez-Vous
                    </li>
                </ul>
            </div>
        </section>
        
        <!-- MODIFICATION DE LA PHOTO -->
        <section>
            <div class="panel panel-primary">
                <div class="panel-heading"> Modifier sa photo</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" enctype="multipart/form-data" action="MonProfil.html" method="post">
                        <div class="col-lg-12">
                            <input type="file" class="file-pos" id="InputFile" name="InputFile">
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-12">
                                <br>
                                <button type="submit" class="btn btn-info">Mettre à jour la Photo</button>
                            </div>
                        </div>
                        <input type="hidden" name="FRM" value="3">
                        <input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
                    </form>
                </div>
            </div>
        </section>
        
    </div>
    
    <div class="col-lg-4">
        
        <!-- MODIFICATION DE LA PHOTO -->
        <section>
            <div class="panel panel-primary">
                <div class="panel-heading"> Mes informations personnelles</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" action="MonProfil.html">
                        <div class="form-group">
                            <label  class="col-lg-3 control-label">Prénom</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="f-prenom" name="f-prenom" placeholder="<?php echo $global->getPrenom($_SESSION['OGR_ID']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-3 control-label">Nom</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="f-nom" name="f-nom" placeholder="<?php echo $global->getNom($_SESSION['OGR_ID']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-3 control-label">Email</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="f-email" name="f-email" placeholder="<?php echo $global->getEmail($_SESSION['OGR_ID']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-3 control-label">Téléphone</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="f-telephone" name="f-telephone" placeholder="<?php echo $global->getTelephone($_SESSION['OGR_ID']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-12">
                                <button type="submit" class="btn btn-info">Enregistrer</button>
                            </div>
                        </div>
                        <input type="hidden" name="FRM" value="1">
                    </form>
                </div>
            </div>
        </section>
        
        <!-- MODIFICATION DU MOT DE PASSE -->
        <script>
            function checkPwd()
            {
                if (document.pass.c_pwd.value == document.pass.c_pwd2.value)
                    return true;
                else
                {
                    alert("Les mots de passe ne correspondent pas !");
                    return false;
                }
            }
        </script>
        <section>
            <div class="panel panel-primary">
                <div class="panel-heading"> Modifier mon mot de passe</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post" name="pass" action="MonProfil.html" onSubmit="return checkPwd()">
                        <div class="form-group">
                            <label  class="col-lg-7 control-label">Nouveau mot de de passe</label>
                            <div class="col-lg-5">
                                <input type="password" class="form-control" id="c-pwd" name="c_pwd" placeholder=" ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-7 control-label">Retapez le mot de de passe</label>
                            <div class="col-lg-5">
                                <input type="password" class="form-control" id="c-pwd" name="c_pwd2" placeholder=" ">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-info">Enregistrer</button>
                            </div>
                        </div>
                        <input type="hidden" name="FRM" value="2">
                    </form>
                </div>
            </div>
        </section>
        
    </div>
        
    <div class="col-lg-4">
        <!-- LES MESSAGES -->        
        <section>
            <div class="panel panel-primary">
                <div class="panel-heading"> Mes messages non lus</div>
                <div class="panel-body">
                    <div class="timeline-messages">
                        
                        <?php echo $global->getLastMessages($_SESSION['OGR_ID']); ?>
                                  
                    </div>
               </div>
            </div>
        </section>
    </div>
</div>