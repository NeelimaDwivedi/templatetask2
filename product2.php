<?php include 'header.php'; ?>
<?php include 'config.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Fashion</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>
          <li class="active">Women</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
                <form action="" class="aa-sort-form">
                  <label for="">Sort by</label>
                  <select name="">
                    <option value="1" selected="Default">Default</option>
                    <option value="2">Name</option>
                    <option value="3">Price</option>
                    <option value="4">Date</option>
                  </select>
                </form>
                <form action="" class="aa-show-form">
                  <label for="">Show</label>
                  <select name="">
                    <option value="1" selected="12">12</option>
                    <option value="2">24</option>
                    <option value="3">36</option>
                  </select>
                </form>
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>
            <div class="aa-product-catg-body">
              <ul class="aa-product-catg">
                <!-- start single product item -->
                <?php
                    $sql = "SELECT * FROM products LIMIT 20,10";
                    $result = $conn->query($sql);
                ?>
                <?php
                while ($row = $result->fetch_assoc())
                {
                echo '<li>';
                  echo '<figure>';
                  echo '<a class="aa-product-img" href="#"><img src="'.$row['pimage'].'" alt="polo shirt img"></a>' ;
                    echo "<a class='aa-add-card-btn' data-productid='$row[pid]'  href='#'><span class='fa fa-shopping-cart'  ></span>Add To Cart</a>" ;
                    echo '<figcaption>';
                      echo '<h4 class="aa-product-title"><a href="#">'.$row['pname'].'</a></h4>' ;
                       /*'<span class="aa-product-price">$45.50</span>*/echo '<span class="aa-product-price">$'.$row['pprice'].'</span>' ;
                      echo '<p class="aa-product-descrip">'.$row['description'].'</p>' ;
                    echo '</figcaption>';
                  echo '</figure>';
                  echo '<div class="aa-product-hvr-content">';

                    echo "<a href='#' data-toggle2='tooltip' data-placement='top' title='Quick View' data-toggle='modal' data-target='#quick-view-modal'><span data-productid='".$row['pid']."' class='fa fa-search'></span></a>" ;
                  echo '</div>';
                 // echo '<span class="aa-badge aa-sale" href="#">SALE!</span>';
                echo '</li>';
                }
                ?>
                <!-----add-to-cart-ajax-method---->
                <script>
                $(document).ready(function(){
                    $('.aa-add-card-btn').click(function(){
                        var id=$(this).data('productid');
                        console.log('clicked'+id);
                        $.ajax({
                            method: "POST",
                            url: "ajax.php",
                            data: { productid:id, action:'add'},
                            dataType:"json"
                        })
                            .done(function( msg ) {
                                  alert("Product added to the cart.");
                            });

                    });

                });
              </script>

              </ul>
              <!-- quick view modal -->
              <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <div class="row">
                        <!-- Modal view slider -->
                        <script>
                          $(document).ready(function(){
                              $('.fa-search').click(function(){
                                  var id=$(this).data('productid');
                                  console.log('clicked'+id);
                                  $.ajax({
                                      method: "POST",
                                      url: "ajax.php",
                                      data: { productid:id, action:'add'},
                                      dataType:"json"
                                  })
                                      .done(function( msg ) {
                                            console.log('done');
                                      });
                              });
                          });
                        </script>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-slider">
                            <div class="simpleLens-gallery-container" id="demo-1">
                              <div class="simpleLens-container">
                                  <div class="simpleLens-big-image-container">
                                      <a class="simpleLens-lens-image" data-lens-image="img/view-slider/large/polo-shirt-1.png">
                                          <img src="<?php echo $_SESSION['productpop']['pimage']; ?>" class="simpleLens-big-image">
                                      </a>
                                  </div>
                              </div>
                                <!--<div class="simpleLens-thumbnails-container">
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-1.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                                  </a>
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-3.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-3.png">
                                  </a>

                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-4.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-4.png">
                                  </a>
                              </div>-->
                            </div>
                          </div>
                        </div>
                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3><?php echo $_SESSION['productpop']['pname']; ?></h3>
                            <div class="aa-price-block">
                              <span class="aa-product-view-price"><?php echo '$'. $_SESSION['productpop']['pprice']; ?></span>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
                            <p><?php echo $_SESSION['productpop']['pdescription']; ?></p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                              <a href="#">S</a>
                              <a href="#">M</a>
                              <a href="#">L</a>
                              <a href="#">XL</a>
                            </div>
                            <div class="aa-prod-quantity">
                              <form action="">
                                <select name="" id="">
                                  <option value="0" selected="1">1</option>
                                  <option value="1">2</option>
                                  <option value="2">3</option>
                                  <option value="3">4</option>
                                  <option value="4">5</option>
                                  <option value="5">6</option>
                                </select>
                              </form>
                              <p class="aa-prod-category">
                                Category: <a href="#"><?php echo $_SESSION['productpop']['pcategory']; ?></a>
                              </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                              <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <a href="#" class="aa-add-to-cart-btn">View Details</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div>
              <!-- / quick view modal -->
            </div>
            <div class="aa-product-catg-pagination">
              <nav>
                <ul class="pagination">
                  <li>
                    <a href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li><a href="product.php">1</a></li>
                  <li><a href="product1.php">2</a></li>
                  <li><a href="product2.php">3</a></li>
                  <li><a href="product3.php">4</a></li>
                  <li><a href="#">5</a></li>
                  <li>
                    <a href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Category</h3>
              <?php
                  $sql = "SELECT * FROM category";
                  $result = $conn->query($sql);
              ?>
              <ul class="aa-catg-nav">
              <?php
                  while ($row = $result->fetch_assoc()) {
                    echo "<li><a href='category.php?cname=$row[categoryname]'>".$row['categoryname']."</a></li>" ;
                  }
              ?>
            </ul>

            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Tags</h3>
              <?php
                 //$sql1 = "SELECT t.tagname as tags, p.tag as products FROM tags t, products p " ;
                  $sql="SELECT * from tags";
                  $result = $conn->query($sql);
              ?>
              <div class="tag-cloud">
              <?php
                  while ($row = $result->fetch_assoc()) {
                    echo "<a href='tag.php?tname=$row[tagname]'>".$row['tagname']."</a>" ;
                  }
                ?>
              </div>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Price</h3>
              <!-- price range -->
              <div class="aa-sidebar-price-range">
               <form action="">
                  <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                  </div>
                  <span id="skip-value-lower" class="example-val">30.00</span>
                 <span id="skip-value-upper" class="example-val">100.00</span>
                 <button class="aa-filter-btn" type="submit">Filter</button>
               </form>
              </div>

            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Color</h3>
              <?php
                  $sql = "SELECT * FROM colors";
                  $result = $conn->query($sql);
              ?>
              <div class="aa-color-tag">
              <?php
                while ($row = $result->fetch_assoc()) {
                echo '<a  href="#" style=" background-color:'.$row['color'].';"></a>' ;
                }
                ?>
              </div>
            </div>
            <!-- single sidebar -->

          </aside>
        </div>

      </div>
    </div>
  </section>
  <!-- / product category -->

  <?php include 'footer.php'; ?>