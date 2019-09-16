<?php 
    require 'database.php';

    if(!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);

        $db = Database::connect();

        $statement = $db->prepare('SELECT recettes.name FROM recettes WHERE recettes.id = ?');
        $statement->execute(array($id));

        $item = $statement->fetch();
        $name = $item['name'];

        Database::disconnect();
    }

    if(!empty($_POST))
    {
        $id = checkInput($_POST['id']);
        
        $db = Database::connect();
        
        $statement = $db->prepare('DELETE FROM recettes WHERE id = ?');
        $statement->execute(array($id));
        
        Database::disconnect();
        
        header('Location: admin.php');
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
        <title>Supprimer une recette - Les Recettes de Lolo</title>
        
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
                    <h1 class="titre"><strong>Supprimer une recette</strong></h1>
                    <br>
                    <form class="form" role="form" action="supprimer.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <p class="alert alert-warning">Etes-vous sûr de vouloir supprimer "<?php echo $name; ?>" ?</p>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-warning">Oui</button>
                            <a class="btn btn-default" href="admin.php">Non</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </body>
</html>