<?php
//install container
$register = new Registry();

//Loader
$loader = new loader($register);
$register->set('load',$loader);


// Request
$request = new Request();
$register->set('request', $request);

//Config
$config = new Config();
$config->load('default');
$register->set('config', $config);

<<<<<<< HEAD
// Log
$log = new Log($config->get('config_error_filename'));
$register->set('log', $log);

=======
>>>>>>> cfc48d3f7ec37eebcebf343a97c0dc2ebfd0e3ff
// Response
$response = new Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$register->set('response', $response);
<<<<<<< HEAD

//Url
$url = new Url();
$register->set('url', $url);

//Front
$controller = new Front($register);

=======

//Front
$controller = new Front($register);
>>>>>>> cfc48d3f7ec37eebcebf343a97c0dc2ebfd0e3ff

function getDir($dir){
	$handler = opendir($dir);
	$files = array();
	while (($filename = readdir($handler)) !== false) {
		if ($filename != "." && $filename != "..") {
			$files[] = $filename ;
	 	}
	}
	closedir($handler);
	return $files;
}

function checkDirectory($dir,$checkDir){
	$files = getDir($dir);
    $flag = false;
    if(count($files) > 0){
		foreach ($files as $file) {
			if($file == $checkDir){
				$flag = true;
				break;
			}
		}
    }
    return $flag;
}
<<<<<<< HEAD
=======

>>>>>>> cfc48d3f7ec37eebcebf343a97c0dc2ebfd0e3ff
###########################################################
#php-framework url rule
#  domain/moduleName/packageName/fileName/methodName/parameter
#example
#  http://localhost:7777/fontend/common/home/index
###########################################################
$path = substr(preg_replace('/\?.*$/', '', $_SERVER['REQUEST_URI']),1);
if($path){
	if(count(explode('/',$path)) >= 3 ){
		$paths = explode('/',$path);
		$moduleName = $paths[0];
		$modulePath = DIR_APPLICATION.'modules';
		if(checkDirectory($modulePath,$moduleName)){
			$controllerName = $paths[1];
			$controllerPath = $modulePath .'/'. $moduleName . '/controller';
			checkDirectory($controllerPath,$controllerName);
			if(checkDirectory($controllerPath,$controllerName)){
				$filePath = $controllerPath.'/'.$controllerName.'/'.$paths[2].'.php';
                if(file_exists($filePath)){
                    // startupFramework($paths);
                    $controller->dispatch(new Action($paths));
                    // Output
                    $response->setCompression($config->get('config_compression'));
                    $response->output();
                }else{
					echo "Not found controller";
                }
			}else{
				echo "Not found controller folder";
			}
		}else{
			echo "Not found this module";
		}
	}else{
        echo "Not found page";
	}
}else{
	echo "Plase create you project";
}
