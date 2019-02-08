<?php

        $archivoController = "controllers/Controlador.php";
        $url = isset($_GET['url'])? $_GET['url']: null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        //Añadimos el controlador
        require $archivoController;
        //Iniciamos el controlador
        $controller = new Controlador();

        //Comprobamos si hemos puesto / o /accion
        if(empty($url[0])){
            //Pintamos la página de inicio si accedemos directamente con /
            $controller->inicio();
        } else {
            //Comprobamos que se pueda llamar a un método del controlador
            //Es decir, que la url introducida sea válida
            if (method_exists($controller,$url[0])) {
                // Se obtienen el número de parámetros
                $nparam = sizeof($url);
                // Si hay más de uno, es que se llama a un método con parámetros
                if($nparam > 1){
                    //Hay un parámetro, este ejemplo no contempla más
                    //Si el añadir se hiciera con GET, habría que leer aquí los parámetros
                    $controller->{$url[0]}($url[1]);
                }else{
                    //Se llama directamente al método correspondiente del controlador
                    $controller->{$url[0]}();  
                }
            } else {
                //La url es inválida
                //Podemos mostrar mensaje de error
                $controller->error("Url no válida");
                //O ir a index con, require_once("index.html");
            }
            
        }
        

?>