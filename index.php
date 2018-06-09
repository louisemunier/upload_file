<?php

$upload_dir = 'uploads';
$files = $_FILES['files'];
$uploaded = [];
$failed = [];
$allowed = ['jpg','jpeg','png','gif'];

// foreach ($_FILES['files']['error'] as $key => $error) {
//     if($error === UPLOAD_ERR_OK){
//         // $tmp_name = $_FILES['files']['tmp_name'][$key];
//         $extension = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
//         // générer un nom de fichier
//         $uploadFile = $upload_dir.basename($_FILES['files']['name'][$key]).uniqid().'.'.$extension;
//         // déplacer le fichier
//         move_uploaded_file($_FILES['files']['tmp_name'], $uploadFile);
//     }
// }
// echo '<pre>', print_r($files), '</pre>';


foreach ($files['name'] as $key => $file_name) {
    $file_tmp = $files['tmp_name'][$key];
    $file_size = $files['size'][$key];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_error = $files['error'][$key];
// var_dump($file_tmp);die;

    if (in_array($file_ext, $allowed)) {
        if($file_error === 0) {
            if($file_size <= 1048576) {
                $file_name_new = uniqid().'.'.$file_ext;
                $file_dest = $upload_dir.'/image'.$file_name_new;ie;

                if(move_uploaded_file($file_tmp, $file_dest)) {
                    $uploaded[$key] = $file_dest;
                } else {
                    $failed[$key] = "Le téléchargement de '{$file_name}' a échoué.";
                }

            } else {
                $failed[$key] = "'{$file_size}' est trop lourd ({$file_error}). La taille ne doit pas dépasser 1Mo.";
            }

        } else {
            $failed[$key] = "'{$file_name}' n'a pu être téléchargé. Le code erreur = {$file_error}";
        }

    } else {
        $failed[$key] = "'{$file_name}' l'extension '{$file_ext}' n'est pas valide.";
    }
}



if(!empty($uploaded)) {
    print_r($uploaded);
}
if(!empty($failed)) {
    print_r($failed);
}

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
pathinfo: infos chemin système (ex: PATHINFO_EXTENSION)
*/






 ?>