<?php
define('AVATAR_DIRECTORY','users');

/**
 * Retornan la de la db
 * @param string $fileName
 * @throws Exception
 */
function generarUrlDB($fileName)
{
    $directorioEmpresa = retornarNombreDirectorioEmpresa();
    return '../../img/'.$directorioEmpresa.'/'.AVATAR_DIRECTORY.'/'.$fileName;
}

/**
 * Retornan la de la db
 * @param string $fileName
 * @throws Exception
 */
function generarUrlEmpresaDB($fileName)
{
    $directorioEmpresa = retornarNombreDirectorioEmpresa();
    return '../img/'.$directorioEmpresa.'/'.$fileName;
}


/**
 * Retorna el valor
 * @param $valorFile
 * @return bool
 */
function requestHasFile($valorFile):bool
{
    return !empty($_FILES[$valorFile]['name']);
}

/**
 * Salvar
 * @param $nombreUsuario
 * @param $valorFile
 * @return false|string[]
 * @throws Exception
 */
function salvarAvatarUsuario($nombreUsuario, $valorFile){
    if(requestHasFile($valorFile)){
        return cargarAvatarUsuario($nombreUsuario,$_FILES[$valorFile]);
    }
    return false;
}

/**
 * Retorna la ruta de la imagen
 * @param string $filename Url de la imagen
 * @return string
 * @throws Exception
 */
function traerUrlImagenProducto($filename)
{
    return retornarUrlItemEmpresa().$filename;
}

/**
 * Retornar las urls
 * @return string
 * @throws Exception
 */
function retornarNombreDirectorioEmpresa()
{
    if(!isset($_SESSION['BaseDeDatos'])){
        throw new ErrorException('No esta definido el directorio de la empresa.');
    }
    return $_SESSION['BaseDeDatos'];
}

/**
 * Retorna el path de los items de la empresa
 * @return string
 * @throws Exception
 */
function retornarPathAvatarEmpresa (){
    $directorioEmpresa = retornarPathEmpresa();
    $path =  $directorioEmpresa.DIRECTORY_SEPARATOR.AVATAR_DIRECTORY.DIRECTORY_SEPARATOR;
    generarExistenciaDirectorio($path);
    return $path;
}

/**
 * @param string $directoryPath
 * @return string
 * @throws ErrorException
 */
function generarExistenciaDirectorio($directoryPath) {
    //revisar si el directorio existe
    if(!file_exists($directoryPath)){
        try{
            $d =  mkdir($directoryPath,0777,true);
            if($d === false){
                throw  new ErrorException(sprintf('El directorio %s no pudo ser creado',$directoryPath),1,1);
            }
        }catch(Exception $e){
            throw  new ErrorException(sprintf('El directorio %s no pudo ser creado : %s',$directoryPath,$e->getMessage()),1,1);
        }
    }
    return strval($directoryPath);
}

/**
 * Retorna el path de los items de la empresa
 * @return string
 * @throws Exception
 */
function retornarPathItemEmpresa (){
    $directorioEmpresa = retornarPathEmpresa();
    $path =  $directorioEmpresa.DIRECTORY_SEPARATOR.'items'.DIRECTORY_SEPARATOR;
    generarExistenciaDirectorio($path);
    return $path;
}

/**
 * Retonrna la url del directorio de items para esta empresa
 * @return string
 * @throws Exception
 */
function retornarUrlAvatarsEmpresa (){
    $directorioEmpresa = retornarUrlDiretorioEmpresa();
    return $directorioEmpresa.'/users/';
}

/**
 * Retonrna la url del directorio de items para esta empresa
 * @return string
 * @throws Exception
 */
function retornarUrlItemEmpresa (){
    $directorioEmpresa = retornarUrlDiretorioEmpresa();
    return $directorioEmpresa.'/items/';
}

/**
 * Retorna el path de los items de la empresa
 * @return string
 * @throws Exception
 */
function retornarPathEmpresa (){
    $directorioEmpresa = retornarNombreDirectorioEmpresa();
    $path =  __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.$directorioEmpresa;
    generarExistenciaDirectorio($path);
    return $path;
}

/**
 * @return string
 * @throws Exception
 */
function retornarUrlDiretorioEmpresa (){
    $directorioEmpresa = retornarNombreDirectorioEmpresa();
    return '/img/'.$directorioEmpresa;
}

/**
 * @param array $fileResource $_FILES[valor]
 * @return array path  and filename
 * @throws Exception
 */
