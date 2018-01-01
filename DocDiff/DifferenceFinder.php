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

    /** @var string $outputFile - path to output file */
    protected $outputFile;

    /** @var int $outputType */
    protected $outputType = self::ECHO_OUTPUT;

    /** @var bool $hasDifference **/
    protected $hasDifference = false;

    public function __construct(string $file1 , string $file2, string $outputFilePath = '') {
        $this->validateFiles();
        $this->parseDifference();

        $this->setFilesPath($file1, $file2);
        $this->setOutputFilePath($outputFilePath);

        $this->outputDifference();
    }

    protected function validateFiles() {
        // TODO::make exceptions
        if (!is_file($this->file1)) {
            die ($this->file1 . ' not available');
        }

        if (!is_file($this->file2)) {
            die ($this->file2 . ' not available');
        }
    }

    /** Executes diff command and generates output*/
    private function parseDifference() {
        $diffCommand = 'diff ' .$this->file1. ' ' . $this->file2 . ' --speed-large-files -b';
        exec($diffCommand, $output, $returnValue);

        /** TODO:: check output values
         * Probably I should create temp file to contain differences OR try to use Heredoc
         */
    }

    protected function outputDifference() {
        if ($this->outputType === self::ECHO_OUTPUT) {
            $this->echoDifference();
        } elseif ($this->outputType === self::FILE_OUTPUT) {
            $this->writeDifferenceIntoFile();
        }
    }

    protected function setOutputFilePath(string $outputFile) {
        if ($outputFile !== '') {
            $this->outputType = self::FILE_OUTPUT;
            $this->outputFile = $outputFile;
        }
    }

    protected function setFilesPath(string $file1, string $file2) {
        $this->file1 = $file1;
        $this->file2 = $file2;
    }



    protected function writeDifferenceIntoFile() {
        // TODO:: creation of file;
    }

    /** Outputs difference data into browser */
    protected function echoDifference() {

    }

    protected function generateFileName() {

    }
}