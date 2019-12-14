<?php
header('Content-Type: text/html; charset=UTF-8');

$clantag = "#8Y8RJ2CC";

$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6IjE0NjYxZWJlLTc1YzQtNDg0Ny05NmI3LTQ0NzJkZmZjOWU0ZiIsImlhdCI6MTU3NTc5NDAxNiwic3ViIjoiZGV2ZWxvcGVyLzFlYzE2ZjhhLTY5YzUtYWMxNy1kZDJhLTViN2E3M2M0N2U2YiIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjk3LjExNS4yMjguMTAwIl0sInR5cGUiOiJjbGllbnQifV19.aJ04xKT6eQt84w8kpdQunYRS1fdOq-AHruZ1rDTDpRV0wPvgk0GWtHrcHGfX909w8mFuTyO0bv090cwPKCQtoQ";

$url = "https://api.clashofclans.com/v1/clans/" . urlencode($clantag);

$ch = curl_init($url);

$headr = array();
$headr[] = "Accept: application/json";
$headr[] = "Authorization: Bearer ".$token;

curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$res = curl_exec($ch);
$data = json_decode($res, true);
curl_close($ch);

echo "<pre>";
var_dump($data);
echo "</pre>";
?>
