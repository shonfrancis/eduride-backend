<?php

$dir = __DIR__ . '/app/Models/';
$files = scandir($dir);

foreach ($files as $file) {
    if (strpos($file, '.php') === false || $file === 'User.php') continue;

    $path = $dir . $file;
    $fileContent = file_get_contents($path);
    
    // Check if guarded is already there
    if (strpos($fileContent, '$guarded = []') !== false) {
        continue;
    }

    $pattern = '/use HasFactory;\n}/';
    $replacement = "use HasFactory;\n\n    protected \$guarded = [];\n}";
    
    $fileContent = preg_replace($pattern, $replacement, $fileContent);
    file_put_contents($path, $fileContent);
    echo "Updated $file\n";
}
