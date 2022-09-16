<?php
include_once "manageuser.class.php";
class ManageUserContr extends ManageUser
{
    public function registerUser($fname, $lname, $phone, $phone2, $email, $pwd, $user_type)
    {
        return $this->registersUser($fname, $lname, $phone, $phone2, $email, $pwd, $user_type);
    }

    //This function manages the login data ------------------------------------------------------------------------>
    public function userLogin($email, $password)
    {
        return $this->loginUser($email, $password);
    }

    //This function views the users in the system ------------------------------------------------------------------>
    public function viewsUsers($type)
    {
        return $this->viewUsers($type);
    }

    //This function views the user in the system ------------------------------------------------------------------>
    public function viewsUser($id)
    {
        return $this->viewUser($id);
    }

    //This function counts the users in the system ------------------------------------------------------------------>
    public function countsUsers($type)
    {
        return $this->countUsers($type);
    }

    //This function edits the user status in the system ------------------------------------------------------------>
    public function editStatus($user_id, $status)
    {
        return $this->editsStatus($user_id, $status);
    }

    //This function deletes the user in the system ----------------------------------------------------------------->
    public function deleteUser($user_id)
    {
        return $this->deletesUser($user_id);
    }

    //This function checks the user in the system ----------------------------------------------------------------->
    public function checkUser($name, $email)
    {
        return $this->checksUser($name, $email);
    }

    //This function resets the password --------------------------------------------------------------------------->
    public function resetPassword($fname, $email, $password)
    {
        return $this->resetsPassword($fname, $email, $password);
    }

    // This function passes data to change the password
    public function  changePassword($user_id, $old_pass, $new_pass)
    {
        return $this->changesPassword($user_id, $old_pass, $new_pass);
    }
}
