<?php

// Server credentials
$hst_hostname = 'happywheelspin.com';
$hst_port = '8083';
$hst_username = 'admin';
$hst_password = '96Pb1YsXfAFGeJ2KyERdzqMZtCajLV';
$hst_returncode = 'yes';
$hst_command = 'v-add-domain';

// Domain details
$username = 'admin';
$domain = 'mdfdhoitwheel089.jgdx.xyz';

// Prepare POST query
$postvars = array(
    'user' => $hst_username,
    'password' => $hst_password,
    'returncode' => $hst_returncode,
    'cmd' => $hst_command,
    'arg1' => $username,
    'arg2' => $domain,
    'CUSTOM_DOCROOT'=>'jgdx.xyz'

   

);

// Send POST query via cURL
$postdata = http_build_query($postvars);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://' . $hst_hostname . ':' . $hst_port . '/api/');
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
$answer = curl_exec($curl);

// Check result
if($answer === 0) {
    echo "Domain has been successfuly created\n";
} else {
    echo "Query returned error code: " .$answer. "\n";
}