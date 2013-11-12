<?php
    include_once("../../classes/entretien.class.php");
    $entretien = new Entretien();

    if (isset($_POST['ACT']))
    {
        switch ($_POST['ACT'])
        {
            case "1" :  $entretien->deleteForm($_POST['PID']);
                        break;
            case "2" :  $entretien->modifyForm($_POST['PID'], $_POST['nom'], $_POST['TYP']);
                        break;
            case "3" :  $entretien->addForm($_POST['nom'], $_POST['TYP']);
                        break;
        }
    }
?>
<!-- ################################################### -->
<!-- EN-TETE DE LA PAGE POUR SPECIFIER OU L'ON SE TROUVE -->
<!-- ################################################### -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li> <i class="icon-comments-alt"></i> &nbsp;Les Entretiens</li>
            <li>Les formulaires</li>
        </ul>
    </div>
</div>

<div class="row">
    
    <!-- LES FORMULAIRES -->
    <div class="col-lg-8">
        <section class="panel">
            <header class="panel-heading">
                Les Formulaires
            </header>
            <br>
            &nbsp;
            <a href="#addForm" data-toggle="modal" class="btn btn-xs btn-success">
                Ajouter un nouveau formulaire
            </a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Catégorie / Type</th>
                        <th>Libellé du formulaire</th>
                        <th style="width: 120px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $entretien->getAllForms(); ?>
                </tbody>
            </table>
        </section>
    </div>
    
    <!-- VISIBILITÉ DU FORMULAIRE -->
    <div class="col-lg-4">
        <section class="panel">
            <header class="panel-heading">
                Visibilité du formulaire
            </header>
            <table class="table">
                <?php if (isset($_POST['CURRENT'])) { ?>
                <thead>
                    <tr>
                        <th width="50%">Droits Administrateur</th>
                        <th width="50%">Droits de Lecture</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            hhhh
                        </td>
                        <td>ppo</td>
                    </tr>
                </tbody>
                <?php } else { ?>
                <thead>
                    <tr>
                        <th>Sélectionnez un formulaire pour définir les droits de visibilité.</th>
                    </tr>
                </thead>
                
                <?php } ?>
            </table>
        </section>
    </div>
</div>

<!-- ###################################################### -->
<!-- FENÊTRE DE CONFIRMATION DE SUPPRESSION D'UN FORMULAIRE -->
<!-- ###################################################### -->
<div class="modal fade" id="deleteForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" name="DELETE_FORM" action="LesFormulaires.html">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confirmation de suppression</h4>
                </div>
                <div class="modal-body">
                    Etês-vous sûr de vouloir supprimer cet formulaire ?<br><br>Toutes les données et liens associés à ce formulaire seront aussi supprimés.
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer la fenêtre</button>
                    <button class="btn btn-warning" type="button" onClick="document.DELETE_FORM.submit();"> Confirmer</button>
                </div>
            </div>
        </div>
        <input type="hidden" name="ACT" value="1">
        <input type="hidden" name="PID" value="">
    </form>
</div>

<!-- ####################################### -->
<!-- FENÊTRE DE MODIFICATION D'UN FORMULAIRE -->
<!-- ####################################### -->
<div class="modal fade" id="modifyForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" name="MODIFY_FORM" action="LesFormulaires.html">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modification d'un formulaire</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label  class="col-lg-12 control-label">Type d'Entretien</label>
                                <div class="col-lg-12">
                                    <select class="form-control m-bot15" name="TYP">
                                        <?php echo $entretien->getTypes(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label  class="col-lg-12 control-label">Libellé du type d'entrerien</label>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" id="nom" name="nom">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer la fenêtre</button>
                    <button class="btn btn-warning" type="button" onClick="document.MODIFY_FORM.submit();"> Mettre à jour</button>
                </div>
            </div>
        </div>
        <input type="hidden" name="ACT" value="2">
        <input type="hidden" name="PID" value="">
    </form>
</div>

<!-- ############################### -->
<!-- FENÊTRE D'AJOUT D'UN FORMULAIRE -->
<!-- ############################### -->
<div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" name="ADD_FORM" action="LesFormulaires.html">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ajout d'un formulaire</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label  class="col-lg-12 control-label">Type d'Entretien</label>
                                <div class="col-lg-12">
                                    <select class="form-control m-bot15" name="TYP">
                                        <?php echo $entretien->getTypes(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label  class="col-lg-12 control-label">Libellé du type d'entrerien</label>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" id="nom" name="nom">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer la fenêtre</button>
                    <button class="btn btn-warning" type="button" onClick="document.ADD_FORM.submit();"> Enregistrer</button>
                </div>
            </div>
        </div>
        <input type="hidden" name="ACT" value="3">
    </form>
</div>

<!-- ######################### -->
<!-- SELECTION D'UN FORMULAIRE -->
<!-- ######################### -->
<form method="post" action="LesFormulaires.html" name="selectForm">
    <input type="hidden" name="CURRENT" value="">
</form>

<!-- ############################# -->
<!-- VISUALISATION D'UN FORMULAIRE -->
<!-- ############################# -->
<form method="post" action="DetailFormulaire.html" name="viewForm">
    <input type="hidden" name="CURRENT" value="">
    <input type="hidden" name="NAME" value="">
    <input type="hidden" name="CAT" value="">
    <input type="hidden" name="TYP" value="">
</form>