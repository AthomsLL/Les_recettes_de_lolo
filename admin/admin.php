<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Liste des recettes - Les Recettes de Lolo</title>
        
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
                    <h1><strong class="titre">Liste des recettes</strong><span>   </span><a href="ajouter.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Infos</th>
                                <th>Catégorie</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                                require 'database.php';
                            
                                $db = Database::connect();
                                $statement = $db->query('SELECT recettes.id, recettes.name, recettes.nbrepersonnes, recettes.difficulty, recettes.preptime, recettes.cooktime, recettes.ingr1, recettes.ingr2, recettes.ingr3, recettes.ingr4,                                   recettes.ingr5, recettes.ingr6, recettes.ingr7, recettes.ingr8, recettes.ingr9, recettes.ingr10, recettes.ingr11, recettes.ingr12, recettes.ingr13, recettes.ingr14,                                             recettes.ingr15, categories.name AS category, difficulty.name AS difficulty
                                                         FROM recettes 
                                                         LEFT JOIN categories ON recettes.category = categories.id
                                                         LEFT JOIN difficulty ON recettes.difficulty = difficulty.id
                                                         ORDER BY recettes.id DESC');
                            
                                while($item = $statement->fetch())
                                {
                                    echo '<tr>';
                                    echo '<td>' . $item['name'] . '</td>';
                                    echo '<td width=500>';
                                    echo '<p>Nombre de personnes : ' . $item['nbrepersonnes'] . ', Difficulté : ' . $item['difficulty'] . ', Temps de préparation : ' . $item['preptime'] . ', Temps de cuisson : ' . $item['cooktime'] . 
                                         '</p>';
                                    echo '</td>';
                                    echo '<td>' . $item['category'] . '</td>';
                                    echo '<td class="width=300">';
                                    echo '<a class="btn btn-default" href="voir.php?id=' . $item['id'] . '"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                                    echo ' ';
                                    echo '<a class="btn btn-primary" href="modifier.php?id=' . $item['id'] . '"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                                    echo ' ';
                                    echo '<a class="btn btn-danger" href="supprimer.php?id=' . $item['id'] . '"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            
                                Database::disconnect();
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>    
    </body>
</html>