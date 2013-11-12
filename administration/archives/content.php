<?php
    include_once("../../classes/global.class.php");
    $global = new Ogreos();

    if (isset($_POST['PID']))
    {
        $global->updateArchiveMessage($_POST['PID'], 0);
    }

    if (isset($_POST['DEST']))
    {
        $global->createMessage($_POST['DEST'], $_POST['MESSAGE'], $_SESSION['OGR_ID']);
    }
?>

<!-- #################################################### -->
<!-- ENT-TETE DE LA PAGE POUR SPECIFIER OU L'ON SE TROUVE -->
<!-- #################################################### -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li> <i class="icon-envelope-alt"></i> &nbsp;Mes Messages</li>
        </ul>
    </div>
</div>

<div class="mail-box">
    
    <aside class="lg-side">
        <div class="inbox-head">
            <h3>MESSAGES ARCHIVÉS 
            <?php
                if ($global->getNbrMessagesArchives($_SESSION['OGR_ID']) < 2)
                    echo "(" . $global->getNbrMessagesArchives($_SESSION['OGR_ID']) . " message)";
                else
                    echo "(" . $global->getNbrMessagesArchives($_SESSION['OGR_ID']) . " messages)";
            ?>
            </h3>
        </div>
        <div class="inbox-body">
                         
            <table class="table table-inbox table-hover">
                <tbody>
                    <?php echo $global->getMessagesArchives($_SESSION['OGR_ID']); ?>
                </tbody>
            </table>

        </div>
    </aside>
    
    <aside class="sm-side">
        
        <!-- BOUTON POUR ECRIRE UN MESSAGE -->
        <div class="inbox-body">
            <a class="btn btn-compose" data-toggle="modal" href="#NewMessage">
                Nouveau Message
            </a>

            <!-- FENETRE POUR ECRIRE UN MESSAGE -->
            <div class="modal fade" id="NewMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">NOUVEAU MESSAGE</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form" method="post" action="MesMessagesArchives.html">
                                <div class="form-group">
                                    <label  class="col-lg-2 control-label">Destinataire</label>
                                    <div class="col-lg-10">
                                        <select class="form-control m-bot15" name="DEST">
                                            <?php echo $global->getUsers($_SESSION['OGR_ID']    ); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Message</label>
                                    <div class="col-lg-10">
                                        <textarea name="MESSAGE" id="" class="form-control" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <center>
                                        <button data-dismiss="modal" class="btn btn-default" type="button">Fermer la fenêtre</button>
                                        <input type="submit" class="btn btn-send" name="ACT" value="Envoyer le Message">
                                    </center>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <!-- MENU DE LA MESSAGERIE -->
        <ul class="inbox-nav inbox-divider">
            <li>
                <a href="MesMessages.html">
                    <i class="icon-inbox"></i> Boîte de Réception
                    <?php
                        if ($global->getNbrMessagesUnread($_SESSION['OGR_ID']) > 0)
                            echo '<span class="label label-danger pull-right">' . $global->getNbrMessagesUnread($_SESSION['OGR_ID']) . '</span>';
                    ?>
                </a>
            </li>
            <li>
                <a href="MesMessagesEnvoyes.html"><i class="icon-envelope-alt"></i> Messages Envoyés</a>
            </li>
            <li class="active">
                <a href="MesMessagesArchives.html"><i class="icon-stackexchange"></i> Messages Archivés</a>
            </li>
        </ul>
        
        <!-- FENETRE POUR AFFICHER UN MESSAGE -->
            <div class="modal fade" id="ViewMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">MESSAGE</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form" name="VIEW" action="MesMessagesArchives.html" method="post">
                                <div class="form-group">
                                    <label  class="col-lg-2 control-label">Expéditeur</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="EXPEDITEUR" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-lg-2 control-label">Ecrit le</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="LE" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Message</label>
                                    <div class="col-lg-10">
                                        <textarea id="MESSAGE" name="MESSAGE" class="form-control" cols="30" rows="10" disabled></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <center>
                                        <button data-dismiss="modal" class="btn btn-default" type="button">Fermer la fenêtre</button>
                                        <input type="submit" class="btn btn-send" name="ACT" value="Remettre dans la Boîte de réception">
                                    </center>
                                </div>
                                <input type="hidden" name="PID" value="">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </aside>
    
</div>