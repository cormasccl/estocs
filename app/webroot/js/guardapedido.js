function guardarPedido(num_pedido) {

	if (confirm(I18nJs.t('¿Está seguro que desea enviar el pedido a su comercial?'))) {


		observations = document.getElementById('observations').value;
		//url = "http://corma.site/CashOrders/savecashorder/";
		url = "https://www.corma.es/intranet/CashOrders/savecashorder/";
		data = '{';
		data += '"num":"'+num_pedido+'",';
		data += '"observations":"'+removeHtml(observations)+'"}';
		dataBefore = data;
		
		j.ajax({
		    url : url,
		    type: "POST",
		    dataType: 'json',
		    contentType: 'application/json',
		    data:  JSON.stringify(dataBefore),
		    success: function(data)
		    {
		    	console.log('pedido enviado ok');
		    	alert(I18nJs.t('El pedido se ha enviado correctamente a su comercial. Revise su correo, recibirá un email con el resumen de su pedido.'));
		        //window.location.href='http://corma.site/customers/index';
				window.location.href= "https://www.corma.es/intranet/Customers/index/";
		    },
		    error: function (jqXHR, textStatus, errorThrown)
		    {
		    	console.log(jqXHR);
		    	console.log(errorThrown);
		    	console.log(textStatus);
		 		console.log(data);
		    }
		});

	}

}

var tagBody = '(?:[^"\'>]|"[^"]*"|\'[^\']*\')*';

var tagOrComment = new RegExp(
    '<(?:'
    // Comment body.
    + '!--(?:(?:-*[^->])*--+|-?)'
    // Special "raw text" elements whose content should be elided.
    + '|script\\b' + tagBody + '>[\\s\\S]*?</script\\s*'
    + '|style\\b' + tagBody + '>[\\s\\S]*?</style\\s*'
    // Regular name
    + '|/?[a-z]'
    + tagBody
    + ')>',
    'gi');
function removeHtml(html) {
  var oldHtml;
  do {
    oldHtml = html;
    html = html.replace(tagOrComment, '');
  } while (html !== oldHtml);
  return html.replace(/</g, '&lt;');
}