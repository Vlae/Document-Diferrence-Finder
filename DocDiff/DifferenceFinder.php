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

    /** @var bool $hasDifference **/
    protected $hasDifference = false;

    public function __construct(string $file1 , string $file2) {
        $this->file1 = $file1;
        $this->file2 = $file2;

        $this->validateFiles();
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

    protected function findDifference() {

    }

    /** Executes diff command and generates output*/
    private function parseDifference() {
        $diffCommand = 'diff ' .$this->file1. ' ' . $this->file2 . ' --speed-large-files -b';
        exec($diffCommand, $output, $returnValue);

        //TODO:: check output values
    }

    protected function outputDifference(int $outputMethod) {

    }

    protected function setOutputFilePath(string $outputFile) {
        $this->outputFile = $outputFile;
    }

    protected function writeDifferenceIntoFile() {

    }

    /** Outputs difference data into browser */
    protected function echoDifference() {

    }

    protected function generateFileName() {

    }




}