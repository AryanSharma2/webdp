<?php

include 'php-image-resize-master\lib\ImageResize.php';
use \Gumlet\ImageResize;

$houseName  = filter_input(INPUT_POST, 'houseName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$houseId = filter_input(INPUT_POST, 'houseId', FILTER_SANITIZE_NUMBER_INT);
$slug = filter_input(INPUT_POST, "slug", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$imgg = "";
print_r($_FILES);
function file_upload_path($original_filename, $upload_subfolder_name = 'images')
{
    $current_folder = dirname(__FILE__);
    $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
    return join(DIRECTORY_SEPARATOR, $path_segments);
}

function file_is_an_image($temporary_path, $new_path)
{
    $allowed_mime_types = ['image/jpg'];
    $allowed_file_extensions = ['jpg'];
    $actual_file_extension = pathinfo($new_path, PATHINFO_EXTENSION);
    $actual_mime_type = $_FILES['image']['type'];

    $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
    $mime_type_is_valid = in_array($actual_mime_type, $allowed_mime_types);
    return $file_extension_is_valid && $mime_type_is_valid;
}

$image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
$upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);

if ($image_upload_detected) {
    $image_filename = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
    $image_fileExtention = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $temporary_image_path = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $new_image_path = file_upload_path($_FILES['image']['name']);
    if (file_is_an_image($temporary_image_path, $new_image_path)) {
        move_uploaded_file($temporary_image_path, $new_image_path);
        $imgg = $_FILES['image']['name'];
        $medImage = new ImageResize(file_upload_path($image_filename . "." . $image_fileExtention));
        $medImage->resize(400);
        $medImage->save(file_upload_path($image_filename . "." . $image_fileExtention));
    }
}

if($_POST['command'] == "Delete")
{
    require('connect.php');

    $query = "DELETE FROM house WHERE houseId = :houseId";
    $statement = $db->prepare($query);
    $statement->bindValue(':houseId', $houseId, PDO::PARAM_INT);
    $statement->execute();

    header("Location: houses.php");
    exit;
}

elseif($_POST['command'] == "Edit")
{
    require('connect.php');
    $query     = "UPDATE house SET houseName = :houseName, Description = :description, Slug = :slug WHERE houseId = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':houseName', $houseName);        
    $statement->bindValue(':description', $_POST['description']);
    $statement->bindValue(':slug', $slug);
    $statement->bindValue(':id', $houseId, PDO::PARAM_INT);
    
    // Execute the INSERT.
    $statement->execute();
    header("Location: houses.php");
    exit;
}


elseif($_POST['command'] == "Create")
{
    require('connect.php');

    $query     = "INSERT INTO house (HouseName, BannerImage, Description, Slug) values (:HouseName, :BannerImage, :Description, :Slug)";
    $statement = $db->prepare($query);
    $statement->bindValue(':HouseName', $houseName);     
    // $statement->bindValue(':BannerImage', pathinfo($_FILES['image']['name'], PATHINFO_BASENAME));
    $statement->bindValue(':BannerImage', $imgg);
    $statement->bindValue(':Description', $description);
    $statement->bindValue(':Slug', $slug);
    $statement->execute();
    
    header("Location: houses.php");
    exit;
}

?>