function cargarFotoArticulo($codigoArticulo, $fileResource)
{
    $pathItemEmpresa = retornarPathItemEmpresa();
    $fileTmpPath = $fileResource['tmp_name'];
    $fileName = $fileResource['name'];
    $fileNameCmps = explode('.', $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = 'foto' . $codigoArticulo . '.' . $fileExtension;
    $filePath =$pathItemEmpresa.$newFileName;
    if(file_exists($filePath)) {
        unlink($filePath);
    }
    if(!move_uploaded_file($fileTmpPath, $filePath)) {
        throw new Exception('El archivo no pudo ser movido');
    }
    return array(
        'path' => $filePath,
        'fileName' => $newFileName
    );
}

/**
 * @param $fileExtension
 * @param string[] $allowedExtensions
 * @return bool  true
 * @throws Exception Validation exception
 */
function checkExtension($fileExtension,$allowedExtensions =  array('jpg')){
    if(!in_array($fileExtension, $allowedExtensions)){
        throw new Exception(sprintf('The %s extension is not among those allowed ( %s )',$fileExtension,implode(',',$allowedExtensions)));
    }
    return true;
}

/**
 * @param string $filePath FilePath
 * @param int $requiredWith
 * @param int $requiredHeight
 * @return bool true
 * @throws Exception Validation exception
 */
function checkImageSize($filePath, $requiredWith, $requiredHeight ){
    list($width, $height, $type, $attr) = getimagesize($filePath);
    if($width != $requiredWith){
        throw new Exception(sprintf('Width %s is different from required %s',$width,$requiredWith));
    }
    if($height != $requiredHeight){
        throw new Exception(sprintf('Height %s is different from required %s',$height,$requiredHeight));
    }
    return true;
}

/**
 * Permite la carga de una imagen png como avatar del usuario
 * @param  string $username nombre de usuario
 * @param $fileResource
 * @return string[]
 * @throws Exception
 */
function cargarAvatarUsuario($username,$fileResource){
    sanitizarNombreDirectorio($username);
    $pathItemEmpresa = retornarPathAvatarEmpresa();
    $fileTmpPath = $fileResource['tmp_name'];
    $fileName = $fileResource['name'];
    $fileNameCmps = explode('.', $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    checkExtension($fileExtension,['png']);
    $newFileName =  $username. '.' . $fileExtension;
    $filePath =$pathItemEmpresa.$newFileName;
    if(file_exists($filePath)) {
        unlink($filePath);
    }
    if(!move_uploaded_file($fileTmpPath, $filePath)) {
        throw new Exception('El archivo no pudo ser movido');
    }
    return array(
        'path' => $filePath,
        'fileName' => $newFileName,
        'dbUrl' => generarUrlDB($newFileName),
    );
}

/**
 * Reemplaza los caracteres que tengan que ser convertidos para generar una url mas limpia
 * @param string $nombreDirectorio Nombre del directorio  a crear
 * @param int $max cantidad de caracteres
 * @return string Nombre del directorio convertido
 */
function sanitizarNombreDirectorio(&$nombreDirectorio, $max = 40)
{
    $out = substr(preg_replace("/[^-\/+|\w ]/", '', $nombreDirectorio), 0, $max);
    $out = strtolower(trim($out, '-'));

    return  preg_replace("/[\/_| -]+/", '-', $out);
}

/**
 * Permite la carga de una imagen png como avatar del usuario
 * @param  string $fileName nombre de usuario
 * @param $fileResource
 * @return string[]
 * @throws Exception
 */
function cargarLogoCompania($fileResource,$fileName = 'logo', $extension='jpg,jpeg,png,svg'){
    $pathItemEmpresa = retornarPathEmpresa();
    $tmpName = $fileResource['name'];
    $fileNameCmps = explode('.', $tmpName);
    //valida que sea un jpg
    $fileExtension = strtolower(end($fileNameCmps));
    checkExtension($fileExtension,explode(',',$extension));
    //
    $newFileName =  $fileName. '.'.$fileExtension;
    $filePath =$pathItemEmpresa.DIRECTORY_SEPARATOR.$newFileName;
    if(file_exists($filePath)) {
        unlink($filePath);
    }
    if(!move_uploaded_file($fileResource['tmp_name'], $filePath)) {
        throw new Exception('El archivo no pudo ser movido');
    }
    return array(
        'path' => $filePath,
        'fileName' => $newFileName,
        'dbUrl' => generarUrlEmpresaDB($newFileName),
    );
}

/**
 * Salvar el logo de la compania
 * @param string $valorFile Key en la que se envio el valor
 * @param string  $fileName nombre del logo
 * @param string  $extension extension del logo
 * @return false|string[]
 * @throws Exception
 */
function salvarLogoCompania($valorFile,$fileName = 'logo', $extension='jpg,jpeg,png,svg'){
    if(requestHasFile($valorFile)){
        return cargarLogoCompania($_FILES[$valorFile], $fileName,$extension);
    }
    return false;
}