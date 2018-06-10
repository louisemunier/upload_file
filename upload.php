<?php
    require 'index.php';
 ?>

 <!DOCTYPE html>
 <html>
     <head>
         <meta charset="utf-8">
         <title>Multiple Upload file</title>
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
         <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
         <link rel="stylesheet" href="style.css" type="text/css">
         <style>
            /*@import url('https://fonts.googleapis.com/css?family=Pacifico');*/
        </style>
     </head>
     <body>
         <div class="container-fluid">
             <div class="row justify-content-md-center title">
                 <h1>Upload files & watch them</h1>
             </div>
             <div class="row">
                 <!-- formulaire d'upload -->
                 <div class="col-md-4 col-sm-12 form">
                     <form class="" action="upload.php" method="post" enctype="multipart/form-data">
                         <div class="form-group">
                             <label for="files"><strong class="text-uppercase font-weight-bold">Indications </strong>: </label>
                             <ul class="list-unstyled">
                                 <li>max size : 1Mo</li>
                                 <li>allowed extension : jpg/png/gif</li>
                             </ul>
                             <input type="hidden" name="MAX_FILE_SIZE" value="1048576"/>
                             <input type="hidden" name="POST_MAX_SIZE" value="1048576"/>
                             <input class="form-control-file" type="file" name="files[]" value="" multiple="multiple" required>
                             <input class="btn" type="submit" name="submit" value="Valider">
                         </div>
                     </form>
                 </div>
                 <!-- visualisation des images -->
                 <div class="col-md-8 col-sm-12 preview">
                     <p>Résultats :  <?php echo count($nbrImages) - 2; ?></p>
                     <div class="img-preview">
                         <?php
                         $loop = 0;
                         foreach ($nbrImages as $key => $img) {
                             $loop++;
                             if($key > 1){
                                 echo '<div class=""><img src="'.$upload_dir.'/'.$img.'" alt="'.$img.'" class="img-thumbnail img-responsive"><figcaption>'.$img.'</figcaption></div>';
                             }
                         } ?>
                     </div>
                 </div>
             </div>
         </div>
     </body>
 </html>
