<?php

    
    function getOwnerByEmail(string $email) {
        require'configuration.php';
        $sql = "select * from Homeowner where email_address = \"{$email}\" ";
        $query = mysqli_query($connection, $sql); 
        return mysqli_fetch_assoc($query);
    }
 //
    function getSeekerByEmail(string $email) {
        require'configuration.php';
        $sql = "select * from HomeSeeker where email_address = \"{$email}\" ";
        $query = mysqli_query($connection, $sql); 
        return mysqli_fetch_assoc($query);
    }

    function getOwnerByID(int $id){
        require'configuration.php';
        $sql = "select * from Homeowner where id = {$id} ";
        $query = mysqli_query($connection, $sql); 
        return mysqli_fetch_assoc($query);
    }
    
    function getApplications(int $ownerID) {
        require'configuration.php';
        $sql = "SELECT 
            Property.name, 
            Property.location, 
            concat(HomeSeeker.first_name, HomeSeeker.last_name) AS applicant, 
            ApplicationStatus.status,
            Property.id AS property_id,
            HomeSeeker.id AS seeker_id,
            app.id as app_id    
        from RentalApplication AS app

        JOIN Property ON Property.id = app.property_id
        JOIN HomeSeeker ON HomeSeeker.id = app.home_seeker_id
        JOIN ApplicationStatus ON ApplicationStatus.id = app.application_status_id
        JOIN Homeowner ON Homeowner.id = Property.homeowner_id
        
        WHERE Homeowner.id = {$ownerID};";

        $query = mysqli_query($connection, $sql); 
        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    function getUnrented(int $ownerID) {
        require'configuration.php';
        $sql = "SELECT 
            Property.name, 
            PropertyCategory.category,
            Property.rent_cost, 
            Property.rooms,
            Property.location,
            Property.id
        FROM Property  
        JOIN PropertyCategory on PropertyCategory.id = Property.property_category_id
        WHERE Property.homeowner_id = {$ownerID}
        AND NOT EXISTS(
            SELECT * FROM RentalApplication
            WHERE RentalApplication.property_id = property.id
            AND RentalApplication.application_status_id = 2
        )";

        $query = mysqli_query($connection, $sql); 
        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }


 require 'configuration.php';

    if(isset($_GET['updateApp'])){
        $app_id = $_GET['updateApp'];
        $state_id = $_GET['state'];

        $sql = " UPDATE RentalApplication SET application_status_id = '$state_id' WHERE id = '$app_id' ";
        $query = mysqli_query($connection, $sql);
        
        if($state_id == 2){
            $sql = "SELECT property_id FROM RentalApplication WHERE id = $app_id";
            $query = mysqli_query($connection, $sql);
            $prop_id = mysqli_fetch_assoc($query)['property_id'];
            $sql = "UPDATE RentalApplication SET Application_status_id = 3
            WHERE id != $app_id AND property_id = $prop_id;";
            
            $query = mysqli_query($connection, $sql);
        }

        header('location:HomeOwner.php');
    }
    
    if(isset($_GET['delProp'])){
        $prop_id = $_GET['delProp'];
        $sql = "DELETE FROM propertyimage WHERE property_id = $prop_id";
        $query = mysqli_query($connection, $sql);

        $sql = "DELETE FROM rentalapplication WHERE property_id = $prop_id";
        $query = mysqli_query($connection, $sql);
        
        $sql = "DELETE FROM property WHERE id = $prop_id;";
        $query = mysqli_query($connection, $sql);
        
        header('location:HomeOwner.php');
    }
    if(isset($_GET['delImg'])){
       $proid= $_GET['propertyID'];
        $imgpath =$_GET['delImg'];
        unlink("uploads//$imgpath");
       header("location:EditProperty.php?propertyID='.$proid'");
    }

?>
