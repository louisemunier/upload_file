<?php
    require 'index.php';
    session_start();
    $upload_dir = 'uploads';

    $_SESSION['nbrFiles'] = count(scandir($upload_dir)) -2;
    $_SESSION['files'] = scandir($upload_dir);

 ?>

 <!DOCTYPE html>
 <html>
     <head>
         <meta charset="utf-8">
         <title>Multiple Upload file</title>
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
         <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
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
                             <!-- <div class="row">
                                 <div class="col-8">
                                     <input class="form-control" type="file" name="files[]" value="" multiple="multiple" required>
                                 </div>
                                 <div class="col-2">
                                     <input class="btn" type="submit" name="submit" value="Valider">
                                 </div>
                             </div> -->

                             <div class="input-group mb-3">
                                 <input class="form-control" id="file" type="file" name="files[]" value="" multiple="multiple" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit"name="submit"><i class="fa fa-check"></i> validate</button>
                                </div>
                            </div>
                             <input type="hidden" name="MAX_FILE_SIZE" value="1048576"/>
                             <input type="hidden" name="POST_MAX_SIZE" value="1048576"/>

                         </div>
                     </form>
                     <?php
                        if ($_SESSION['success'] === 0) {
                            $alertInfo = 'No picture saved !';
                            $alertType = 'alert-danger';
                        } else {
                            $alertInfo = 'Your(s) picture(s) has been saved !';
                            $alertType = 'alert-info';
                        }
                     ?>
                     <div class="alert <?php echo $alertType ?> alert-dismissible fade show" role="alert">
                         <p><?php echo $alertInfo ?></p>
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div id="prev">
                         <p id="error-msg"></p>
                     </div>
                 </div>
                 <!-- visualisation des images -->
                 <div class="col-md-8 col-sm-12 preview" data-dlfiles="<?php echo $_SESSION['nbrFiles']; ?>">
                     <p><?php if ($_SESSION['nbrFiles'] === 1) { echo 'You have download '.$_SESSION['nbrFiles'].' file'; } elseif ($_SESSION['nbrFiles'] > 1) { echo 'You have download '.$_SESSION['nbrFiles'].' files'; } ?></p>
                     <div class="img-preview">
                         <?php
                         $loop = 0;
                         foreach ($_SESSION['files'] as $key => $img) {
                             $loop++;
                             if($key > 1){
                                 echo '<div class="thumbnail"><img src="'.$upload_dir.'/'.$img.'" alt="'.$img.'" class="img-thumbnail img-responsive"><figcaption>'.$img.'  <a class="remove" href=""><i class="fa fa-trash"></i></a></figcaption></div>';
                             }
                         } ?>
                     </div>
                 </div>
             </div>
         </div>
     </body>
 </html>

 <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="javascript.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
