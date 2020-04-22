<?php
include 'PolaczBaza.php';
 if(isset($_POST['nick'])){
        $sql="SELECT Nick FROM Uzytkownicy WHERE Nick = '".$_POST['nick']."';";
             if(mysqli_num_rows(mysqli_query($mysqli,$sql)) == 0 ){
                $resultat = "INSERT INTO Uzytkownicy VALUES (NULL,'".$_POST['nick']."','".$_POST['haslo']."', '".$_POST['gender']."')";
                mysqli_query($mysqli, $resultat);
                echo("<script>location.href = '/gra/gra.php?par=utworzone';</script>");
               echo 'Udało Ci się utworzyć użytkownika';
              }
          
              else{
                  echo 'Użytkownik z takim loginem już istnieje!';
                  
              }
    }
?>