<html>
<link rel="stylesheet" href="style.css">
<form method="get" action="">  
<input id="ville" type="text" name="ville"  value="<?php echo $ville=isset($_GET['ide'])? $_GET['ide']: $ville=""; ?>" placeholder="<?php echo $ville; ?>" />
<input id="cp" type="text" name="cp"  value="<?php echo $ville=isset($_GET['cp'])? $_GET['cp']: $ville=""; ?>" placeholder="<?php echo $ville; ?>" />
<input type="submit" />
<div id="villesDeFrance" class="villes"></div>
<div id="postal" class="postal"></div>
</form>


<script>

function myFunction(arr, linkinfo) {
        console.log(arr)
        document.getElementById('villesDeFrance').innerHTML=""
        tableau_ville=[]
        tableau_code=[]
        for (i=0; i<arr.length; i++){
          
            tableau_ville.push(arr[i].ville_nom)
            tableau_code.push(arr[i].postal)        
           }
          console.log(tableau_ville)
       
      var autocomplete=document.getElementById('villesDeFrance')
      element=[];   
      lien=[]
      for(i=0; i<tableau_ville.length; i++){
        essai1=document.createElement('a')
        essai1.setAttribute("href", "villes2.php?ide="+tableau_ville[i]+"&cp="+tableau_code[i])
   
        lien.push(essai1)
      }
      sauts=[]
      for(i=0; i<tableau_ville.length; i++){
        saut=document.createElement('br')
        sauts.push(saut)
      }
                
      for(i=0; i<tableau_ville.length && i<lien.length && i<sauts.length && tableau_code.length; i++){
      lien[i].textContent=tableau_ville[i]
      autocomplete.appendChild(lien[i]).append(' '+tableau_code[i])
      autocomplete.append(sauts[i])
    }
    if(mot!=""){
        mot=document.getElementById('ville').value.substring(0, mot.length); 
    }  
    if(code!=""){
        code=document.getElementById('ville').value.substring(0, code.length); 
    }   
    console.log(document.getElementById('villesDeFrance'))        
    }   
    
var input=document.getElementById('ville');

mot=""

input.addEventListener('keyup', function(e){

   if(e.keyCode!=8){
    
     if(mot+=new String(String.fromCharCode(e.keyCode))){
        console.log(mot)
        villeFrance=document.getElementById("ville").value
        mot=villeFrance.substring(0, villeFrance.length)
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "ville.php?id="+mot, true);
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var myArr = JSON.parse(this.responseText);
          myFunction(myArr)  
          }
      }
    xhttp.send();
           
    }
    } else if(e.keyCode==8) {

    villeFrance=document.getElementById("ville").value
    villeFrance=villeFrance.substring(0, villeFrance.length)
     
    console.log(villeFrance);
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "ville.php?id="+villeFrance, true);
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var myArr = JSON.parse(this.responseText);
        myFunction(myArr) 
	}

      }
    xhttp.send(); 
 }
})  
    
var cp=document.getElementById('cp');

code=[]

cp.addEventListener('keyup', function(e){
   
   if(e.keyCode!=8){
    if (e.keyCode>=96 && e.keyCode<=105)
        {
        code+=e.keyCode-96;
        }
      
        console.log(code)
        cpFrance=document.getElementById("cp").value
        code=cpFrance.substring(0, cpFrance.length)
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "ville.php?cp="+code, true);
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var myArr = JSON.parse(this.responseText);
          myFunction(myArr)  
          }
      }
    xhttp.send();
           
    
    } else if(e.keyCode==8) {
      
    cpFrance=document.getElementById("cp").value
    code=cpFrance.substring(0, cpFrance.length)

   
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "ville.php?cp="+code, true);
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var myArr = JSON.parse(this.responseText);
        myFunction(myArr) 
	}

      }
    xhttp.send(); 
    }
})

</script>

</html>