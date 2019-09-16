<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Les Recettes de Lolo</title>
        
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
        
        <!-- css -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href="css/style.css" rel="stylesheet">
        
        <!-- fonts -->
        <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet">
        
        <!-- meta SEO -->
        <meta name="description" content="Site de recettes de cuisine familiale délicieuses">
        <meta name="keywords" content="cuisine, cook, recettes, plats, desserts">
        
    </head>
    
    <body data-spy="scroll" data-target=".navbar" data-offset="60">
        
        <?php 
            require 'admin/database.php';
        
            echo '<header class="header container">
                     <nav class="header-menu navbar navbar-default navbar-fixed-top">
                        <div class="navbar-header">
                            <button type="button" class="header-btn navbar-toggle" data-toggle="collapse" data-target="#monMenu">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="header-navbar-collapse collapse navbar-collapse" id="monMenu">
                            <ul class="header-navbar-nav nav navbar-nav">';
            
            $db = Database::connect();
        
            $statement = $db->query('SELECT * FROM categories');
            $categories = $statement->fetchAll();
        
            foreach($categories as $category)
            {
                echo '<li><a class="header-menu-item" href="#' . $category['name'] . '">' . $category['name'] . '</a></li>';    
            }
            
            echo           '</ul>
                        </div>
                     </nav>
                 </header>';
        
            echo '<div class="banner container">
                    <div class="banner-img"></div>
                    <div class="banner-inner-banner">
                        <h1 class="banner-title"> Les Recettes de Lolo </h1>
                    </div>
                </div>';
        
           foreach($categories as $category)
           {
                if(($category['id'] == 1) || ($category['id'] == 3))
                {
                    echo '<section class="white-background" id="' . $category['name'] . '">
                            <div class="orange-divider"></div>';
                }
                else 
                {
                    echo '<section class="orange-background" id="' . $category['name'] . '">
                            <div class="black-divider"></div>';
                }
                
                echo '<div class="heading">
                        <h2 class="heading-title">' . $category['name'] . '</h2>
                      </div>
                      <div class="container">';
                
                echo '<div class="row">';
               
                $statement = $db->prepare('SELECT * FROM recettes WHERE recettes.category = ?');
                $statement->execute(array($category['id']));
               
                while($item = $statement->fetch())
                {
                    echo '<div class="col-xs-12 col-sm-6 col-md-4">
                            <article class="thumbnail">
                                <img src="images/' . $item['image'] . '" alt="...">
                                <div class="caption">
                                    <h2 class="caption-title">' . $item['name'] . '</h2>
                                    <a class="caption-btn btn btn-default btn-lg" href="recette.php?id=' . $item['id'] . '" target="_blank" role="button">La recette</a>
                                </div>
                            </article>
                        </div>';    
                }
               
                echo '</div>';
                echo '</div>';
                echo '</section>';
           } 
        
           Database::disconnect();
            
        ?>
        
        <!-- FOOTER -->
        
        <footer class="footer container">
        
        </footer>
        
        <!-- FOOTER -->
        
    </body>
</html>