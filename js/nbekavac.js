/*$(document).ready(function(){
    $('#korime2').blur(function(){
    var korisnickoIme=$(this).val();
    $.ajax({
        url:"provjeraKorisnickogImena.php",
        method:"POST",
        data:{kor_ime:korisnickoIme},
        dataType:"text",
        success:function(html){
                $('#availability').html(html);
            }
        });
    });      
});
*/

function provjeraNedozvoljenih(){
        //provjera nedozvoljenih znakova i praznih znakova
        var unosImena = document.getElementById('ime').value;
		for(var i=0;i<unosImena.length;i++){
		if (unosImena[i] === "!" || unosImena[i]==="'" || unosImena[i]==="?" || unosImena[i]==="#")
			{
				alert("Nedozvoljen znak u imenu");
				event.preventDefault();
			}
		}
		if (unosImena==="")
		{
			alert("Morate unijeti vrijednost za ime");
			event.preventDefault();
		}		
		var unosPrezimena = document.getElementById('prez').value;
			for(var i=0;i<unosPrezimena.length;i++){
			if (unosPrezimena[i] === "!" || unosPrezimena[i]==="'" || unosPrezimena[i]==="?" || unosPrezimena[i]==="#")
				{
					alert("Nedozvoljen znak kod odabira prezime");
					event.preventDefault();
				}
			}
			if (unosPrezimena==="")
			{
				alert("Morate unijeti vrijednost za prezime");
				event.preventDefault();
			}	
			var unosKorisnickogImena = document.getElementById('korime2').value;
			for(var i=0;i<unosKorisnickogImena.length;i++){
			if (unosKorisnickogImena[i] === "!" || unosKorisnickogImena[i]==="'" || unosKorisnickogImena[i]==="?" || unosKorisnickogImena[i]==="#")
				{
					alert("Nedozvoljen znak u korisnickom imenu");
					event.preventDefault();
				}
			}
			if (unosKorisnickogImena==="")
			{
				alert("Morate unijeti vrijednost za korisnicko ime");
				event.preventDefault();
			}
			var unosEmaila = document.getElementById('email').value;
			for(var i=0;i<unosEmaila.length;i++){
			if (unosEmaila[i] === "!" || unosEmaila[i]==="'" || unosEmaila[i]==="?" || unosEmaila[i]==="#")
				{
					alert("Nedozvoljen znak u emailu");
					event.preventDefault();
				}
			}
			if (unosEmaila==="")
			{
				alert("Morate unijeti vrijednost za email");
				event.preventDefault();
            }
            var unosLozinke=document.getElementById('lozinka2').value;
            for(var i=0;i<unosLozinke.length;i++){
                if (unosLozinke[i] === "!" || unosLozinke[i]==="'" || unosLozinke[i]==="?" || unosLozinke[i]==="#")
                    {
                        alert("Nedozvoljen znak u lozinci");
                        event.preventDefault();
                    }
                }
                if (unosLozinke==="")
                {
                    alert("Morate unijeti vrijednost za lozinku");
                    event.preventDefault();
                }
            //provjera broja znakova
            if(unosLozinke.length<5)
            {
                alert("Premali broj znakova za lozinku");
                event.preventDefault();
            }
            if(unosKorisnickogImena.length<5)
            {
                alert("Premali broj znakova za korisnicko ime");
                event.preventDefault();
            }
            //provjera emaila
           var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(re.test(unosEmaila)===false || (unosEmaila.length>30) || (unosEmaila.length<10)) {
                alert("Neispravan oblik emaila");
                event.preventDefault();
            }
            //provjera jesu lozinke iste
            var ponovljenaLozinke=document.getElementById('lozinkaPonovi').value;
            if(unosLozinke!=ponovljenaLozinke){
                alert("Lozinka i ponovljena lozinke nisu jednake");
                event.preventDefault();
            }
            				
}
function provjeraKolacica(){
	if (document.cookie.indexOf("uvjeti_koristenja") >= 0) {
		
	  }
	  else {
		// set a new cookie
		expiry = new Date();
		expiry.setTime(expiry.getTime()+(10*60*60000)); 
	  
		// Date()'s toGMTSting() method will format the date correctly for a cookie
		document.cookie = "uvjeti_koristenja=yes; expires=" + expiry.toGMTString();
		alert("Klikom na OK prihvacate uvjete koristenja i biljezenje podataka u kolacic");
	  }
}


function addListeners(){
    if(window.addEventListener){
        document.getElementById('submit').addEventListener('click', provjeraNedozvoljenih,false);
    
    }
}
window.addEventListener('load', provjeraKolacica,false);
window.onload=addListeners;