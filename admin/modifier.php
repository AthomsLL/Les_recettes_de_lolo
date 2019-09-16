<?php 
    require 'database.php';

    if(!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }

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
            $isImageUpdated = false;
        } 
        else
        {
            $isImageUpdated = true;
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
        
        if(($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated))
        {
            $db = Database::connect();
            
            if($isImageUpdated)
            {
                $statement = $db->prepare('UPDATE recettes SET name = ?, nbrepersonnes = ?, difficulty = ?, preptime = ?, cooktime = ?, ingr1 = ?, ingr2 = ?, ingr3 = ?, ingr4 = ?, ingr5 = ?, ingr6 = ?, ingr7 = ?, ingr8 = ?, ingr9 = ?, ingr10 = ?, ingr11 = ?, ingr12 = ?, ingr13 = ?, ingr14 = ?, ingr15 = ?, step1 = ?, step2 = ?, step3 = ?, step4 = ?, step5 = ?, step6 = ?, step7 = ?, step8 = ?, step9 = ?, step10 = ?, step11 = ?, step12 = ?, step13 = ?, step14 = ?, step15 = ?, category = ?, image = ? WHERE id= ?');
            
                $statement->execute(array($name, $nbrepersonnes, $difficulty, $preptime, $cooktime, $ingr1, $ingr2, $ingr3, $ingr4, $ingr5, $ingr6, $ingr7, $ingr8, $ingr9, $ingr10, $ingr11, $ingr12, $ingr13, $ingr14, $ingr15, $step1, $step2, $step3, $step4, $step5, $step6, $step7, $step8, $step9, $step10, $step11, $step12, $step13, $step14, $step15, $category, $image, $id));    
            }
            else
            {
                $statement = $db->prepare('UPDATE recettes SET name = ?, nbrepersonnes = ?, difficulty = ?, preptime = ?, cooktime = ?, ingr1 = ?, ingr2 = ?, ingr3 = ?, ingr4 = ?, ingr5 = ?, ingr6 = ?, ingr7 = ?, ingr8 = ?, ingr9 = ?, ingr10 = ?, ingr11 = ?, ingr12 = ?, ingr13 = ?, ingr14 = ?, ingr15 = ?, step1 = ?, step2 = ?, step3 = ?, step4 = ?, step5 = ?, step6 = ?, step7 = ?, step8 = ?, step9 = ?, step10 = ?, step11 = ?, step12 = ?, step13 = ?, step14 = ?, step15 = ?, category = ? WHERE id= ?');
            
                $statement->execute(array($name, $nbrepersonnes, $difficulty, $preptime, $cooktime, $ingr1, $ingr2, $ingr3, $ingr4, $ingr5, $ingr6, $ingr7, $ingr8, $ingr9, $ingr10, $ingr11, $ingr12, $ingr13, $ingr14, $ingr15, $step1, $step2, $step3, $step4, $step5, $step6, $step7, $step8, $step9, $step10, $step11, $step12, $step13, $step14, $step15, $category, $id));    
            }
            
            Database::disconnect();
            
            header('Location: admin.php');
        }  
        else if($isImageUpdated && !$isUploadSuccess)
        {
            $db = Database::connect();
            
            $statement = $db->prepare('SELECT image FROM recettes WHERE id = ?');
            $statement->execute(array($id));
            $item = $statement->fetch();
            $image = $item['image'];
            
            Database::disconnect();
        }
    }
    else
    {
        $db = Database::connect();
        
        $statement = $db->prepare('SELECT * FROM recettes WHERE id = ?');
        $statement->execute(array($id));
        $item = $statement->fetch();
        $name               = $item['name'];
        $nbrepersonnes      = $item['nbrepersonnes'];
        $difficulty         = $item['difficulty'];
        $preptime           = $item['preptime'];
        $cooktime           = $item['cooktime'];
        $ingr1              = $item['ingr1'];
        $ingr2              = $item['ingr2'];
        $ingr3              = $item['ingr3'];
        $ingr4              = $item['ingr4'];
        $ingr5              = $item['ingr5'];
        $ingr6              = $item['ingr6'];
        $ingr7              = $item['ingr7'];
        $ingr8              = $item['ingr8'];
        $ingr9              = $item['ingr9'];
        $ingr10             = $item['ingr10'];
        $ingr11             = $item['ingr11'];
        $ingr12             = $item['ingr12'];
        $ingr13             = $item['ingr13'];
        $ingr14             = $item['ingr14'];
        $ingr15             = $item['ingr15'];
        $step1              = $item['step1'];
        $step2              = $item['step2'];
        $step3              = $item['step3'];
        $step4              = $item['step4'];
        $step5              = $item['step5'];
        $step6              = $item['step6'];
        $step7              = $item['step7'];
        $step8              = $item['step8'];
        $step9              = $item['step9'];
        $step10             = $item['step10'];
        $step11             = $item['step11'];
        $step12             = $item['step12'];
        $step13             = $item['step13'];
        $step14             = $item['step14'];
        $step15             = $item['step15'];
        $category           = $item['category'];
        $image              = $item['image'];
        
        Database::disconnect();
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
        <title>Modifier une recette - Les Recettes de Lolo</title>
        
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
                    <div class="col-sm-6">
                        <h1 class="titre"><strong>Modifier une recette</strong></h1>
                        <br>
                        <form class="form" role="form" action="<?php echo 'modifier.php?id=' . $id; ?>" method="post" enctype="multipart/form-data">
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
                                            if($row['id'] == $difficulty)
                                                echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                            else
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
                                            if($row['id'] == $category)
                                                echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                            else
                                                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                        }

                                        Database::disconnect();
                                    ?>
                                </select>
                                <span class="help-inline"><?php echo $categoryError; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Image:</label>
                                <p><?php echo $image; ?></p>
                                <label for="image">Sélectionner une image:</label>
                                <input type="file" id="image" name="image">
                                <span class="help-inline"><?php echo $imageError; ?></span>
                            </div>    
                            <br>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                                <a class="btn btn-primary" href="admin.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="vueaccueil">Vue Accueil</h2>
                                <article class="thumbnail">
                                    <img src="<?php echo '../images/' . $image; ?>" alt="...">
                                    <div class="caption">
                                        <h2 class="caption-title"><?php echo $name; ?></h2>
                                        <a href="" target="_blank" class="caption-btn btn btn-default btn-lg" role="button">La recette</a>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="vuerecette">Vue Recette</h2>
                                <div class="recette">
                                    <div class="recette-header">
                                        <div class="recette-header-image">
                                            <img src="<?php echo '../images/' . $image; ?>" alt="..."/>
                                            <h2 class="recette-header-title"><?php echo $name; ?></h2>
                                        </div>
                                    </div>
                                    <div class="recette-fond-image">
                                        <div class="recette-body">
                                            <p class="recette-body-infos">
                                                - Nombre de personnes : <?php echo $nbrepersonnes; ?><br/>
                                                - Difficulté : <?php echo $difficulty; ?><br/>
                                                - Temps de préparation : <?php echo $preptime; ?><br/>
                                                - Temps de cuisson : <?php echo $cooktime; ?><br/>
                                            </p>
                                            <div class="recette-black-divider"></div>
                                            <h5>Ingrédients</h5>
                                            <?php 
                                                echo '<ul class="recette-body-ingredients">';
                                                echo '<li>' . $ingr1 . '</li>';
                                                echo '<li>' . $ingr2 . '</li>';
                                                echo '<li>' . $ingr3 . '</li>';
                                                if(!empty($ingr4))
                                                    echo '<li>' . $ingr4 . '</li>';    
                                                if(!empty($ingr5))
                                                    echo '<li>' . $ingr5 . '</li>';    
                                                if(!empty($ingr6))
                                                    echo '<li>' . $ingr6 . '</li>';    
                                                if(!empty($ingr7))
                                                    echo '<li>' . $ingr7 . '</li>'; 
                                                if(!empty($ingr8))
                                                    echo '<li>' . $ingr8 . '</li>';
                                                if(!empty($ingr9))
                                                    echo '<li>' . $ingr9 . '</li>';
                                                if(!empty($ingr10))
                                                    echo '<li>' . $ingr10 . '</li>';
                                                if(!empty($ingr11))
                                                    echo '<li>' . $ingr11 . '</li>';
                                                if(!empty($ingr12))
                                                    echo '<li>' . $ingr12 . '</li>';
                                                if(!empty($ingr13))
                                                    echo '<li>' . $ingr13 . '</li>';
                                                if(!empty($ingr14))
                                                    echo '<li>' . $ingr14 . '</li>';
                                                if(!empty($ingr15))
                                                    echo '<li>' . $ingr15 . '</li>'; 
                                                echo '</ul>';
                                            ?>
                                            <div class="recette-black-divider"></div>
                                            <h5>Préparation</h5>
                                            <?php 
                                                echo '<ol class="recette-body-preparation">';
                                                echo '<li>' . $step1 . '</li>';
                                                if(!empty($step2))
                                                    echo '<li>' . $step2 . '</li>';
                                                if(!empty($step3))
                                                    echo '<li>' . $step3 . '</li>';    
                                                if(!empty($step4))
                                                    echo '<li>' . $step4 . '</li>';    
                                                if(!empty($step5))
                                                    echo '<li>' . $step5 . '</li>';    
                                                if(!empty($step6))
                                                    echo '<li>' . $step6 . '</li>'; 
                                                if(!empty($step7))
                                                    echo '<li>' . $step7 . '</li>';
                                                if(!empty($step8))
                                                    echo '<li>' . $step8 . '</li>';
                                                if(!empty($step9))
                                                    echo '<li>' . $step9 . '</li>';
                                                if(!empty($step10))
                                                    echo '<li>' . $step10 . '</li>';
                                                if(!empty($step11))
                                                    echo '<li>' . $step11 . '</li>';
                                                if(!empty($step12))
                                                    echo '<li>' . $step12 . '</li>';
                                                if(!empty($step13))
                                                    echo '<li>' . $step13 . '</li>';
                                                if(!empty($step14))
                                                    echo '<li>' . $step14 . '</li>';
                                                if(!empty($step15))
                                                    echo '<li>' . $step15 . '</li>';
                                                echo '</ol>';
                                            ?>
                                        </div>
                                        <div class="recette-footer">
                                            <button type="button" class="recette-footer-btn btn btn-primary">Imprimer</button>   
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>  
                    </div>
                </div>    
            </div>
        </div>    
    </body>
</html>