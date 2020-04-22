<?php
session_start();
require 'PolaczBaza.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>GRA</title>
    <script src="jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <style>
        .zdjecie{
            position:relative;
            float:left;
            border:1px solid;
            margin-left:5px;
        }
        .img__description_layer {
          position: absolute;
          top: auto;
          bottom: 5px;
          width:auto;
          height:100px;
          left: 0;
          right: 0;
          background: rgba(0, 0, 0, 0.6);
          color: #fff;
          opacity: 1;
          display: flex;
          align-items: center;
          justify-content: center;
          
        }
        .zdjecie:hover{
            padding:5px;
            border:1px solid red;
        }
    </style>
</head>
<body>
    <?php
    setcookie("cookie[three]", "cookiethree");
	setcookie("cookie[two]", "cookietwo");
	setcookie("cookie[one]", "cookieone");
	$res = setcookie('cookie[one]', '', time() - 3600);
      $_SESSION['ekwipunek']=array('','','');
      if(isset($_SESSION['bron'])){
        $_SESSION['ekwipunek'][0]=$_SESSION['bron'];
      }
        if(isset($_SESSION['zbroja'])){
                  $_SESSION['ekwipunek'][1]=$_SESSION['zbroja'];
        }
        if(isset($_SESSION['buty'])){
                  $_SESSION['ekwipunek'][2]=$_SESSION['buty'];
        }
      
     function Wybor($bron,$obrazenia,$zbroja,$obrona,$buty,$unik, $poziom){
                
                require 'Postac.php';
                require 'Arena.php';
                ?>
                <p>Wybierz swoją broń!</p>
                <form method='POST' onclick="return true;">
                    <div class='zdjecie'><button name = 'bron' value='<?php echo $bron ?>' ><img src = 'images/<?php echo $bron ?>.png' width='300px' height='300px'></img><p class='img__description_layer'>+<?php echo $obrazenia ?> do obrażeń</p></button></div>
                    <div class='zdjecie'><button name = 'zbroja' value='<?php echo $zbroja ?>'><img src = 'images/<?php echo $zbroja ?>.png' width='300px' height='300px' ></img><p class='img__description_layer'>+<?php echo $obrona ?> do obrony</p></button></div>
                    <div class='zdjecie'><button name = 'buty' value='<?php echo $buty ?>'><img src = 'images/<?php echo $buty ?>.png' width='300px' height='300px' ></img><p class='img__description_layer'>+<?php echo $unik ?> do uniku obrażeń</p></button></div>
                </form>
             
                <?php
                
                    if(isset($_POST['bron'])){
                        if($_POST['bron']==$bron){
                           $_SESSION['bron1']=$bron;
                           $_SESSION['bron']="<img src='images/".$bron.".png' width='25px' height='30px' style='border:1px solid; margin-left:1px;'></img>";
                            $_SESSION['obrazenia']=$_SESSION['obrazenia']+$obrazenia;
                            echo("<script>location.href = '/gra/gra.php?par=$poziom';</script>");
                        }
                    }
                      
                    if(isset($_POST['zbroja'])){
                        if($_POST['zbroja']==$zbroja){
                            $_SESSION['zbroja']="<img src='images/".$zbroja.".png' width='25px' height='30px' style='border:1px solid; margin-left:1px;'></img>";
                            $_SESSION['obrona']=$_SESSION['obrona']+$obrona;
                            echo("<script>location.href = '/gra/gra.php?par=$poziom';</script>");
                        }
                    }
                    if(isset($_POST['buty'])){
                        if($_POST['buty']==$buty){
                           $_SESSION['buty']="<img src='images/".$buty.".png' width='25px' height='30px' style='border:1px solid; margin-left:1px;'></img>";
                           $_SESSION['unik']=$_SESSION['unik']+$unik;
                            echo("<script>location.href = '/gra/gra.php?par=$poziom';</script>");
                        }
                    }
                }
                function Walka($potwor, $przycisk,$dalej,$poziom){

                    require 'Arena.php';
                    require 'Postac.php';
                    echo "<section style='width:30%; height:30%; float:left;'>";
                    echo $_SESSION['postac']."<br>Życie: ".$_SESSION['zycie']."<br>Obrażenia: ".$_SESSION['obrazenia']."<br>Obrona: ".$_SESSION['obrona']."<br>Szansa na unik: ".$_SESSION['unik']."%<br>";
                    echo "<br>";
                    echo "<img src='images/".$_SESSION['klasa'].".png' width = '300px' height='300px'>";
                     echo "<progress id='health' value='".$_SESSION['zycie']."' max='".$_SESSION['zycie']."'></progress><p class='bohatera'>".$_SESSION['zycie']."</p></section>";
                    $szczur = new $potwor($potwor);
                    $obrazeniaPotwor=$szczur->obrazenia;
                    $obronaPotwor=$szczur->obrona;
                    $zyciePotwor=$szczur->zycie;
                    $_SESSION['tura']=1;
                    $zycieGracz=$_SESSION['zycie'];
                        
                    echo "<h1 style='position:absolute; left:50%;'>VS</h1>";
                    echo "<section id='walka' style='width:30%; height:30%; float:left'>";
                    echo "<img src='images/".$_SESSION['bron1'].".png' width='150px' height='150px' id='demo-image'></img>";
                    echo "<img src='images/Reka.png' width='150px' height='150px' id='demo-image2' style='display:none;'></img>";
                    
                    while($_SESSION['zycie'] > 0 || $zyciePotwor > 0){
                        
                        if($_SESSION['tura']==1){
                           // echo "<div class='walka2'><span><br><br><strong>Tura gracza</strong><br>";
                            $atak=$_SESSION['obrazenia']-$obronaPotwor;
                           // echo "Zadaje: ".$atak." obrażeń<br></span>";
                            $zyciePotwor=$zyciePotwor-$atak;
                           // echo "<span style='color:red;'>Życie Potwora: ".$zyciePotwor."<br></span></div>";
                            $_SESSION['tura']=0;
                             
                            
                        }
                        else if($_SESSION['tura']==0){
                          //  echo "<div class='walka2'><span><br><strong>Tura potwora</strong><br></span>";
                            $atak2=$obrazeniaPotwor-$_SESSION['obrona'];
                            //Naprawić uniki
                            $random=100;
                            if($random > $_SESSION['unik']){
                            //  echo "<span>Zadaje: ".$atak2." obrażeń<br></span>";
                               $_SESSION['zycie']=$_SESSION['zycie']-$atak2;
                             // echo "<span style='color:red;'>Życie gracza: ".$_SESSION['zycie']."</span></div>";
                             
                            }
                            else{
                               // echo "<div class='walka2''>Potwór nie trafia.<br></div>";
                            }
                            $_SESSION['tura']=1;
                        }
                        
                        if( $_SESSION['zycie'] <= 0 && $zyciePotwor > 0){
                        echo "<h1><br>Przegrałeś!</h1><br>Powrót na stronę główną: <a href = '/gra/gra.php?par=zalogowany'>Strona Główna</a>";
                        break;
                        }
                        else if($zyciePotwor <= 0 && $_SESSION['zycie'] > 0){
                            $_SESSION['poziom']=$poziom;
                            echo "<h1><p id='demo'>Wygrał gracz!</p></h1>";
                            echo "<button onclick='myFunction()'>Dalej</button>";
                            echo("<script>function myFunction() {location.href = '/gra/gra.php?par=".$dalej."';}</script>");                          
                            break;
                        }
                    }
         
                    echo "</section>";
                    echo "<section style='width:30%; height:30%; float:left;'>".$szczur."<br>";
                    echo "<img src='images/".$potwor.".png' width='300px' height = '300px'>";
                    echo "<progress id='health2' value='".$szczur->zycie."' max='".$szczur->zycie."'></progress><p class='text'>".$szczur->zycie."</p></section>";
                    $zyciePotwor=$szczur->zycie;
                    echo"<script>
                             $(document).ready(function (){
                             let health2 = document.getElementById('health2');
                             let health = document.getElementById('health');
                             var zyciePotwora = ".$zyciePotwor.";  
                             var zycieGracza=".$zycieGracz.";
                             walka();
                             
                             
                            function walka(){ 
                             zyciePotwora = zyciePotwora-".$atak.";
                                setTimeout(function(){
                                 $('#health2').val(zyciePotwora);
                                 $('p.text').text(health2.value);
                                 $('#demo-image').show();
                                	$('#demo-image').animate({  transform: 90 }, {
                                       step: function(now,fx) {
                                           $(this).css({
                                               '-webkit-transform':'rotate('+now+'deg)', 
                                               '-moz-transform':'rotate('+now+'deg)',
                                               'transform':'rotate('+now+'deg)'
                                           });
                                       }
                                      });
                                $('#demo-image').hide(1000);
                                    
                                 if(zyciePotwora>0){
                                     zycieGracza = zycieGracza-".$atak2.";
                                        setTimeout(function(){
                                         $('#health').val(zycieGracza);
                                         $('p.bohatera').text(health.value);
                                         $('#demo-image2').show();
                                        	$('#demo-image2').animate({  transform: -90 }, {
                                               step: function(now,fx) {
                                                   $(this).css({
                                                       '-webkit-transform':'rotate('+now+'deg)', 
                                                       '-moz-transform':'rotate('+now+'deg)',
                                                       'transform':'rotate('+now+'deg)'
                                                   });
                                               }
                                              });
                                        $('#demo-image2').hide(1000);
                                         if(zycieGracza>0){
                                             walka();
                                            }
                                         },2000)
                                 }
                                 },2000)
                            }

                            });</script>";
                }
                
                function pokazBron(){
                    if(isset($_SESSION['ekwipunek'])){
                        echo "Posiadasz w ekwipunku: ";
                        for($i=0; $i<count($_SESSION['ekwipunek']); $i++){
                            echo $_SESSION['ekwipunek'][$i]." ";
                        }
                        echo "<br>";
                    }
                }
    if(isset($_GET['par'])){
        if(!empty($_GET['par']=='utworzone')){
            echo 'Udało Ci się utworzyć konto! możesz się teraz zalogować!';
            echo "<br>";
            require 'Logowanie.php';
        }
         if(!empty($_GET['par']=='zalogowany')){
                if($_SESSION['zalogowany']==1){
                     $_SESSION['poziom']=0;
                     $_SESSION['bron']='';
                     $_SESSION['zbroja']='';
                     $_SESSION['buty']='';
                    require 'Postac.php';
                    $postac=new $_SESSION['klasa']($_SESSION['postac'],$_SESSION['klasa']);
                    echo "Witaj spowrotem ";
                    echo $postac;
                     $_SESSION['zycie']=$postac->getZycie();
                     $_SESSION['obrazenia']=$postac->getObrazenia();
                     $_SESSION['obrona']=$postac->getObrona();
                     $_SESSION['unik']=$postac->getUnik();
                    echo "<br><a href='gra.php?par=arena'>Arena</a>";
                    echo "<br><a href='gra.php?par=wyloguj'>Wyloguj</a>";
                    echo "<br><a href='gra.php?par=pojedynek'>Pojedynek</a>";
                
            }
        }
        if(!empty($_GET['par']=='wyloguj')){
            echo 'Zostałeś Wylogowany!';
            $_SESSION['zalogowany']=0;
            session_destroy();
            echo "<br>";
            echo "<a href='gra.php'>Powrót do strony głównej</a>";
        }
        if(!empty($_GET['par']=='arena')){
            if($_SESSION['zalogowany']==1){
                
                if($_SESSION['klasa']=='Wojownik'){
                    pokazBron();
                    Wybor('Miecz',20,'Zbroja',40,'Buty',10,'arena1');
                }
                
                else if($_SESSION['klasa']=='Mag'){
                    pokazBron();
                    Wybor('Rozdzka',50,'Szaty',10,'Buty',10,'arena1');
                }
                
                else if($_SESSION['klasa']=="Łucznik"){
                    pokazBron();
                    Wybor('Luk',30,'Kamizelka',20,'Buty',15,'arena1');
                }
                 
            }
        }
        if(!empty($_GET['par']=='arena1')){
            if($_SESSION['zalogowany']==1){
                if($_SESSION['poziom']==0){
                    pokazBron();
                    Walka('Szczur','Dalej1','arena2Bron',1);
                }
            }
        }
         if(!empty($_GET['par']=='arena2Bron')){
            if($_SESSION['zalogowany']==1){
                if($_SESSION['poziom']==1){
                    if($_SESSION['klasa']=='Wojownik'){
                        pokazBron();
                        Wybor('MieczWyzwolenia',30,'ZbrojaWolnosci','50','ButyWojownika',20,'arena2');
                    }
                    
                    else if($_SESSION['klasa']=='Mag'){
                        pokazBron();
                        Wybor('RozdzkaZycia',60,'SzatyWolnosci',15,'ButyMaga',15,'arena2');
                    }
                    
                    else if($_SESSION['klasa']=="Łucznik"){
                        pokazBron();
                        Wybor('LukMocy',40,'KamizelkaWolnosci',25,'ButyLucznika',30,'arena2');
                    }
                }
            }
         }
         if(!empty($_GET['par']=='arena2')){
            if($_SESSION['zalogowany']==1){
                if($_SESSION['poziom']==1){
                    pokazBron();
                    Walka('Zombie','Dalej2','arena3Bron',2);
                }
            }
         }
          if(!empty($_GET['par']=='arena3Bron')){
            if($_SESSION['zalogowany']==1){
               if($_SESSION['poziom']==2){
                    if($_SESSION['klasa']=='Wojownik'){
                        pokazBron();
                        Wybor('MieczOrla',40,'ZbrojaLwa','60','ButyWeza',30,'arena3');
                    }
                    
                    else if($_SESSION['klasa']=='Mag'){
                    pokazBron();
                    Wybor('RozdzkaSowy',70,'SzatyNiedzwiedzia',25,'ButyJaszczurki',25,'arena3');
                    }
                    
                    else if($_SESSION['klasa']=="Łucznik"){
                        pokazBron();
                        Wybor('LukNietoperza',50,'KamizelkaPantery',35,'ButyWilka',40,'arena3');
                    }
               }
            }
         }
         if(!empty($_GET['par']=='arena3')){
            if($_SESSION['zalogowany']==1){
                if($_SESSION['poziom']==2){    
                    pokazBron();
                    Walka('Wilkołak','Dalej','arena4',3);
                }
            }
         }
         if(!empty($_GET['par']=='arena4')){
            if($_SESSION['zalogowany']==1){
                if($_SESSION['poziom']==3){    
                    pokazBron();
                    echo "<br>Udało Ci się wygrać arenę. GRATULUJE!";
                    echo "<a href = '/gra/gra.php?par=zalogowany'>Powrót na stronę główną";
                }
            }
         }

         if(!empty($_GET['par']=='pojedynek')){
                if($_SESSION['zalogowany']==1){
                	include 'pojedynek.php';
                }
            }
    }
    else{
         if(empty($_SESSION['zalogowany'])){    
    ?>
        
        <a href = "Rejestracja.php">Zarejestruj się</a><br><br>
            

</body>
</html>
<?php

        require 'Logowanie.php';    
        }
        else{
         echo "<br><a href='gra.php?par=wyloguj'>Wyloguj</a>";
        }
    }
mysqli_close($mysqli);
?>