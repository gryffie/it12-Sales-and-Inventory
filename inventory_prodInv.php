<?php
  include 'mod_function.php';

  $sql = "";
  $errorMessage = "";

  try{
    if(isset($_POST['search'])){
      $searchQuery = clean_input($_POST["search_input"]);
      if(!empty($searchQuery)){
        $sql = "SELECT * FROM product WHERE prodname LIKE '%$searchQuery%' OR prodid LIKE '%$searchQuery%' OR catid LIKE '%$searchQuery%' OR price LIKE '%$searchQuery%' OR status LIKE '%$searchQuery%'";
      }else{
        $sql = "SELECT * FROM product";
      }
    }else{
      $sql = "SELECT * FROM product";
    }
  }catch(Exception $e){
    echo 'Message: ' .$e->getMessage();
  }
?>

<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<title> Responsive Sidebar Menu  | CodingLab </title>-->
    <link rel="stylesheet" href="css/navStyle.css?rnd=132">
    <link rel="stylesheet" href="css/compStyle.css?rnd=132">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap CDN Link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   </head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus icon'></i>
        <div class="logo_name">Inventory</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="inventory_dash.html">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
     <li>
        <a href="inventory_order.html">
          <i class='bx bx-cart-alt' ></i>
          <span class="links_name">Order</span>
        </a>
        <span class="tooltip">Order</span>
      </li>
     <li>
       <a href="inventory_prodInv.php">
         <i class='bx bx-pie-chart-alt-2' ></i>
         <span class="links_name">Inventory</span>
       </a>
       <span class="tooltip">Inventory</span>
     </li>
     <li>
       <a href="#">
         <i class='bx bx-folder' ></i>
         <span class="links_name">Purchase Orders</span>
       </a>
       <span class="tooltip">Purchase</span>
     </li>
     <li class="profile">
         <div class="profile-details">
           <div class="name_job">
             <div class="name">Arhiel Griffin Arles</div>
             <div class="job">Web designer</div>
           </div>
         </div>
         <i class='bx bx-log-out' id="log_out" ></i>
     </li>
    </ul>
  </div>

  <section class="home-section">
    <div class="title">
      <h1 class="">Product Inventory</h1>
    </div>
    
    <form method="POST" action="inventory_prodInv.php">
    <div class="top-filter">
        <div class="item-count">
          <h3>182 items</h3>
        </div>
        <div class="rows">
          <div class="search">
            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2" name="search_input">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2" name="search"><i class="bx bx-search"></i></button>
          </div>
          <div class="def-btn"><a class="btn" href="" type="submit"><i class="bx bx-plus-circle"></i> Add Product</a></div>
        </div>
    </div>
    </form>

    <div class="table-responsive">
      <?php
        //Retreive all data from product table
        $res = retrieve_data($sql);
      ?>
      <table class="table table-hover def-table">
        <tr>
          <th>Prod Id</th>
          <th>Name</th>
          <th>Category</th>
          <th>Price per Unit</th>
          <th>Status</th>
          <th>In Stock</th>
          <th>Quantity</th>
          <th>Action</th>
        </tr>

        <?php
          //If product table is not empty
          if($res->num_rows > 0){
            while($rows = $res->fetch_assoc()){ ?>
              <tr>
                  <td><p><?php echo $rows['prodid']?></p></td>
                  <td><p><?php echo $rows['prodname']?></p></td>
                  <td><p><?php echo $rows['catid']?></p></td>
                  <td><p><?php echo $rows['price']?></p></td>
                  <td><p><?php echo $rows['status']?></p></td>
                  <td><p><?php echo $rows['instock']?></p></td>
                  <td><p><?php echo $rows['quantity']?></p></td>
                  <td>
                    <a href="#">Edit</a>
                    <a href="#">Delete</a>
                  </td>
              </tr>
        <?php }
          }else{
            $errorMessage = "No records found.";
          }
        ?>
      </table>
    </div>
    <div class="container">
      <p class="err"><?php echo $errorMessage;?></p>
    </div>

  </section>

  <script src="js/navScript.js"></script>
</body>
</html>