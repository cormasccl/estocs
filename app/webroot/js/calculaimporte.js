// JScript source code
function validaEntero(e) {

var esIE=(document.all);
var esNS=(document.layers);
tecla=(esIE) ? event.keyCode : e.which;


if ((tecla < 48 || tecla > 57) && tecla != 13 && tecla != 0 && tecla != 8) {
	
	if ((tecla == 45 && event.srcElement.value.search(" - ") != -1) || tecla != 45 || tecla != 9) {
		var browser = navigator.appName;
		e.preventDefault();
		if (browser.indexOf('Microsof') != -1) event.returnValue = ""
		else return false;

		return false;
	}
}
return true;
}


function limpiaCelda(idArticle) {
	document.getElementById('Unities'+idArticle).value = '';
	document.getElementById('UnitiesServices'+idArticle).value = 'P';
	document.getElementById('customerobservations'+idArticle).value = '';

var cash_order = document.getElementById('cash_order'+idArticle).value;



	CalculaImport("'Unities"+idArticle+"'",
		"'UnitiesServices"+idArticle+"'",
		"'price"+idArticle+"'",
		"'perbox"+idArticle+"'",
		"'boxesfloor"+idArticle+"'",
		"'carrifloor"+idArticle+"'",
		"'realunities"+idArticle+"'",
		"'import"+idArticle+"'",
		"'carrisarticle"+idArticle+"'",
		"'import"+idArticle+"'",
		idArticle,
		cash_order,
		"'customerobservations"+idArticle+"'");

}


function FormatDecimal(numero) {
var resultado = "";

// Si el numero empieza por el valor "-" (numero negativo)
if (numero[0] == "-") {
	// Cogemos el numero eliminando los posibles puntos que tenga, y sin
	// el signo negativo
	nuevoNumero = numero+replace(/\./g, '').substring(1);
} else {
	// Cogemos el numero eliminando los posibles puntos que tenga
	nuevoNumero = numero.replace(/\./g, '');
}

// Si tiene decimales, se los quitamos al numero
if (numero.indexOf(",") >= 0)
	nuevoNumero = nuevoNumero.substring(0, nuevoNumero.indexOf(","));

// Ponemos un punto cada 3 caracteres
for (var j, i = nuevoNumero.length - 1, j = 0; i >= 0; i--, j++)
	resultado = nuevoNumero.charAt(i) + ((j > 0) && (j % 3 == 0) ? "." : "") + resultado;

// Si tiene decimales, se lo añadimos al numero una vez forateado con 
// los separadores de miles
if (numero.indexOf(",") >= 0)
	resultado += numero.substring(numero.indexOf(","));

if (numero[0] == "-") {
	// Devolvemos el valor añadiendo al inicio el signo negativo
	return "-" + resultado;
} else {
	return resultado;
}

}

function ControlaEnter(keycode, txtQuantitatDemanadaID, ddlUnitatServeiID, hdnPreuID, hdnUniCaiID, hdnCaiPisID, hdnPisCarID, tdUnitatsID, tdImportLiniaID, hdnCarriProducteID, hdnImportProducteID) {
CalculaImport(txtQuantitatDemanadaID, ddlUnitatServeiID, hdnPreuID, hdnUniCaiID, hdnCaiPisID, hdnPisCarID, tdUnitatsID, tdImportLiniaID, hdnCarriProducteID, hdnImportProducteID);
if (keycode == 13) {
	return false;
} else {
	return true;
}
}

