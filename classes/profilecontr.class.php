<?php
include_once "profile.class.php";
class ProfileContr extends Profile
{
    // This function passes data to change the password
    public function  changePassword($user_id, $old_pass, $new_pass)
    {
        return $this->changesPassword($user_id, $old_pass, $new_pass);
    }

    // This function passes data to change the address
    public function changeAddress($name, $district, $box, $email, $phone, $mpamba, $airtel)
    {
        return $this->changesAddress($name, $district, $box, $email, $phone, $mpamba, $airtel);
    }

    // This function views the company address
    public function viewAddress()
    {
        return $this->viewsAddress();
    }

    // This function views the districts
    public function viewDistricts()
    {
        return $this->viewsDistricts();
    }

    // This function views the district
    public function viewDistrict($id)
    {
        return $this->viewsDistrict($id);
    }
    //These functions pass terms and conditions
    public function changeCustomerTerms($customer)
    {
        return $this->changesCustomerTerms($customer);
    }

    public function changeLandlordTerms($landlord)
    {
        return $this->changesLandlordTerms($landlord);
    }

    // This function views the company address
    public function viewTerms()
    {
        return $this->viewsTerms();
    }

    // this function changes the about page
    public function changeAbout($about)
    {
        return $this->changesAbout($about);
    }

    // This function views the company address
    public function viewAbout()
    {
        return $this->viewsAbout();
    }

    // this function changes the social media URLs
    public function changeUrls($whatsapp, $facebook, $instagram, $twitter)
    {
        return $this->changesUrls($whatsapp, $facebook, $instagram, $twitter);
    }

    // This function views the company address
    public function viewUrls()
    {
        return $this->viewsUrls();
    }
}
