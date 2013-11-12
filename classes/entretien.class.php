<?php

    class Entretien
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
        
        // ##############################
        // RECUPERE TOUTES LES CATEGORIES
        // ##############################
        public function getAllCategories()
        {
            try
            {
                $resultat = "";
                $query = "  SELECT * FROM ogr_entretien_categories ORDER BY Name ASC";
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $i = 0;
                while ($data = $result->fetch())
                {
                    $resultat .= '<tr>';
                    $resultat .= '<td>' . $data->Name . '</td>';
                    $resultat .= '<td>';
                    $resultat .= '<a data-toggle="modal" href="#modifyCategorie" onClick="document.MODIFY_CATEGORIE.PID.value = \'' . $data->ID . '\';document.MODIFY_CATEGORIE.nom.value = \'' . str_replace("'", "\'", $data->Name) . '\'"><button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button></a>&nbsp;';
                    $resultat .= '<a data-toggle="modal" href="#deleteCategorie" onClick="document.DELETE_CATEGORIE.PID.value = \'' . $data->ID . '\'"><button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button></a>';
                    $resultat .= '</td>';
                    $resultat .= '</tr>';
                    
                    $i++;
                }
                
                if ($i == 0)
                    $resultat = '<tr><td colspan="2">Vous n\'avez aucune catégorie.</td></tr>';
                
                return $resultat;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][getAllCategories]</font> $e</strong>";
			}
        }
        
        // #####################################
        // RECUPERE TOUTES LES TYPES D'ENTRETIEN
        // #####################################
        public function getAllMeetingTypes()
        {
            try
            {
                $resultat = "";
                $query = "  SELECT ogr_entretien_types.*, ogr_entretien_categories.Name as Category 
                            FROM ogr_entretien_types 
                            LEFT OUTER JOIN ogr_entretien_categories ON ogr_entretien_types.CategoryID = ogr_entretien_categories.ID
                            ORDER BY ogr_entretien_types.Name ASC";
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $i = 0;
                while ($data = $result->fetch())
                {
                    $resultat .= '<tr>';
                    $resultat .= '<td>' . $data->Category . '</td>';
                    $resultat .= '<td>' . $data->Name . '</td>';
                    $resultat .= '<td>';
                    $resultat .= '<a data-toggle="modal" href="#modifyType" onClick="document.MODIFY_TYPE.PID.value = \'' . $data->ID . '\';document.MODIFY_TYPE.nom.value = \'' . str_replace("'", "\'", $data->Name) . '\';document.MODIFY_TYPE.CAT.value = \'' . $data->CategoryID . '\';"><button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button></a>&nbsp;';
                    $resultat .= '<a data-toggle="modal" href="#deleteType" onClick="document.DELETE_TYPE.PID.value = \'' . $data->ID . '\'"><button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button></a>';
                    $resultat .= '</td>';
                    $resultat .= '</tr>';
                    
                    $i++;
                }
                
                if ($i == 0)
                    $resultat = '<tr><td colspan="2">Vous n\'avez aucun type d\'entretien.</td></tr>';
                
                return $resultat;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][getAllMeetingTypes]</font> $e</strong>";
			}
        }
        
        // ###############################
        // RECUPERE TOUTES LES FORMULAIRES
        // ###############################
        public function getAllForms()
        {
            try
            {
                $resultat = "";
                $query = "  SELECT ogr_entretien_formulaire.*, ogr_entretien_types.Name AS TypeEntretien, ogr_entretien_categories.Name AS Category
                            FROM ogr_entretien_formulaire
                            LEFT OUTER JOIN ogr_entretien_types ON ogr_entretien_formulaire.TypeID = ogr_entretien_types.ID
                            LEFT OUTER JOIN ogr_entretien_categories ON ogr_entretien_types.CategoryID = ogr_entretien_categories.ID
                            ORDER BY Name ASC";
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $i = 0;
                while ($data = $result->fetch())
                {
                    if ((isset($_POST['CURRENT'])) && ($_POST['CURRENT'] == $data->ID))
                        $resultat .= '<tr bgcolor="#CFCFCF">';
                    else
                        $resultat .= '<tr>';
                    $resultat .= '<td><span class="label label-primary">' . $data->Category . '</span> <span class="label label-success">' . $data->TypeEntretien . '</span></td>';
                    $resultat .= '<td>' . $data->Name . '</td>';
                    $resultat .= '<td>';
                    $resultat .= '<a data-toggle="modal" href="#modifyForm" onClick="document.MODIFY_FORM.PID.value = \'' . $data->ID . '\';document.MODIFY_FORM.nom.value = \'' . str_replace("'", "\'", $data->Name) . '\';document.MODIFY_FORM.TYP.value = \'' . $data->TypeID . '\'"><button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button></a>&nbsp;';
                    $resultat .= '<a href="#" onClick="document.selectForm.CURRENT.value = \'' . $data->ID . '\';document.selectForm.submit();"><button class="btn btn-warning btn-xs"><i class="icon-lock"></i></button></a>&nbsp;';
                    $resultat .= '<a href="#" onClick="document.viewForm.CURRENT.value = \'' . $data->ID . '\';document.viewForm.NAME.value = \'' . str_replace("'", "\'", $data->Name) . '\';document.viewForm.CAT.value = \'' . str_replace("'", "\'", $data->Category) . '\';document.viewForm.TYP.value = \'' . str_replace("'", "\'", $data->TypeEntretien) . '\';document.viewForm.submit();"><button class="btn btn-info btn-xs"><i class="icon-edit"></i></button></a>&nbsp;';
                    $resultat .= '<a data-toggle="modal" href="#deleteForm" onClick="document.DELETE_FORM.PID.value = \'' . $data->ID . '\'"><button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button></a>';
                    $resultat .= '</td>';
                    $resultat .= '</tr>';
                    
                    $i++;
                }
                
                if ($i == 0)
                    $resultat = '<tr><td colspan="2">Vous n\'avez aucun type d\'entretien.</td></tr>';
                
                return $resultat;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][getAllMeetingTypes]</font> $e</strong>";
			}
        }
        
        // #############################################
        // RECUPERE TOUTES LES QUESTIONS D'UN FORMULAIRE
        // #############################################
        public function getAllQuestions($id)
        {
            try
            {
                $resultat = "";
                $query = "  SELECT *
                            FROM ogr_entretien_questions
                            WHERE FormID = " . $id .
                            " ORDER BY Rank ASC";
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);
                $i = 0;
                while ($data = $result->fetch())
                {
                    $resultat .= '<li class="dd-item" data-id="' . $data->ID . '">';
                    $resultat .= '<div class="dd-handle">';
                    if (strlen($data->Title) > 60)
                        $resultat .= substr($data->Title, 0, 60) . "...";
                    else
                        $resultat .= substr($data->Title, 0, 60);
                    $resultat .= '</div>';
                    
                    // Les Réponses
                    $queryAnwers = "SELECT * FROM ogr_entretien_reponses WHERE QuestionID = " . $data->ID;
                    $resultAnwers = $this->connection->query($queryAnwers);
                    $resultAnwers->setFetchMode(PDO::FETCH_OBJ);
                    $j = 1;
                    while ($dataAnswers = $resultAnwers->fetch())
                    {
                        $resultat .= '<ol class="dd-list">';
                        $resultat .= '<li class="dd-item" data-id="3"><div><u>Réponse #' . $j . '</u> : ' . $dataAnswers->ContentRep . '</div></li>';
                        $resultat .= '</ol>';
                        $j++;
                    }
                    
                    $resultat .= '<a data-toggle="modal" href="#deleteQuestion" onClick="document.DELETE_QUESTION.PID.value = \'' . $data->ID . '\'"><button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button></a>';
                    $resultat .= '</li>';
                    
                    $i++;
                }
                
                if ($i == 0)
                    $resultat = 'Vous n\'avez aucune question.';
                
                return $resultat;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][getAllQuestions]</font> $e</strong>";
			}
        }
        
        // ###########################
        // SUPPRESSION D'UNE CATÉGORIE
        // ###########################
        public function deleteCategory($id)
        {
            try
            {
                $query = "DELETE FROM ogr_entretien_categories WHERE ID = " . $id;
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][deleteCategory]</font> $e</strong>";
			}
        }
        
        // #####################
        // SUPPRESSION D'UN TYPE
        // #####################
        public function deleteType($id)
        {
            try
            {
                $query = "DELETE FROM ogr_entretien_types WHERE ID = " . $id;
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][deleteType]</font> $e</strong>";
			}
        }
        
        // ###########################
        // SUPPRESSION D'UN FORMULAIRE
        // ###########################
        public function deleteForm($id)
        {
            try
            {
                $query = "DELETE FROM ogr_entretien_formulaire WHERE ID = " . $id;
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][deleteForm]</font> $e</strong>";
			}
        }
        
        // ##########################
        // SUPPRESSION D'UNE QUESTION
        // ##########################
        public function deleteQuestion($id)
        {
            try
            {
                $query = "DELETE FROM ogr_entretien_questions WHERE ID = " . $id;
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][deleteQuestion]</font> $e</strong>";
			}
        }
        
        // ############################
        // MODIFICATION D'UNE CATÉGORIE
        // ############################
        public function modifyCategory($id, $name)
        {
            try
            {
                $query = "UPDATE ogr_entretien_categories SET Name = '" . str_replace("'", "\'", $name) . "' WHERE ID = " . $id;
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][modifyCategory]</font> $e</strong>";
			}
        }
        
        // ######################
        // MODIFICATION D'UN TYPE
        // ######################
        public function modifyType($id, $name, $category)
        {
            try
            {
                $query = "UPDATE ogr_entretien_types SET CategoryID = " . $category . ", Name = '" . str_replace("'", "\'", $name) . "' WHERE ID = " . $id;
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][modifyType]</font> $e</strong>";
			}
        }
        
        // ############################
        // MODIFICATION D'UN FORMULAIRE
        // ############################
        public function modifyForm($id, $name, $type)
        {
            try
            {
                $query = "UPDATE ogr_entretien_formulaire SET TypeID = " . $type . ", Name = '" . str_replace("'", "\'", $name) . "' WHERE ID = " . $id;
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][modifyForm]</font> $e</strong>";
			}
        }
        
        // ####################
        // AJOUT D'UNE QUESTION
        // ####################
        public function addQuestion($titre, $desc, $champ, $coef, $id)
        {
            try
            {
                $query = "INSERT INTO ogr_entretien_questions (Title, Description, AnswerTypeID, Coefficient, FormID) VALUES ('" . str_replace("'", "\'", $titre) . "','" . str_replace("'", "\'", $desc) . "', " . $champ . ", " . $coef . ", " . $id . ")";
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][addQuestion]</font> $e</strong>";
			}
        }
        
        // #####################
        // AJOUT D'UNE CATÉGORIE
        // #####################
        public function addCategory($name)
        {
            try
            {
                $query = "INSERT INTO ogr_entretien_categories (Name) VALUES ('" . str_replace("'", "\'", $name) . "')";
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][addCategory]</font> $e</strong>";
			}
        }
        
        // ###############
        // AJOUT D'UN TYPE
        // ###############
        public function addType($name, $category)
        {
            try
            {
                $query = "INSERT INTO ogr_entretien_types (Name, CategoryID) VALUES ('" . str_replace("'", "\'", $name) . "', $category)";
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][addType]</font> $e</strong>";
			}
        }
        
        // #####################
        // AJOUT D'UN FORMULAIRE
        // #####################
        public function addForm($name, $type)
        {
            try
            {
                $query = "INSERT INTO ogr_entretien_formulaire (Name, TypeID) VALUES ('" . str_replace("'", "\'", $name) . "', $type)";
                $this->connection->exec($query);
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][addForm]</font> $e</strong>";
			}
        }
        
        // #######################################
        // RECUPERE TOUTES LES CATÉGORIES (SELECT)
        // #######################################
        public function getCategories()
        {
            try
            {
                $resultat = '<option value="0">Aucune catégorie</option>';
                $query = "  SELECT * FROM ogr_entretien_categories ORDER BY Name";
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);

                while ($data = $result->fetch())
                {
                    $resultat .= '<option value="' . $data->ID . '">' . $data->Name . '</option>';
                }

                return $resultat;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][getCategories]</font> $e</strong>";
			}
        }
        
        // ##############################################
        // RECUPERE TOUTES LES TYPES D'ENTRETIEN (SELECT)
        // ##############################################
        public function getTypes()
        {
            try
            {
                $resultat = '';
                $query = "  SELECT * FROM ogr_entretien_types ORDER BY Name";
                $result = $this->connection->query($query);
                $result->setFetchMode(PDO::FETCH_OBJ);

                while ($data = $result->fetch())
                {
                    $resultat .= '<option value="' . $data->ID . '">' . $data->Name . '</option>';
                }

                return $resultat;
            }
            catch (Exception $e)
			{
				echo "<hr width=100% color=black><strong><font color=red>[Entretien][getCategories]</font> $e</strong>";
			}
        }
        
    }
?>