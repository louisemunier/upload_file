<?php

define("ERRORMESSAGE", [
    '0' => 'Aucune erreur',
    '1' => 'La taille fichier téléchargé exède valeur maximale.',
    '2' => 'La Taille fichier téléchargé exède valeur maximale.',
    '3' => 'Fichier partiellement téléchargé.',
    '4' => 'Aucun fichier téléchargé.',
    '6' => 'Erreur lors du téléchargement.',
    '7' => 'Une erreur est survenue lors de l\'écriture du fichier sur le disque.',
    '8' => 'Erreur d\'extension.'
]);

if(isset($_POST['submit'])) {

    $upload_dir = 'uploads/';
    $files = $_FILES['files'];
    $uploaded = [];
    $failed = [];
    $allowed = ['jpg','jpeg','png','gif'];

    // echo '<pre>', print_r($files), '</pre>';
    if(count($files['name']) > 0) {

        foreach ($files['name'] as $key => $file_name) {
            $file_tmp = $files['tmp_name'][$key];
            $file_size = $files['size'][$key];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_error = ERRORMESSAGE[$files['error'][$key]];
            $file_error_key = $files['error'][$key];

            if (in_array($file_ext, $allowed)) {
//  var_dump($file_error_key);die;
                if($file_error_key === 0) {
                    if($file_size <= 1048576) {
                        $file_name_new = uniqid().'.'.$file_ext;
                        $file_dest = $upload_dir.'image'.$file_name_new;

                        if(move_uploaded_file($file_tmp, $file_dest)) {
                            $uploaded[$key] = $file_dest;
                            $_SESSION['success'] = 1;
                        } else {
                            $failed[$key] = "Le téléchargement de '{$file_name}' a échoué.";
                            $_SESSION['success'] = 0;
                        }

                    } else {
                        $failed[$key] = "'{$file_size}' est trop lourd; La taille ne doit pas dépasser 1Mo.({$file_error}). ";
                        $_SESSION['success'] = 0;
                    }

                } else {
                    $failed[$key] = "'{$file_name}' n'a pu être téléchargé. ({$file_error})";
                    $_SESSION['success'] = 0;
                }

            } else {
                $failed[$key] = "'{$file_name}' l'extension '{$file_ext}' n'est pas valide.";
                $_SESSION['success'] = 0;
            }
        }


        if(!empty($uploaded)) {
            // foreach ($uploaded as $key => $value) {
            //     echo 'value : '.$value;
            // }

        }
        if(!empty($failed)) {
            foreach ($failed as $key => $value) {
                echo 'key : '.$key.', value : '.$value;
            }
            
        }
    }

    $it = new FilesystemIterator(dirname('uploads'));
    $nbrImages = scandir($upload_dir);
    var_dump($nbrImages);
    // die;


// echo '<pre>', print_r($_SESSION), '</pre>';

}



// if(isset($_GET['file']) && !empty($_GET['file']))
// {
//     $fileToDelete = urldecode($_GET['file']);
//     unlink($dir.$fileToDelete);
//     header('Location: upload.php');
// }


/* messages d'erreur
- UPLOAD_ERR_OK = 0 : aucune erreur
- UPLOAD_ERR_INI_SIZE = 1 : taille fichier téléchargé exède valeur upload_max_files du php.ini
- UPLOAD_ERR_FORM_SIZE = 2 : taille fichier téléchargé exède valeur max_file_size du form
- UPLOAD_ERR_PARTIAL = 3 : partiellement téléchargé
- UPLOAD_ERR_NO_FILE = 4 : aucun fichier téléchargé
- UPLOAD_ERR_NO_TMP_DIR = 6 : dossier temporaire manquant
- UPLOAD_ERR_CANT_WRITE = 7 : échec écriture du fichier sur le disque
- UPLOAD_ERR_EXTENSION = 8 : extension php a arrêté l'envoi du fichier
*/

/* fonctions utiles
filesize : lit la taille d'un fichier
mime_content_type : détecte le type de contenu
uniqid : génère un id unique
pathinfo : infos chemin système (ex: PATHINFO_EXTENSION)
unlink : supprimer un fichier
*/


 ?>

 
<!DOCTYPE html>
 <html>
     <head>
         <meta charset="utf-8">
         <title>Multiple Upload file</title>
         <link rel="stylesheet" href="style.css" type="text/css">
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
         <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
         <script
			  src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
			  integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
			  crossorigin="anonymous"></script>
         <script type="text/javascript" src="javascript.js"></script>
         <style>
            @import url('https://fonts.googleapis.com/css?family=Pacifico');
        </style>
     </head>
     <body>
         <div class="container-fluid">
             <div class="row justify-content-md-center">
                 <h1>Uploader des fichiers</h1>
             </div>
             <!-- formulaire d'upload -->
             <div class="col-md-4 col-sm-12">
                 <form class="" action="index.php" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                         <label for="files">Indications : taille max 1Mo, jpg/png/gif, nom de fichier = image{id_unique}.ext</label>
                         <input type="hidden" name="MAX_FILE_SIZE" value="1048576"/>
                         <input type="hidden" name="POST_MAX_SIZE" value="1048576"/>
                         <input class="form-control-file" type="file" name="files[]" value="" multiple="multiple">
                         <input class="btn" type="submit" name="submit" value="Valider">
                     </div>
                 </form>
             </div>
             <!-- visualisation des images -->
             <div class="col-md-8 col-sm-12 preview">

             </div>
         </div>
     </body>
 </html>
