<?php 
    require 'database.php';

    if(!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }

    $db = Database::connect();
    
    $statement = $db->prepare('SELECT recettes.id, recettes.name, recettes.nbrepersonnes, recettes.difficulty, recettes.preptime, recettes.cooktime, recettes.ingr1, recettes.ingr2, recettes.ingr3, recettes.ingr4,                                                                 recettes.ingr5, recettes.ingr6, recettes.ingr7, recettes.ingr8, recettes.ingr9, recettes.ingr10, recettes.ingr11, recettes.ingr12, recettes.ingr13, recettes.ingr14,                                                                           recettes.ingr15, recettes.step1, recettes.step2, recettes.step3, recettes.step4, recettes.step5, recettes.step6, recettes.step7, recettes.step8, recettes.step9, recettes.step10, recettes.step11,                                             recettes.step12, recettes.step13, recettes.step14, recettes.step15, recettes.image, categories.name AS category, difficulty.name AS difficulty
                               FROM recettes 
                               LEFT JOIN categories ON recettes.category = categories.id
                               LEFT JOIN difficulty ON recettes.difficulty = difficulty.id
                               WHERE recettes.id = ?');

    $statement->execute(array($id));
    $item = $statement->fetch();

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
<html>
    <head lang="fr">
        <title>Voir une recette - Les Recettes de Lolo</title>
        
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
                        <h1 class="titre"><strong>Voir une recette</strong></h1>
                        <br>
                        <form>
                            <div class="form-group">
                                <label>Nom:</label><?php echo ' ' . $item['name']; ?> 
                            </div>
                            <div class="form-group">
                                <label>Infos:</label>
                                <?php 
                                    echo ' <p>- Nombre de personnes : ' . $item['nbrepersonnes'] . '<br>
                                              - Difficulté : ' . $item['difficulty'] . '<br>
                                              - Temps de préparation : ' . $item['preptime'] . '<br>
                                              - Temps de cuisson : ' . $item['cooktime'] . 
                                          '</p>';
                                ?> 
                            </div>
                            <div class="form-group">
                                <label>Ingrédients:</label>
                                <?php 
                                    echo '<ul>';
                                    echo '<li>' . $item['ingr1'] . '</li>';
                                    echo '<li>' . $item['ingr2'] . '</li>';
                                    echo '<li>' . $item['ingr3'] . '</li>';
                                    if(!empty($item['ingr4']))
                                        echo '<li>' . $item['ingr4'] . '</li>';    
                                    if(!empty($item['ingr5']))
                                        echo '<li>' . $item['ingr5'] . '</li>';    
                                    if(!empty($item['ingr6']))
                                        echo '<li>' . $item['ingr6'] . '</li>';    
                                    if(!empty($item['ingr7']))
                                        echo '<li>' . $item['ingr7'] . '</li>'; 
                                    if(!empty($item['ingr8']))
                                        echo '<li>' . $item['ingr8'] . '</li>';
                                    if(!empty($item['ingr9']))
                                        echo '<li>' . $item['ingr9'] . '</li>';
                                    if(!empty($item['ingr10']))
                                        echo '<li>' . $item['ingr10'] . '</li>';
                                    if(!empty($item['ingr11']))
                                        echo '<li>' . $item['ingr11'] . '</li>';
                                    if(!empty($item['ingr12']))
                                        echo '<li>' . $item['ingr12'] . '</li>';
                                    if(!empty($item['ingr13']))
                                        echo '<li>' . $item['ingr13'] . '</li>';
                                    if(!empty($item['ingr14']))
                                        echo '<li>' . $item['ingr14'] . '</li>';
                                    if(!empty($item['ingr15']))
                                        echo '<li>' . $item['ingr15'] . '</li>';    
                                    echo '</ul>';
                                ?> 
                            </div>
                            <div class="form-group">
                                <label>Préparation:</label>
                                <?php
                                    echo '<ol>';
                                    echo '<li>' . $item['step1'] . '</li>';
                                    if(!empty($item['step2']))
                                        echo '<li>' . $item['step2'] . '</li>';
                                    if(!empty($item['step3']))
                                        echo '<li>' . $item['step3'] . '</li>';    
                                    if(!empty($item['step4']))
                                        echo '<li>' . $item['step4'] . '</li>';    
                                    if(!empty($item['step5']))
                                        echo '<li>' . $item['step5'] . '</li>';    
                                    if(!empty($item['step6']))
                                        echo '<li>' . $item['step6'] . '</li>'; 
                                    if(!empty($item['step7']))
                                        echo '<li>' . $item['step7'] . '</li>';
                                    if(!empty($item['step8']))
                                        echo '<li>' . $item['step8'] . '</li>';
                                    if(!empty($item['step9']))
                                        echo '<li>' . $item['step9'] . '</li>';
                                    if(!empty($item['step10']))
                                        echo '<li>' . $item['step10'] . '</li>';
                                    if(!empty($item['step11']))
                                        echo '<li>' . $item['step11'] . '</li>';
                                    if(!empty($item['step12']))
                                        echo '<li>' . $item['step12'] . '</li>';
                                    if(!empty($item['step13']))
                                        echo '<li>' . $item['step13'] . '</li>';
                                    if(!empty($item['step14']))
                                        echo '<li>' . $item['step14'] . '</li>';
                                    if(!empty($item['step15']))
                                        echo '<li>' . $item['step15'] . '</li>';
                                    echo '</ol>';
                                ?>
                            </div>
                            <div class="form-group">
                                <label>Catégorie:</label><?php echo ' ' . $item['category']; ?>
                            </div>
                            <div class="form-group">
                                <label>Image:</label><?php echo ' ' . $item['image']; ?>
                            </div>
                        </form>
                        <br>
                        <div class="form-actions">
                            <a class="btn btn-primary" href="admin.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="vueaccueil">Vue Accueil</h2>
                                <article class="thumbnail">
                                    <img src="<?php echo '../images/' . $item['image']; ?>" alt="...">
                                    <div class="caption">
                                        <h2 class="caption-title"><?php echo $item['name']; ?></h2>
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
                                            <img src="<?php echo '../images/' . $item['image']; ?>" alt="..."/>
                                            <h2 class="recette-header-title"><?php echo $item['name']; ?></h2>
                                        </div>
                                    </div>
                                    <div class="recette-fond-image">
                                        <div class="recette-body">
                                            <p class="recette-body-infos">
                                                - Nombre de personnes : <?php echo $item['nbrepersonnes']; ?><br/>
                                                - Difficulté : <?php echo $item['difficulty']; ?><br/>
                                                - Temps de préparation : <?php echo $item['preptime']; ?><br/>
                                                - Temps de cuisson : <?php echo $item['cooktime']; ?><br/>
                                            </p>
                                            <div class="recette-black-divider"></div>
                                            <h5>Ingrédients</h5>
                                            <?php 
                                                echo '<ul class="recette-body-ingredients">';
                                                echo '<li>' . $item['ingr1'] . '</li>';
                                                echo '<li>' . $item['ingr2'] . '</li>';
                                                echo '<li>' . $item['ingr3'] . '</li>';
                                                if(!empty($item['ingr4']))
                                                    echo '<li>' . $item['ingr4'] . '</li>';    
                                                if(!empty($item['ingr5']))
                                                    echo '<li>' . $item['ingr5'] . '</li>';    
                                                if(!empty($item['ingr6']))
                                                    echo '<li>' . $item['ingr6'] . '</li>';    
                                                if(!empty($item['ingr7']))
                                                    echo '<li>' . $item['ingr7'] . '</li>'; 
                                                if(!empty($item['ingr8']))
                                                    echo '<li>' . $item['ingr8'] . '</li>';
                                                if(!empty($item['ingr9']))
                                                    echo '<li>' . $item['ingr9'] . '</li>';
                                                if(!empty($item['ingr10']))
                                                    echo '<li>' . $item['ingr10'] . '</li>';
                                                if(!empty($item['ingr11']))
                                                    echo '<li>' . $item['ingr11'] . '</li>';
                                                if(!empty($item['ingr12']))
                                                    echo '<li>' . $item['ingr12'] . '</li>';
                                                if(!empty($item['ingr13']))
                                                    echo '<li>' . $item['ingr13'] . '</li>';
                                                if(!empty($item['ingr14']))
                                                    echo '<li>' . $item['ingr14'] . '</li>';
                                                if(!empty($item['ingr15']))
                                                    echo '<li>' . $item['ingr15'] . '</li>'; 
                                                echo '</ul>';
                                            ?>
                                            <div class="recette-black-divider"></div>
                                            <h5>Préparation</h5>
                                            <?php 
                                                echo '<ol class="recette-body-preparation">';
                                                echo '<li>' . $item['step1'] . '</li>';
                                                if(!empty($item['step2']))
                                                    echo '<li>' . $item['step2'] . '</li>';
                                                if(!empty($item['step3']))
                                                    echo '<li>' . $item['step3'] . '</li>';    
                                                if(!empty($item['step4']))
                                                    echo '<li>' . $item['step4'] . '</li>';    
                                                if(!empty($item['step5']))
                                                    echo '<li>' . $item['step5'] . '</li>';    
                                                if(!empty($item['step6']))
                                                    echo '<li>' . $item['step6'] . '</li>'; 
                                                if(!empty($item['step7']))
                                                    echo '<li>' . $item['step7'] . '</li>';
                                                if(!empty($item['step8']))
                                                    echo '<li>' . $item['step8'] . '</li>';
                                                if(!empty($item['step9']))
                                                    echo '<li>' . $item['step9'] . '</li>';
                                                if(!empty($item['step10']))
                                                    echo '<li>' . $item['step10'] . '</li>';
                                                if(!empty($item['step11']))
                                                    echo '<li>' . $item['step11'] . '</li>';
                                                if(!empty($item['step12']))
                                                    echo '<li>' . $item['step12'] . '</li>';
                                                if(!empty($item['step13']))
                                                    echo '<li>' . $item['step13'] . '</li>';
                                                if(!empty($item['step14']))
                                                    echo '<li>' . $item['step14'] . '</li>';
                                                if(!empty($item['step15']))
                                                    echo '<li>' . $item['step15'] . '</li>';
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