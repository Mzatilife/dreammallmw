<?php
include_once "dbh.class.php";
class Blog extends Dbh
{
    //-----------------------DEALS WITH THE BLOG CATEGORY ---------------------------------------//
    protected function addsCategory($name)
    {
        $sql = "INSERT INTO categories ( `category_name`, `upload_date`) VALUES (?, NOW())";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$name]);
        return $result;
    }

    protected function viewsCategories()
    {
        $sql = "SELECT * FROM categories ORDER BY `category_id` DESC";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }

    protected function editsCategory($id, $name)
    {
        $sql = "UPDATE categories SET  `category_name` = ? WHERE `category_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$name, $id]);
        return $result;
    }

    protected function deletesCategory($id)
    {
        $sql = "DELETE FROM categories WHERE `category_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$id]);

        $sql2 = "DELETE FROM blogs WHERE `category_id` = ?";
        $stmt2 = $this->connect()->prepare($sql2);
        $result2 = $stmt2->execute([$id]);

        if ($result && $result2) {
            return true;
        } else {
            return false;
        }
    }

    protected function countsCategory()
    {
        $sql = "SELECT * FROM `categories`";
        $stmt = $this->connect()->query($sql);
        return $stmt->rowCount();
    }


    //-----------------------DEALS WITH THE ACTUAL BLOG CATEGORY ---------------------------------------//
    protected function addsBlog($cat, $title, $author, $image, $content, $date)
    {
        $sql = "INSERT INTO blogs ( `category_id`, `title`, `author`, `image`, `content`, `date`) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$cat, $title, $author, $image, $content, $date]);
        return $result;
    }

    protected function editsBlog($cat, $title, $author, $image, $content, $date, $blog_id)
    {
        $sql = "UPDATE `blogs` SET `category_id` = ?, `title` = ?, `author` = ?, `image` = ?, `content` = ?, `date` = ? WHERE `blog_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$cat, $title, $author, $image, $content, $date, $blog_id]);
        return $result;
    }

    protected function viewsBlog()
    {
        $sql = "SELECT * FROM `blogs` INNER JOIN `categories` ON blogs.category_id = categories.category_id ORDER BY blogs.blog_id DESC";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }

    protected function viewsBlogById($id)
    {
        $sql = "SELECT * FROM `blogs` INNER JOIN `categories` ON blogs.category_id = categories.category_id WHERE blogs.blog_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    protected function viewsBlogWithLimit($start, $end)
    {
        $sql = "SELECT * FROM `blogs` INNER JOIN `categories` ON blogs.category_id = categories.category_id ORDER BY blogs.blog_id DESC LIMIT $start, $end";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    protected function countsBlog()
    {
        $sql = "SELECT * FROM `blogs` INNER JOIN `categories` ON blogs.category_id = categories.category_id";
        $stmt = $this->connect()->query($sql);
        return $stmt->rowCount();
    }

    protected function viewsBlogAndCategory($id, $start, $end)
    {
        $sql = "SELECT * FROM `blogs` INNER JOIN `categories` ON blogs.category_id = categories.category_id WHERE categories.category_id = ? ORDER BY blogs.blog_id DESC LIMIT $start, $end";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }
    protected function countsBlogAndCategory($id)
    {
        $sql = "SELECT * FROM `blogs` INNER JOIN `categories` ON blogs.category_id = categories.category_id WHERE categories.category_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    protected function deletesBlog($id)
    {
        $image = $this->viewsBlogById($id);
        unlink("../img/blog/" . $image['image']);

        $sql = "DELETE FROM blogs WHERE `blog_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$id]);

        $sql2 = "DELETE FROM comments WHERE `blog_id` = ?";
        $stmt2 = $this->connect()->prepare($sql2);
        $result2 = $stmt2->execute([$id]);

        if ($result && $result2) {
            return true;
        } else {
            return false;
        }
    }


    //-----------------------DEALS WITH THE COMMENTING SECTION ---------------------------------------//
    protected function commentsBlog($blog_id, $name, $email, $comment)
    {
        $sql = "INSERT INTO comments ( `blog_id`, `name`, `email`, `comment`, `date`) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$blog_id, $name, $email, $comment]);
        return $result;
    }

    protected function viewsComments($id, $start, $end)
    {
        $sql = "SELECT * FROM `comments` WHERE `blog_id` = ? ORDER BY `comment_id` DESC LIMIT $start, $end";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function countsComments($id)
    {
        $sql = "SELECT * FROM `comments` WHERE `blog_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    protected function deletesComment($id)
    {
        $sql = "DELETE FROM comments WHERE `comment_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$id]);
        return $result;
    }
}
