<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) {

  $article = Article::getByID($conn, $_GET['id']);

  if (!$article) {
    die("article not found");
  }
} else {
  die("id not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  var_dump($_FILES);

  // catching errors + size
  try {
    if (empty($_FILES)) {
      throw new Exception('Invalid upload');
    }
    switch ($_FILES['file']['error']) {
      case UPLOAD_ERR_OK:
        break;
      case UPLOAD_ERR_NO_FILE:
        throw new Exception('No file uploaded');
        break;
      case UPLOAD_ERR_INI_SIZE:
        throw new Exception('File is too large (from the server settings)');
        break;
      default:
        throw new Exception('An error occurred');
    }
    if ($_FILES['file']['size'] > 1000000) {
      throw new Exception('File is too large');
    }

    $mime_types = ['image/gif', 'image/png', 'image/jpeg'];

    // create new file info ressource
    // pass new file info ressource + path of uploaded file
    // split file path into various parts
    // select filename
    // sanitise filename
    // reconstruct filename + type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);
    $pathinfo = pathinfo($_FILES['file']['name']);
    $base = $pathinfo['filename'];
    $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);
    $filename = $base . "." . $pathinfo['extension'];

    // create destination path
    $destination = "../uploads/$filename";

    // check if file exists. if so rename
    $i = 1;
    while (file_exists($destination)) {
      $filename = $base . "-$i." . $pathinfo['extension'];
      $destination = "../uploads/$filename";
      $i++;
    }

    // move file to upload folder
    if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
      echo "File uploaded successfully.";
    } else {
      throw new Exception('Unable to move uploaded file');
    }

    // checking mime type
    if (!in_array($mime_type, $mime_types)) {
      throw new Exception('Invalid file type');
    }
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}


?>

<!-- header -->
<?php require '../includes/header.php'; ?>


<!-- main -->
<div class="container stack">
  <h2>Update article image</h2>

  <form method="post" enctype="multipart/form-data" class="stack">
    <div class="stack">
      <label for=" file">Image file</label>
      <input type="file" name="file" id="file">
    </div>
    <button class="space-stack:composition">Upload</button>
  </form>
</div>


<!-- footer -->
<?php require '../includes/footer.php'; ?>