function changeCateg(target){
	var categ = $("#selectCateg").val();
	var dnadmin = $("#gb_data").data('dnadmin');
	if(categ != ""){
		if($(target == 'categ')){
			var path = categ;
			$('#footerImg').attr('src',dnadmin+'/printer/assets/atf/'+path+'.jpg');
			switch(categ){
				case 'delegate':
					$('#image').css({'border-color': '#7FFF00'});
				break;
				case 'panelist':
					$('#image').css({'border-color': '#4CEAF9'});
				break;
				case 'organizer':
					$('#image').css({'border-color': '#635059'});
				break;
				case 'media':
					$('#image').css({'border-color': '#34006F'});
				break;
				case 'support':
				case 'interpreter':
					$('#image').css({'border-color': '#FC9D21'});
				break;
				case 'organizervip':
				case 'delegatevip':
				case 'panelistvip':
					$('#image').css({'border-color': '#A50700'});
				break;	
			}
		}
	}
	setPrinterBtn()
}




function PrintElem(elem){
	var restorepage = $('body').html();
	var printcontent = $(elem).html();
	$('body').html(printcontent);
	window.print();
	$('body').html(restorepage);
	//Popup($(elem).html());
}

function Popup(data) 
{
	var dnadmin = $("#gb_data").data('dnadmin');
	var mywindow = window.open('', 'Badge card', 'height=400,width=600');
	mywindow.document.write('<!DOCTYPE html><html><head><title>Badge card</title>');
	mywindow.document.write('<link rel="stylesheet" href="'+dnadmin+'/printer/css/bootstrap.min.css" type="text/css" />');
	mywindow.document.write('</head><body id="badgPopup">');
	mywindow.document.write(data);
	mywindow.document.write('</body></html>');

	mywindow.document.close(); // necessary for IE >= 10
	mywindow.focus(); // necessary for IE >= 10
	$('#badgPopup').ready(function(){
		mywindow.print();
	});
	mywindow.close();

	return true;
}

function writeName(target){
	if(target == "company"){
		var text = $("#companyName").val();
		if(text == "") text = "Company Name";
		$("#company_name").html(text);
	}else if(target == "profile"){
		var text = $("#fullName").val();
		if(text == ""){ text = "Full Name";}
		$("#profile_name").html(text);
		setPrinterBtn();
	}
}

function setPrinterBtn(){
	var cardcateg = $("#selectCateg").val();
	var textb = $("#fullName").val();
	if(cardcateg != "" && textb != ""){
		$('#cardPrinterBtn').prop('disabled', false);
		$('.card_categ').hide();
	}else{
		$('#cardPrinterBtn').prop('disabled', true);
	}
}