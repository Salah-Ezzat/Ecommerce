<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location:../user_login.php");
  exit;
};
if (!isset($_GET['pro_id'])){
  header("location:shop.php?alert=alert");
  exit;
};
if(isset($_GET['alert'])){
  echo"
  <div class='alert alert-danger' role='alert'>
  <h4 class='alert-heading'>Attension!</h4>
  <p>Sorry, You should click the button<span class='text-danger' style= 'font-weight: bold'>Procceed to ckeckout</span> to be forwared to <span class='text-danger' style= 'font-weight: bold'>Ckeckout</span> page.</p>
  <hr>
  <p class='mb-0'>Click on the button<span class='text-danger' style= 'font-weight: bold'>Procceed to ckeckout</span> to be forwared to <span class='text-danger' style= 'font-weight: bold'>Ckeckout</span> below.</p>
  <a type='button' class= 'btn btn-danger' href='cart.php'>OK</a>
</div>

  ";
  
}
include "../includes/botique_nav.php";

  $pro_id= $_GET['pro_id'];
  $select= "SELECT * FROM products WHERE id=$pro_id";
 $query= $conn->query($select);
 if($query){
     $product= $query->fetch_assoc();
     $name        = $product['product'];
     $price       = $product['price'];
     $description= $product['description'];
     $pro_id         = $product['id'];
    

 }else{
  echo $conn->error;
 }

