<?php
include_once "blog.class.php";
class BlogContr extends Blog
{
    //-----------------------DEALS WITH THE BLOG CATEGORY ---------------------------------------//
    public function addCategory($name)
    {
        return $this->addsCategory($name);
    }

    public function viewCategories()
    {
        return $this->viewsCategories();
    }

    public function countCategory()
    {
        return $this->countsCategory();
    }

    public function deleteCategory($id)
    {
        return $this->deletesCategory($id);
    }

    public function editCategory($id, $name)
    {
        return $this->editsCategory($id, $name);
    }

    //-----------------------DEALS WITH THE ACTUAL BLOG CATEGORY ---------------------------------------//
    public function addBlog($cat, $title, $author, $image, $content, $date)
    {
        return $this->addsBlog($cat, $title, $author, $image, $content, $date);
    }

    public function editBlog($cat, $title, $author, $image, $content, $date, $cat_id)
    {
        return $this->editsBlog($cat, $title, $author, $image, $content, $date, $cat_id);
    }

    public function viewBlog()
    {
        return $this->viewsBlog();
    }

    public function viewBlogWithLimit($start, $end)
    {
        return $this->viewsBlogWithLimit($start, $end);
    }

    public function viewBlogById($id)
    {
        return $this->viewsBlogById($id);
    }

    public function countBlog()
    {
        return $this->countsBlog();
    }

    public function viewBlogAndCategory($id, $start, $end)
    {
        return $this->viewsBlogAndCategory($id, $start, $end);
    }

    public function countBlogAndCategory($id)
    {
        return $this->countsBlogAndCategory($id);
    }

    public function deleteBlog($id)
    {
        return $this->deletesBlog($id);
    }

    // ------------------------- THIS PART DEALS WITH THE COMMENTING PROCESS -------------------------
    public function commentBlog($blog_id, $name, $email, $comment)
    {
        return $this->commentsBlog($blog_id, $name, $email, $comment);
    }

    public function viewComments($blog_id, $start, $end)
    {
        return $this->viewsComments($blog_id, $start, $end);
    }
    public function countComments($blog_id)
    {
        return $this->countsComments($blog_id);
    }

    public function deleteComment($id)
    {
        return $this->deletesComment($id);
    }
}
