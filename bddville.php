<?php
   
   try
   {
   $bdd = new PDO("mysql:host=localhost;dbname=bd_normal;charset=utf8", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
       }
   catch (Exception $e)
       {
   die("Erreur : " . $e->getMessage());
   }

$ville=isset($_GET['id'])? $_GET['id'].'%':"" ;
$cp=isset($_GET['cp'])?$_GET['cp'].'%':"";

if($ville!=""){

    $sth2 = 'SELECT ville_nom, ville_code_postal as postal FROM villes WHERE ville_nom LIKE "'.$ville.'" ORDER BY ville_nom ASC LIMIT 30';
    $reponse = $bdd->query($sth2);
    
    $donnees=$reponse->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($donnees);
    }
if($cp!=""){

    $sth2 = 'SELECT ville_nom, ville_code_postal as postal FROM villes WHERE ville_code_postal LIKE "'.$cp.'" ORDER BY ville_code_postal ASC LIMIT 30';
    $reponse = $bdd->query($sth2);
    
    $donnees=$reponse->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($donnees);
}

?>