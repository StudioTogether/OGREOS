<?php
    include_once("../../classes/entretien.class.php");
    $entretien = new Entretien();

    if (isset($_POST['ACT']))
    {
        switch ($_POST['ACT'])
        {
            case "1" :  $entretien->deleteQuestion($_POST['PID']);
                        break;
            case "2" :  $entretien->addQuestion($_POST['TITRE'], $_POST['DESCRIPTION'], $_POST['CHAMP'], $_POST['COEF'], $_POST['CURRENT']);
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
            <li><?php echo $_POST['NAME']; ?></li>
        </ul>
    </div>
    <table width="100%" border="0">
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <span class="label label-primary"><?php echo $_POST['CAT']; ?></span> 
                <span class="label label-success"><?php echo $_POST['TYP']; ?></span>
            </td>
            <td align="right">
                <a href="LesFormulaires.html"><button type="button" class="btn btn-primary"><i class="icon-circle-arrow-left"></i> Retourner à la liste des formulaire</button></a>
                &nbsp;&nbsp;&nbsp;
            </td>
        </tr>
    </table>
</div>

<br>

<div class="row">
    
    <!-- LISTE DES QUESTIONS -->
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                Liste des Questions
            </header>
            <div class="panel-body">
                <div class="dd" id="nestable_list_1">
                    <ol class="dd-list">
                        <?php echo $entretien->getAllQuestions($_POST['CURRENT']); ?>
                    </ol>
                </div>
            </div>
        </section>
    </div>
    
    <!-- -->
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                Ajouter une Question
            </header>
            <div class="panel-body">
                <form class="form-horizontal" role="form" name="VIEW" action="DetailFormulaire.html" method="post">
                    <div class="form-group">
                        <label  class="col-lg-12 control-label">Titre de la question</label>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" id="TITRE" name="TITRE" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-12 control-label">Description</label>
                        <div class="col-lg-12">
                            <textarea id="MESSAGE" name="DESCRIPTION" class="form-control" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-12 control-label">Type de la réponse</label>
                        <div class="col-lg-12">
                            <select class="form-control m-bot15" name="CHAMP">
                                <option value="1">Champ libre court (255 caractères)</option>
                                <option value="2">Champ libre long (illimté)</option>
                                <option value="3">Choix stricte</option>
                                <option value="4">Choix multiple</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-lg-12 control-label">Coefficient de la question</label>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="COEF" id="COEF" value="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <center>
                            <button class="btn btn-send" type="button" onClick="document.VIEW.submit();">Enregistrer</button>
                        </center>
                    </div>
                    <input type="hidden" name="CURRENT" value="<?php echo $_POST['CURRENT']; ?>">
                    <input type="hidden" name="NAME" value="<?php echo $_POST['NAME']; ?>">
                    <input type="hidden" name="CAT" value="<?php echo $_POST['CAT']; ?>">
                    <input type="hidden" name="TYP" value="<?php echo $_POST['TYP']; ?>">
                    <input type="hidden" name="ACT" value="2">
                </form>
            </div>
        </section>
    </div>
</div>

<!-- ##################################################### -->
<!-- FENÊTRE DE CONFIRMATION DE SUPPRESSION D'UNE QUESTION -->
<!-- ##################################################### -->
<div class="modal fade" id="deleteQuestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" name="DELETE_QUESTION" action="DetailFormulaire.html">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confirmation de suppression</h4>
                </div>
                <div class="modal-body">
                    Etês-vous sûr de vouloir supprimer la question ?
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer la fenêtre</button>
                    <button class="btn btn-warning" type="button" onClick="document.DELETE_QUESTION.submit();"> Confirmer</button>
                </div>
            </div>
        </div>
        <input type="hidden" name="ACT" value="1">
        <input type="hidden" name="PID" value="">
        <input type="hidden" name="CURRENT" value="<?php echo $_POST['CURRENT']; ?>">
        <input type="hidden" name="NAME" value="<?php echo $_POST['NAME']; ?>">
        <input type="hidden" name="CAT" value="<?php echo $_POST['CAT']; ?>">
        <input type="hidden" name="TYP" value="<?php echo $_POST['TYP']; ?>">
    </form>
</div>

<div class="row">
                  <div class="col-lg-12">
                      <div class="border-head">
                          <h3>Serialised Output (per list)</h3>
                      </div>

                      <div class="row">
                          <div class="col-lg-6">
                              <textarea id="nestable_list_1_output" class=" col-lg-12 form-control"></textarea>
                          </div>
                          <div class="col-lg-6">
                              <textarea id="nestable_list_2_output" class=" col-lg-12 form-control"></textarea>
                          </div>
                      </div>
                  </div>
              </div>