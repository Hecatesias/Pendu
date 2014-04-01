<?php

//Recuperation aléatoire du mot à trouver
$fichier = file("dictionnaire.txt");
$cut = explode(" ", $fichier[0]);
$rand = rand(0, count($cut)); 

$lemot = $cut[$rand];

for ($i=0; isset($lemot[$i]); $i++) 
	{ 
	$mot[$lemot[$i]] = "0";
	}
//Nombres de tours à jouer
$chance = 10;

//Prompt
while (true)
{
	affichage($mot);
	echo "Chances restantes : $chance\n\n";
	$lettre = readline("Proposez une lettre : ");
	$lettre = strtoupper($lettre);
	echo "-----------\n";
	$mot = update_mot($mot, $lettre);
	$chance = update_chance($mot, $lettre, $chance);
	$gagner = check_gagner($mot);
	if ($chance == 0)
	{
		echo "Dommage, le mot était : ".$lemot." ! Vous êtes pendu ! \n\n
*----------\
||       __|__
||      |     |
||      | X X |
||      |_____|
||     ____|____
||   /|         |\
||  / |         | \
|| /  |         |  \
||    |_________|
||        /\
||       /  \
||      /    \
||   __/      \__
||
|\___________
|____________\\\n";
		exit;
	}
	if ($gagner == "gagner")
	{
		affichage($mot);
		echo "Bravo vous avez gagné ! \n\n

       __|__
      | * * |
      |     |
 \    |_\_/_|    /
  \  ____|____  /
   \|         |/
    |         | 
    |         |  
    |_________|
        /\
       /  \
      /    \
   __/      \__
\\\n";
		exit;		
	}
}

function affichage($mot)
{
	echo "\nTrouvez ce mot : ";
	foreach ($mot as $key => $value) 
	{
		if ($value == "1")
			echo $key;
		else
			echo "_";
		echo " ";
	}
	echo "\n";
}

function update_mot($mot, $lettre)
{
	foreach ($mot as $key => $value) 
	{
		if ($key == $lettre)
			$mot[$key] = "1";
	}
	return $mot;
}

function update_chance($mot, $lettre, $chance)
{
	foreach ($mot as $key => $value) 
	{
		if ($key == $lettre)
			return $chance;
	}
	return ($chance - 1);
}

function check_gagner($mot)
{
	$gagner = "gagner";
	foreach ($mot as $key => $value) 
	{
		if ($value == "0")
			$gagner = "pasgagner";
	}
	return $gagner;
}

//function draw()
//{

//}
