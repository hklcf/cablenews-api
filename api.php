<?php
$channel = isset($_GET['channel']) ? htmlspecialchars($_GET['channel']) : 1;
if($channel == 1) {
  $channel_no = '_9'; // 新聞台HD
} elseif($channel == 2) {
  $channel_no = '_10'; // 直播新聞台
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://mobileapp.i-cable.com/iCableMobile/API/api.php?method=streamingGenerator');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "quality=l&network=wifi&type=live&channel_no=".$channel_no);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if(curl_errno($ch)) {
  echo 'Error:' . curl_error($ch);
}
curl_close($ch);
echo $result;
?>
