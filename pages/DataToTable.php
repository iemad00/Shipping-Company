<?php
    $sql = "SELECT * FROM package,user WHERE user.id = $userID AND package.userID = user.id ORDER BY package.date DESC";
    $result = mysqli_query($conn, $sql);
    if($result){
    while($row = mysqli_fetch_assoc($result)){
        $packageNb = $row['packageNb'];

        $weight = $row['weight'];
        $height = $row['height'];
        $width = $row['width'];
        $packageType =  $row['packageType'];
        $length = $row['length'];
        $destination = $row['destination'];
        $dimensionalWeight = ($height*$width*$length)/5000;
        $shippingWeight = (int)max($weight,$dimensionalWeight);
        if($shippingWeight > 2){
            $price = 60 + (($shippingWeight-2) * 15);
        }
        else{
            $price = 30*$shippingWeight;
        }

        $price = (string)$row['price'];
        $price .= "$";
        $date = $row['date'];
        $paid =  $row['paid'];

        $findStatus = "SELECT * FROM `transportationEvent` WHERE packageNb = $packageNb ORDER BY DATE DESC LIMIT 1";
        $result2 = mysqli_query($conn, $findStatus);
        $row2 = mysqli_fetch_assoc($result2);
        if(mysqli_num_rows($result2) > 0){
          $status = $row2['status'];
        }else{
          $status = 'In Process';
        }

        $option = "";
        if($paid == "Yes"){
            $option = "disabled";
            $paid = "Confirmed";
        }else{
            $paid = "Not Paid";
        }

        echo '   
        <tr>
        <th scope="row">'.$packageNb.'</th>
        <td>'.$shippingWeight.'</td>
        <td>'.$destination.'</td>
        <td>'.$packageType.'</td>
        <td>'.$price.'</td>
        <td>'.$paid.'</td>
        <td>'.$date.'</td>
        <td>'.$status.'</td>
        <td>
        <button class="btn btn-primary"><a href="trackPackage.php?packageID='.$packageNb.'" class="operation-btn text-light" style="">Track Package</a></button> 
        <button class="btn btn-success '.$option.'"><a href="pay.php?packageID='.$packageNb.'" class="operation-btn text-light" style="">Pay</a></button> 


        
        </tr>     
        ';
    }
    }
    ?>