<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicando PWA em uma Aplicação PHP</title>

    <link rel="manifest" href="manifest.json">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">

    <link rel="shortcut icon" href="imagens/icon-96.png">
    <link rel="apple-touch-icon" href="imagens/icon-apple.png">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="imagens/logo-branco.svg" alt="Vida de Programador" height="100px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="me-auto mb-2 mb-lg-0">
                </div>
                <ul class="navbar-nav d-flex">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mailto:burnes@professorburnes.com">Contato</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div id="a2hs">
	    <p class="center">Deseja adicionar a tela principal como um APP?</p>
	    <p class="center">
	      <button type="button" id="btnAdd" name="btnAdd" class="btn btn-success" aria-label="Adicionar">Adicionar</button>
	      <button type="button" id="btnDis" name="btnDis" class="btn btn-danger" aria-label="Ferchar">Fechar</button>
	    </p>
	</div>

    <main class="container">
        <?php
            function reaverImg($html) {
                preg_match_all('/<img\ssrc="([^"]+)/', $html, $images);
                if ( isset ($images[0][0]) )
                    return $images[0][0];
                else
                    return NULL;
            }

            function pubDate($date) {

            }
            $xml = simplexml_load_file("https://developerslife.tech/pt/feed.xml");

            foreach($xml->channel->item as $item){
                ?>
                <div class="card">
                    <div class="card-body">
                        <h2>
                            <a href="<?=$item->link?>" title="<?=$item->title?>" target="_blank">
                                <?=$item->title?>
                            </a>
                        </h2>

                        <?php
                            $img = reaverImg($item->description);
                            if ( !empty ($img ) )
                                echo $img.'" class="w-100">';
                            else
                                echo $item->description;
                        ?>
                        <p>
                        <a href="<?=$item->link?>" title="<?=$item->title?>" target="_blank" class="btn btn-danger">
                            Ver Tirinha no Site
                        </a>
                        </p>
                        <p><strong>Publicado em: <?=strftime("%d-%m-%Y %H:%M:%S", strtotime($item->pubDate))?></strong></p>
                    </div>
                </div>
                <?php
            }
        ?>
    </main>

    <footer class="bg-dark p-2">
        <p class="text-center">PWA - Vida de Programador</p>
    </footer>

    <script src="js/install.js"></script>
    <script type="text/javascript">
		if ( 'serviceWorker' in navigator ) {
		  	navigator.serviceWorker.register("sw.js", { scope: '/pwa/' })
		  	.then(function(register){

		      //verifica, pode-se fazer algo caso esteja em algum desses estados
		  		if ( register.installing )
		  			console.log('Service Worker instalando com sucesso em '+register.scope);
		  		else if( register.waiting ) 
		  			console.log('Service Worker waiting em '+register.scope);
		  		else if ( register.active )
		  			console.log('Service Worker ativo em '+register.scope);

		  	}).catch(function(error){

		      //se houver falha vc pode avisar, enviar o erro para uma URL, gerar log
		  		console.log('Falha ao registrar Service Worker '+error);

		  	});
		}
	</script>
</body>

</html>