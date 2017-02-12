<!DOCTYPE html>
<html>
  <head>
    <?php
        require "php/cdn.php";
        require "php/database.php";
    ?>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="js/shopscript.js"></script>
<script>
</script>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar static-top navbar-toggleable-md navbar-light bg-faded">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">Oxylus</a>
      <div class="collapse navbar-collapse" id="mainNavbar">
        <div class="navbar-nav">
          <a class="nav-item nav-link" href="index.php">Home</a>
          <a class="nav-item nav-link active" href="storelist.php">Shop</a>
        </div>
      </div>
    </nav>

    <nav class="navbar navbar-toggleable-md navbar-light bg-faded" style="background-color: #E3E3E3;">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#shopNavbar" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle Shop Navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="shopNavbar">
        <div class="navbar-nav">
          <a class="nav-item nav-link" id="basket">Basket</a>
        </div>
      </div>
    </nav>
    <div class="container" style="margin-top: 1em;">
      <div class="row">
    <?php
        $currencyUnit = "£";
        $result = DB::queryFirstRow("SELECT * FROM products WHERE ProductID=%i", $_GET["id"]);
        $price = $currencyUnit.$result["ProductPrice"];
        $stock = "";
        $categories = '<div class="text-left">Categories:<ul>';
        $categoriesArray = explode(",", $result["ProductCategory"]);
        foreach($categoriesArray as $string)
        {
          $categories .= "<li>".$string."</li>";
        }
        $categories .= "</ul></div>";
        if($result["ProductStock"] > 10)
        {
          $stock = '<div class="alert alert-success" roles="alert"><strong>In Stock.</strong></div>';
        }
        else if($result["ProductStock"] > 0)
        {
          $stock = '<div class="alert alert-warning"><strong>Only '.$result["ProductStock"].' in stock.</strong></div>';
        }
        else
        {
          $stock = '<div class="alert alert-danger><strong>Out of Stock.</strong></div>';
        }
        echo '
        <div class="col-md-9">
          <div class="card text-center expanded-product">
            <div class="card-header">
              <ul class="nav nav-pills card-header-pills nav-fill">
                <li class="nav-item">
                  <a class="nav-link active" href="#">Overview</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Reviews</a>
                </li>
                <li class="nav-link">
                  <strong class="nav-link">'.$price.'</strong>
                </li>
              </ul>
            </div>
            <div class="card-block tab-content">
              <div class="tab-pane fade show active" id="tab-overview" role="tabpanel">
                <h4 class="card-title">'.$result["ProductName"].'</h4>
                <p class="card-text">'.$result["ProductDetailedDescription"].'</p>
                '.$categories.'
              </div>
              </div>
              <img class="card-img-bottom img-fluid" src="'.$result["ProductImagePath"].'" alt="'.$result["ProductName"].'">
          </div>
          </div>';
    ?>
    <div class="col-md-3">
      <div class="card text-center">
        <div class="card-header">
          <h5>Purchase</h5>
        </div>
        <div class="card-body">
          <?php
            echo '<strong class="card-text">'.$price.'</strong>'.$stock.'<div class="input-group"><span class="input-group-addon" id="add-quantity'.$result["ProductID"].'" onclick="increaseQuantity('.$result["ProductID"].');">+</span><input type="text" value="1" id="quantity'.$result["ProductID"].'" class="form-control" aria-describedby="add-quantity'.$result["ProductID"].'" style="text-align: center;"><span class="input-group-addon" id="remove-quantity'.$result["ProductID"].'" onclick="decreaseQuantity('.$result["ProductID"].');">-</span>
            <div class="input-group-btn"><button onclick="addToBasket('.$result["ProductID"].');" class="btn btn-primary p-2" style="cursor: pointer;">Add to Basket</button></div></div>';
           ?>
        </div>
    </div>
  </div>
</div>
  </div>
  </body>
</html>
