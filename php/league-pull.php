<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <style>

      * {
        margin:0;
        padding:0;
      }

      body {
        font-family: Arial, Helvetica, sans-serif;
        background-color: #222;
        margin:0;
        padding:0;
      }
      table.clantable {
        border-collapse: separate;
        border-spacing: 0px;
        width:100%;
        background-color: #222;
      }
      table.clantable tr td {
        border-bottom: solid #000 1px;
        color: #fff;
        font-size: 1em;
        font-weight: bold;
        text-shadow: 1px 1px 0px #000;
        padding-top: 5px;

      }
      table.clantable tr:first-child td:nth-child(3n+1) {

      }
      table.clantable tr:first-child td:first-child {
        text-align: center;
      }
      table.clantable tr:first-child td:last-child {
        width: 20em;
      }
      table.clantable tr:first-child td:nth-child(2) {
        color: #fff;
        font-size: 2em;
        font-weight: bold;
        text-shadow: 1px 1px 0px #000, -1px 1px 0px #000, 1px -1px 0px #000, -1px -1px 0px #000 ;
        padding-top: 5px;
        white-space: nowrap;
        text-align: left;
        padding-right: 50px;
        vertical-align: bottom;
      }
      table.clantable tr:first-child td:nth-child(3) {
        color: #fff;
        font-size: 1em;
        font-weight: bold;
        white-space: nowrap;
      }
      table.clantable tr:nth-child(1n+2) td {
        border-bottom: solid #000 1px;
        color: #fff;
        font-size: 1em;
        font-weight: bold;
        text-shadow: 1px 1px 0px #000;
        padding-top: 5px;
        white-space: nowrap;
      }
      table.clantable tr:nth-child(1n+2) td:first-child {
        text-align: center;
      }
      table.clantable tr:nth-child(1n+2) td:last-child {

      }
      table.clantable tr:first-child > td:first-child {

      }
      table.clantable tr:first-child > td:last-child {

      }
      table.clantable .clanlevel {
        color: #fff;
        font-size: 1em;
        font-weight: bold;
        background-color: #000;
        padding: 3px;
      }
      #back-container {
        height:50px;
        width:100%;
        background-color: #222;
        border-bottom: 1px solid #fff;
      }
      #back-btn {
        height:50px;
        width:10%;
        background-color: #222;
        border-bottom: 1px solid #fff;
      }
      #back-btn:hover {
        height:50px;
        width:10%;
        background-color: #000;
        border-right: 1px solid #fff;
      }

      #back-btn p {
        color:#fff;
        text-align: center;
        padding:15px;
      }

      #desc-style {
        padding:20px 0 0 20px;
      }

      #clan-level-style {
        text-align: center;
        width:20%;
      }

      #align-left {
        text-align: left;
        width:20%;
      }
      </style>
<?php
$clantag = $_POST["clan-tag"];

$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6ImQwOTlkNGFjLWZmMWMtNDM5ZS04M2IyLTBhNGRmNTg3MTEwMyIsImlhdCI6MTU3ODAxMzkzMSwic3ViIjoiZGV2ZWxvcGVyLzFlYzE2ZjhhLTY5YzUtYWMxNy1kZDJhLTViN2E3M2M0N2U2YiIsInNjb3BlcyI6WyJjbGFzaCJdLCJsaW1pdHMiOlt7InRpZXIiOiJkZXZlbG9wZXIvc2lsdmVyIiwidHlwZSI6InRocm90dGxpbmcifSx7ImNpZHJzIjpbIjcxLjM0LjEwOS4xMTgiXSwidHlwZSI6ImNsaWVudCJ9XX0.JZyud6_EKTLSlveUO6Ylcqg4jbgq4vA3GEipsjRQb_zlEzNGQq6FwdeXX2OjfAmz-640cDtTjR_GA4vhjtwVlg";

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

if (isset($data["reason"])) {
  $errormsg = true;
}

$members = $data["memberList"];

?>
  <title><?php echo $data["name"]; ?></title>
</head>
<body>
<?php
  if (isset($errormsg)) {
    echo "<p>", "Failed: ", $data["reason"], " : ", isset($data["message"]) ? $data["message"] : "", "</p></body></html>";
    exit;
  }
?>

<div id="back-container"><div id="back-btn"><p>< BACK</p></div></div>

  <table class="clantable">
    <tr>
      <td id="clan-level-style" rowspan="11"><span class="clanlevel">Clan level : <?php echo $data["clanLevel"]; ?></span><br/><img src="<?php echo $data["badgeUrls"]["medium"]; ?>" alt="<?php echo $data["name"]; ?>"/></td>
      <td><?php echo $data["name"]; ?></td><td><?php echo $data["tag"]; ?></td>
      <td id="desc-style" rowspan="11"><?php echo $data["description"]; ?></td>
    </tr>
    <tr>
      <td id="align-left">Total points</td><td><?php echo $data["clanPoints"]; ?></td>
    </tr>
    <tr>
      <td id="align-left">Wars won</td><td><?php echo $data["warWins"]; ?></td>
    </tr>
    <tr>
      <td id="align-left">War win streak</td><td><?php echo $data["warWinStreak"]; ?></td>
    </tr>
    <tr>
      <td id="align-left">Wars drawn</td><td><?php echo $data["warTies"]; ?></td>
    </tr>
    <tr>
      <td id="align-left">Wars lost</td><td><?php echo $data["warLosses"]; ?></td>
    </tr>
    <tr>
      <td id="align-left">Members</td><td><?php echo $data["members"]; ?>/50</td>
    </tr>
    <tr>
      <td id="align-left">Type</td><td><?php echo $data["type"]; ?></td>
    </tr>
    <tr>
      <td id="align-left">Required trophies</td><td><?php echo $data["requiredTrophies"]; ?></td>
    </tr>
    <tr>
      <td id="align-left">War frequency</td><td><?php echo $data["warFrequency"]; ?></td>
    </tr>
    <tr>
      <td id="align-left">Clan location</td><td><?php echo $data["location"]["name"]; ?></td>
    </tr>
  </table>
  <table class="clantable">
<?php
  foreach ($members as $member) {
?>
    <tr>
      <td><?php echo $member["clanRank"], "(", $member["previousClanRank"], ")"; ?></td>
      <td><img src="<?php echo $member["league"]["iconUrls"]["tiny"]; ?>" alt="<?php echo $member["league"]["name"]; ?>"/></td>
      <td><?php echo $member["expLevel"]; ?></td>
      <td><?php echo "<b>", $member["name"], "</b><br/>", $member["role"]; ?></td>
      <td>Donated:<br/><?php echo $member["donations"]; ?></td>
      <td>Received:<br/><?php echo $member["donationsReceived"]; ?></td>
      <td>Trophies:<br/><?php echo $member["trophies"]; ?></td>
    </tr>
<?php
  }
?>
  </table>

<script>

function goBack() {
  window.location.href = "clan-search.html";
}

  document.getElementById("back-btn").addEventListener("click", goBack);

</script>

</body>
</html>
