<?php
include_once "dbh.class.php";
class ManageUser extends Dbh
{
    // FUNCTION TO MANAGE THE USER REGISTRATION *********************************************************************>
    protected function registersUser($fname, $lname, $phone, $phone2, $email, $pwd, $user_type)
    {

        $sql = "SELECT * FROM `users` WHERE `email` = ? OR `phone` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email, $phone]);

        //checking if the email and username are unavailable ----------------------------------------------------->
        if ($stmt->rowCount() > 0) {
            return $errorMsg[] = "Error, email or phone is already registered!";
        } else {

            //adding the user data into the database ----------------------------------------------------------------->

            $sql1 = "INSERT INTO users (`first_name`, `last_name`, `phone`, `phone_2`, `email`, `password`, `user_type`, `status`, `reg_date`) VALUES (?, ?, ?, ?, ?, ?, ?, 1, NOW())";
            $stmt1 = $this->connect()->prepare($sql1);
            $passwd = password_hash($pwd, PASSWORD_DEFAULT);

            $result = $stmt1->execute([$fname, $lname, $phone, $phone2, $email, $passwd, $user_type]);

            //Checking if the data was uploaded ----------------------------------------------------------------------->

            if ($result) {
                $sql2 = "SELECT * FROM `users` WHERE `email` = ? OR `phone` = ?";
                $stmt2 = $this->connect()->prepare($sql2);
                $stmt2->execute([$email, $phone]);
                $row = $stmt2->fetch();

                if ($stmt2->rowCount() > 0) {
                    session_start();
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['fname'] = $row['first_name'];
                    $user_type = $row['user_type'];
                    return header("location: $user_type/index.php");
                }
            } else {
                return $errorMsg[] = "Error, registration was not done!";
            }
        }
    }

    // FUNCTION TO MANAGE THE USER LOGIN ****************************************************************************>
    protected function loginUser($email, $password)
    {
        $sql = "SELECT * FROM `users` WHERE `email` = ? OR `phone` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email, $email]);
        $row = $stmt->fetch();

        if ($stmt->rowCount() > 0) {
            //checking if the account is active ----------------------------------------------------------------------->
            if ($row['status'] == 1) {
                //checking if the username is correct ----------------------------------------------------------------->
                if ($email == $row['email'] || $email == $row['phone']) {
                    //verifying the password --------------------------------------------------------------------------> 
                    if (password_verify($password, $row['password'])) {
                        session_start();
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['fname'] = $row['first_name'];
                        $user_type = $row['user_type'];
                        return header("location: $user_type/index.php");
                    } else {
                        return $errorMsg[] = "incorrect password";
                    }
                } else {
                    return $errorMsg[] = "incorrect email or Phone number";
                }
            } else {
                return $errorMsg[] = "Your account is deactivated";
            }
        } else {
            return $errorMsg[] = "incorrect email or phone number or password";
        }
    }

    // FUNCTION TO VIEW USER DETAILS ****************************************************************************>
    protected function viewUsers($type)
    {
        $sql = "SELECT * FROM users WHERE user_type = ? ORDER BY `user_id` DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$type]);
        return $stmt->fetchAll();
    }

    // FUNCTION TO VIEW USER DETAILS ****************************************************************************>
    protected function viewUser($id)
    {
        $sql = "SELECT * FROM users WHERE `user_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // FUNCTION TO COUNT USER DETAILS ****************************************************************************>
    protected function countUsers($type)
    {
        $sql = "SELECT * FROM users WHERE user_type = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$type]);
        return $stmt->rowCount();
    }

    // FUNCTION TO EDIT USER STATUS ****************************************************************************>
    protected function editsStatus($user_id, $status)
    {
        $sql = "UPDATE users SET `status` = ? WHERE `user_id` = ? ";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$status, $user_id]);
    }

    // FUNCTION TO DELETE ***************************************************************************************>
    protected function deletesUser($user_id)
    {
        $sql = "DELETE FROM users WHERE `user_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        if ($stmt->execute([$user_id])) {
            return true;
        } else {
            return false;
        }
    }

    // FUNCTION TO CHECK USER DETAILS ****************************************************************************>
    protected function checksUser($name, $email)
    {
        $sql = "SELECT * FROM `users` WHERE `first_name`=? and `email`=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $email]);
        $result = $stmt->rowCount();

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    // FUNCTION TO RESET PASSWORD *********************************************************************************>
    protected function resetsPassword($fname, $email, $password)
    {
        $pwd = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE `users` SET `password` = ? WHERE `first_name` = ? AND `email` = ?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$pwd, $fname, $email]);

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    protected function changesPassword($user_id, $old_pass, $new_pass)
    {
        $sql = "SELECT * FROM `users` WHERE `user_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        $row = $stmt->fetch();

        if ($stmt->rowCount() > 0) {
            if (password_verify($old_pass, $row['password'])) {
                $sql1 = "UPDATE users SET `password` = ? WHERE `user_id` = ? ";
                $stmt1 = $this->connect()->prepare($sql1);
                $password = password_hash($new_pass, PASSWORD_DEFAULT);
                $result = $stmt1->execute([$password, $user_id]);

                if ($result) {
                    return $msg = "Password changed successfully!";
                } else {
                    return $msg =  "Error, you can't change the password!";
                }
            } else {
                return $msg = "Incorrect password!";
            }
        } else {
            return $msg = "Error, you can't change the password!";
        }
    }
    
}
