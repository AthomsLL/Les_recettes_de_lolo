<?php 
    require 'database.php';

    $name = $nbrepersonnes = $difficulty = $preptime = $cooktime = $ingr1 = $ingr2 = $ingr3 = $ingr4 = $ingr5 = $ingr6 = $ingr7 = $ingr8 = $ingr9 = $ingr10 = $ingr11 = $ingr12 = $ingr13 = $ingr14 = $ingr15 = $step1 = $step2 = $step3 = $step4 = $step5 = $step6 = $step7 = $step8 = $step9 = $step10 = $step11 = $step12 = $step13 = $step14 = $step15 = $category = $image = $nameError = $nbrepersonnesError = $difficultyError = $preptimeError = $cooktimeError = $ingr1Error = $step1Error = $categoryError = $imageError = "";
    
    if(!empty($_POST))
    {
        $name               = checkInput($_POST['name']);
        $nbrepersonnes      = checkInput($_POST['nbrepersonnes']);
        $difficulty         = checkInput($_POST['difficulty']);
        $preptime           = checkInput($_POST['preptime']);
        $cooktime           = checkInput($_POST['cooktime']);
        $ingr1              = checkInput($_POST['ingr1']);
        $ingr2              = checkInput($_POST['ingr2']);
        $ingr3              = checkInput($_POST['ingr3']);
        $ingr4              = checkInput($_POST['ingr4']);
        $ingr5              = checkInput($_POST['ingr5']);
        $ingr6              = checkInput($_POST['ingr6']);
        $ingr7              = checkInput($_POST['ingr7']);
        $ingr8              = checkInput($_POST['ingr8']);
        $ingr9              = checkInput($_POST['ingr9']);
        $ingr10             = checkInput($_POST['ingr10']);
        $ingr11             = checkInput($_POST['ingr11']);
        $ingr12             = checkInput($_POST['ingr12']);
        $ingr13             = checkInput($_POST['ingr13']);
        $ingr14             = checkInput($_POST['ingr14']);
        $ingr15             = checkInput($_POST['ingr15']);
        $step1              = checkInput($_POST['step1']);
        $step2              = checkInput($_POST['step2']);
        $step3              = checkInput($_POST['step3']);
        $step4              = checkInput($_POST['step4']);
        $step5              = checkInput($_POST['step5']);
        $step6              = checkInput($_POST['step6']);
        $step7              = checkInput($_POST['step7']);
        $step8              = checkInput($_POST['step8']);
        $step9              = checkInput($_POST['step9']);
        $step10             = checkInput($_POST['step10']);
        $step11             = checkInput($_POST['step11']);
        $step12             = checkInput($_POST['step12']);
        $step13             = checkInput($_POST['step13']);
        $step14             = checkInput($_POST['step14']);
        $step15             = checkInput($_POST['step15']);
        $category           = checkInput($_POST['category']);
        $image              = checkInput($_FILES['image']['name']);
        $imagePath          = '../images/' . basename($image);
        $imageExtension     = pathinfo($imagePath, PATHINFO_EXTENSION);
        $isSuccess          = true;
        $isUploadSuccess    = false;
        
        if(empty($name))
        {
            $nameError = 'Ce champ doit être rempli';
            $isSuccess = false;
        }
        if(empty($nbrepersonnes))
        {
            $nbrepersonnesError = 'Ce champ doit être rempli';
            $isSuccess = false;
        }
        if(empty($difficulty))
        {
            $difficultyError = 'Ce champ doit être rempli';
            $isSuccess = false;
        }
        if(empty($preptime))
        {
            $preptimeError = 'Ce champ doit être rempli';
            $isSuccess = false;
        }
        if(empty($cooktime))
        {
            $cooktimeError = 'Ce champ doit être rempli';
            $isSuccess = false;
        }
        if(empty($ingr1))
        {
            $ingr1Error = 'Ce champ doit être rempli';
            $isSuccess = false;
        }
        if(empty($step1))
        {
            $step1Error = 'Ce champ doit être rempli';
            $isSuccess = false;
        }
        if(empty($category))
        {
            $categoryError = 'Ce champ doit être rempli';
            $isSuccess = false;
        }
        if(empty($image))
        {
            $imageError = 'Veuillez sélectionner une image';
            $isSuccess = false;
        } 
        else
        {
            $isUploadSuccess = true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif")
            {
                $imageError = 'Les fichiers autorisés sont: .jpg, .jpeg, .png et .gif';
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath))
            {
                $imageError = 'Le fichier existe deja';
                $isUploadSuccess = false;
            }
            if($_FILES['image']['size'] > 2500000)
            {
                $imageError = 'Le fichier ne doit pas dépasser les 2,5MB';
                $isUploadSuccess = false;
            }
            if($isUploadSuccess)
            {
                if(!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath))
                {
                    $imageError = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                }
            }
        }
        
        if($isSuccess && $isUploadSuccess)
        {
            $db = Database::connect();
            
            $statement = $db->prepare('INSERT INTO recettes (name, nbrepersonnes, difficulty, preptime, cooktime, ingr1, ingr2, ingr3, ingr4, ingr5, ingr6, ingr7, ingr8, ingr9, ingr10, ingr11, ingr12, ingr13, ingr14, ingr15, step1, step2, step3, step4, step5, step6, step7, step8, step9, step10, step11, step12, step13, step14, step15, category, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            
            $statement->execute(array($name, $nbrepersonnes, $difficulty, $preptime, $cooktime, $ingr1, $ingr2, $ingr3, $ingr4, $ingr5, $ingr6, $ingr7, $ingr8, $ingr9, $ingr10, $ingr11, $ingr12, $ingr13, $ingr14, $ingr15, $step1, $step2, $step3, $step4, $step5, $step6, $step7, $step8, $step9, $step10, $step11, $step12, $step13, $step14, $step15, $category, $image));
            
            Database::disconnect();
            
            header('Location: admin.php');
        }   
    }

    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Ajouter une recette - Les Recettes de Lolo</title>
        
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="../js/script.js"></script>
        
        <!-- css -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href="../css/style.css" rel="stylesheet">
        
        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet">
        
        <!-- meta SEO -->
        <meta name="description" content="Site de recettes de cuisine familiale délicieuses">
        <meta name="keywords" content="cuisine, cook, recettes, plats, desserts">
        
    </head>
    
    <body>
        <div class="container-fluid">
            <h1 class="site"> Les Recettes de Lolo </h1>
            <div class="container admin">
                <div class="row">
                    <h1 class="titre"><strong>Ajouter une recette</strong></h1>
                    <br>
                    <form class="form" role="form" action="ajouter.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nom:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la recette" value="<?php echo $name; ?>">
                            <span class="help-inline"><?php echo $nameError; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Infos:</label>
                            <p>
                                - Nombre de personnes : <input type="text" class="form-control" id="nbrepersonnes" name="nbrepersonnes" placeholder="Nombre de personnes" value="<?php echo $nbrepersonnes; ?>"><span class="help-inline"><?php echo $nbrepersonnesError; ?></span>
                                <br>
                                - Difficulté: 
                                <select class="form-control" id="difficulty" name="difficulty">
                                <?php 
                                    $db = Database::connect();
                                
                                    foreach($db->query('SELECT * FROM difficulty') as $row)
                                    {
                                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                    }
                                
                                    Database::disconnect();
                                ?>
                                </select>
                                <span class="help-inline"><?php echo $difficultyError; ?></span>
                                <br>
                                - Temps de préparation : <input type="text" class="form-control" id="preptime" name="preptime" placeholder="Temps de préparation" value="<?php echo $preptime; ?>"><span class="help-inline"><?php echo $preptimeError; ?></span>
                                <br>
                                - Temps de cuisson : <input type="text" class="form-control" id="cooktime" name="cooktime" placeholder="Temps de cuisson" value="<?php echo $cooktime; ?>"><span class="help-inline"><?php echo $cooktimeError; ?></span>
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Ingrédients:</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="ingr1" name="ingr1" placeholder="Ingrédient 1" value="<?php echo $ingr1; ?>"><span class="help-inline"><?php echo $ingr1Error; ?></span>
                                    <input type="text" class="form-control" id="ingr2" name="ingr2" placeholder="Ingrédient 2" value="<?php echo $ingr2; ?>">
                                    <input type="text" class="form-control" id="ingr3" name="ingr3" placeholder="Ingrédient 3" value="<?php echo $ingr3; ?>">
                                    <input type="text" class="form-control" id="ingr4" name="ingr4" placeholder="Ingrédient 4" value="<?php echo $ingr4; ?>">
                                    <input type="text" class="form-control" id="ingr5" name="ingr5" placeholder="Ingrédient 5" value="<?php echo $ingr5; ?>">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="ingr6" name="ingr6" placeholder="Ingrédient 6" value="<?php echo $ingr6; ?>">
                                    <input type="text" class="form-control" id="ingr7" name="ingr7" placeholder="Ingrédient 7" value="<?php echo $ingr7; ?>">
                                    <input type="text" class="form-control" id="ingr8" name="ingr8" placeholder="Ingrédient 8" value="<?php echo $ingr8; ?>">
                                    <input type="text" class="form-control" id="ingr9" name="ingr9" placeholder="Ingrédient 9" value="<?php echo $ingr9; ?>">
                                    <input type="text" class="form-control" id="ingr10" name="ingr10" placeholder="Ingrédient 10" value="<?php echo $ingr10; ?>">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="ingr11" name="ingr11" placeholder="Ingrédient 11" value="<?php echo $ingr11; ?>">
                                    <input type="text" class="form-control" id="ingr12" name="ingr12" placeholder="Ingrédient 12" value="<?php echo $ingr12; ?>">
                                    <input type="text" class="form-control" id="ingr13" name="ingr13" placeholder="Ingrédient 13" value="<?php echo $ingr13; ?>">
                                    <input type="text" class="form-control" id="ingr14" name="ingr14" placeholder="Ingrédient 14" value="<?php echo $ingr14; ?>">
                                    <input type="text" class="form-control" id="ingr15" name="ingr15" placeholder="Ingrédient 15" value="<?php echo $ingr15; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Préparation:</label>
                            <div class="row">
                                <div>
                                    <input type="text" class="form-control" id="step1" name="step1" placeholder="Etape 1" value="<?php echo $step1; ?>"><span class="help-inline"><?php echo $step1Error; ?></span>
                                    <input type="text" class="form-control" id="step2" name="step2" placeholder="Etape 2" value="<?php echo $step2; ?>">
                                    <input type="text" class="form-control" id="step3" name="step3" placeholder="Etape 3" value="<?php echo $step3; ?>">
                                    <input type="text" class="form-control" id="step4" name="step4" placeholder="Etape 4" value="<?php echo $step4; ?>">
                                    <input type="text" class="form-control" id="step5" name="step5" placeholder="Etape 5" value="<?php echo $step5; ?>">
                                    <input type="text" class="form-control" id="step6" name="step6" placeholder="Etape 6" value="<?php echo $step6; ?>">
                                    <input type="text" class="form-control" id="step7" name="step7" placeholder="Etape 7" value="<?php echo $step7; ?>">
                                    <input type="text" class="form-control" id="step8" name="step8" placeholder="Etape 8" value="<?php echo $step8; ?>">
                                    <input type="text" class="form-control" id="step9" name="step9" placeholder="Etape 9" value="<?php echo $step9; ?>">
                                    <input type="text" class="form-control" id="step10" name="step10" placeholder="Etape 10" value="<?php echo $step10; ?>">
                                    <input type="text" class="form-control" id="step11" name="step11" placeholder="Etape 11" value="<?php echo $step11; ?>">
                                    <input type="text" class="form-control" id="step12" name="step12" placeholder="Etape 12" value="<?php echo $step12; ?>">
                                    <input type="text" class="form-control" id="step13" name="step13" placeholder="Etape 13" value="<?php echo $step13; ?>">
                                    <input type="text" class="form-control" id="step14" name="step14" placeholder="Etape 14" value="<?php echo $step14; ?>">
                                    <input type="text" class="form-control" id="step15" name="step15" placeholder="Etape 15" value="<?php echo $step15; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category">Catégorie:</label>
                            <select class="form-control" id="category" name="category">
                                <?php 
                                    $db = Database::connect();
                                
                                    foreach($db->query('SELECT * FROM categories') as $row)
                                    {
                                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                    }
                                
                                    Database::disconnect();
                                ?>
                            </select>
                            <span class="help-inline"><?php echo $categoryError; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="image">Sélectionner une image:</label>
                            <input type="file" id="image" name="image">
                            <span class="help-inline"><?php echo $imageError; ?></span>
                        </div>    
                        <br>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                            <a class="btn btn-primary" href="admin.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </body>
</html>