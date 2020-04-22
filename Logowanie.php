<?php


?>
<p>Zaloguj się: </p>
        <form method="POST">
            <p>Podaj nick:</p>
            <input type="text" name="nick">
            <p>Podaj Hasło</p>
            <input type="password" name="haslo"><br><br>
            <input type="submit" value="Zaloguj" name="zaloguj">
        </form>
<?php
include 'PolaczBaza.php';
if(isset($_POST['nick'])){
    if($_POST['zaloguj']='Zaloguj'){
        $sql="SELECT Nick FROM Uzytkownicy WHERE Nick = '".$_POST['nick']."';";
        if(mysqli_num_rows(mysqli_query($mysqli,$sql))){
            $sql2="SELECT Haslo FROM Uzytkownicy WHERE Nick = '".$_POST['nick']."';";
            $wynik=[];
            if($haslo=mysqli_query($mysqli,$sql2)){
            {
                  $rowcount=mysqli_num_rows($haslo);
                  if($rowcount > 0) {
                    while($row=mysqli_fetch_assoc($haslo)) { 
                
                       $wynik[] = $row['Haslo']; 
                    } 
                  }
                  mysqli_free_result($haslo);
                  }
            }
            if($_POST['haslo']==$wynik[0]){
                $_SESSION['zalogowany']=1;
                require 'Postac.php';
                $sql="SELECT Klasa FROM Uzytkownicy WHERE Nick ='".$_POST['nick']."';";
                $rezultat =mysqli_num_rows(mysqli_query($mysqli,$sql));
                $wynik2 = array();
                if ($result=mysqli_query($mysqli,$sql))
                  {
                  $rowcount=mysqli_num_rows($result);
                  if($rowcount > 0) {
                    while($row=mysqli_fetch_assoc($result)) { 
                
                       $wynik2[] = $row['Klasa']; 
                    } 
                  }
                  mysqli_free_result($result);
                  }
                
                $_SESSION['postac']=$_POST['nick'];
                $_SESSION['klasa']=$wynik2[0];
                echo("<script>location.href = '/gra/gra.php?par=zalogowany';</script>");
                
            }
            else{
                echo 'Podałeś złe Hasło lub login';
            }
                
        }
        else{
            echo 'Podałeś złe Hasło lub login';
        }
    }
}



?>