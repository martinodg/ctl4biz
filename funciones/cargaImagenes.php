<?php

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
function retornarNombreDirectorioItemsEmpresa()
{
    if(!isset($_SESSION['BaseDeDatos'])){
        throw new Exception('No esta definido el directorio de la empresa.');
    }
    return $_SESSION['BaseDeDatos'];
}

/**
 * Retorna el path de los items de la empresa
 * @return string
 * @throws Exception
 */
function retornarPathItemEmpresa (){
    $directorioEmpresa = retornarNombreDirectorioItemsEmpresa();
    return $directorioEmpresa.DIRECTORY_SEPARATOR.'items'.DIRECTORY_SEPARATOR;
}

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
    $directorioEmpresa = retornarNombreDirectorioItemsEmpresa();
    return __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.$directorioEmpresa;
}

/**
 * @return string
 * @throws Exception
 */
function retornarUrlDiretorioEmpresa (){
    $directorioEmpresa = retornarNombreDirectorioItemsEmpresa();
    return '/img/'.$directorioEmpresa;
}


/**
 * @param array $fileResource $_FILES[valor]
 * @return array path  and filename
 * @throws Exception
 */
function cargarFotorticulo($codigoArticulo,$fileResource)
{
    $directorioEmpresa = retornarNombreDirectorioItemsEmpresa();
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