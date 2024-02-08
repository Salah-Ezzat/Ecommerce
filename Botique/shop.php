<?php
session_start();
include "../includes/botique_nav.php";
if(isset($_GET['alert'])){
  echo"
  <div class='alert alert-danger' role='alert'>
  <h4 class='alert-heading'>Attension!</h4>
  <p>Sorry, You should firstly choose a product before forwared to <span class='text-danger' style= 'font-weight: bold'>Product detail</span> page.</p>
  <hr>
  <p class='mb-0'>Click on one product from the products shown below.</p>
  <a type='button' class= 'btn btn-danger' href='shop.php'>OK</a>
</div>

  ";
  
};

?>


      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Shop</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <div class="container p-0">
            <div class="row">
              <!-- SHOP SIDEBAR-->
              <div class="col-lg-3 order-2 order-lg-1">
                <h5 class="text-uppercase mb-4">Categories</h5>
                <!-- <div class="py-2 px-4 bg-dark text-white mb-3"><strong class="small text-uppercase font-weight-bold">Fashion &amp; Acc</strong></div> -->
                <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                  <?php
                  
                  $selectCat= "SELECT * FROM categories";
                  $queryCat= $conn->query($selectCat);
                  if($queryCat){
                    foreach($queryCat as $Cat){
                      $category= $Cat['category'];
                      $cat_id= $Cat['id'];
                      echo "<li class='mb-2'><a class='reset-anchor' href='?cat_id=$cat_id'>$category</a></li>";

                    };
                  };
                
                  ?>
                 
                </ul>
               

                
              </div>
              <!-- SHOP LISTING-->
              <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
                <div class="row mb-3 align-items-center">
                  <div class="col-lg-6 mb-2 mb-lg-0">
                    <?php
                      if(isset($_GET['cat_id'])){
                        $cat_id=$_GET['cat_id'];
                        $select= "SELECT * FROM products WHERE cat_id= '$cat_id' ";
                      }elseif(isset($_GET['search'])){
                        $search=$_GET['search'];
                        $select= "SELECT * FROM products WHERE `product`LIKE '%$search%' ";

                      }else{     
                       $select= "SELECT * FROM products";
                      };     
                       $query= $conn->query($select);
                       $count= $query->num_rows;
                       
                       $pageNum=ceil($count/3);
                       if(!isset($_GET['page']) || $_GET['page']==0 || $pageNum==1){
                        $N=0;
                      }else{
                     $N=($_GET['page']-1)*3; 
                      };
                   
                    ?>
                    <?php
                    if ($count==0){
                      echo "<p class=\"text-medium text-danger mb-0\">There is no product matches this item </p>";

                    }elseif($count<($N+3)){
                      $N1=$N+1;
                      $N3=$N+3;
                     echo "<p class=\"text-small text-muted mb-0\">Showing $N1-$count of $count results</p>";

                    }else{
                      $N1=$N+1;
                      $N3=$N+3;
                      echo "<p class=\"text-small text-muted mb-0\">Showing  $N1-$N3 of $count results</p>";

                    }
                    ?>
                    
                  </div>
                  <div class="col-lg-6">
                    <ul class="list-inline d-flex align-items-center justify-content-lg-end mb-0">
                      <li class="list-inline-item text-muted mr-3"><a class="reset-anchor p-0" href="#"><i class="fas fa-th-large"></i></a></li>
                      <li class="list-inline-item text-muted mr-3"><a class="reset-anchor p-0" href="#"><i class="fas fa-th"></i></a></li>
                      <li class="list-inline-item">
                        <form class="myform" method="GET" action="">
                        <select class="selectpicker ml-auto" onchange="document.querySelector('.myform').submit()" id="selectSort" name="sorting" data-width="200" data-style="bs-select-form-control" data-title="Default sorting">
                          <option value="default">Default sorting</option>
                          <option value="popularity">Popularity</option>
                          <option value="low">Price: Low to High</option>
                          <option value="high">Price: High to Low</option>
                        </select>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <!-- PRODUCT-->
                  <?php
                      if(isset($_GET['cat_id'])){
                      $cat_id=$_GET['cat_id'];
                      $select= "SELECT * FROM products WHERE cat_id= '$cat_id' LIMIT 3 OFFSET $N ";
                                            
                    }elseif(isset($_GET['search'])){
                        $search=$_GET['search'];
                        $select= "SELECT * FROM products WHERE `product`LIKE '%$search%' LIMIT 3 OFFSET $N";

                      }elseif(isset($_GET['sorting'])){
                        if($_GET['sorting']== 'low'){
                        $select= "SELECT * FROM products ORDER BY price ASC LIMIT 3 OFFSET $N";   
                        }elseif($_GET['sorting']== 'high'){
                          $select= "SELECT * FROM products ORDER BY price DESC LIMIT 3 OFFSET $N";   
                        }elseif($_GET['sorting']== 'popularity'){
                          $select= "SELECT * FROM products ORDER BY price DESC LIMIT 3 OFFSET $N";   
                        }  
                      }else{
                        $select= "SELECT * FROM products LIMIT 3 OFFSET $N";
                      };          
                      $query= $conn->query($select);
                      if($query){
                      foreach($query as $product){
                        $name= $product['product'];
                        $price= $product['price'];
                        $pro_id= $product['id'];
                      $selectimg= "SELECT image FROM images WHERE product_id= $pro_id";
                      $queryimg= $conn->query($selectimg);
                      if($queryimg){
                        $result= $queryimg->fetch_assoc();
                        
                      if($result){
                        $image= $result['image'];
                        
                      }else{
                        $image="No_Image.png";
                      }
                      
                      
                      };
                  
                    ?>
                  <div class="col-lg-4 col-sm-6">
                    <div class="product text-center">
                      <div class="mb-3 position-relative">
                        <div class="badge text-white badge-"></div><a class="d-block" href="detail.php?pro_id=<?=$pro_id?>"><img class="img-fluid w-100" src="../images/<?=$image?>" alt="..."></a>
                        <div class="product-overlay">
                          <ul class="mb-0 list-inline">
                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark"
                            <?php
                                if(isset($_SESSION['id'])){
                                  $user=$_SESSION['id'];
                                  echo"href='cart.php?user_id=$user&pro_id=$pro_id'";
                                }else { 
                                  echo "href='cart.php'";
                                }
                                ?>
                                  >Add to cart</a></li>
                            <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
                          </ul>
                        </div>
                      </div>
                      <h6> <a class="reset-anchor" href="detail.php?pro_id=<?=$pro_id?>"><?=$name?></a></h6>
                      <p class="small text-muted">$<?=$price?></p>
                    </div>
                  </div>
                  <?php
                     };

                    }else{
                     echo $conn->error;
                    }
 
                  ?>

                  

                </div> 
                <!-- PAGINATION-->
              <?php
                if(isset($_GET['page'])){
                  if (($_GET['page'])>1 && ($_GET['page'])< $pageNum ){
                    $prvious=($_GET['page']-1);
                    $next=($_GET['page']+1);
                  }elseif(($_GET['page'])==1){
                    $prvious=1;
                    $next=($_GET['page']+1);
                  }elseif(($_GET['page'])== $pageNum){
                    $prvious=($_GET['page']-1);
                    $next=$pageNum;
                  }elseif(($_GET['page'])<1){
                    $prvious=1;
                    $next=1 ;
                  }elseif(($_GET['page'])> $pageNum){
                    $prvious=$pageNum;
                    $next=$pageNum;

                  }elseif($pageNum==1){
                    $prvious=1;
                    $next=1;

                  };

                }else{
                  $prvious=1;
                  $next=2;
                };
                if(isset($_GET['cat_id'])){
                  $cat_id=$_GET['cat_id'];

              ?>
                  <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center justify-content-lg-end">
                    <li class="page-item"><a class="page-link" href="?cat_id=<?=$cat_id?>&page=<?=$prvious?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                    <?php
                    
                    function active(){
                      if($page==$i){
                        echo "active";
                      };
                    }
                    for($i=1; $i<= $pageNum; $i++){
                      echo "<li class='page-item active()'><a class='page-link' href='?cat_id=$cat_id&page=$i'>$i</a></li>";
                    };
                  

                    ?>
                    
                    <li class="page-item"><a class="page-link" href="?cat_id=<?=$cat_id?>&page=<?=$next?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                    <?php 
                    }elseif(isset($_GET['search'])){
                      
                      ?>
                      <nav aria-label="Page navigation example">
                      <ul class="pagination justify-content-center justify-content-lg-end">
                        <li class="page-item"><a class="page-link" href="?page=<?=$prvious?>&search=<?=$search?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                        <?php
                        
                        function active(){
                          if($page==$i){
                            echo "active";
                          };
                        }
                        for($i=1; $i<= $pageNum; $i++){
                          echo "<li class='page-item active()'><a class='page-link' href='?page=$i&search=$search'>$i</a></li>";
                        };
                       ?>
    
                        
                        
                        <li class="page-item"><a class="page-link" href="?page=<?=$next?>&search=<?=$search?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                   <?php
                    }elseif(isset($_GET['sorting'])){
                      $sorting=$_GET['sorting'];

                    ?>
                    <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center justify-content-lg-end">
                      <li class="page-item"><a class="page-link" href="?page=<?=$prvious?>&sorting=<?=$sorting?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                      <?php
                      
                      function active(){
                        if($page==$i){
                          echo "active";
                        };
                      }
                      for($i=1; $i<= $pageNum; $i++){
                        echo "<li class='page-item active()'><a class='page-link' href='?page=$i&sorting=$sorting'>$i</a></li>";
                      };
                      ?>

                      
                      
                      <li class="page-item"><a class="page-link" href="?page=<?=$next?>&sorting=<?=$sorting?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                      <?php
                       }else{
                      ?>
                      <nav aria-label="Page navigation example">
                      <ul class="pagination justify-content-center justify-content-lg-end">
                        <li class="page-item"><a class="page-link" href="?page=<?=$prvious?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                        <?php
                        
                        function active(){
                          if($page==$i){
                            echo "active";
                          };
                        }
                        for($i=1; $i<= $pageNum; $i++){
                          echo "<li class='page-item active()'><a class='page-link' href='?page=$i'>$i</a></li>";
                        };
                       ?>
    
                        
                        
                        <li class="page-item"><a class="page-link" href="?page=<?=$next?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                   <?php }?>
                   

                    
                    
                    
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </section>
      </div>
      <footer class="bg-dark text-white">
        <div class="container py-4">
          <div class="row py-5">
            <div class="col-md-4 mb-3 mb-md-0">
              <h6 class="text-uppercase mb-3">Customer services</h6>
              <ul class="list-unstyled mb-0">
                <li><a class="footer-link" href="#">Help &amp; Contact Us</a></li>
                <li><a class="footer-link" href="#">Returns &amp; Refunds</a></li>
                <li><a class="footer-link" href="#">Online Stores</a></li>
                <li><a class="footer-link" href="#">Terms &amp; Conditions</a></li>
              </ul>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
              <h6 class="text-uppercase mb-3">Company</h6>
              <ul class="list-unstyled mb-0">
                <li><a class="footer-link" href="#">What We Do</a></li>
                <li><a class="footer-link" href="#">Available Services</a></li>
                <li><a class="footer-link" href="#">Latest Posts</a></li>
                <li><a class="footer-link" href="#">FAQs</a></li>
              </ul>
            </div>
            <div class="col-md-4">
              <h6 class="text-uppercase mb-3">Social media</h6>
              <ul class="list-unstyled mb-0">
                <li><a class="footer-link" href="#">Twitter</a></li>
                <li><a class="footer-link" href="#">Instagram</a></li>
                <li><a class="footer-link" href="#">Tumblr</a></li>
                <li><a class="footer-link" href="#">Pinterest</a></li>
              </ul>
            </div>
          </div>
          <div class="border-top pt-4" style="border-color: #1d1d1d !important">
            <div class="row">
              <div class="col-lg-6">
                <p class="small text-muted mb-0">&copy; 2020 All rights reserved.</p>
              </div>
              <div class="col-lg-6 text-lg-right">
                <p class="small text-muted mb-0">Template designed by <a class="text-white reset-anchor" href="https://bootstraptemple.com/p/bootstrap-ecommerce">Bootstrap Temple</a></p>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <!-- JavaScript files-->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="vendor/lightbox2/js/lightbox.min.js"></script>
      <script src="vendor/nouislider/nouislider.min.js"></script>
      <script src="vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
      <script src="vendor/owl.carousel2/owl.carousel.min.js"></script>
      <script src="vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
      <script src="js/front.js"></script>
      <!-- Nouislider Config-->
      <script>
        var range = document.getElementById('range');
        noUiSlider.create(range, {
            range: {
                'min': 0,
                'max': 2000
            },
            step: 5,
            start: [100, 1000],
            margin: 300,
            connect: true,
            direction: 'ltr',
            orientation: 'horizontal',
            behaviour: 'tap-drag',
            tooltips: true,
            format: {
              to: function ( value ) {
                return '$' + value;
              },
              from: function ( value ) {
                return value.replace('', '');
              }
            }
        });
        
      </script>
      <script>
        // ------------------------------------------------------- //
        //   Inject SVG Sprite - 
        //   see more here 
        //   https://css-tricks.com/ajaxing-svg-sprite/
        // ------------------------------------------------------ //
        function injectSvgSprite(path) {
        
            var ajax = new XMLHttpRequest();
            ajax.open("GET", path, true);
            ajax.send();
            ajax.onload = function(e) {
            var div = document.createElement("div");
            div.className = 'd-none';
            div.innerHTML = ajax.responseText;
            document.body.insertBefore(div, document.body.childNodes[0]);
            }
        }
        // this is set to BootstrapTemple website as you cannot 
        // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
        // while using file:// protocol
        // pls don't forget to change to your domain :)
        injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
    
        
      </script>
      <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </div>
  </body>
</html>