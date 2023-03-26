<?php

$id = $_GET['id'];

$str = strval($id);
$series = substr($str, 0, 2);
$lotno = substr($str, 2, 3);
$number = substr($str, 5, 12);

$data = array(
    "name"=> "NFT LOTTO",
    "description"=> "https://fhunn.com/",
    "image" => "https://nft.fhunn.com/i/".$id,
    "attributes" => array(
        "SERIES"=> $series,
        "LOT NO."=> $lotno,
        "NUMBER"=> $number
    )

);


header("Content-Type: application/json");
echo json_encode($data);

exit;
?>