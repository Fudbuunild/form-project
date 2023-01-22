<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

$data = $_POST;

    fetch($data['address_1'], $data['address_2'], $data['city'], $data['state'], $data['zip-code']);

    function fetch($address1, $address_2 = "", $city = "", $state = "", $zipCode = "")
    {
//        you need to put your userId in USERDID
        $input_data = '<AddressValidateRequest USERID="use_your"> 
        <Revision>1</Revision>
        <Address ID="0">
        <Address1>' . "$address1" . '</Address1>
        <Address2>' . "$address_2" . '</Address2>
        <City>' . "$city" . '</City>
        <State>' . "$state" . '</State>
        <Zip5>' . "$zipCode" . '</Zip5>
        <Zip4></Zip4>
        </Address>
        </AddressValidateRequest>';

        $fields = array(
            'API' => 'Verify',
            'XML' => $input_data
        );

        $url = 'http://production.shippingapis.com/ShippingAPITest.dll?' . http_build_query($fields);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 300);

        try {
            $response = new SimpleXMLElement(curl_exec($curl));
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $error = $response->Address->Error->Description;
                if ($error) {
                    echo json_encode(['error' => (string)$error]);
                } else {
                    echo json_encode([
                        'usps_address_1' => (string)$response->Address->Address1,
                        'usps_address_2' => (string)$response->Address->Address2,
                        'usps_city' => (string)$response->Address->City,
                        'usps_state' => (string)$response->Address->State,
                        'usps_zip-code' => (string)$response->Address->Zip5]);
                }

            }
        } catch (Exception $e) {
            echo "Exception";
            echo $e;
        }
}

if ($_POST['save_data']) {
    $host = 'localhost:3301';
    $db = 'validation-form';
    $user = 'root';
    $pass = 'root';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;$charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    $pdo = new PDO($dsn, $user, $pass, $opt);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db`;
                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;")
    or die(print_r($pdo->errorInfo(), true));

    $pdo->query("use `validation-form`");
    $pdo->exec("CREATE TABLE IF NOT EXISTS `information` (
                        `id` INT AUTO_INCREMENT NOT NULL,
                        `address1` varchar(100),
                        `address2` varchar(100),
                        `city` varchar(100),
                        `state` varchar(100),
                        `zip_code` INT NOT NULL,
                        PRIMARY KEY (`id`))
                        CHARACTER SET utf8 COLLATE utf8_general_ci");

    $dataSave = [
        'address1' => $data['address_1'], 'address2' => $data['address_2'], 'city' => $data['city'], 'state' => $data['state'], 'zip_code' => $data['zip-code']
    ];
    $sql = "INSERT INTO information (address1, address2, city, state, zip_code) VALUES (:address1, :address2, :city, :state, :zip_code)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute($dataSave);
}