?>
      <section class="py-5">
        <div class="container">
          <div class="row mb-5">
            <div class="col-lg-6">
              <!-- PRODUCT SLIDER-->
              <div class="row m-sm-0">
                <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0">
                  <div class="owl-thumbs d-flex flex-row flex-sm-column" data-slider-id="1">
                    <?php

                    $selectimg= "SELECT * FROM images WHERE product_id=$pro_id ";

                    $queryimg= $conn->query($selectimg);

                    if($queryimg){

                      $imgs=[];
                      foreach($queryimg as $image){
                       $img= $image['image'];             
                      
                        $imgs[]= "$img";
                        
                        echo "<div class=\"owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0\"><img class=\"w-100\" src=\"../images/$img\" alt=\"No Available Image\"></div>";

                      };
                  
                    
                      
                    }else {echo $conn->error;};
                  
                  
                    ?>

                  </div>
                </div>
                <div class="col-sm-10 order-1 order-sm-2">
                  
                  <div class="owl-carousel product-slider" data-slider-id="1">
                   <?php
                              
                  // };
                  $item=0;
                  foreach($imgs as $oneImg){
                   $item++;
                   echo "<a class='d-block' href='../images/$oneImg' data-lightbox='product' title='$name item $item'><img class='img-fluid' src='../images/$oneImg' alt='...'></a>";
                  };    
               
                   ?>
                    
                    </div> 
                </div>
              </div>
            </div>
            <!-- PRODUCT DETAILS-->
            <div class="col-lg-6">
              <ul class="list-inline mb-2">
                <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
              </ul>
              <h1><?=$name?></h1>
              <p class="text-muted lead">$<?=$price?></p>
              <p class="text-small mb-4"><?=$description?></p>
              <div class="row align-items-stretch mb-4">
                <div class="col-sm-5 pr-sm-0">
                  <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                  <form method= "POST" action='../functions/cart_insert.php?pro_id=<?=$pro_id?>'>
                    <div class="quantity">
                      <a type= "button" class="dec-btn p-0"><i class="fas fa-caret-left"></i></a>
                      
                      <input  name= "quantity" class="form-control border-0 shadow-0 p-0" type="text" value="1">
                      <a type= "button" class="inc-btn p-0"><i class="fas fa-caret-right"></i></a>
                    </div>
                  </div>zzz
                </div>
                <div class="col-sm-3 pl-sm-0"><button type="submit" class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" >Add to cart</button></div>
                
              </div><a class="btn btn-link text-dark p-0 mb-4" href="#"><i class="far fa-heart mr-2"></i>Add to wish list</a><br>
                </form>

            </div>
          </div>
          <!-- DETAILS TABS-->
          <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a></li>
            <li class="nav-item"><a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a></li>
            <?php
            if(isset($_SESSION['id'])){
              $user_id= $_SESSION['id'];
              echo "<li class=\"nav-item\"><a class=\"nav-link\" id=\"addReview-tab\" data-toggle=\"tab\" href=\"#addReview\" role=\"tab\" aria-controls=\"addReview\" aria-selected=\"false\">Add Review</a></li>";
            }
            ?>
          </ul>
          <div class="tab-content mb-5" id="myTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
              <div class="p-4 p-lg-5 bg-white">
                <h6 class="text-uppercase">Product description </h6>
                <p class="text-muted text-small mb-0"><?=$description?></p>
              </div>
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
              <div class="p-4 p-lg-5 bg-white">
                <div class="row">
                  <div class="col-lg-8">
                    <?php
                     $select= "SELECT * FROM reviews WHERE product_id= '$pro_id'";
                     $query= $conn->query($select);
                     if($query){
                      foreach ($query as $review){
                     $reviewId= $review['id'];
                     $date= $review['time'];
                     $rating= $review['rating'];
                     $reviewtxt= $review['review'];
                    ?>
                    <div class="media mb-3"><img class="rounded-circle" src="img/customer-1.png" alt="" width="50">
                      <div class="media-body ml-3">
                        <?php
                        $selectuser="SELECT username FROM users WHERE id= '$reviewId'";
                        $queryuser= $conn->query($selectuser);
                        if ($queryuser){
                          foreach($queryuser as $user){
                           $username= $user['username'];
                          }
                        }
                        ?>
                        <h6 class="mb-0 text-uppercase"><?=$username?></h6>
                        <p class="small text-muted mb-0 text-uppercase"><?=$date?></p>
                        <ul class="list-inline mb-1 text-xs">
                          <?php
                          for ($i=0 ; $i< $rating ; $i++){
                            echo "<li class=\"list-inline-item m-0\"><i class=\"fas fa-star text-warning\"></i></li>";
                          }
                          ?>
                         
                        </ul>
                        <p class="text-small mb-0 text-muted"><?=$reviewtxt?></p>
                      </div>
                    </div>
                    <?php
                      };
                    };
                    ?>
                    <div class="media"><img class="rounded-circle" src="img/customer-2.png" alt="" width="50">
                      <div class="media-body ml-3">
                        <h6 class="mb-0 text-uppercase">Jason Doe</h6>
                        <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                        <ul class="list-inline mb-1 text-xs">
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                          <li class="list-inline-item m-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                        </ul>
                        <p class="text-small mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="addReview" role="tabpanel" aria-labelledby="reviews-tab">
              <div class="p-4 p-lg-5 bg-white">
                <div class="row">
                  <div class="col-lg-8">
                    
                  <form method="post" action="../functions/review_insert.php">
                    <div class="form-group">
                     
                      <input type="hidden" name="user_id" class="form-control" id="exampleFormControlInput1" value="<?=$user_id?>">
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="product_id" class="form-control" id="exampleFormControlInput2" value="<?=$pro_id?>">
                    </div>
                    <div class="form-group">                   
                      <input type="hidden" name="date" class="form-control" id="exampleFormControlInput3" value="<?= date ('Y.M.d')?>">
                    </div>                  
                     <div class="form-group">
                      <label for="exampleFormControlSelect1">Product Rating</label>
                      <select name= "rating" class="form-control" id="exampleFormControlSelect1">
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="2">2 Stars</option>
                        <option value="1">1 Star</option>
                      </select>
                      
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Add your product review</label>
                      <textarea name= "review" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- RELATED PRODUCTS-->
          <h2 class="h5 text-uppercase mb-4">Related products</h2>
          <div class="row">
            <!-- PRODUCT-->
            <div class="col-lg-3 col-sm-6">
              <div class="product text-center skel-loader">
                <div class="d-block mb-3 position-relative"><a class="d-block" href="detail.php"><img class="img-fluid w-100" src="img/product-1.jpg" alt="..."></a>
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="#">Add to cart</a></li>
                      <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
                    </ul>
                  </div>
                </div>
                <h6> <a class="reset-anchor" href="detail.php">Kui Ye Chen’s AirPods</a></h6>
                <p class="small text-muted">$<?=$price?></p>
              </div>
            </div>
            <!-- PRODUCT-->
            <div class="col-lg-3 col-sm-6">
              <div class="product text-center skel-loader">
                <div class="d-block mb-3 position-relative"><a class="d-block" href="detail.php"><img class="img-fluid w-100" src="img/product-2.jpg" alt="..."></a>
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="#">Add to cart</a></li>
                      <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
                    </ul>
                  </div>
                </div>
                <h6> <a class="reset-anchor" href="detail.php">Air Jordan 12 gym red</a></h6>
                <p class="small text-muted">$300</p>
              </div>
            </div>
            <!-- PRODUCT-->
            <div class="col-lg-3 col-sm-6">
              <div class="product text-center skel-loader">
                <div class="d-block mb-3 position-relative"><a class="d-block" href="detail.php"><img class="img-fluid w-100" src="img/product-3.jpg" alt="..."></a>
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="#">Add to cart</a></li>
                      <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
                    </ul>
                  </div>
                </div>
                <h6> <a class="reset-anchor" href="detail.php">Cyan cotton t-shirt</a></h6>
                <p class="small text-muted">$25</p>
              </div>
            </div>
            <!-- PRODUCT-->
            <div class="col-lg-3 col-sm-6">
              <div class="product text-center skel-loader">
                <div class="d-block mb-3 position-relative"><a class="d-block" href="detail.php"><img class="img-fluid w-100" src="img/product-4.jpg" alt="..."></a>
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="#">Add to cart</a></li>
                      <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
                    </ul>
                  </div>
                </div>
                <h6> <a class="reset-anchor" href="detail.php">Timex Unisex Originals</a></h6>
                <p class="small text-muted">$351</p>
              </div>
            </div>
          </div>
        </div>
      </section>
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