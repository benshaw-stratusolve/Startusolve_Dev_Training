<?php

$fut = [
    [
        "name" => "Benjamin Shaw", "club" => "Manchester United", "position" => "RB", "goals" => 23
    ],
    [
        "name" => "Cole Palmer", "club" => "Chelsea", "position" => "CAM", "goals" => 20
    ],
    [
        "name" => "Robbie Cole", "club" => "Leister City", "position" => "CB", "goals" => 2
    ],
    [
        "name" => "Erling Haaland", "club" => "Manchester City", "position" => "ST", "goals" => 36
    ],
    [
        "name" => "Mohamed Salah", "club" => "Liverpool", "position" => "RW", "goals" => 28
    ],
    [
        "name" => "Bukayo Saka", "club" => "Arsenal", "position" => "RW", "goals" => 17
    ],
    [
        "name" => "Marcus Rashford", "club" => "Manchester United", "position" => "LW", "goals" => 8
    ],
    [
        "name" => "Harry Kane", "club" => "Bayern Munich", "position" => "ST", "goals" => 44
    ]
];

?>

<?php

function filterByPosition($fut){
    if ($fut['position'] === "RW"){
        return "position: " . $fut['position'] . "\n" . $fut['name'];
    }
    elseif ($fut['position'] === "ST"){
        return "position: " . $fut['position'] . "\n" . $fut['name'];
    }
    elseif ($fut['position'] === "LW"){
        return "position: " . $fut['position'] . "\n" . $fut['name'];
    }
    elseif ($fut['position'] === "RB"){
        return "position: " . $fut['position'] . "\n" . $fut['name'];
    }
}

?>

<?php

echo filterByPosition($fut);

?>
