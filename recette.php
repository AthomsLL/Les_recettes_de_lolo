<?php 
    require 'admin/database.php';

    if(!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }

    $db = Database::connect();
    
    $statement = $db->prepare('SELECT recettes.id, recettes.name, recettes.nbrepersonnes, recettes.difficulty, recettes.preptime, recettes.cooktime, recettes.ingr1, recettes.ingr2, recettes.ingr3, recettes.ingr4, recettes.ingr5, recettes.ingr6, recettes.ingr7, recettes.ingr8, recettes.ingr9, recettes.ingr10, recettes.ingr11, recettes.ingr12, recettes.ingr13, recettes.ingr14, recettes.ingr15, recettes.step1, recettes.step2, recettes.step3, recettes.step4, recettes.step5, recettes.step6, recettes.step7, recettes.step8, recettes.step9, recettes.step10, recettes.step11, recettes.step12, recettes.step13, recettes.step14, recettes.step15, recettes.image, categories.name AS category, difficulty.name AS difficulty
                               FROM recettes 
                               LEFT JOIN categories ON recettes.category = categories.id
                               LEFT JOIN difficulty ON recettes.difficulty = difficulty.id
                               WHERE recettes.id = ?');

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
        <title><?php echo $name; ?> - Les Recettes de Lolo</title>
        
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
        <!-- javascript -->
        
        <!-- css -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href="css/style.css" rel="stylesheet">
        <!-- css -->
        
        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet">
        <!-- fonts -->
        
        <!-- meta SEO -->
        <meta name="description" content="Site de recettes de cuisine familiale délicieuses">
        <meta name="keywords" content="cuisine, cook, recettes, plats, desserts, entrees, aperitifs">
        <!-- meta SEO -->
    </head>
    
    <body>
        
        <div class="container-fluid">

            <!-- HEADER -->
            <header class="header">
                <nav class="navbar navbar-default">
                    <div class="navbar-header">
                        <button type="button" class="header-btn navbar-toggle" data-toggle="collapse" data-target="#monMenu">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="header-recette-collapse collapse navbar-collapse" id="monMenu">
                        <a href="index.php#banner"><h1 class="site"> Les Recettes de Lolo </h1></a>
                        <ul class="header-navbar-nav nav navbar-nav">
                            <?php 
                                $db = Database::connect();
        
                                $statement = $db->query('SELECT * FROM categories');
                                $categories = $statement->fetchAll();
                            
                                foreach($categories as $category)
                                {
                                    echo '<li><a class="header-menu-item" href="#' . $category['name'] . '">' . $category['name'] . '</a></li>';    
                                }

                                Database::disconnect();
                            ?>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- HEADER -->
        
            <!-- CONTENU DE LA RECETTE -->
            <main>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="recette recette-max-width center-block">
                                <div class="recette-header">
                                    <div class="recette-header-image">
                                        <img src="<?php echo 'images/' . $image; ?>" alt="..."/>
                                        <h2 class="recette-header-title"><?php echo $name; ?></h2>
                                    </div>
                                </div>
                                <div class="recette-fond-image">
                                    <div class="recette-body">
                                        <p class="recette-body-infos">
                                            - Nombre de personnes : <?php echo $nbrepersonnes; ?> <br/>
                                            - Difficulté : <?php echo $difficulty; ?> <br/>
                                            - Temps de préparation : <?php echo $preptime; ?> <br/>
                                            - Temps de cuisson : <?php echo $cooktime; ?> <br/>
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
                                        <button type="button" class="recette-footer-btn btn btn-primary" onclick="window.print();">Imprimer</button>   
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </main>
            <!-- CONTENU DE LA RECETTE -->
        
            <!-- FOOTER -->
        
            <footer class="footer container">
        
            </footer>
        
            <!-- FOOTER -->
        </div>
    </body>
    
</html>