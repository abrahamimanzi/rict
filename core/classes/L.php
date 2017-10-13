<?php
class L
{
	
	public static function p($string){
		// set Dictionary
		if($_SESSION['lang'] == 'fr'){
			$book = L::fr();
			if(isset($book[$string])) $val=$book[$string]; else $val=$string;	
		}elseif($_SESSION['lang'] == 'rw'){
			$book = L::rw();
			if(isset($book[$string])) $val=$book[$string]; else $val=$string;	
		}elseif($_SESSION['lang'] == 'en'){
			$book = L::en();
			if(isset($book[$string])) $val=$book[$string]; else $val=$string;	
		}else{
			$val = $string;
		}
		return $val;
	}
	
	public static function en(){
		$list = array(
			'Local'=>'News',
			'News'=>'News',
			'Foreign'=>'International',
			'FOREIGN NEWS'=>"INTERNATIONAL NEWS",
			'LOCAL NEWS'=>"NEWS",
			'ADS SPACE'=>"QUICK LINKS",
		);
		return $list;
	}
	public static function fr(){
		$list = array(
			'ADVERTISEMENT'=>'PUBLICITE',
			'ABOUT'=>'A PROPOS',
			'About'=>'A propos',
			'About Us'=>'A propos',
			'ABOUT US'=>'A PROPOS',
			'EASY ACCESS'=>'RACCOURCIS',
			'FIND US'=>'TROUVER NOUS',
			'LATEST NEWS'=>'DERNIERES NOUVELLES',
			'BREAKING NEWS'=>'AGEZWEHO',
			'Read more'=>'En savoir plus',
			'Home'=>'Accueil',
			'Local'=>'Info',
			'News'=>'Info',
			'Entertainment'=>'Divertissement',
			'Foreign'=>'Internationale',
			'Weather'=>'Meteo',
			'Contact'=>'Contact',
			'Radio'=>'Radio',
			'RTV Live'=>'RTV en direct',
			'LIVE Radio'=>"RADIO en direct",
			'LOCAL NEWS'=>'INFO',
			'VIDEOS'=>'VIDEOS',
			'BUSINESS NEWS'=>"INFO D'AFFAIRE",
			'FOREIGN NEWS'=>"INFO INTERNATIONAL",
			'FEATURED NEWS'=>"INFO VEDETTE",
			'TRENDING NEWS'=>"INFO POPULAIRE",
			'SPORTS NEWS'=>"INFO SPORT",
			'ENTERTAINMENT NEWS'=>'DIVERTISSEMENT',
			'DISCOVER'=>"DECOUVERTE",
			'Music'=>"Musique",
			'Technology'=>"Technologie",
			'Views'=>"Visites",
			'Disclaimer'=>"Desistement",
			'Schedule'=>"Calendrier",
			'CLICK PLAY TO WATCH RTV LIVE'=>"Clickez pour voir RTV en direct",
			'ADS SPACE'=>"PUBLICITE",
			'View older'=>"Voir plus",
			'DAILY WEATHER'=>"METEO DU JOUR",
			'VIDEO'=>"VIDEO",
			'Podcast'=>"Podcast",
			'Other podcast'=>"Autre Podcast",
			'Program line up'=>"Gamme de programme",
			'Click here for'=>"Cliquez ici pour",
			'Other Radios'=>"Autre Radios",
			'LOCATE US'=>"LOCALISE NOUS",
			'SEND MESSAGE'=>"ENVOYER",
			'SEND US A MESSAGE'=>"ENVOYER NOUS UN MESSAGE",
			'RTV Schedule'=>"RTV, Programme du jour",
			'Posted on'=>"Poster le",
			'Share this page on'=>"Partager ceci sur",
			'Leave a Comment'=>"Laissez un commentaire",
			'Submit'=>"Soumettre",
			'Full name'=>"Noms",
			'Email Address'=>"Address Email",
			'Phone Number'=>"Numero de Telephone",
			'Your Message'=>"Votre message",
			'Comment'=>"Commentaire",
			'JOURNALISTS'=>"JOURNALITES",
			'Click here for Schedule'=>"Cliquez ici pour le programme",
			'View and Share'=>"Visualisez et Partager",
			'Be the first to comment on this article'=>"Soyez le premier à commenter cet article",
			'Subscribe by entering your email'=>"Abonnez-vous en entrant votre email",
			'Subscribe'=>"Abonnez-vous",
			'POLITIC NEWS'=>"POLITIQUES",
		);
		return $list;
	}
	public static function rw(){
		$list = array(
			'ADVERTISEMENT'=>'KWAMAMAZA',
			'ABOUT'=>'ABO TURIBO',
			'About'=>'Abo turibo',
			'About Us'=>'Abo turibo',
			'ABOUT US'=>'ABO TURIBO',
			'EASY ACCESS'=>'GERAYO VUBA',
			'Job Application Form'=>'Akazi',
			'FIND US'=>'DUSANGE',
			'LATEST NEWS'=>'AGEZWEHO',
			'BREAKING NEWS'=>'AGEZWEHO',
			'Read more'=>'Soma inkuru',
			'Home'=>'Ahabanza',
			'Local'=>'Amakuru',
			'News'=>'Amakuru',
			'Sports'=>'Siporo',
			'Entertainment'=>'Imyidagaduro',
			'ENTERTAINMENT NEWS'=>'Imyidagaduro',
			'Business'=>'Ubucuruzi',
			'Foreign'=>'Hanze',
			'Weather'=>'Ikirere',
			'Contact'=>'Twandikire',
			'Radio'=>'Radiyo',
			'Education'=>'Uburezi',
			'RTV Live'=>'RTV',
			'LIVE Radio'=>"Umva radiyo",
			'LOCAL NEWS'=>'AMAKURU',
			'VIDEOS'=>'AMASHUSHO',
			'Videos'=>'Amashusho',
			'BUSINESS NEWS'=>"UBUCURUZI",
			'FOREIGN NEWS'=>"HANZE",
			'FEATURED NEWS'=>"AMAKURU ARAMBUYE",
			'TRENDING NEWS'=>"AYASOMWE CYANE",
			'SPORTS NEWS'=>"SIPORO",
			'DISCOVER'=>"VUMBURA",
			'Music'=>"Indirimbo",
			'Technology'=>"Ikoranabuhanga",
			'Views'=>"Visite",
			'Disclaimer'=>"Icyitonderwa",
			'Schedule'=>"Gahunda",
			'CLICK PLAY TO WATCH RTV LIVE'=>"Kanda hano urebe televiziyo",
			'ADS SPACE'=>"KWAMAMAZA",
			'View older'=>"Izindi nkuru",
			'DAILY WEATHER'=>"IKIRERE CY'UMUNSI",
			'VIDEO'=>"AMASHUSHO",
			'Podcast'=>"Podcast",
			'Other podcast'=>"Autre Podcast",
			'Program line up'=>"Gahunda iteguwe",
			'Click here for'=>"Kanda hano",
			'Other Radios'=>"Izindi Radiyo",
			'LOCATE US'=>"AHO DUKORERA",
			'SEND MESSAGE'=>"HOHEREZA",
			'SEND US A MESSAGE'=>"TWOHEREJE UBUTUMWA",
			'RTV Schedule'=>"RTV, Gahunda iteguwe",
			'Posted on'=>"Yanditswe",
			'Share this page on'=>"Saranganya kuri",
			'Leave a Comment'=>"Tanga igitekerezo",
			'Submit'=>"Emeza",
			'Full name'=>"Amazina yose",
			'Email Address'=>"Emeli",
			'Phone Number'=>"Numero ya telefone",
			'Your Message'=>"Ubutumwa bwawe",
			'Comment'=>"Igitekerezo",
			'JOURNALISTS'=>"ABANYAMAKURU",
			'Click here for Schedule'=>"Gahunda",
			'View and Share'=>"View and Share",
			//Footer
			'PAGES'=>'UMUYOBORO',
			'Career'=>'Akazi',
			'Be the first to comment on this article'=>"Ba wambere gutanga igitekerezo",
			'Subscribe by entering your email'=>"Andika email yawe, ijye ubona amakuru",
			'Subscribe'=>"Iyandikishe",
			'POLITIC NEWS'=>"POLITIKI",
			//About
			'Our Mission'=>"Misiyo yacu",
			'Our Vision'=>"Intumbero yacu",
			'Administrative Team'=>"Abayobozi",
			'Organisational Chart'=>"Urutonde rw'imitunganyirize",
		);
		return $list;
	}
}
?>