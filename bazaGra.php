<?php
include 'PolaczBaza.php';
$sql2="SELECT * FROM Uzytkownicy";
$wynik2 = array();
if ($result=mysqli_query($mysqli,$sql2))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  // Free result set
  if($rowcount > 0) {
    while($row=mysqli_fetch_assoc($result)) { 

       $wynik2[] = $row['Nick']; 
    } 

    
  }
  mysqli_free_result($result);
  }
    if(isset($_POST['nick'])){
        if($_POST['utworz']=='Utworz'){
            $haslo=$_POST['haslo'];
            $sql="SELECT Nick FROM Uzytkownicy WHERE Nick = '".$_POST['nick']."';";
                 if(mysqli_num_rows(mysqli_query($mysqli,$sql)) == 0 ){
                     $wyrazenie = '/^[a-zA-Z0-9\.\-_]{2,10}$/D';
                     if(preg_match($wyrazenie, $_POST['nick'])){
                         $haselo='/^[a-zA-Z0-9]{6,24}$/i';
                         if(preg_match($haselo, $_POST['haslo'])){
                            $resultat = "INSERT INTO Uzytkownicy VALUES (NULL,'".$_POST['nick']."','".$haslo."', '".$_POST['gender']."')";
                            mysqli_query($mysqli, $resultat);
                            echo("<script>location.href = '/gra/gra.php?par=utworzone';</script>");
                           echo 'Udało Ci się utworzyć użytkownika';
                         }
                         else{
                             echo "Twoje hasło musi zawierać minimum 6 znaków! litery albo 
                cyfry.";
                         }
                     }
                     else{
                         echo "Twój nick może zawierać tylko litery a-z i cyfry, a także 2-10 znaków";
                     }
                  }
              
                  else{
                      echo 'Użytkownik z takim loginem już istnieje!';
                      
                  }
        }
    }


?>