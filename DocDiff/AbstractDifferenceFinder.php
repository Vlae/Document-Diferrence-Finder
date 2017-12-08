<?php

namespace DocDiff;

abstract class AbstractDifferenceFinder
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

    abstract public function __construct(string $file1 , string $file2);

    abstract protected function validateFiles();

    abstract protected function findDifference();

    abstract protected function outputDifference(int $outputMethod);

    abstract protected function setOutputFilePath(string $outputFile);

    protected function setDifferenceFlag() {
        $this->hasDifference = true;
    }

    abstract protected function writeDifferenceIntoFile();

    /** Outputs difference data into browser */
    abstract protected function echoDifference();

    abstract protected function generateFileName();

}