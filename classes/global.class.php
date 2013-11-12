<?php

    class Ogreos
	{
		private $_hostname 		= "localhost";
		private $_database 		= "OGREOS";
		private $_username 		= "root";
		private $_password 		= "HIadKA#1976";
        private $_connection 	= NULL;
				
		// ###############
		// LE CONSTRUCTEUR
		// ###############
		public function __construct()
		{
			try
			{
				$this->connection = new PDO("mysql:host=$this->_hostname;dbname=$this->_database;port=3327", $this->_username, $this->_password);
			}
			catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][constructor]</font> $e</strong>";
			}
		}
        
        // ######################
        // CRYPTE LE MOT DE PASSE
        // ######################
        private function encrypt($s) {
            $salt = "Rk4#6Gsske/%3r";
            return md5($salt, false) . sha1($s, false);
        }
        
        // ###################################
        // VERIFIE SI UN COMPTE EXISTE EN BASE
        // ###################################
        public function checkAccount($l, $p)
        {
            try
            {
                $query = "SELECT ID FROM ogr_users WHERE Login = '" . $l . "' AND Password = '" . $this->encrypt($p) . "' AND Connected = 0";
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $data = $result->fetch()->ID;
                
                if ($data == "")
                    return -1;
                else   
                    return $data;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][checkAccount]</font> $e</strong>";
			}
        }

        // ###############################
        // VEROUILLE LE COMPTE UTILISATEUR
        // ###############################
        public function lockAccount($id)
        {
            try
            {
                $query = "UPDATE ogr_users SET Connected = 1 WHERE ID = " . $id;
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][lockAccount]</font> $e</strong>";
			}
        }
        
        // #################################
        // DEVEROUILLE LE COMPTE UTILISATEUR
        // #################################
        public function logout($id)
        {
            try
            {
                $query = "UPDATE ogr_users SET Connected = 0 WHERE ID = " . $id;
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][lockAccount]</font> $e</strong>";
			}
        }
        
        // #############################################
        // RECUPERE LE PRENOM ET LE NOM DE L'UTILISATEUR
        // #############################################
        public function getIdentity($id)
        {
            try
            {
                $query = "SELECT Prenom, Nom FROM ogr_users WHERE id = " . $id;
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $data = $result->fetch();
                return $data->Prenom . " " . strtoupper($data->Nom);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][checkAccount]</font> $e</strong>";
			}
        }
        
        // ###################################
        // RECUPERE LE GROUPE DE L'UTILISATEUR
        // ###################################
        public function getGroup($id)
        {
            try
            {
                $query = "  SELECT ogr_groups.Nom FROM ogr_users 
                            LEFT OUTER JOIN ogr_groups ON ogr_users.GroupID = ogr_groups.ID 
                            WHERE ogr_users.id = " . $id;
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $data = $result->fetch();
                return $data->Nom;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][getGroup]</font> $e</strong>";
			}
        }
        
        // ##################################
        // RECUPERE LA PHOTO DE L'UTILISATEUR
        // ##################################
        public function getPhoto($id)
        {
            try
            {
                $query = "SELECT Photo FROM ogr_users WHERE id = " . $id;
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $data = $result->fetch();
                return $data->Photo;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][checkAccount]</font> $e</strong>";
			}
        }
        
        // ###################################
        // RECUPERE LE PRENOM DE L'UTILISATEUR
        // ###################################
        public function getPrenom($id)
        {
            try
            {
                $query = "SELECT Prenom FROM ogr_users WHERE id = " . $id;
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $data = $result->fetch();
                return $data->Prenom;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][getPrenom]</font> $e</strong>";
			}
        }
        
        // ################################
        // RECUPERE LE NOM DE L'UTILISATEUR
        // ################################
        public function getNom($id)
        {
            try
            {
                $query = "SELECT Nom FROM ogr_users WHERE id = " . $id;
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $data = $result->fetch();
                return $data->Nom;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][getNom]</font> $e</strong>";
			}
        }
        
        // #################################
        // RECUPERE L'EMAIL DE L'UTILISATEUR
        // #################################
        public function getEmail($id)
        {
            try
            {
                $query = "SELECT Email FROM ogr_users WHERE id = " . $id;
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $data = $result->fetch();
                return $data->Email;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][getEmail]</font> $e</strong>";
			}
        }
        
        // ######################################
        // RECUPERE LE TELEPHONE DE L'UTILISATEUR
        // ######################################
        public function getTelephone($id)
        {
            try
            {
                $query = "SELECT Telephone FROM ogr_users WHERE id = " . $id;
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $data = $result->fetch();
                return $data->Telephone;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][getTelephone]</font> $e</strong>";
			}
        }
        
        // #########################################
        // MISE A JOUR DES INFORMATIONS PERSONNELLES
        // #########################################
        public function updateMyInfos($a, $b, $c, $d, $id)
        {
            try
            {
                $query = "UPDATE ogr_users SET ID = " . $id;
                
                if ($a != "")
                    $query .= ", Prenom = '" . $a . "'";
                if ($b != "")
                    $query .= ", Nom = '" . $b . "'";
                if ($c != "")
                    $query .= ", Email = '" . $c . "'";
                if ($d != "")
                    $query .= ", Telephone = '" . $d . "'";
                
                $query .= " WHERE ID = " . $id;
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][updateMyInfos]</font> $e</strong>";
			}
        }
        
        // #######################################
        // MISE A JOUR DU MOT DE PASSE UTILISATEUR
        // #######################################
        public function updateMyPassword($a, $id)
        {
            try
            {
                $query = "UPDATE ogr_users SET Password = '" . $this->encrypt($a) . "' WHERE ID = " . $id;
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][updateMyInfos]</font> $e</strong>";
			}
        }
        
        // #########################################
        // MISE A JOUR DE LA PHOTO DE L'UTILISATEUR
        // #########################################
        public function updatePhoto($a, $id)
        {
            try
            {
                $query = "UPDATE ogr_users SET Photo = '" . $a . "' WHERE ID = " . $id;
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][updatePhoto]</font> $e</strong>";
			}
        }
        
        // ##################################################
        // RECUPERE LE 5 DERNIERS MESSAGES POUR L'UTILISATEUR
        // ##################################################
        public function getLastMessages($id)
        {
            try
            {
                $resultat = "";
                $query = "  SELECT ogr_messages.*, CONCAT(Prenom, ' ', Nom) as Identity, Photo, Connected
                            FROM ogr_messages
                            INNER JOIN ogr_users ON ogr_messages.ExpID = ogr_users.ID
                            WHERE Archive = 0 AND Lu = 0 AND DestID = " . $id . " ORDER BY ID DESC LIMIT 0,5";
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $i = 0;
                while ($data = $result->fetch())
                {
                    $status = "Hors<br>ligne";
                    if ($data->Connected == 1)
                        $status = "En<br>ligne";
                    
                    $resultat .= '<div class="msg-time-chat">';
                    $resultat .= '<a href="#" class="message-img"><img class="avatar" src="' . $data->Photo . '" alt=""><br>' . $status . '</a>';
                    $resultat .= '<div class="message-body msg-in">';
                    $resultat .= '<span class="arrow"></span>';
                    $resultat .= '<div class="text">';
                    $resultat .= '<p class="attribution"><a href="#">' . $data->Identity . '</a><br>' . $data->DateMsg . '</p>';
                    $resultat .= '<p align="justify">' . $data->ContentMsg . '</p>';
                    $resultat .= '</div>';
                    $resultat .= '</div>';
                    $resultat .= '</div>';
                    
                    $i++;
                }
                
                if ($i == 0)
                    $resultat = 'Vous n\'avez aucun message.';
                
                return $resultat;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][getLastMessages]</font> $e</strong>";
			}
        }
        
        // ########################################
        // RECUPERE LES MESSAGES POUR L'UTILISATEUR
        // ########################################
        public function getMessages($id)
        {
            try
            {
                $resultat = "";
                $query = "  SELECT ogr_messages.*, CONCAT(Prenom, ' ', Nom) as Identity, Photo, Connected
                            FROM ogr_messages
                            INNER JOIN ogr_users ON ogr_messages.ExpID = ogr_users.ID
                            WHERE Archive = 0 AND DestID = " . $id . " ORDER BY ID DESC";
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $i = 0;
                while ($data = $result->fetch())
                {
                    if ($data->Lu == 1)
                        $resultat .= '<tr class="read">';
                    else
                        $resultat .= '<tr class="unread">';
                    $resultat .= '<td class="view-message"><img class="avatar" src="' . $data->Photo . '" alt="" width="35" height="35"></td>';
                    $resultat .= '<td class="view-message">' . $data->DateMsg . '</td>';
                    $resultat .= '<td class="view-message">' . $data->Identity . '</td>';
                    $resultat .= '<td class="view-message"><a data-toggle="modal" href="#ViewMessage" onclick="document.VIEW.EXPEDITEUR.value = \'' . $data->Identity . '\';document.VIEW.LE.value = \'' . $data->DateMsg . '\';document.VIEW.MESSAGE.value = \'' . str_replace("'", "\'", $data->ContentMsg) . '\';';
                    if ($data->Lu == 1)
                        $resultat .= 'document.VIEW.ACT.value = \'Marquer comme non lu\';document.VIEW.STATE.value = \'0\';';
                    else
                        $resultat .= 'document.VIEW.ACT.value = \'Marquer comme lu\';document.VIEW.STATE.value = \'1\';';
                    $resultat .= 'document.VIEW.PID.value = \'' . $data->ID . '\';">' . $data->ContentMsg . '</a></td>';
                    $resultat .= '</tr>';
                    
                    $i++;
                }
                
                if ($i == 0)
                    $resultat = 'Vous n\'avez aucun message.';
                
                return $resultat;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][getMessages]</font> $e</strong>";
			}
        }
        
        // ###############################################
        // RECUPERE LES MESSAGES ENVOYÉS PAR L'UTILISATEUR
        // ###############################################
        public function getMessagesSend($id)
        {
            try
            {
                $resultat = "";
                $query = "  SELECT ogr_messages.*, CONCAT(Prenom, ' ', Nom) as Identity
                            FROM ogr_messages
                            INNER JOIN ogr_users ON ogr_messages.DestID = ogr_users.ID
                            WHERE ExpID = " . $id . " ORDER BY ID DESC";
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $i = 0;
                while ($data = $result->fetch())
                {
                    $resultat .= '<td class="view-message">' . $data->DateMsg . '</td>';
                    $resultat .= '<td class="view-message">' . $data->Identity . '</td>';
                    $resultat .= '<td class="view-message">' . $data->ContentMsg . '</td>';
                    $resultat .= '</tr>';
                    
                    $i++;
                }
                
                if ($i == 0)
                    $resultat = 'Vous n\'avez aucun message.';
                
                return $resultat;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][getMessagesSend]</font> $e</strong>";
			}
        }
        
        // #################################################
        // RECUPERE LES MESSAGES ARCHIVÉS POUR L'UTILISATEUR
        // #################################################
        public function getMessagesArchives($id)
        {
            try
            {
                $resultat = "";
                $query = "  SELECT ogr_messages.*, CONCAT(Prenom, ' ', Nom) as Identity, Photo, Connected
                            FROM ogr_messages
                            INNER JOIN ogr_users ON ogr_messages.ExpID = ogr_users.ID
                            WHERE Archive = 1 AND DestID = " . $id . " ORDER BY ID DESC";
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $i = 0;
                while ($data = $result->fetch())
                {
                    if ($data->Lu == 1)
                        $resultat .= '<tr class="read">';
                    else
                        $resultat .= '<tr class="unread">';
                    $resultat .= '<td class="view-message"><img class="avatar" src="' . $data->Photo . '" alt="" width="35" height="35"></td>';
                    $resultat .= '<td class="view-message">' . $data->DateMsg . '</td>';
                    $resultat .= '<td class="view-message">' . $data->Identity . '</td>';
                    $resultat .= '<td class="view-message"><a data-toggle="modal" href="#ViewMessage" onclick="document.VIEW.EXPEDITEUR.value = \'' . $data->Identity . '\';document.VIEW.LE.value = \'' . $data->DateMsg . '\';document.VIEW.MESSAGE.value = \'' . str_replace("'", "\'", $data->ContentMsg) . '\';';
                    $resultat .= 'document.VIEW.PID.value = \'' . $data->ID . '\';">' . $data->ContentMsg . '</a></td>';
                    $resultat .= '</tr>';
                    
                    $i++;
                }
                
                if ($i == 0)
                    $resultat = 'Vous n\'avez aucun message.';
                
                return $resultat;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][getMessagesArchives]</font> $e</strong>";
			}
        }
        
        // #############################################
        // RECUPERE LES NOTIFICATIONS POUR L'UTILISATEUR
        // #############################################
        public function getNotifications($id)
        {
            try
            {
                $resultat = "";
                $query = "  SELECT * FROM ogr_notifications WHERE DestID = " . $id . " ORDER BY ID DESC";
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $i = 0;
                while ($data = $result->fetch())
                {
                    $resultat .= '<div class="alert ' . $data->AlertType . ' fade in">';
                    $resultat .= '<button data-dismiss="alert" class="close close-sm" type="button" onClick="document.DELETE.PID.value = \'' . $data->ID . '\';document.DELETE.submit();">';
                    $resultat .= '<i class="icon-remove"></i>';
                    $resultat .= '</button>';
                    $resultat .= $data->ContentNot;
                    $resultat .= '</div>';
                    
                    $i++;
                }
                
                if ($i == 0)
                    $resultat = 'Vous n\'avez aucune notification.';
                
                return $resultat;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][getMessages]</font> $e</strong>";
			}
        }
        
        // ##############################################
        // RECUPERE LE NOMBRE DE MESSAGE DE L'UTILISATEUR
        // ##############################################
        public function getNbrMessages($id)
        {
            try
            {
            $query = "SELECT COUNT(ID) as total FROM ogr_messages WHERE Archive = 0 AND DestID = " . $id;
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $data = $result->fetch();
                return $data->total;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][getNbrMessages]</font> $e</strong>";
			}
        }
        
        // ######################################################
        // RECUPERE LE NOMBRE DE MESSAGE ENVOYÉS DE L'UTILISATEUR
        // ######################################################
        public function getNbrMessagesSend($id)
        {
            try
            {
            $query = "SELECT COUNT(ID) as total FROM ogr_messages WHERE ExpID = " . $id;
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $data = $result->fetch();
                return $data->total;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][getNbrMessagesSend]</font> $e</strong>";
			}
        }
        
        // #######################################################
        // RECUPERE LE NOMBRE DE MESSAGE ARCHIVÉS DE L'UTILISATEUR
        // #######################################################
        public function getNbrMessagesArchives($id)
        {
            try
            {
                $query = "SELECT COUNT(ID) as total FROM ogr_messages WHERE Archive = 1 AND DestID = " . $id;
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $data = $result->fetch();
                return $data->total;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][getNbrMessagesArchives]</font> $e</strong>";
			}
        }
        
        // ###########################################@#########
        // RECUPERE LE NOMBRE DE MESSAGE NON LU DE L'UTILISATEUR
        // #####################################################
        public function getNbrMessagesUnread($id)
        {
            try
            {
                $query = "SELECT COUNT(ID) as total FROM ogr_messages WHERE Archive = 0 AND Lu = 0 AND DestID = " . $id;
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $data = $result->fetch();
                return $data->total;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][getNbrMessages]</font> $e</strong>";
			}
        }
        
        // ##################################
        // MISE A JOUR DE L'ÉTAT D'UN MESSAGE
        // ###################################
        public function updateStateMessage($id, $state)
        {
            try
            {
                $query = "UPDATE ogr_messages SET Lu = " . $state . " WHERE ID = " . $id;
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][updateStateMessage]</font> $e</strong>";
			}
        }
        
        // #####################################
        // MISE A JOUR DE L'ARCHIVE D'UN MESSAGE
        // ######################################
        public function updateArchiveMessage($id, $state)
        {
            try
            {
                $query = "UPDATE ogr_messages SET Archive = " . $state . " WHERE ID = " . $id;
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][updateArchiveMessage]</font> $e</strong>";
			}
        }
        
        // ##############################
        // RECUPERE TOUS LES UTILISATEURS
        // ##############################
        public function getUsers($id)
        {
            try
            {
                $resultat = "";
                $query = "  SELECT * FROM ogr_users WHERE ID <> " . $id;
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                while ($data = $result->fetch())
                {
                    $resultat .= '<option value="' . $data->ID . '">' . $data->Prenom . ' ' . $data->Nom . '</option>';
                }
                
                return $resultat;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][getUsers]</font> $e</strong>";
			}
        }
        
        // #####################
        // CRÉATION D'UN MESSAGE
        // #####################
        public function createMessage($dest, $msg, $id)
        {
            try
            {
                $query = "INSERT INTO ogr_messages (ExpID, DestID, DateMsg, ContentMsg) VALUES (" . $id . ", " . $dest . ", 'Le " . date("l d F Y") . " à " . date("H\hi\m") . "', '" . str_replace("'", "\'", $msg) . "')";
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][createMessage]</font> $e</strong>";
			}
        }
        
        // ##############################
        // SUPPRESSION D'UNE NOTIFICATION
        // ##############################
        public function deleteNotification($id)
        {
            try
            {
                $query = "DELETE FROM ogr_notifications WHERE ID = " . $id;
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Ogreos][deleteNotification]</font> $e</strong>";
			}
        }
        
    }
?>