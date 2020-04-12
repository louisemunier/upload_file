<?php
    require 'upload.php';
    session_start();
    $upload_dir = 'uploads/';

    $_SESSION['nbrFiles'] = count(scandir($upload_dir)) -2;
    $_SESSION['files'] = scandir($upload_dir);

 ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Multiple Upload file</title>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script
		  src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
		  integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
		  crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/javascript.js"></script>
        <script type="text/javascript" src="js/ui.js"></script>
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
                            <!-- drag & drop -->
                            <fieldset>
                                <!-- <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" /> -->
                                <div>
                                    <!-- <label for="fileselect">Files to upload:</label> -->
                                    <!-- <input type="file" id="fileselect" name="fileselect[]" multiple="multiple" /> -->
                                    <div id="filedrag">Drop files here or with the form below</div>
                                </div>
                                <div id="submitbutton">
                                    <button type="submit">Upload</button>
                                </div>
                            </fieldset>
                                <!-- <div id="messages">
                                    <p>Status Messages</p>
                                </div> -->
                            <!-- </div> -->

                            <div class="input-group mb-3">
                                <input class="form-control" id="file" type="file" name="files[]" value="" multiple="multiple">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" name="submit"><i class="fa fa-check"></i> validate</button>
                                </div>
                            </div>
                            <input type="hidden" name="MAX_FILE_SIZE" value="1048576"/>
                            <input type="hidden" name="POST_MAX_SIZE" value="1048576"/>

                        </div>
                    </form>
                    
                    <div id="messages">
                        <p>Pending file(s)</p>
                    </div>
                    <?php
                        if (isset($_SESSION) && isset($_SESSION['success'])) {
                            if ($_SESSION['success'] === 0) {
                                $alertInfo = 'No picture saved !';
                                $alertType = 'alert-danger';
                            } else {
                                $alertInfo = 'Your(s) picture(s) has been saved !';
                                $alertType = 'alert-info';
                            }
                        } else{
                            $alertInfo = null;
                            $alertType = null;
                        }
                    ?>
                    <div class="alert <?php echo $alertType ?> alert-dismissible fade show" role="alert" style="<?php if(is_null($alertType)) { echo "display:none;"; } ?>">
                        <p><?php if(!is_null($alertInfo)) { echo $alertInfo; } ?></p>
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
                    <p><?php if ($_SESSION['nbrFiles'] === 1) { echo 'You downloaded '.$_SESSION['nbrFiles'].' file'; } elseif ($_SESSION['nbrFiles'] > 1) { echo 'You have download '.$_SESSION['nbrFiles'].' files'; } ?></p>
                    <div class="img-preview">
                        <?php
                        $loop = 0;
                        foreach ($_SESSION['files'] as $key => $img) {
                            $loop++;
                            if($key > 1){
                                echo '<div class="thumbnail"><img src="'.$upload_dir.'/'.$img.'" alt="'.$img.'" class="img-thumbnail img-responsive"><figcaption>'.$img.'  <a class="remove" href="index.php?file='.urlencode($upload_dir.$img).'"><i class="fa fa-trash"></i></a></figcaption></div>';
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
</html>


