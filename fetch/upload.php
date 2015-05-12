<?php

session_start();

require_once "includes/main.php";
require_once "includes/db.php";

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    if (isset($_FILES['document'])) {
        switch ($_FILES['document']['error']) {
        case UPLOAD_ERR_OK:
            //what file to save it in
            $path = "uploads/";
            //build the stored file path
            // $path = $path . basename( $_FILES['document']['name']);
            $filename = $_FILES['document']['name'];

            if (true == fieldExistsInColumn($filename, "name", "file")) {
                echo "File $filename already exists. Please rename your file, or " .
                     "try a different file.";
                header("Refresh: 6; ./dashboard.php");
            } else {
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $file_contents = file_get_contents($_FILES['document']['tmp_name']);
                $mime_type = $finfo->buffer($file_contents);
                $move_file_successfully = move_uploaded_file(
                    $_FILES['document']['tmp_name'], $path . $filename
                );
                if ($move_file_successfully) {
                    print_r('move_file_successfully');
                    insertNewFile(
                        $_SESSION['username'],
                        $path,
                        $filename,
                        $mime_type
                    );
                    header("Refresh: 6; dashboard.php");
                } else {
                    echo "<div>File {$_FILES['document']['name']} was not moved " .
                         "successfully. The error may stem from a permissions " .
                         "issue on the target directory.</div>\n";
                }
            }
            break;

        case UPLOAD_ERR_INI_SIZE:
            echo "<div>The size of the uploaded file is larger than " .
                 "MAX_FILE_SIZE.</div>\n";
            break;

        case UPLOAD_ERR_FORM_SIZE:
            echo "<div>The size of the uploaded file is larger than the value " .
                 "of the form’s MAX_FILE_SIZE element.</div>\n";
            break;

        case UPLOAD_ERR_PARTIAL:
            echo "<div>Only part of the file was uploaded.</div>\n";
            break;

        case UPLOAD_ERR_NO_FILE:
            echo "<div>There was no file uploaded.</div>\n";
            break;

        case UPLOAD_ERR_NO_TMP_DIR:
            echo "<div>The upload failed because there was no temporary directory " .
                 "to store the file.</div>\n";
            break;

        case UPLOAD_ERR_CANT_WRITE:
            echo "<div>PHP couldn’t write the file to disk.</div>\n";
            break;

        default:
            echo "<div>Abnormal error in <code>upload_audio.php</code>. Hit the " .
                 "back button on your browser and try again.</div>\n";
            break;
        }
    } else {
        echo "<div>An unknown upload error has occurred, possibly due to a file " .
             "size larger than MAX_FILE_SIZE. Hit the back button on your browser " .
             "and try again.</div>\n";
    }
}
