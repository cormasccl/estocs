// JScript source code

function selectCatalog(obj) {
	console.log(obj.id);
	if (obj.id == 'btncompra') {
		window.location.href = 'https://www.corma.es/intranet/catalogues/index/compra';
	} else {
		window.location.href = 'https://www.corma.es/intranet/catalogues/index/vista/motora';
	}
}