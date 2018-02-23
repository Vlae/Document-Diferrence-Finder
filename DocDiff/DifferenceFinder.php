<?php

namespace DocDiff;

/**
 * Class finds difference between two files and make output into file/browser
 *
 * Class DifferenceFinder
 * @package DocDiff
 */

class DifferenceFinder extends AbstractDifferenceFinder
{
    const ECHO_OUTPUT = 0;
    const FILE_OUTPUT = 1;

    /** @var string $file1 - path to existing file */
    protected $file1;

    /** @var string $file2 - path to existing file */
    protected $file2;

    /** @var string $outputPath */
    protected $outputPath;

    /** @var int $outputType */
    protected $outputType = self::ECHO_OUTPUT;

    /** @var bool $hasDifference **/
    protected $hasDifference = false;

    /** @var string $differenceString */
    protected $differenceString = '';

    public function __construct(string $file1 , string $file2, string $outputFilePath = '') {
        $this->setFilesPath($file1, $file2);

        $this->validateFiles();
        $this->parseDifference();

        $this->setOutputFilePath($outputFilePath);
        $this->outputDifference();
    }

    protected function validateFiles() {
        // TODO::make exceptions
        if (!is_file($this->file1)) {
            die('file "' . $this->file1 . '" not available');
        }

        if (!is_file($this->file2)) {
            die('file "' .$this->file2 . '" not available');
        }
    }

    /** Executes diff command and generates output*/
    private function parseDifference() {
        $diffCommand = 'diff ' .$this->file1. ' ' . $this->file2 . ' --speed-large-files -b';
        exec($diffCommand, $differenceArray, $returnValue);

        $this->setDifferenceString($differenceArray);
    }

    protected function outputDifference() {
        if ($this->outputType === self::ECHO_OUTPUT) {
            $this->echoDifference();
        } elseif ($this->outputType === self::FILE_OUTPUT) {
            $this->writeDifferenceIntoFile();
        }
    }

    protected function setOutputFilePath(string $outputPath) {
        if ($outputPath !== '') {
            if ($outputPath === '/') {
                $this->outputPath = '';
            } else {
                $outputPath = $outputPath . '/';
            }

            $this->outputType = self::FILE_OUTPUT;
            $this->outputPath = $outputPath;
        }
    }

    protected function setFilesPath(string $file1, string $file2) {
        $this->file1 = $file1;
        $this->file2 = $file2;
    }



    protected function writeDifferenceIntoFile() {
        $handler = fopen($this->outputPath . $this->generateFileName(), 'w+');
        fwrite($handler, $this->differenceString);
        fclose($handler);
        echo date('H:i:s') . ': document created successfully';
    }

    /** Outputs difference data into browser */
    protected function echoDifference() {
        echo $this->differenceString;
    }

    protected function generateFileName() {
        return date('d-m-Y--G-i-s');
    }

    /**
     * Get difference only for first file
     *
     * @param array $filesDifference
     */
    private function setDifferenceString(array $filesDifference) {
        $size = count($filesDifference);

        $outputString = '';
        for ($i = 1; $i < $size; $i = $i + 2) {             // exec diff takes first elem of array for hash
            $outputString .= str_replace(['<', '>'], '', $filesDifference[$i]) . PHP_EOL;   // Takes only differences for first file
        }

        $this->differenceString = $outputString;
    }
}