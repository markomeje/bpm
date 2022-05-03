<?php

/**
 * Simple build script.
 */

$inputPath = __DIR__ . '/../vendor/umpirsky/';
$outputPath = __DIR__ . '/../data/';
$types = ['country', 'currency', 'language'];

$start = time();

foreach ($types as $type) {
    echo sprintf("Building %s data folder ...\n", $type);

    $dataFolder = $inputPath . $type . '-list/data/';
    $localeFolders = array_diff(scandir($dataFolder), ['..', '.']);

    foreach ($localeFolders as $localeFolder) {
        $inputFile = $dataFolder . $localeFolder . '/' . $type . '.php';

        if (! file_exists($inputFile)) {
            throw new \LogicException(sprintf('File "%s" not found', $inputFile));
        }

        $data = require_once($inputFile);

        if (! is_array($data)) {
            throw new \LogicException(sprintf('Unexpected content in file "%s"', $inputFile));
        }

        $outputFolder = $outputPath . $type . '/' . $localeFolder;
        $outputFile = $outputFolder . '/' . $type . '.php';

        if (! is_dir($outputFolder)) {
            if (! mkdir($outputFolder, 0777, true)) {
                throw new \LogicException(sprintf('Failed to create directory "%s"', $outputFolder));
            }
        }

        $data =  "<?php\n\n// FILE GENERATED AUTOMATICALLY\n// DO NOT EDIT\n\nreturn ".var_export($data, true).';';

        if (! file_put_contents($outputFile, $data)) {
            throw new \LogicException(sprintf('Failed to create file "%s"', $outputFile));
        }
    }
}

$elapsed = time() - $start;
echo sprintf("Build finished in %s seconds.\n", $elapsed);
