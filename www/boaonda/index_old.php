<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Apresentação</title>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.1.3.1.min.js"></script>

	<style type="text/css">
	
		/*RESET*/
		body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,textarea,p,blockquote,th,td{margin:0;padding:0;}
		table{border-collapse:collapse;border-spacing:0;}
		fieldset,img{border:0;}
		li{list-style:none;}
		h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal;}
		body{font-family:Arial; font-size:14px; color:#fff; font-weight:bold; background-position:center top; background-repeat:no-repeat;}

		a{position:fixed; top:50px; display:inline-block; padding:10px; color:#fff; text-decoration:none; border:1px solid #ccc; background-color:#000;}
		a#prev{left:30px;}
		a#next{right:30px;}
		
		#nro{position:fixed; bottom:0; left:50%; width:80px; margin-left:-40px; padding:10px 0; text-align:center; border:1px solid #ccc; border-bottom:none; background-color:#000;}
		#loader{display:none; position:fixed; left:50%; top:50%; width:120px; height:30px; padding-top:70px; margin:-50px 0 0 -60px; text-align:center; background:url(loader.gif) center -10px no-repeat #000;}
		
	</style>
	<script type="text/javascript">

		var colecao = new Array(
			'01.jpg',
			'02.jpg',
			'03.jpg',
			'04.jpg',
			'05.jpg',
			'06.jpg',
			'07.jpg',
			'08.jpg',
			'09.jpg'
			),
			lastImg = (colecao.length - 1),
			currentImg = 0,
			loader,
			body;
		
		function change(){
			var img = new Image();
			
			loader.show();
			
			img.src = colecao[currentImg];
			img.onload = function(){
				body
					.css('background-image', 'url(' + colecao[currentImg] + ')')
					.height(img.height);
				$('#atual').html((currentImg + 1).toString());
				loader.hide();
			}
		}
		
		$(document).ready(function(){
			
			loader = $('#loader');
			body = $('#body');

			$('#total').html(colecao.length);
			
			$('#next').click(function(){
				if (currentImg < lastImg)
					currentImg++;
				else
					currentImg = 0;
				change();
			});
			$('#prev').click(function(){
				if (currentImg > 0)
					currentImg--;
				else
					currentImg = lastImg;
				change();
			});
			change();
		})

	</script>
</head>
<body id="body">
	<div id="nro"><span id="atual">1</span>/<span id="total"></span></div>
	<a href="javascript:;" id="prev">Anterior</a>
	<a href="javascript:;" id="next">Próxima</a>
	<div id="loader">Carregando</div>
</body>
</html>