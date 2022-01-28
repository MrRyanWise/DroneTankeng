<!DOCTYPE html>
<html>
<head>
    <title> Burger code RYAN TANKENG </title>
    <meta charset="utf-8">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Holtwood+One+SC">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
     
    <div class="container site">
            <?php
           require 'database/database.php';
           echo '<nav class="navbar navbar-default   navbar-dark bg-dark">
                      <ul class="nav nav-pills ">
                      <li class="nav-link" role ="presentation" ><a href="#">BurgerCode</a></li>';
                     
        $db = Database::connect();
        $statement = $db->query('SELECT * FROM categories');
        $categories = $statement->fetchAll();
        foreach($categories as  $category)
        {
                if($category['id'] == '1')
                   echo '<li role ="presentation" class=" nav-link active"><a href="#'. $category['id'] . ' " data-toggle="tab">'. $category['name']. '</a></li>';
                else
                   echo '<li role ="presentation" class="nav-link"><a href="#'.$category['id'].'" data-toggle="tab">'.$category['name'].'</a></li>'; 
        }
        echo '</ul>
                </nav>';
        echo '<div class="tab-content">';
        foreach($categories as  $category)
        {
                if($category['id'] == '1')
                   echo ' <div class="tab-pane active" id="' . $category['id'] . '">';
                else
                echo ' <div class="tab-pane" id="' . $category['id'] . '">';

        echo  '<div class="row">';
        $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
        $statement->execute(array($category['id']));

        while($item = $statement->fetch())
        {
                echo '<div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                           <img src="images/'. $item['image'] . '" alt="...">
                           <div class="price">'. number_format($item['price'], 2, '.', '').' €</div>
                           <div class="caption">
                                <h4>'. $item['name'] .'</h4>
                                <p>'. $item['description'] .'</p>
                                <a href="database/view.php?id='.$item['id'].'" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span>Commander</a>
                             </div>
                        </div>
                       </div> '; 
        }
        echo '</div>
                </div> ';
        }
        Database::disconnect();
        echo '</div>';
        ?>
        
    </div>
</body>
</html>