function CalculaImport(txtQuantitatDemanadaID, ddlUnitatServeiID, hdnPreuID, hdnUniCaiID, hdnCaiPisID, hdnPisCarID, tdUnitatsID, tdImportLiniaID, hdnCarriProducteID, hdnImportProducteID, idArticle, cashorderSession, observacionesID) {
		




	var txtQuantitatDemanada = document.getElementById(txtQuantitatDemanadaID);

	var tdCarris = document.getElementById("tdCarris");
	var tdImpTotal = document.getElementById("tdImpTotal");
	var ddlUnitatServei = document.getElementById(ddlUnitatServeiID);
	var hdnPreu = document.getElementById(hdnPreuID);
	var hdnUniCai = document.getElementById(hdnUniCaiID);
	var hdnCaiPis = document.getElementById(hdnCaiPisID);
	var hdnPisCar = document.getElementById(hdnPisCarID);
	var iUnitats = document.getElementById(tdUnitatsID);
	var iImportLinia = document.getElementById(tdImportLiniaID);
	var hdnCarriProducte = document.getElementById(hdnCarriProducteID);
	var hdnImportProducte = document.getElementById(hdnImportProducteID);
	var hCalculTransport =  document.getElementById('hCalculTransport');
	var hObservaciones    = document.getElementById(observacionesID);

	var observacionesValue = hObservaciones.value;
	var observacionesValue = observacionesValue.replace(/[`~!@#$%^&*()_|\=?;:'",.<>\{\}\[\]\\\/]/gi, '');
	
//var tdPortes = document.getElementById('tdPortes');
			
	var Carris, ImpTotal, CarriProducte, CarriTotal, Preu, UniCai, CaiPis, PisCar, QuantitatDemanada, Unitats, ImportLinia;
		
	var browser = navigator.appName;


	
	
	if (tdCarris != null && tdImpTotal != null && ddlUnitatServei != null && hdnPreu != null && hdnUniCai != null 
	&& hdnCaiPis != null && hdnPisCar != null && iImportLinia != null 
	&& iUnitats != null && hdnCarriProducte != null && hdnImportProducte != null) {
			
			
		if (!IsNumeric(txtQuantitatDemanada.value)) txtQuantitatDemanada.value = "";
			
		QuantitatDemanada = txtQuantitatDemanada.value;
		ImpTotal          = tdImpTotal.innerText ? tdImpTotal.innerText : tdImpTotal.textContent;
		UnitatServei      = ddlUnitatServei.value;
		Preu              = hdnPreu.value;
		UniCai            = hdnUniCai.value;
		CaiPis            = hdnCaiPis.value;
		PisCar            = hdnPisCar.value;



				
		switch(UnitatServei) {
			case "U":
				Unitats = QuantitatDemanada;
				break;
			case "C":
				Unitats = UniCai * QuantitatDemanada;
				break;
			case "P":
				Unitats = (CaiPis * QuantitatDemanada) * UniCai;
				break;
			case "K":
				Unitats = ((PisCar * QuantitatDemanada) * CaiPis) * UniCai;
				break;
		}
				
		ImportProducte          = parseFloat(String(Preu).replace(",",".")) * parseFloat(Unitats);

		//console.log('tdImpTotal: '+tdImpTotal.innerText);
		//console.log('hdnImportProducte: '+hdnImportProducte.value);
		
		ImpTotal                = CalcularImportTotal(tdImpTotal, iImportLinia, ImportProducte, hdnImportProducte);
		if (UniCai == 0 || CaiPis == 0 || PisCar == 0) {
			CarriProducte = 0;
		} else {
			CarriProducte           = ((parseFloat(Unitats) / parseFloat(UniCai)) / parseFloat(CaiPis)) / parseFloat(PisCar);
		}
		CarriTotal              = CalcularCarriTotal(tdCarris, hdnCarriProducte, CarriProducte);
		hdnCarriProducte.value  = new Number(CarriProducte).toFixed(2).replace(".",",");
		hdnImportProducte.value = new Number(ImportProducte).toFixed(2).replace(".",",");

		if (CarriTotal == 0)
		{
			if (browser.indexOf('Microsof') != -1)
				tdCarris.innerText = 0;
			else
				tdCarris.textContent = 0;
		} else {
			if (browser.indexOf('Microsof') != -1)
				tdCarris.innerText = new Number(CarriTotal).toFixed(2).replace(".",",");
			else
				tdCarris.textContent = new Number(CarriTotal).toFixed(2).replace(".",",");
		}

		if (ImportProducte == 0)
		{
			if (browser.indexOf('Microsof') != -1)
				iImportLinia.value = 0;
			else
				iImportLinia.value = 0;
		} else {
			if (browser.indexOf('Microsof') != -1)
				iImportLinia.value = new Number(ImportProducte).toFixed(2).replace(".",",");
			else
				iImportLinia.value = new Number(ImportProducte).toFixed(2).replace(".",",");
		}
				
		iUnitats.value = Unitats;


//console.log('ImpTotal: '+ImpTotal);

		if (ImpTotal == 0)
		{
			if (browser.indexOf('Microsof') != -1) {
				tdImpTotal.innerText = 0;
				tdImpTotalVisible.innerText = 0;
				
			}
			else {
				tdImpTotal.textContent = 0;
				tdImpTotalVisible.textContent = 0;
				
			}
		} else {
		if (browser.indexOf('Microsof') != -1) {
			tdImpTotal.innerText = new Number(ImpTotal).toFixed(2).replace(".", ",");
			tdImpTotalVisible.innerText = FormatDecimal(new Number(ImpTotal).toFixed(2).replace(".", ","));
		}
		else {
			tdImpTotal.textContent = new Number(ImpTotal).toFixed(2).replace(".", ",");
			tdImpTotalVisible.textContent = new Number(ImpTotal).toFixed(2).replace(".", ",");
			
			//tdImpTotalVisible.textContent = FormatDecimal(new Number(ImpTotal).toFixed(2).replace(".", ","));
						
		}






		//console.log(tdImpTotal.textContent);
		//console.log(tdImpTotalVisible.textContent);
	}		
				
	var numCarris;
	var arrCalculPortes;
	var arrCalculPortesRang;
	var ind;

	numCarris = (new Number(CarriTotal.toFixed(0)));
	if (numCarris < CarriTotal) numCarris = (new Number(numCarris)) + 1;
	//console.log("host: ");
	//console.log(window.location.host);

	if (window.location.host == "81.46.196.226") {
		url = "https://81.46.196.226/corma/intranet/CashOrderDetails/saveonline/";
	} else {
		url = "https://"+window.location.host+"/intranet/CashOrderDetails/saveonline/";
	}

	//console.log(url);
	//url = "http://www.corma.es/intranet/CashOrderDetails/saveonline/";

	//console.log(url);
//	url = "http://corma.site/CashOrderDetails/saveonline/";
	data = '{';
	data += '"preu":"'+Preu+'",';
	data += '"cantidad":"'+QuantitatDemanada+'",';
	data += '"unitat":"'+UnitatServei+'",';
	data += '"article":"'+idArticle+'",';
	data += '"sesion":"'+cashorderSession+'",';
	data += '"observations":"'+observacionesValue+'",';
	data += '"real_unities":"'+Unitats+'",';
	data += '"carris_article":"'+CarriProducte+'"}';
	dataBefore = data;
	j = jQuery;
	j.noConflict();
	j.ajax({
	    url : url,
	    type: "POST",
	    dataType: 'json',
	    contentType: 'application/json',
	    data:  JSON.stringify(dataBefore),
	    // success: function(data)
	    // {
	    //     console.log(data);
	    // },
	    // error: function (jqXHR, textStatus, errorThrown)
	    // {
	 
	    // }
	});

	}
}
		
function IsNumeric(strString) {
var strValidChars = "0123456789,";
var strChar;
var blnResult = true;
						
if (strString.length == 0) return false;
			
for (i = 0; i < strString.length && blnResult == true; i++) {
	strChar = strString.charAt(i);
	if (strValidChars.indexOf(strChar) == -1) {
		blnResult = false;
	}
}
			
return blnResult;
}
		
function CalcularImportTotal(tdImportTotal, iImportLinia, ImportLinia, hdnImportProducte) {
var ITotal = null;
var ILinia = null;
var browser=navigator.appName;  
			
if (IsNumeric(tdImportTotal.innerText ? tdImportTotal.innerText : tdImportTotal.textContent))
{
	if (browser.indexOf('Microsof') != -1)
		ITotal = parseFloat(tdImportTotal.innerText.replace(",","."))
	else
		ITotal = parseFloat(tdImportTotal.textContent.replace(",","."))
}
			
if (IsNumeric(hdnImportProducte.value))
	ILinia = parseFloat(hdnImportProducte.value.replace(",","."))
				
if (ITotal == null)
	return ImportLinia;
else
	if (ILinia == null)
		return ITotal + ImportLinia;
	else
		return ITotal - ILinia + ImportLinia;
}
		
function CalcularCarriTotal(tdCarris, hdnCarriProducte, CarriProducte) {
var CTotal = null;
var CLinia = null;
var browser=navigator.appName;  
			
if (IsNumeric(tdCarris.innerText ? tdCarris.innerText : tdCarris.textContent))
{
	if (browser.indexOf('Microsof') != -1)
		CTotal = parseFloat(tdCarris.innerText.replace(",","."))
	else
		CTotal = parseFloat(tdCarris.textContent.replace(",","."))
}
else
	CTotal = 0;
	
	console.log('hdnCarriProducte: '+hdnCarriProducte.value);
	console.log('CTotal: '+CTotal);

CLinia = parseFloat(hdnCarriProducte.value.replace(",","."));
return parseFloat(CTotal) - parseFloat(CLinia) + parseFloat(CarriProducte);
}


function onGetFocusDesc(obj) {
if (obj.value.substr(0, 1) == '<' && obj.value.substr(obj.value.length - 1, 1) == '>')
	obj.value = '';
}


function myUrlEncode($string) {
    $entities = array(' ','', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
    $replacements = array('-','!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
    return str_replace($entities, $replacements, strtolower($string));
}