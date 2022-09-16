<?php
include_once "dbh.class.php";
class Shops extends Dbh
{
  // FUNCTION TO REGISTER BUSINESS ****************************************************************************>
  protected function registersBusiness($user_id, $district, $name, $type, $area, $opent, $closet, $days, $address, $phone, $phone2, $email, $url, $new_name, $fb, $ig, $twitter, $app)
  {
    //adding the user data into the database ----------------------------------------------------------------->

    $sql = "INSERT INTO shops (`user_id`, `district_id`, `cat_id`, `shop_name`, `area`, `opening_time`, `closing_time`, `opening_days`, `address`, `phone`, `phone_2`, `email`, `website`, `logo`, `facebook`, `instagram`, `twitter`, `whatsapp`, `views`, `status`, `verified`, `reg_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, 0, 0, NOW())";
    $stmt = $this->connect()->prepare($sql);

    $result = $stmt->execute([$user_id, $district, $type, $name, $area, $opent, $closet, $days, $address, $phone, $phone2, $email, $url, $new_name, $fb, $ig, $twitter, $app]);

    //Checking if the data was uploaded ----------------------------------------------------------------------->

    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  // FUNCTION TO REGISTER BUSINESS ****************************************************************************>
  protected function updatesBusiness($shop_id, $district, $name, $type, $area, $opent, $closet, $days, $address, $phone, $phone2, $email, $url, $new_name, $fb, $ig, $twitter, $app)
  {
    //adding the user data into the database ----------------------------------------------------------------->

    $sql = "UPDATE shops SET `district_id` = ?, `cat_id` = ?, `shop_name` = ?, `area` = ?, `opening_time` = ?, `closing_time` = ?, `opening_days` = ?, `address` = ?, `phone` = ?, `phone_2` = ?, `email` = ?, `website` = ?, `logo` = ?, `facebook` = ?, `instagram` = ?, `twitter` = ?, `whatsapp` = ?  WHERE `shop_id` = ?";
    $stmt = $this->connect()->prepare($sql);

    $result = $stmt->execute([$district, $type, $name, $area, $opent, $closet, $days, $address, $phone, $phone2, $email, $url, $new_name, $fb, $ig, $twitter, $app, $shop_id]);

    //Checking if the data was uploaded ----------------------------------------------------------------------->

    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  // FUNCTION TO CHECK IF USER HAS SHOP REGISTERED ****************************************************************************>
  protected function checksShop($id)
  {
    $sql = "SELECT * FROM `shops` WHERE `user_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->rowCount();
  }

  // FUNCTION TO VIEW SHOP/BUSINESS DETAILS ****************************************************************************>
  protected function viewsShop($id)
  {
    $sql = "SELECT * FROM `shops` WHERE `user_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  // FUNCTION TO VIEW SHOP/BUSINESS DETAILS USING SHOP ID ***************************************************************>
  protected function viewsShopUsingShopID($id)
  {
    $sql = "SELECT * FROM `shops` WHERE `shop_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  // FUNCTION TO VIEW SHOP/BUSINESS DETAILS ****************************************************************************>
  protected function viewsShopAdmin()
  {
    $sql = "SELECT * FROM `shops` ORDER BY `shop_id` DESC";
    $stmt = $this->connect()->query($sql);
    return $stmt->fetchAll();
  }

  // FUNCTION TO VIEW SHOP/BUSINESS DETAILS WITH STATUS ****************************************************************************>
  protected function viewsShopAdminWithStatus($status)
  {
    $sql = "SELECT * FROM `shops` WHERE `status` = ? ORDER BY `shop_id` DESC";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$status]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO VIEW SHOP/BUSINESS DETAILS ****************************************************************************>
  protected function viewsShopWithIg($start, $end)
  {
    $sql = "SELECT * FROM `shops` WHERE `instagram` != '' ORDER BY RAND() LIMIT $start, $end";
    $stmt = $this->connect()->query($sql);
    return $stmt->fetchAll();
  }

  // FUNCTION TO VIEW SHOP/BUSINESS DETAILS ****************************************************************************>
  protected function viewsShopAdminWithLimit($start, $end)
  {
    $sql = "SELECT * FROM `shops` ORDER BY `shop_id` DESC LIMIT $start, $end";
    $stmt = $this->connect()->query($sql);
    return $stmt->fetchAll();
  }

  // FUNCTION TO VIEW SHOP/BUSINESS DETAILS RANDOMS ****************************************************************************>
  protected function viewsRandomShopWithLimit($sts, $start, $end)
  {
    $sql = "SELECT * FROM `shops` WHERE `status` = ? ORDER BY RAND() LIMIT $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$sts]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO VIEW SHOP/BUSINESS DETAILS RANDOMS ****************************************************************************>
  protected function viewsRandomShopWithCat($st, $cat, $start, $end)
  {
    $sql = "SELECT * FROM `shops` WHERE `cat_id` = ? AND `status` = ? ORDER BY RAND() LIMIT $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$cat, $st]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO VIEW SHOP/BUSINESS DETAILS WITH DESCENDING VIEWS****************************************************************************>
  protected function viewsShopWithViewsDesc($st, $start, $end)
  {
    $sql = "SELECT * FROM `shops` WHERE `status` = ?  ORDER BY `views` DESC LIMIT $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$st]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO VIEW SHOP/BUSINESS DETAILS WITH DESCENDING VIEWS****************************************************************************>
  protected function viewsItemsWithViewsDesc($start, $end)
  {
    $sql = "SELECT * FROM `random_items` ORDER BY `views` DESC LIMIT $start, $end";
    $stmt = $this->connect()->query($sql);
    return $stmt->fetchAll();
  }

  // FUNCTION TO CHANGE STATUS AND VERIFICATION  *********************************************************************>
  protected function changesStatusOrVerification($column, $id, $st)
  {
    $sql = "UPDATE shops SET $column = ? WHERE `shop_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$st, $id]);

    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  // FUNCTION TO UPLOAD SHOP/BUSINESS PRODUCTS ****************************************************************************>
  protected function uploadsShopProduct($shop_id, $name, $quantity, $nego, $price, $description)
  {
    //adding the user data into the database ----------------------------------------------------------------->

    $sql = "INSERT INTO shop_products (`shop_id`, `prod_name`, `prod_quantity`, `prod_negotiable`, `prod_price`, `prod_description`, `upload_date`) VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$shop_id, $name, $quantity, $nego, $price, $description]);

    //Checking if the data was uploaded ----------------------------------------------------------------------->
    if ($result) {
      $sql2 = "SELECT * FROM shop_products WHERE `shop_id` = ? AND `prod_name` = ? AND `prod_negotiable` = ? AND `prod_description` = ?";
      $stmt2 = $this->connect()->prepare($sql2);
      $stmt2->execute([$shop_id, $name, $nego, $description]);
      return $stmt2->fetch();
    } else {
      return false;
    }
  }

  // FUNCTION TO UPLOAD RANDOM ITEMS ****************************************************************************>
  protected function uploadsRandomItem($user_id, $district, $name, $area, $quantity, $nego, $price, $description)
  {
    //adding the user data into the database ----------------------------------------------------------------->

    $sql = "INSERT INTO random_items (`user_id`, `district_id`, `item_name`, `item_area`, `item_quantity`, `item_negotiable`, `item_price`, `item_description`, `views`, `item_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, NOW())";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$user_id, $district, $name, $area, $quantity, $nego, $price, $description]);

    //Checking if the data was uploaded ----------------------------------------------------------------------->
    if ($result) {
      $sql2 = "SELECT * FROM random_items WHERE `user_id` = ? AND `district_id` = ? AND `item_name` = ? AND `item_area` = ?  AND `item_negotiable` = ? AND `item_description` = ?";
      $stmt2 = $this->connect()->prepare($sql2);
      $stmt2->execute([$user_id, $district, $name, $area, $nego, $description]);
      return $stmt2->fetch();
    } else {
      return false;
    }
  }

  // FUNCTION TO UPLOAD PRODUCTS IMAGES ****************************************************************************>
  protected function uploadsImages($prod_id, $name)
  {
    //adding the user data into the database ----------------------------------------------------------------->

    $sql = "INSERT INTO product_images (`prod_id`, `image_name`) VALUES (?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$prod_id, $name]);
    return $result;
  }

  // FUNCTION TO UPLOAD ITEM IMAGES ****************************************************************************>
  protected function uploadsItemImages($item_id, $name)
  {
    //adding the user data into the database ----------------------------------------------------------------->
    $sql = "INSERT INTO item_images (`item_id`, `image_name`) VALUES (?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$item_id, $name]);
    return $result;
  }

  // FUNCTION TO VIEW SHOP/BUSINESS PRODUCTS ****************************************************************************>
  protected function viewsShopProducts($id)
  {
    $sql = "SELECT * FROM `shop_products` WHERE `shop_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO VIEW SHOP/BUSINESS PRODUCTS ****************************************************************************>
  protected function viewsShopProducts2($id, $start, $end)
  {
    $sql = "SELECT * FROM `shop_products` WHERE `shop_id` = ? LIMIT $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO VIEW SHOP/BUSINESS PRODUCTS ****************************************************************************>
  protected function viewsShopProductsWithLimit($id, $start, $end)
  {
    $sql = "SELECT * FROM `shop_products` WHERE `shop_id` = ?  ORDER BY `prod_name` ASC LIMIT $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO COUNT SHOP/BUSINESS PRODUCTS ****************************************************************************>
  protected function countsShopProducts($id)
  {
    $sql = "SELECT * FROM `shop_products` WHERE `shop_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->rowCount();
  }

  // FUNCTION TO VIEW RANDOM PRODUCTS ****************************************************************************>
  protected function viewsRandomProducts($id)
  {
    $sql = "SELECT * FROM `random_items` WHERE `user_id` = ? ORDER BY `item_id` DESC";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO VIEW RANDOM PRODUCTS ****************************************************************************>
  protected function viewsRandomProducts2($id, $start, $end)
  {
    $sql = "SELECT * FROM `random_items` WHERE `user_id` = ? ORDER BY `item_id` DESC LIMIT $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO VIEW SINGLE RANDOM PRODUCTS ****************************************************************************>
  protected function viewsItemDetails($id)
  {
    $sql = "SELECT * FROM `random_items` WHERE `item_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  // FUNCTION TO VIEW SINGLE SHOP PRODUCT ****************************************************************************>
  protected function viewsProductDetails($id)
  {
    $sql = "SELECT * FROM `shop_products` WHERE `prod_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  // FUNCTION TO VIEW RANDOM PRODUCTS ****************************************************************************>
  protected function viewsRandomProductsAdmin()
  {
    $sql = "SELECT * FROM `random_items` ORDER BY `item_id` DESC";
    $stmt = $this->connect()->query($sql);
    return $stmt->fetchAll();
  }

  // FUNCTION TO VIEW RANDOM PRODUCTS ****************************************************************************>
  protected function viewsRandomProductsAdminWithLimit($start, $end)
  {
    $sql = "SELECT * FROM `random_items` ORDER BY `item_id` DESC LIMIT $start, $end ";
    $stmt = $this->connect()->query($sql);
    return $stmt->fetchAll();
  }

  // FUNCTION TO VIEW RANDOM PRODUCTS ****************************************************************************>
  protected function viewsRandomProductsWithLimit($start, $end)
  {
    $sql = "SELECT * FROM `random_items` ORDER BY RAND() LIMIT $start, $end ";
    $stmt = $this->connect()->query($sql);
    return $stmt->fetchAll();
  }

  // FUNCTION TO COUNT RANDOM PRODUCTS ****************************************************************************>
  protected function countsRandomProducts($id)
  {
    $sql = "SELECT * FROM `random_items` WHERE `user_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->rowCount();
  }

  // FUNCTION TO COUNT RANDOM ITEMS ****************************************************************************>
  protected function countsRandomItems()
  {
    $sql = "SELECT * FROM `random_items`";
    $stmt = $this->connect()->query($sql);
    return $stmt->rowCount();
  }

  // FUNCTION TO COUNT RANDOM ITEMS ****************************************************************************>
  protected function countsShops($st)
  {
    $sql = "SELECT * FROM `shops` WHERE `status` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$st]);
    return $stmt->rowCount();
  }

  protected function countsShopsWithCat($st, $cat)
  {
    $sql = "SELECT * FROM `shops` WHERE `cat_id` = ? AND `status` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$cat, $st]);
    return $stmt->rowCount();
  }

  // FUNCTION TO VIEW PRODUCT IMAGES ****************************************************************************>
  protected function viewsProductImages($id)
  {
    $sql = "SELECT * FROM `product_images` WHERE `prod_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO VIEW PRODUCT IMAGE ****************************************************************************>
  protected function viewsProductImage($id)
  {
    $sql = "SELECT * FROM `product_images` WHERE `prod_id` = ? ORDER BY RAND() LIMIT 1";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  // FUNCTION TO VIEW PRODUCT IMAGES ****************************************************************************>
  protected function viewsItemImages($id)
  {
    $sql = "SELECT * FROM `item_images` WHERE `item_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll();
  }

  // FUNCTION TO VIEW PRODUCT IMAGE ****************************************************************************>
  protected function viewsItemImage($id)
  {
    $sql = "SELECT * FROM `item_images` WHERE `item_id` = ? ORDER BY RAND() LIMIT 1";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  // FUNCTION TO DELETE SHOP/BUSINESS PRODUCTS ****************************************************************************>
  protected function deletesShop($id)
  {
    $logo = $this->viewsShopUsingShopID($id);
    unlink("../assets/images/logos/" . $logo['logo']);

    $sql = "DELETE FROM `shops` WHERE `shop_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$id]);

    $row = $this->viewsShopProducts($id);
    if (!empty($row)) {
      foreach ($row as $rw) {
        $prod_id = $rw['prod_id'];
        $result2 = $this->deletesShopProducts($prod_id);
      }
    } else {
      $result2 = true;
    }


    if ($result && $result2) {
      return true;
    } else {
      return false;
    }
  }

  // FUNCTION TO DELETE SHOP/BUSINESS PRODUCTS ****************************************************************************>
  protected function deletesShopProducts($id)
  {
    $images = $this->viewsProductImages($id);
    foreach ($images as $image) {
      unlink("../assets/images/products/" . $image['image_name']);
    }
    $sql = "DELETE FROM shop_products WHERE `prod_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$id]);

    $sql2 = "DELETE FROM product_images WHERE `prod_id` = ?";
    $stmt2 = $this->connect()->prepare($sql2);
    $result2 = $stmt2->execute([$id]);

    if ($result && $result2) {
      return true;
    } else {
      return false;
    }
  }

  // FUNCTION TO DELETE RANDOM PRODUCTS ****************************************************************************>
  protected function deletesRandomProducts($id)
  {
    $images = $this->viewsItemImages($id);
    foreach ($images as $image) {
      unlink("../assets/images/products/" . $image['image_name']);
    }
    $sql = "DELETE FROM random_items WHERE `item_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$id]);

    $sql2 = "DELETE FROM item_images WHERE `item_id` = ?";
    $stmt2 = $this->connect()->prepare($sql2);
    $result2 = $stmt2->execute([$id]);

    if ($result && $result2) {
      return true;
    } else {
      return false;
    }
  }

  // FUNCTION TO EDIT SHOP/PRODUCT VIEWS ****************************************************************************>
  protected function changesViews($table, $column, $id, $views)
  {
    $sql = "UPDATE $table SET `views` = ? WHERE $column = ?";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$views, $id]);
    return $result;
  }

  // FUNCTION TO EDIT SHOP/BUSINESS PRODUCTS ****************************************************************************>
  protected function editsShopProduct($id, $name, $quantity, $nego, $price, $description)
  {
    $sql = "UPDATE `shop_products` SET `prod_name` = ?, `prod_quantity` = ?, `prod_negotiable` = ?, `prod_price` = ?, `prod_description` = ? WHERE `prod_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$name, $quantity, $nego, $price, $description, $id]);
    return $result;
  }

  // FUNCTION TO EDIT RANDOM PRODUCTS ****************************************************************************>
  protected function editsRandomProduct($id, $district, $name, $area, $quantity, $nego, $price, $description)
  {
    $sql = "UPDATE `random_items` SET `district_id` = ?, `item_name` = ?, `item_area` = ?, `item_quantity` = ?, `item_negotiable` = ?, `item_price` = ?, `item_description` = ? WHERE `item_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$district, $name, $area, $quantity, $nego, $price, $description, $id]);
    return $result;
  }

  // FUNCTION TO VIEW SHOP/BUSINESS DETAILS WITH MAXIMUM VIEWS ****************************************************************************>
  protected function viewsShopWithMaxViews($st)
  {
    $sql = "SELECT * FROM `shops` WHERE `views` = (SELECT MAX(`views`) FROM `shops` WHERE `status` = ?) AND `status` = ? ORDER BY RAND() LIMIT 1";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$st, $st]);
    return $stmt->fetch();
  }

  // FUNCTION TO VIEW RELATED PRODUCTS *******************************************************************>
  protected function viewsRelated($table, $column, $column2, $name, $id, $start, $end)
  {
    $sql = "SELECT * FROM $table WHERE $column = ? AND $column2 != ? ORDER BY RAND() LIMIT $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$name, $id]);
    return $stmt->fetchAll();
  }

  // ---------------------------SEARCH ALGORITHMS -------------------------------------------------------->
  protected function searchsShops($dist, $cat, $name, $st, $start, $end)
  {
    $sql = "SELECT * FROM `shops` WHERE (`district_id` = ? AND `cat_id` = ? AND `status` = ?) OR (`shop_name` LIKE '%$name%' AND `status` = ?) LIMIT $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$dist, $cat, $st, $st]);
    return $stmt->fetchAll();
  }

  protected function countsSearchShops($dist, $cat, $name, $st)
  {
    $sql = "SELECT * FROM `shops` WHERE (`district_id` = ? AND `cat_id` = ?  AND `status` = ?) OR (`shop_name` LIKE '%$name%' AND `status` = ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$dist, $cat, $st, $st]);
    return $stmt->rowCount();
  }

  protected function searchsRandomItem($dist, $name, $start, $end)
  {
    $sql = "SELECT * FROM `random_items` WHERE `district_id` = ? AND `item_name` LIKE '%$name%' LIMIT $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$dist]);
    return $stmt->fetchAll();
  }

  protected function countsSearchRandomItem($dist, $name)
  {
    $sql = "SELECT * FROM `random_items` WHERE `district_id` = ? AND `item_name` LIKE '%$name%'";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$dist]);
    return $stmt->rowCount();
  }

  protected function searchsShopProduct($shop_id, $name, $start, $end)
  {
    $sql = "SELECT * FROM `shop_products` WHERE `shop_id` = ? AND `prod_name` LIKE '%$name%' LIMIT $start, $end";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$shop_id]);
    return $stmt->fetchAll();
  }

  protected function countsSearchShopProduct($shop_id, $name)
  {
    $sql = "SELECT * FROM `shop_products` WHERE `shop_id` = ? AND `prod_name` LIKE '%$name%'";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$shop_id]);
    return $stmt->rowCount();
  }

  // ***************************************** MANAGING SHOP CATEGORIES **************************************** //
  // FUNCTION TO UPLOAD SHOP CATEGORY ****************************************************************************>
  protected function addsCategory($name)
  {
    //adding the user data into the database ----------------------------------------------------------------->
    $sql = "INSERT INTO `shop_categories` (`cat_name`, `upload_date`) VALUES (?, NOW())";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$name]);
    return $result;
  }

  // FUNCTION TO EDIT SHOP CATEGORY ****************************************************************************>
  protected function editsCategory($id, $name)
  {
    //adding the user data into the database ----------------------------------------------------------------->
    $sql = "UPDATE `shop_categories` SET `cat_name` = ? WHERE  `cat_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$name, $id]);
    return $result;
  }

  // FUNCTION TO DELETES SHOP CATEGORY ****************************************************************************>
  protected function deletesCategory($id)
  {
    //adding the user data into the database ----------------------------------------------------------------->
    $sql = "DELETE FROM `shop_categories` WHERE `cat_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$id]);
    return $result;
  }

  // FUNCTION TO VIEW SHOP CATEGORY WITH ID ****************************************************************************>
  protected function viewsCategoryWithId($id)
  {
    //adding the user data into the database ----------------------------------------------------------------->
    $sql = "SELECT * FROM `shop_categories` WHERE `cat_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $result = $stmt->execute([$id]);
    return $stmt->fetch();
  }

  // FUNCTION TO VIEW SHOP CATEGORIES****************************************************************************>
  protected function viewsCategories()
  {
    //adding the user data into the database ----------------------------------------------------------------->
    $sql = "SELECT * FROM `shop_categories` ORDER BY `cat_name` ASC";
    $stmt = $this->connect()->query($sql);
    return $stmt->fetchAll();
  }

  // FUNCTION TO COUNT SHOP CATEGORY PRODUCTS WITH ID ****************************************************************************>
  protected function countsCategoryProducts($id)
  {
    //adding the user data into the database ----------------------------------------------------------------->
    $sql = "SELECT * FROM `shops` WHERE `cat_id` = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->rowCount();
  }
}
