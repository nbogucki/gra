<!Doctype html>
<html>
    <title>Rejestracja</title>
    <style>
   
    
        
        label > input{ /* HIDE RADIO */
          visibility: hidden; /* Makes input not-clickable */
          position: absolute; /* Remove input from document flow */
        }
        label > input + img{ /* IMAGE STYLES */
          cursor:pointer;
          border:2px solid ;
          transition: .5s ease;
          
        }
        label > input:checked + img{ /* (RADIO CHECKED) IMAGE STYLES */
          border:2px solid #f00;
          padding:5px;
          
        }
        .img__wrap {
          position: relative;
          
            }
            label > input + img:hover{
                padding : 5px;
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
  visibility: hidden;
  opacity: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  

  /* transition effect. not necessary */
  transition: opacity .2s, visibility .2s;
}

.img__wrap:hover .img__description_layer {
  visibility: visible;
  opacity: 1;
  
}
.img__description {
  font-size:50px;
  transition: .2s;
  transform: translateY(1em);
}

.img__wrap:hover .img__description {
  transform: translateY(0);
 
}
    </style>
</html>
<body>
<p>Zarejestruj się: </p>
<form method="POST">
    <p>Podaj nick:</p>
    <input type="text" name="nick">
    <p>Podaj Hasło</p>
    <input type="password" name="haslo">
    <p>Wybierz klasę klasę:</p>
   <label class="img__wrap"><input type="radio" name="gender" value="Wojownik" checked><img title="Wojownik" src="images/Wojownik.png" width="300px" height="300px"></img><div class="img__description_layer">
    <p class="img__description">Wojownik</p>
  </div></label>
    <label class="img__wrap"><input type="radio" name="gender" value="Mag"><img title="Mag" src="images/Mag.png" width="300px" height="300px"></img><div class="img__description_layer">
    <p class="img__description">Mag</p>
  </div></label>
    <label class="img__wrap"><input type="radio" name="gender" value = "Łucznik"><img title="Łucznik" src="images/Łucznik.png" width="300px" height="300px"></img><div class="img__description_layer">
    <p class="img__description">Łucznik</p>
  </div></label><br><br>
    <input type="submit" value="Utworz" name="utworz">
</form>
</body>
</html>
<?php
  
    require 'bazaGra.php';
    


?>