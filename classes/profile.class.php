<?php
include_once "dbh.class.php";
class Profile extends Dbh
{
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

    protected function changesAddress($name, $district, $box, $email, $phone, $mpamba, $airtel)
    {
        $sql1 = "UPDATE company_address SET `company_name` = ?, `postal_box` = ?, `district` = ?, `email` = ?, `phone` = ?, `mpamba` = ?, `airtel_money` = ?";
        $stmt1 = $this->connect()->prepare($sql1);
        $result = $stmt1->execute([$name, $box, $district, $email, $phone, $mpamba, $airtel]);
        if ($result) {
            return $msg = "Address changed successfully!";
        } else {
            return $msg =  "Error, you can't change the address!";
        }
    }

    protected function viewsAddress()
    {
        $sql = "SELECT * FROM `company_address`";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }

    protected function viewsDistricts()
    {
        $sql = "SELECT * FROM `districts`";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }

    protected function viewsDistrict($id)
    {
        $sql = "SELECT * FROM `districts` WHERE `district_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    protected function changesCustomerTerms($customer)
    {
        $sql1 = "UPDATE company_terms SET `customer` = ?";
        $stmt1 = $this->connect()->prepare($sql1);
        $result = $stmt1->execute([$customer]);
        if ($result) {
            return $msg = "Terms and Conditions changed successfully!";
        } else {
            return $msg =  "Error, you can't change the Terms and Conditions!";
        }
    }

    protected function changesLandlordTerms($landlord)
    {
        $sql1 = "UPDATE company_terms SET `landlord` = ?";
        $stmt1 = $this->connect()->prepare($sql1);
        $result = $stmt1->execute([$landlord]);
        if ($result) {
            return $msg = "Terms and Conditions changed successfully!";
        } else {
            return $msg =  "Error, you can't change the Terms and Conditions!";
        }
    }

    protected function viewsTerms()
    {
        $sql = "SELECT * FROM `company_terms`";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }

    protected function changesAbout($about)
    {
        $sql1 = "UPDATE company_about SET `about` = ?";
        $stmt1 = $this->connect()->prepare($sql1);
        $result = $stmt1->execute([$about]);
        if ($result) {
            return $msg = "About page changed successfully!";
        } else {
            return $msg =  "Error, you can't change the about page!";
        }
    }

    protected function viewsAbout()
    {
        $sql = "SELECT * FROM `company_about`";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }

    protected function changesUrls($whatsapp, $facebook, $instagram, $twitter)
    {
        $sql1 = "UPDATE company_urls SET `whatsapp` = ?, `facebook` = ?, `instagram` = ?, `twitter` = ?";
        $stmt1 = $this->connect()->prepare($sql1);
        $result = $stmt1->execute([$whatsapp, $facebook, $instagram, $twitter]);
        if ($result) {
            return $msg = "Social Media URLs changed successfully!";
        } else {
            return $msg =  "Error, you can't change the Social Media URLs!";
        }
    }

    protected function viewsUrls()
    {
        $sql = "SELECT * FROM `company_urls`";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
}
