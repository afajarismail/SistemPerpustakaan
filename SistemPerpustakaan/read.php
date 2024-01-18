<?php
if (isset($_GET['file'])) {
    $file_path = 'BUKU/' . $_GET['file'];

    if (file_exists($file_path)) {
        // You can customize the method of displaying the book content here
        // For example, you might want to embed a PDF viewer or use other methods.
        // In this example, we are using an iframe to display the PDF.
        echo "<iframe src='https://docs.google.com/gview?url=" . urlencode($file_path) . "&embedded=true' style='width:100%; height:500px;' frameborder='0'></iframe>";
    } else {
        echo 'File not found.';
    }
}
?>
