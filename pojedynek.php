<?php
if($_SESSION['zalogowany']==1){
    include 'PolaczBaza.php';
    include 'Postac.php';
    echo "Wybierz swojego przeciwnika!<br>";
    $sql2="SELECT Nick, Klasa FROM Uzytkownicy;";
        $wynik=[];
        if($haslo=mysqli_query($mysqli,$sql2)){            
            $rowcount=mysqli_num_rows($haslo);
                if($rowcount > 0) {
                    while($row=mysqli_fetch_assoc($haslo)) { 
                
                       $wynik[] = $row['Nick'];
                       $wynik2[] = $row['Klasa'];
                    } 
                  }
                  mysqli_free_result($haslo);
            }
     echo "<form method='POST'>";
    for($i=0; $i<count($wynik);$i++){
        $postac = new $wynik2[$i]($wynik[$i],$wynik2[$i]);

        echo "<button style='float:left; width:300px; height:520px; margin-left:5px; margin-top:5px; border:1px solid;' value='walczy' name='walczy'><p>".$postac."</p></button>";
    }
    echo "</form>";
    if(isset($_POST['walczy'])){
        if($_POST['walczy']=='walczy'){
         echo("<script>location.href = '/gra/gra.php?par=walka';</script>");
         
        }
    }
}
?>