<?php
echo '<div class="container">';
echo '<div class="grid-container">';
foreach (glob("../../img/avatars/*.*") as $filename) {
    echo '<div class="grid-item"><a href="#"><img class="avatarImg" src="'.$filename.'" onClick="avatarSelected(&apos;'.$filename.'&apos;)" ></a></div>';
}
echo '</div>';
echo '<div id="BtDiv">';
echo '   <form action="../../funciones/BackendQueries/uploadFile.php" method="post" enctype="multipart/form-data">';
echo '            <div class="BtContainer">';
echo '                <div class="button-wrap">';
echo '                    <label class="button" for="fileToUpload">Seleciona Archivo</label>';
echo '                    <input type="file" name="fileToUpload" id="fileToUpload">';
echo '                </div>';
echo '            </div>';
echo '      <a href="#"> <button type="submit" value="Upload Image" name="submit" id="btSelectPhoto" onmouseover="style.cursor=cursor">';
echo '                      <img src="../../img/w-upload.svg"><span id="tupphoto">Sube tu foto</span>';
echo '                  </button>';
echo '      </a>';
echo '  </form>   ';
echo'</div>';
?>