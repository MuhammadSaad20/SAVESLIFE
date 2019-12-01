<?php
// Check whether token is not empty
if(!empty($_POST['token'])){
    
    // Token info
    $token  = $_POST['token'];
    
    // Card info
    $card_num = $_POST['card_num'];
    $card_cvv = $_POST['cvv'];
    $card_exp_month = $_POST['exp_month'];
    $card_exp_year = $_POST['exp_year'];
    
    // Buyer info
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneNumber = '555-555-5555';
    $addrLine1 = '123 Test St';
    $city = 'Columbus';
    $state = 'OH';
    $zipCode = '43123';
    $country = 'USA';
    
    // Item info
    $itemName = 'Premium Script CodexWorld';
    $itemNumber = 'PS123456';
    $itemPrice = '25.00';
    $currency = 'USD';
    $orderID = 'SKA92712382139';
    
    
    // Include 2Checkout PHP library
    require_once("2checkout-php/lib/Twocheckout.php");
    
    // Set API key
    Twocheckout::privateKey('C8CEA801-9B78-48A0-8706-B19CC8029F09');
    Twocheckout::sellerId('901416156');
    Twocheckout::sandbox(true);
    
    try {
        // Charge a credit card
        $charge = Twocheckout_Charge::auth(array(
            "merchantOrderId" => $orderID,
            "token"      => $token,
            "currency"   => $currency,
            "total"      => $itemPrice,
            "billingAddr" => array(
                "name" => $name,
                "addrLine1" => $addrLine1,
                "city" => $city,
                "state" => $state,
                "zipCode" => $zipCode,
                "country" => $country,
                "email" => $email,
                "phoneNumber" => $phoneNumber
            )
        ));
        
        // Check whether the charge is successful
        if ($charge['response']['responseCode'] == 'APPROVED') {
            
            // Order details
            $orderNumber = $charge['response']['orderNumber'];
            $total = $charge['response']['total'];
            $transactionId = $charge['response']['transactionId'];
            $currency = $charge['response']['currencyCode'];
            $status = $charge['response']['responseCode'];
            
            // Include database config file
            include_once 'dbConfig.php';
            
            // Insert order info to database
            $sql = "INSERT INTO orders(name, email, card_num, card_cvv, card_exp_month, card_exp_year, item_name, item_number, item_price, currency, paid_amount, order_number, txn_id, payment_status, created, modified) VALUES('".$name."', '".$email."', '".$card_num."', '".$card_cvv."', '".$card_exp_month."', '".$card_exp_year."', '".$itemName."', '".$itemNumber."','".$itemPrice."', '".$currency."', '".$total."', '".$orderNumber."', '".$transactionId."', '".$status."', NOW(), NOW())";
            $insert = $db->query($sql);
            $insert_id = $db->insert_id;
            
            $statusMsg = '<h2>Thanks for your Order!</h2>';
            $statusMsg .= '<h4>The transaction was successful. Order details are given below:</h4>';
            $statusMsg .= "<p>Order ID: {$insert_id}</p>";
            $statusMsg .= "<p>Order Number: {$orderNumber}</p>";
            $statusMsg .= "<p>Transaction ID: {$transactionId}</p>";
            $statusMsg .= "<p>Order Total: {$total} {$currency}</p>";
        }
    } catch (Twocheckout_Error $e) {
        $statusMsg = '<h2>Transaction failed!</h2>';
        $statusMsg .= '<p>'.$e->getMessage().'</p>';
    }
    
}else{
    $statusMsg = "<p>Form submission error...</p>";
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>2Checkout Payment Status</title>
<meta charset="utf-8">
</head>
<body>
<div class="container" style="background-color:lightgray">
  <?php echo $statusMsg; ?>
  <p><a href="pay.php">Back to Payment</a></p>
</div>
</body>
</html>