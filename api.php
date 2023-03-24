<?php

// api.php

$headers = [
    "user-Agent: EX"
];


for ($i = 9000; $i < 9100; $i++) {
    $ch = curl_init("https://api.basisregisters.vlaanderen.be/v1/postinfo/$i");

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


    $responce = curl_exec($ch);
    curl_close($ch);



    $data = json_decode($responce, false);

    //foreach ($data as $staad) {
    // $place = new Place();



    ?>
    <pre> <?php
    print($i . '--->');
    var_dump($data);
    ;
    ?> </pre>
    <?php
    //  }

}