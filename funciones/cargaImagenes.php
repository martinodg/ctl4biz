<?php


/**
 * @param array $fileResource $_FILES[valor]
 * @return array path  and filename
 * @throws Exception
 */
function cargarFotorticulo($codigoArticulo,$fileResource){
    $fileTmpPath = $fileResource['tmp_name'];
    $fileName = $fileResource['name'];
    $fileSize = $fileResource['size'];
    $fileType = $fileResource['type'];
    $fileNameCmps = explode('.', $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    checkExtension($fileExtension);
    checkImageSize($fileTmpPath, 200,200);
    $newFileName = 'foto' . $codigoArticulo . '.' . $fileExtension;
    $filePath = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'fotos'.DIRECTORY_SEPARATOR.$newFileName;
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