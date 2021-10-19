<?php
include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
function allpath($path, $extension)
{
    $files = array();

    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $file)
    {
        if (pathinfo($file, PATHINFO_EXTENSION) == $extension)
            $files[] = (string)$file;
            echo '<a target="_blank" href="'.$file.'">'.$file.'</a></br>';
    }
    echo '</br>';
    return $files;
}

print_r(allpath('../public', 'php'));
?>
