<?php

class AnnotationHelper
{
    static public function getViewModelType($file)
    {
        $line = fgets(fopen($file, 'r'));

        $startIndex = strpos($line, ":") + 1;
        $endIndex = strpos($line, "-->");
        $line = substr($line, $startIndex, ($endIndex - $startIndex));

        return trim($line);
    }
}