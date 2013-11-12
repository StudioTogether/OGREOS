<?php
    include_once("../../classes/global.class.php");
    $global = new Ogreos();

    if (isset($_POST['PID']))
    {
        $global->deleteNotification($_POST['PID']);
    }
?>

<!-- #################################################### -->
<!-- ENT-TETE DE LA PAGE POUR SPECIFIER OU L'ON SE TROUVE -->
<!-- #################################################### -->
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li> <i class="icon-bell-alt"></i> &nbsp;Mes Notifications</li>
        </ul>
    </div>
</div>

<div class="mail-box">
    
    <aside class="lg-side">
        <div class="inbox-head">
            <h3>LISTE DES NOTIFICATIONS</h3>
        </div>
        <div class="inbox-body">
                         
            
                    <?php echo $global->getNotifications($_SESSION['OGR_ID']); ?>
                

        </div>
    </aside>
    
</div>

<form method="post" action="MesNotifications.html" name="DELETE">
    <input type="hidden" name="PID" value="">
</form>