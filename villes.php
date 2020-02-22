<html>
<link rel="stylesheet" href="style.css">
<form method="get" action="">  
<input id="ville" type="text" name="ville"  value="<?php echo $ville=isset($_GET['ide'])? $_GET['ide']: $ville=""; ?>" placeholder="<?php echo $ville; ?>" />
<input id="cp" type="text" name="cp" class="cp"  value="<?php echo $ville=isset($_GET['cp'])? $_GET['cp']: $ville=""; ?>" placeholder="<?php echo $ville; ?>" />
<input type="submit" />
<div class="flex">
  <div id="villesDeFrance" class="villes"></div>
  <div id="postal" class="postal"></div>
</div>

</form>


<script>

function myFunction(arr, value, villecp, div, linkinfo) {
        console.log(arr)
        
    document.getElementById(div).classList.add('disable')
    
        document.getElementById(div).innerHTML=""
        tableau_ville=[]
        tableau_code=[]
       
     for (i=0; i<arr.length; i++){
         
          if(arr[i].postal.includes('-')){
            villestirets=arr[i].postal.split("-")
           console.log(villestirets)
           for(i=0; i<villestirets.length; i++){
              tableau_code.push(villestirets[0])
              
            }
          break;     
          
          
        }
      }
           for (i=0; i<arr.length; i++){
          
            tableau_ville.push(arr[i].ville_nom)
            tableau_code.push(arr[i].postal)
          }
      var autocomplete=document.getElementById(div)
      element=[];   
      lien=[]
      for(i=0; i<tableau_ville.length; i++){
        essai1=document.createElement('a')
        essai1.setAttribute("href", "villes.php?ide="+tableau_ville[i]+"&cp="+tableau_code[i])
   
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

    if(value=="32" || document.getElementById(villecp).value==="" ){
    
        erase_childs(document.getElementById(div))
       
    }
  
    if(document.getElementById(villecp).value==="" ){
      document.getElementById(div).classList.add('disable2')
    }else{
      document.getElementById(div).classList.remove('disable2')
    }


    if(mot!=""){
      
        mot=document.getElementById(villecp).value.substring(0, mot.length);
        
    }  
    if(code!=""){
        code=document.getElementById(villecp).value.substring(0, code.length); 
       
    }   
    console.log(document.getElementById(div))        
    }   
    
    function erase_childs(node){
	    if(node.childNodes){
        
		  var childs=node.childNodes;
		  for(var i=0;i<childs.length;i++){
			node.removeChild(childs[i]);
      console.log('ok')
		  }
	  }
    
}


var input=document.getElementById('ville');

mot=""

input.addEventListener('keyup', function(e){

   if(e.keyCode!=8){
      var evenement=e.keyCode
     
     if(mot+=new String(String.fromCharCode(e.keyCode))){
        console.log(mot)
        villeFrance=document.getElementById("ville").value
        mot=villeFrance.substring(0, villeFrance.length)
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "bddville.php?id="+mot, true);
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var myArr = JSON.parse(this.responseText);
          myFunction(myArr, evenement, "ville", "villesDeFrance")  
          }
      }
    xhttp.send();
           
    }
    } else if(e.keyCode==8) {
 
      var evenement=e.keyCode
    villeFrance=document.getElementById("ville").value
    
    mot=villeFrance.substring(0, villeFrance.length)
     
    console.log(villeFrance);
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "bddville.php?id="+villeFrance, true);
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var myArr = JSON.parse(this.responseText);
        myFunction(myArr, evenement, "ville", "villesDeFrance") 
	}

      }
    xhttp.send(); 
 }
})  
    
var cp=document.getElementById('cp');

code=""

cp.addEventListener('keyup', function(e){
   
   if(e.keyCode!=8){

    var evenement=e.keyCode
    if (e.keyCode>=96 && e.keyCode<=105)
        {
        code+=e.keyCode-96;
        }
      
        console.log(code)
        cpFrance=document.getElementById("cp").value
        code=cpFrance.substring(0, cpFrance.length)
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "bddville.php?cp="+code, true);
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var myArr = JSON.parse(this.responseText);
          myFunction(myArr, evenement, "cp", "postal")  
          }
      }
    xhttp.send();
           
    
    } else if(e.keyCode==8) {
  
    cpFrance=document.getElementById("cp").value
  
    code=cpFrance.substring(0, cpFrance.length)

   
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "bddville.php?cp="+code, true);
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var myArr = JSON.parse(this.responseText);
        myFunction(myArr, evenement, "cp", "postal") 
	}

      }
    xhttp.send(); 
    }
})


</script>

</html>