<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

$data = $_POST;

fetch($data['address_1'], $data['address_2'], $data['city'], $data['state'], $data['zip-code']);

function fetch($address1, $address_2 = "", $city = "", $state = "", $zipCode = "")
{
    $input_data = '<AddressValidateRequest USERID="105SELF02197">
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
                echo json_encode(['error' => (string) $error]);
            } else {
                echo json_encode([
                    'usps_address_1' => (string) $response->Address->Address1,
                    'usps_address_2' => (string) $response->Address->Address2,
                    'usps_city' => (string) $response->Address->City,
                    'usps_state' => (string) $response->Address->State,
                    'usps_zip-code' => (string) $response->Address->Zip5]);
            }

        }
    } catch (Exception $e) {
        echo "Exception";
        echo $e;
    }
}