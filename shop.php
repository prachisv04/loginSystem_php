<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    require '__dbconnect.php';
    $isloggedin = false;
    if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
        $isloggedin = true;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- title -->
  <title>Sahitya | Shop</title>
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">

  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

  <!-- JQuery -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Montserrat:wght@500&family=Mukta&family=Playfair+Display:ital@0;1&display=swap"
    rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!--  style sheets -->
  <link rel="stylesheet" href="CSS/shop.css">
  <link rel="stylesheet" href="CSS/style.css">

</head>

<body class="bg">

  <!-- navbar -->
  <?php
         require '__navbar.php';
    ?>


  <!-- Modal to open when person tries to wishlist item before login. -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Wishlist Says...</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>To add Item Please Login </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <a type="button" href="http://localhost/Bookstore/login.php" class="btn btn-outline-danger">Login</a>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row  text-center d-flex justify-content-around">
      <div class="col-3  filters">
            <select class="form-select" aria-label="Default select example">
              <option selected disabled>Sort By</option>
              <option value="1">Recommended</option>
              <option value="2">Pricing:High to Low</option>
              <option value="3">Pricing:Low to High</option>
              <option value="3">Customer Rating</option>
              <option value="3">Popularity</option>
            </select>

        <ul class="leftfilter mt-3">

          <li type="button" class="collapsible border-bottom">
            <div class="d-flex justify-content-between">
              <h6>Category</h6>
              <i class="bi bi-plus fs-5"></i>
            </div>
          </li>
          <div class="content">
            <ul class="list-group .list-group-flush text-start">
              <?php
                 $sql = "SELECT DISTINCT Category FROM book ";
                 $categories = mysqli_query($conn,$sql);
                 $no=1;
                
                 while($cat=mysqli_fetch_assoc($categories)){

                    echo "<li class='list-group-item' id='lf".$cat['Category']."'><input class='form-check-input me-1' type='checkbox' value=".$cat['Category'].">".$cat['Category']."</li>";
                 }
            ?>

            </ul>
          </div>

          <li type="button" class="collapsible border-bottom">
            <div class="d-flex justify-content-between">
              <h6>Languages</h6>
              <i class="bi bi-plus fs-5"></i>
            </div>
          </li>
          <div class="content">
            <ul class="list-group .list-group-flush text-start">
              <?php
                 $sql = "SELECT Language_name FROM languages ";
                 $langs = mysqli_query($conn,$sql);
                 $no=1;
                
                 while($lang=mysqli_fetch_assoc($langs)){

                    echo "<li class='list-group-item' id='lf".$lang['Language_name']."'><input class='form-check-input me-1' type='checkbox' value=".$lang['Language_name'].">".$lang['Language_name']."</li>";
                 }
            ?>
            </ul>
          </div>
          <li type="button" class="collapsible border-bottom">
            <div class="d-flex justify-content-between">
              <h6>Author</h6>
              <i class="bi bi-plus fs-5"></i>
            </div>
          </li>
          <div class="content">
            <ul class="list-group .list-group-flush text-start">
              <?php
                 $sql = "SELECT Author_name FROM author ";
                 $writers = mysqli_query($conn,$sql);
                 $no=1;
                
                 while($author=mysqli_fetch_assoc($writers)){

                    echo "<li class='list-group-item' id='lf".$author['Author_name']."'><input class='form-check-input me-1' type='checkbox' value=".$author['Author_name'].">".$author['Author_name']."</li>";
                 }
            ?>
            </ul>
          </div>
          <li type="button" class="collapsible border-bottom">
            <div class="d-flex justify-content-between">
              <h6>Prices</h6>
              <i class="bi bi-plus fs-5"></i>
            </div>
          </li>
          <div class="content">
            <ul class="list-group .list-group-flush text-start">
              <li class='list-group-item' id="p0"><input class='form-check-input me-1' type='checkbox' value="500">0-500
              </li>
              <li class='list-group-item' id="p500"><input class='form-check-input me-1' type='checkbox'
                  value="500">500-1000</li>
              <li class='list-group-item' id="p1000"><input class='form-check-input me-1' type='checkbox'
                  value="500">1000-2000</li>
              <li class='list-group-item' id="p2000"><input class='form-check-input me-1' type='checkbox'
                  value="500">2000 & up</li>
            </ul>

          </div>
          <li type="button" class="collapsible border-bottom">
            <div class="d-flex justify-content-between">
              <h6>Ratings</h6>
              <i class="bi bi-plus fs-5"></i>
            </div>
          </li>
          <div class="content">
            <ul class="list-group .list-group-flush text-start">

              <li class='list-group-item' id="p500"><input class='form-check-input me-1' type='checkbox' value="4star">
                <span class="bi bi-star-fill text-warning"></span>
                <span class="bi bi-star-fill text-warning"></span>
                <span class="bi bi-star-fill text-warning"></span>
                <span class="bi bi-star-fill text-warning"></span>
                <span>& up</span>
              </li>

              <li class='list-group-item' id="p500"><input class='form-check-input me-1' type='checkbox' value="3star">
                <span class="bi bi-star-fill text-warning"></span>
                <span class="bi bi-star-fill text-warning"></span>
                <span class="bi bi-star-fill text-warning"></span>
                <span>& up</span>
              </li>
            </ul>
          </div>
        </ul>


      </div>
      <div class=" col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 products">
        <div class="container">
        <div class="row d-flex flex-row align-items-left justify-content-left" id="allProducts">
          <?php
                
                $sql = "select book.Book_id , book.Title , book.PageNums , book.Category , author.Author_name, price_details.Price , languages.Language_name , book_pictures.CoverPage from book INNER JOIN author on book.Author_id = author.Author_id INNER JOIN price_details on book.Book_id = price_details.Book_id  INNER JOIN languages on languages.Language_id = price_details.language_id INNER JOIN book_pictures on book_pictures.Book_id = book.Book_id";
                $books = mysqli_query($conn,$sql);
                $no=1;
               
                while($book=mysqli_fetch_assoc($books)){
                  echo" 
                    <div class='col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 py-3 test'>
                      <div class='card'>
                        <div class='card-title py-3 d-flex text-dbrown'>
                        <div class='w-75' >
                        <h6 class='text-start text-truncate px-3 fs-5' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-custom-class='custom-tooltip' title='".$book['Title']."' >".$book['Title']."</h6>
                          <h6 class='card-subtitle text-body-secondary text-brown text-end'>- ".$book['Author_name']."</h6>
                        </div>
                        <div class='w-25'>
                        <button class='wishlist btn text-danger'><i class='bi bi-heart fa-lg'></i></button>
                        </div>
                        </div>
  
                        <div class='card-body text-nowrap d-flex flex-column ' >
                        
                     
                          <img src='data:image/jpeg;charset=utf8;base64,".base64_encode($book['CoverPage'])."' class='bookcover'/> 
                      
                          <div class='details mb-3 d-flex flex-column'>
                            <input class='border-0 text-left px-3 mt-3 fs-6 ' type='text' readonly value='".$book['Category']."' >
                            <input class='border-0 text-left px-3 fs-6 ' type='text' readonly value='".$book['Language_name']."' >
                          </div>
                          <div class='price-box text-center '>
                              <div class='d-flex justify-content-between'>
                              <h6 class='fs-5'><i class='bi bi-star-fill text-success'></i> 5 | ".$book['PageNums']."</h6>
                                <h5 class='fs-5'>&#x20B9;".$book['Price']."</h5>
                              </div>
                          </div>
                        
                        </div>

                        <div class='card-footer'>
                            <button class='addToCart btn btn-dbrown p-2'>Add to Cart <i class='bi bi-bag fa-lg mx-2'></i></button>
                        </div>
                      </div>
                    </div>                 
                    ";
              }
              
              ?>
          <!-- card end  -->
          
        </div>
      </div>
    </div>
   
  </div>



  <!-- Footer -->
  <?php
        require '__footer.html';
  ?>

  <div class=" sticky-bottom bg-dark" id="filterbar">
    <div class="row border d-flex flex-row py-2 text-center">

            <div class="col-6 col-sm-6 text-light fs-5 border-right">Sort By</div>
            <div class="col-6 col-sm-6 text-light fs-5">Filters</div>
              
    </div>
  </div>
  <!-- javascript -->
  <!-- bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
    crossorigin="anonymous"></script>

  <!-- site-custom -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="JS/customs.js"></script>
  <script>
        // $(document).ready(function () {
        //   $('#allProducts').DataTable();

        // });
  </script>
  <script>

    document.getElementById("shop").classList.add("active");

    let coll = document.getElementsByClassName("collapsible");
    let i;

    for (i = 0; i < coll.length; i++) {

      coll[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
          content.style.display = "none";
          this.firstElementChild.lastElementChild.classList.remove("bi-dash");
          this.firstElementChild.lastElementChild.classList.add("bi-plus");
        } else {
          content.style.display = "block";
          this.firstElementChild.lastElementChild.classList.remove("bi-plus");
          this.firstElementChild.lastElementChild.classList.add("bi-dash");

        }
      });
    }

    let wish = document.getElementsByClassName("wishlist");

    for (let itr = 0; itr < wish.length; itr++) {

      wish[itr].addEventListener("click", function () {
    
        <?php
          if ($isloggedin) {
        ?>

            let heart = this.firstElementChild;
          if (heart.classList.contains("bi-heart")) {
            heart.classList.remove("bi-heart");
            heart.classList.add("bi-heart-fill");
          } else {
            heart.classList.remove("bi-heart-fill");
            heart.classList.add("bi-heart");
          }
        <?php
          }
        else {
            ?>
            wish[itr].setAttribute("data-bs-toggle", "modal");
          wish[itr].setAttribute("data-bs-target", "#exampleModal");
              
            <?php
          }   
        ?>
      });
    }


    let carts = document.getElementsByClassName("addToCart");

    for (let itrc = 0; itrc < carts.length; itrc++) {

      carts[itrc].addEventListener("click", function () {

        this.style.display = "none";
        let counter = document.createElement("div");

        counter.classList.add("input-group");

        let btnplus = "<button class='btn  plus ' type='button'><i class='bi bi-plus text-light fa-lg'></i></button>";
        let btnminus = "<button class='btn  minus ' type='button'><i class='bi bi-dash text-light fa-lg'></i></button>";
        let getnum = "<input type='text' class='form-control count text-center fs-5 bg-light' value='1' aria-label='Example text with two button addons'>";

        counter.innerHTML = btnminus + getnum + btnplus;
        counter.style.width = "75%";
        counter.style.backgroundColor = "#9C7F5B";
        counter.style.borderTopLeftRadius = "15px";
        counter.style.borderBottomRightRadius = "15px";

        let plus = counter.getElementsByClassName("plus");

        for (let itrp = 0; itrp < plus.length; itrp++) {

          plus[itrp].addEventListener("click", function () {
            val = this.previousSibling.value;
            this.previousSibling.value = ++val;

          });
        }
        let istrue = false;
        let minus = counter.getElementsByClassName("minus");

        for (let itrm = 0; itrm < minus.length; itrm++) {

          minus[itrm].addEventListener("click", function () {
            val = this.nextSibling.value;
            this.nextSibling.value = --val;

            if (val <= 0) {
              this.nextSibling.value = 1;
              counter.style.display = "none";
              carts[itrc].style.display = "flex";
              carts[itrc].style.marginLeft = "10px";
            }
          });
        }

        this.parentNode.appendChild(counter);
      });
    }

  </script>
</body>

</html>