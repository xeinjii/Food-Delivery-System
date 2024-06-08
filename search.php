<?php
session_start();
// Include your database connection file
include("conn.php");

// Initialize an empty array to hold search results
$search_results = [];

if (isset($_GET['search_query'])) {
    // Get the search query from the form
    $search_query = $_GET['search_query'];

    // Secure the input to prevent SQL injection
    $search_query = mysqli_real_escape_string($conn, $search_query);

    // Perform the database query to search for products
    $query = "SELECT * FROM productdb WHERE ProductTitle LIKE '%$search_query%' OR Category LIKE '%$search_query%'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Fetch all matching records
        $search_results = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Delivery System</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link href=	"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    

<nav class="navbar navbar-expand-lg bg-dark-subtle fixed-top">
  <div class="container-fluid">
    <img class="image" src="img/logo.png" alt="images">
    <a class="navbar-brand food" disabled>Food Delivery System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup1" aria-controls="navbarNavAltMarkup1" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup1">
      <div class="navbar-nav ms-auto">
  
  
</div>
    </div>
  </div>
</nav><br><br><br>

 <div class="search">
     <form class="d-flex"  role="search">
        <input class="form-control me-2 " type="search" name="search_query" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary" type="submit">Search</button>
      </form>
 </div>



 <?php if (isset($_GET['search_query'])): ?>
    <h2>Search Results for "<?php echo htmlspecialchars($search_query); ?>"</h2>

    <?php if (count($search_results) > 0): ?>
        <table table class="table table-hover table-bordered border-black text-center">
            <thead>
                <tr>
                    <th class="bg-body-tertiary p-2 g-col-6">Title</th>
                    <th class="bg-body-tertiary p-2 g-col-6">Price</th>
                    <th class="bg-body-tertiary p-2 g-col-6">Quantity</th>
                    <th class="bg-body-tertiary p-2 g-col-6">Category</th>
                    <th class="bg-body-tertiary p-2 g-col-6">Picture</th>
                    <th class="bg-body-tertiary p-2 g-col-6">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($search_results as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['ProductTitle']); ?></td>
                        <td><?php echo htmlspecialchars($row['ProductPrice']); ?></td>
                        <td><?php echo htmlspecialchars($row['Quantity']); ?></td>
                        <td><?php echo htmlspecialchars($row['Category']); ?></td>
                        <td><img src="uploaded_img/<?php echo htmlspecialchars($row['ProductPicture']); ?>" height="40" alt=""></td>
                        <td> 
                        <a href="searchedit.php?edit=<?php echo $row['id']; ?>" class="btn btn-light"> <i class="fas fa-edit"></i> edit </a>
                        <a href="addproduct.php?remove=<?php echo $row['id']; ?>" class="btn btn-danger"> <i class='bx-fw bx bxs-trash'></i>delete </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
<?php endif; ?>

<div class="foot">
    <a style="width:15%" class="btn btn-success" href="adminpage.php">Back</a>
</div>

         <script src="script/function.js"></script>
      <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>