var req;
var id_cliente=-1;
function getXmlParser(xmlString) {
   try { //Internet Explorer
     xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
     xmlDoc.async="false";
     xmlDoc.loadXML(xmlString);
   } catch(e) {
     try { // Firefox, Mozilla, Opera, etc.
       parser=new DOMParser();
       xmlDoc=parser.parseFromString(xmlString,"text/xml");
     } catch(e) {
       //alert(e.message);
       return;
     }
   }
   return xmlDoc;
}

function loadPage(url, postvalue) {
   req = getAjaxControl();
   if(req) {
      req.open("POST", url, false); // sincrono
      req.setRequestHeader("Content-Type", "text/xml")
      req.send(postvalue);
   }
}

function getAjaxControl() {
   req = false;
   // branch for native XMLHttpRequest object
   if(window.XMLHttpRequest && !(window.ActiveXObject)) {
      try {
         req = new XMLHttpRequest();
      } catch(e) {
         req = false;
      }
   // branch for IE/Windows ActiveX version
   } else if(window.ActiveXObject) {
      try {
         req = new ActiveXObject("Msxml2.XMLHTTP");
      } catch(e) {
         try {
            req = new ActiveXObject("Microsoft.XMLHTTP");
         } catch(e) {
            req = false;
         }
      }
   }
   return req;
}
function carica(num)
{
  	  var quale_div=document.getElementById("clienti_mostra"+num);
      loadPage("/mostra_clienti/carica_clienti.php");
      var array_javascript=JSON.parse(req.responseText);
      var stringa_add="";
      if(array_javascript.lenght != 0)
        for(var i=0;i<array_javascript.length;i++)
          stringa_add+='<a class="dropdown-item" value="' + array_javascript[i][0] + '" id="list_' + i + '_' + num +'" onclick="aggiungi_testo('+ i + ',' + num + ')" href="#">' + array_javascript[i][1] + "</a>";
      //alert(stringa_add);
      quale_div.innerHTML=stringa_add;
}
function aggiungi_testo(val, numero)
{
	var num = document.getElementById("list_"+val + "_" + numero);
    var testo = num.innerHTML;
    var id = num.getAttribute("value");
    //testo+='<input type="hidden" value="' + id_corrente '" + id="id_selezionato' + num + '"/>';
    //alert(testo);
    var butt = document.getElementById("azienda_click" + numero);
    butt.innerHTML=testo;
    butt.value=id;
    $('#fse'+numero).removeAttr('disabled');
}
function carica_fse(numero_riga)
{
	  var id = document.getElementById("azienda_click" + numero_riga ).value;
	  var quale_div=document.getElementById("fse_mostra"+numero_riga);
      loadPage("/mostra_clienti/carica_fse.php?id=" + id);
      var array_javascript=JSON.parse(req.responseText);
      var stringa_add="";
      if(array_javascript.lenght != 0)
        for(var i=0;i<array_javascript.length;i++)
         {
          stringa_add+='<a value="' + array_javascript[i][0] + '" class="dropdown-item" id="fse_' + i + '_' + numero_riga +'" onclick="aggiungi_testo_fse('+ i + ',' + numero_riga + ')" href="#">' + array_javascript[i][1] + "</a>";
         }
      //alert(stringa_add);
      quale_div.innerHTML=stringa_add;
}
function aggiungi_testo_fse(val, numero)
{
	var num = document.getElementById("fse_"+val + "_" + numero);
    var testo = num.innerHTML;
    var id_fse= num.getAttribute("value");
    //alert(id);
    var butt = document.getElementById("fse" + numero);
    butt.innerHTML=testo;
    butt.value=id_fse;
}