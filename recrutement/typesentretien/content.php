<?php
    include_once("../../classes/entretien.class.php");
    $entretien = new Entretien();

    if (isset($_POST['ACT']))
    {
        switch ($_POST['ACT'])
        {
            case "1" :  $entretien->deleteCategory($_POST['PID']);
                        break;
            case "2" :  $entretien->modifyCategory($_POST['PID'], $_POST['nom']);
                        break;
            case "3" :  $entretien->addCategory($_POST['nom']);
                        break;
            case "4" :  $entretien->deleteType($_POST['PID']);
                        break;
            case "5" :  $entretien->modifyType($_POST['PID'], $_POST['nom'], $_POST['CAT']);
                        break;
            case "6" :  $entretien->addType($_POST['nom'], $_POST['CAT']);
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
            <li>Les types d'entretien</li>
        </ul>
    </div>
</div>

<div class="row">
    
    <!-- LES TYPES D'ENTRETIEN -->
    <div class="col-lg-8">
        <section class="panel">
            <header class="panel-heading">
                Les Types d'entretien
            </header>
            <br>
            &nbsp;
            <a href="#addType" data-toggle="modal" class="btn btn-xs btn-success">
                Ajouter un nouveau type d'entretien
            </a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Libellé de la catégorie</th>
                        <th>Libellé du type d'entretien</th>
                        <th style="width: 70px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $entretien->getAllMeetingTypes(); ?>
                </tbody>
            </table>
        </section>
    </div>
    
    <!-- LES CATÉGORIES -->
    <div class="col-lg-4">
        <section class="panel">
            <header class="panel-heading">
                Les Catégories d'entretien
            </header>
            <br>
            &nbsp;
            <a href="#addCategorie" data-toggle="modal" class="btn btn-xs btn-success">
                Ajouter une nouvelle catégorie
            </a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Libellé de la catégorie</th>
                        <th style="width: 70px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $entretien->getAllCategories(); ?>
                </tbody>
            </table>
        </section>
    </div>
</div>

<!-- ###################################################### -->
<!-- FENÊTRE DE CONFIRMATION DE SUPPRESSION D'UNE CATÉGORIE -->
<!-- ###################################################### -->
<div class="modal fade" id="deleteCategorie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" name="DELETE_CATEGORIE" action="LesTypesDEntretiens.html">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confirmation de suppression</h4>
                </div>
                <div class="modal-body">
                    Etês-vous sûr de vouloir supprimer cette catégorie ?<br><br>Celà peut avoir un un impact sur l'organisation des formulaires.
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer la fenêtre</button>
                    <button class="btn btn-warning" type="button" onClick="document.DELETE_CATEGORIE.submit();"> Confirmer</button>
                </div>
            </div>
        </div>
        <input type="hidden" name="ACT" value="1">
        <input type="hidden" name="PID" value="">
    </form>
</div>

<!-- ####################################### -->
<!-- FENÊTRE DE MODIFICATION D'UNE CATÉGORIE -->
<!-- ####################################### -->
<div class="modal fade" id="modifyCategorie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" name="MODIFY_CATEGORIE" action="LesTypesDEntretiens.html">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modification d'une catégorie</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label  class="col-lg-12 control-label">Libellé de la catégorie</label>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" id="nom" name="nom">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer la fenêtre</button>
                    <button class="btn btn-warning" type="button" onClick="document.MODIFY_CATEGORIE.submit();"> Mettre à jour</button>
                </div>
            </div>
        </div>
        <input type="hidden" name="ACT" value="2">
        <input type="hidden" name="PID" value="">
    </form>
</div>

<!-- ############################### -->
<!-- FENÊTRE D'AJOUT D'UNE CATÉGORIE -->
<!-- ############################### -->
<div class="modal fade" id="addCategorie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" name="ADD_CATEGORIE" action="LesTypesDEntretiens.html">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ajout d'une catégorie</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label  class="col-lg-12 control-label">Libellé de la catégorie</label>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" id="nom" name="nom">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer la fenêtre</button>
                    <button class="btn btn-warning" type="button" onClick="document.ADD_CATEGORIE.submit();"> Enregistrer</button>
                </div>
            </div>
        </div>
        <input type="hidden" name="ACT" value="3">
    </form>
</div>

<!-- ################################################ -->
<!-- FENÊTRE DE CONFIRMATION DE SUPPRESSION D'UN TYPE -->
<!-- ################################################ -->
<div class="modal fade" id="deleteType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" name="DELETE_TYPE" action="LesTypesDEntretiens.html">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confirmation de suppression</h4>
                </div>
                <div class="modal-body">
                    Etês-vous sûr de vouloir supprimer ce type d'entretien ?<br><br>Celà peut avoir un un impact sur l'organisation des formulaires.
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer la fenêtre</button>
                    <button class="btn btn-warning" type="button" onClick="document.DELETE_TYPE.submit();"> Confirmer</button>
                </div>
            </div>
        </div>
        <input type="hidden" name="ACT" value="4">
        <input type="hidden" name="PID" value="">
    </form>
</div>

<!-- ################################# -->
<!-- FENÊTRE DE MODIFICATION D'UN TYPE -->
<!-- ################################# -->
<div class="modal fade" id="modifyType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" name="MODIFY_TYPE" action="LesTypesDEntretiens.html">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modification d'un type d'entretien</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label  class="col-lg-12 control-label">Catégorie</label>
                                <div class="col-lg-12">
                                    <select class="form-control m-bot15" name="CAT">
                                        <?php echo $entretien->getCategories(); ?>
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
                    <button class="btn btn-warning" type="button" onClick="document.MODIFY_TYPE.submit();"> Mettre à jour</button>
                </div>
            </div>
        </div>
        <input type="hidden" name="ACT" value="5">
        <input type="hidden" name="PID" value="">
    </form>
</div>

<!-- ######################### -->
<!-- FENÊTRE D'AJOUT D'UN TYPE -->
<!-- ######################### -->
<div class="modal fade" id="addType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" name="ADD_TYPE" action="LesTypesDEntretiens.html">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ajout d'un type d'entretien</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label  class="col-lg-12 control-label">Catégorie</label>
                                <div class="col-lg-12">
                                    <select class="form-control m-bot15" name="CAT">
                                        <?php echo $entretien->getCategories(); ?>
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
                    <button class="btn btn-warning" type="button" onClick="document.ADD_TYPE.submit();"> Enregistrer</button>
                </div>
            </div>
        </div>
        <input type="hidden" name="ACT" value="6">
    </form>
</div>