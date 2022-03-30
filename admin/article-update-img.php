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

    // Restrict the file size
    if ($_FILES['file']['size'] > 1000000) {

      throw new Exception('File is too large');
    }

    $mime_types = ['image/gif', 'image/png', 'image/jpeg'];

    // create new file info ressource
    // pass new file info ressource + path of uploaded file
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);

    // checking mime type
    if (!in_array($mime_type, $mime_types)) {
      throw new Exception('Invalid file type');
    }

    // split file path into various parts
    // select filename
    // sanitise filename
    // restrict filename lenght
    // reconstruct filename + type
    $pathinfo = pathinfo($_FILES['file']['name']);
    $base = $pathinfo['filename'];
    $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);
    $base = mb_substr($base, 0, 200);
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

    // move file to upload folder + database
    if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {

      // allocate current value of img file attribute to variable
      $previous_image = $article->image_file;

      if ($article->setImageFile($conn, $filename)) {

        if ($previous_image) {
          unlink("../uploads/$previous_image");
        }

        Url::redirect("/admin/article?id={$article->id}");
      }
    } else {
      throw new Exception('Unable to move uploaded file');
    }
  } catch (Exception $e) {
    $error = $e->getMessage();
  }
}


?>

<!-- header -->
<?php require '../includes/header.php'; ?>


<!-- main -->
<div class="container stack">
  <h2>Update article image</h2>

  <?php if ($article->image_file) : ?>
    <img src="/uploads/<?= $article->image_file; ?>">
    <a href="article-delete-img?id=<?= $article->id; ?>">Delete</a>
  <?php endif; ?>

  <?php if (isset($error)) : ?>
    <p><?= $error; ?></p>
  <?php endif; ?>

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