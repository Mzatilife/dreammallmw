<?php
include_once "./classes/shopscontr.class.php";
$shop = new ShopsContr;
if (isset($_POST['upload'])) {
    $file = $_FILES['csv']['tmp_name'];

    $file = fopen($file, 'r');
    while ($row = fgetcsv($file)) {
        $category = strip_tags($row['0']);
        $result = $shop->addCategory($category);
    }

    if ($result) {
        echo "Category uploaded!";
    }else{
        echo "Can't upload";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="mt-4" enctype="multipart/form-data">
        <div class="form-group">
            <!-- Form -->
            <div class="form-file mb-3">
                <input type="file" accept=".csv" name="csv" class="form-control" id="customFile" required="required">
            </div>
            <!-- End of Form -->
        </div>
        <div class="form-group">
            <button type="submit" name="upload" class="btn btn-info">Add Users</button>
        </div>
    </form>
</body>

</html>