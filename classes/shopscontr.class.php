<?php
include_once "shops.class.php";
class ShopsContr extends Shops
{
    public function registerBusiness($user_id, $district, $name, $type, $area, $opent, $closet, $days, $address, $phone, $phone2, $email, $url, $new_name, $fb, $ig, $twitter, $app)
    {
        return $this->registersBusiness($user_id, $district, $name, $type, $area, $opent, $closet, $days, $address, $phone, $phone2, $email, $url, $new_name, $fb, $ig, $twitter, $app);
    }

    public function updateBusiness($shop_id, $district, $name, $type, $area, $opent, $closet, $days, $address, $phone, $phone2, $email, $url, $new_name, $fb, $ig, $twitter, $app)
    {
        return $this->updatesBusiness($shop_id, $district, $name, $type, $area, $opent, $closet, $days, $address, $phone, $phone2, $email, $url, $new_name, $fb, $ig, $twitter, $app);
    }

    public function checkShop($id)
    {
        return $this->checksShop($id);
    }

    public function viewShop($id)
    {
        return $this->viewsShop($id);
    }

    public function viewShopUsingShopID($id)
    {
        return $this->viewsShopUsingShopID($id);
    }

    public function viewShopAdminWithLimit($st, $end)
    {
        return $this->viewsShopAdminWithLimit($st, $end);
    }

    public function viewRandomShopWithLimit($sts, $st, $end)
    {
        return $this->viewsRandomShopWithLimit($sts, $st, $end);
    }

    public function viewRandomShopWithCat($sts, $cat, $st, $end)
    {
        return $this->viewsRandomShopWithCat($sts, $cat, $st, $end);
    }

    public function viewShopWithViewsDesc($sts, $st, $end)
    {
        return $this->viewsShopWithViewsDesc($sts, $st, $end);
    }

    public function viewItemsWithViewsDesc($st, $end)
    {
        return $this->viewsItemsWithViewsDesc($st, $end);
    }

    public function viewShopAdmin()
    {
        return $this->viewsShopAdmin();
    }

    public function viewShopAdminWithStatus($status)
    {
        return $this->viewsShopAdminWithStatus($status);
    }

    public function viewShopWithIg($start, $end)
    {
        return $this->viewsShopWithIg($start, $end);
    }

    public function changeStatusOrVerification($column, $id, $st)
    {
        return $this->changesStatusOrVerification($column, $id, $st);
    }

    public function uploadShopProduct($shop_id, $name, $quantity, $nego, $price, $description)
    {
        return $this->uploadsShopProduct($shop_id, $name, $quantity, $nego, $price, $description);
    }

    public function uploadRandomItem($user_id, $district, $name, $area, $quantity, $nego, $price, $description)
    {
        return $this->uploadsRandomItem($user_id, $district, $name, $area, $quantity, $nego, $price, $description);
    }

    public function uploadImages($prod_id, $name)
    {
        return $this->uploadsImages($prod_id, $name);
    }

    public function uploadItemImages($item_id, $name)
    {
        return $this->uploadsItemImages($item_id, $name);
    }

    public function viewShopProducts($id)
    {
        return $this->viewsShopProducts($id);
    }

    public function viewShopProducts2($id, $st, $end)
    {
        return $this->viewsShopProducts2($id, $st, $end);
    }

    public function viewShopProductsWithLimit($id, $st, $end)
    {
        return $this->viewsShopProductsWithLimit($id, $st, $end);
    }

    public function countShopProducts($id)
    {
        return $this->countsShopProducts($id);
    }

    public function viewRandomProducts($id)
    {
        return $this->viewsRandomProducts($id);
    }

    public function viewRandomProducts2($id, $st, $end)
    {
        return $this->viewsRandomProducts2($id, $st, $end);
    }

    public function changeViews($table, $column, $id, $views)
    {
        return $this->changesViews($table, $column, $id, $views);
    }

    public function viewItemDetails($id)
    {
        return $this->viewsItemDetails($id);
    }

    public function viewProductDetails($id)
    {
        return $this->viewsProductDetails($id);
    }

    public function viewRandomProductsAdmin()
    {
        return $this->viewsRandomProductsAdmin();
    }

    public function viewRandomProductsAdminWithLimit($st, $end)
    {
        return $this->viewsRandomProductsAdminWithLimit($st, $end);
    }

    public function viewRandomProductsWithLimit($st, $end)
    {
        return $this->viewsRandomProductsWithLimit($st, $end);
    }

    public function countRandomProducts($id)
    {
        return $this->countsRandomProducts($id);
    }

    public function countRandomItems()
    {
        return $this->countsRandomItems();
    }

    public function countShops($st)
    {
        return $this->countsShops($st);
    }

    public function countShopsWithCat($st, $cat)
    {
        return $this->countsShopsWithCat($st, $cat);
    }

    public function viewProductImages($id)
    {
        return $this->viewsProductImages($id);
    }

    public function viewItemImage($id)
    {
        return $this->viewsItemImage($id);
    }

    public function viewItemImages($id)
    {
        return $this->viewsItemImages($id);
    }

    public function viewProductImage($id)
    {
        return $this->viewsProductImage($id);
    }

    public function deleteShopProducts($id)
    {
        return $this->deletesShopProducts($id);
    }

    public function deleteShop($id)
    {
        return $this->deletesShop($id);
    }

    public function deleteRandomProducts($id)
    {
        return $this->deletesRandomProducts($id);
    }

    public function editShopProduct($id, $name, $quantity, $nego, $price, $description)
    {
        return $this->editsShopProduct($id, $name, $quantity, $nego, $price, $description);
    }

    public function editRandomProduct($id, $district, $name, $area, $quantity, $nego, $price, $description)
    {
        return $this->editsRandomProduct($id, $district, $name, $area, $quantity, $nego, $price, $description);
    }

    public function viewShopWithMaxViews($st)
    {
        return $this->viewsShopWithMaxViews($st);
    }

    public function viewRelated($table, $column, $column2, $name, $id, $start, $end)
    {
        return $this->viewsRelated($table, $column, $column2, $name, $id, $start, $end);
    }

    // ---------------------------SEARCH ALGORITHMS -------------------------------------------------------->
    public function searchShop($dist, $cat, $name, $st, $start, $end)
    {
        return $this->searchsShops($dist, $cat, $name, $st, $start, $end);
    }

    public function countSearchShop($dist, $cat, $name, $st)
    {
        return $this->countsSearchShops($dist, $cat, $name, $st);
    }

    public function searchRandomItem($dist, $name, $start, $end)
    {
        return $this->searchsRandomItem($dist, $name, $start, $end);
    }

    public function countSearchRandomItem($dist, $name)
    {
        return $this->countsSearchRandomItem($dist, $name);
    }

    public function searchShopProduct($shop_id, $name, $start, $end)
    {
        return $this->searchsShopProduct($shop_id, $name, $start, $end);
    }

    public function countSearchShopProduct($shop_id, $name)
    {
        return $this->countsSearchShopProduct($shop_id, $name);
    }

    // ******************************* MANAGING SHOP CATEGORIES *****************************************//
    public function addCategory($name)
    {
        return $this->addsCategory($name);
    }

    public function editCategory($id, $name)
    {
        return $this->editsCategory($id, $name);
    }

    public function deleteCategory($id)
    {
        return $this->deletesCategory($id);
    }

    public function viewCategoryWithId($id)
    {
        return $this->viewsCategoryWithId($id);
    }

    public function viewCategories()
    {
        return $this->viewsCategories();
    }

    public function countCategoryProducts($id)
    {
        return $this->countsCategoryProducts($id);
    }
}
