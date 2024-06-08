<?php
session_start();
include("conn.php");

if (isset($_POST['submit'])) {
    $ProductTitle = $_POST['ProductTitle'];
    $ProductPrice = $_POST['ProductPrice'];
    $Quantity = $_POST['Quantity'];
    $Category = $_POST['Category'];
    $ProductPicture = $_FILES['ProductPicture']['name'];

    $ProductPicture_tmp_name = $_FILES['ProductPicture']['tmp_name'];
    $ProductPicture_folder = 'uploaded_img/'.$ProductPicture;
   // Retrieve the last inserted product ID
   $product_id = mysqli_insert_id($conn);
   
    $insert = "INSERT INTO productdb (ProductTitle, ProductPrice, Quantity, Category, ProductPicture) VALUES ('$ProductTitle', '$ProductPrice', '$Quantity', '$Category', '$ProductPicture')";
    $upload = mysqli_query($conn, $insert);
    if ($upload) {
        move_uploaded_file($ProductPicture_tmp_name, $ProductPicture_folder);
        header("location: adminpage.php");
    } else {
        $message[] = 'could not add the product';
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM productdb WHERE id = $id");
    header('location:adminpage.php');
} else if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM productdb WHERE id = $id");
    header('location: search.php');
}

// Remove the product if quantity is 0
mysqli_query($conn, "DELETE FROM productdb WHERE Quantity = 0");

// Set up pagination variables
$products_per_page = 10; // Number of products per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$start_from = ($page - 1) * $products_per_page; // Start position for the SQL query

// Fetch products for the current page
$select_products = mysqli_query($conn, "SELECT * FROM productdb LIMIT $start_from, $products_per_page");

// Calculate total number of pages
$total_products_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM productdb");
$total_products_row = mysqli_fetch_assoc($total_products_query);
$total_products = $total_products_row['total'];
$total_pages = ceil($total_products / $products_per_page);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Food Delivery System</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-dark-subtle fixed-top">
    <div class="container-fluid">
        <img class="image" src="img/logo.png" alt="images">
        <a class="navbar-brand food" disabled>Food Delivery System</a>
        <a class="icon-link link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="insertadmin.php">Add new admin account</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup1" aria-controls="navbarNavAltMarkup1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup1">
            <div class="navbar-nav ms-auto">
                <button type="button" class="btn btn-outline-dark me-4 profile" disabled>
                    <i class='bx-fw bx bxs-user-rectangle'></i>
                    <?php if (isset($_SESSION['username'])) echo $_SESSION['username']; ?>
                </button>
                <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class='bx-fw bx bx-log-out'></i> Log out
                </button>
            </div>
        </div>
    </div>
</nav><br><br><br>

<!-- Logout Modal -->
<div class="modal fade almodal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure, do you want to logout this admin account?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="logout.php" method="post">
                    <button type="submit" class="btn btn-primary" name="logout">Log out</button>
                </form>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg bg-body-secondary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Product Management</a>
        <a class="btn btn-light" href="search.php">Find Product</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup2" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup2">
            <div class="navbar-nav ms-auto">
            <?php
            $select_rows = mysqli_query($conn, "SELECT * FROM `order`") or die('query failed');
            $row_count = mysqli_num_rows($select_rows);
        ?>
                <a class="btn btn-light me-3" href="order-list.php">Order list <span><?php echo $row_count; ?></span></a>
                <button type="button" class="btn btn-light me-3" data-bs-toggle="modal" data-bs-target="#addproduct">Add Product</button>
            </div>
        </div>
    </div>
</nav>

<table class="table table-hover text-center" id="search">
       <thead>
        <tr class="bg-primary text-white">
            <th class="bg-body-tertiary p-2 g-col-5">Title</th>
            <th class="bg-body-tertiary p-2 g-col-6">Price</th>
            <th class="bg-body-tertiary p-2 g-col-6">Quantity</th>
            <th class="bg-body-tertiary p-2 g-col-6">Category</th>
            <th class="bg-body-tertiary p-2 g-col-6">Picture</th>
            <th class="bg-body-tertiary p-2 g-col-6">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($select_products)) { ?>
            <tr>
                <td><?php echo $row['ProductTitle']; ?></td>
                <td>₱<?php echo $row['ProductPrice']; ?></td>
                <td><?php echo $row['Quantity']; ?></td>
                <td><?php echo $row['Category']; ?></td>
                <td><img src="uploaded_img/<?php echo $row['ProductPicture']; ?>" height="40" alt=""></td>
                <td>
                    <a href="editproduct.php?edit=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fas fa-edit"></i> edit</a>
                    <a href="adminpage.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger"><i class='bx-fw bx bxs-trash'></i>delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Pagination Controls -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item <?php if($page <= 1) { echo 'disabled'; } ?>">
            <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
        </li>
        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <li class="page-item <?php if($page == $i) { echo 'active'; } ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php } ?>
        <li class="page-item <?php if($page >= $total_pages) { echo 'disabled'; } ?>">
            <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
        </li>
    </ul>
</nav>


<!-- Modal addproduct -->
<div class="modal fade" id="addproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="ProductTitle" name="ProductTitle" placeholder="Product Title" required>
                        <label for="floatingPassword">Title</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="ProductPrice" name="ProductPrice" placeholder="Product Price" required>
                        <label for="floatingPassword">Price</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="Quantity" name="Quantity" placeholder="Product Price" min="0" step="1" required>
                        <label for="floatingPassword">Quantity</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-control" name="Category" id="Category">
                            <option value="Desert">Dessert</option>
                            <option value="Drinks">Drinks</option>
                            <option value="Combo meal">Combo meal</option>
                            <option value="Pizza">Pizza</option>
                            <option value="Sandwich">Sandwich</option>
                            <option value="Fries">French fries</option>
                            <option value="Fried">Fried</option>
                        </select>
                        <label for="floatingPassword">Select category</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="ProductPicture" name="ProductPicture" placeholder="Product Picture" required>
                        <label for="floatingPassword">Picture</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="script/function.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
