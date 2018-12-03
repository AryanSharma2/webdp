<?php
    $search = filter_input(INPUT_POST, 'search_text', FILTER_SANITIZE_SPECIAL_CHARS);
    header("Location: houses.php?searchResult=$search");
    exit;
?>