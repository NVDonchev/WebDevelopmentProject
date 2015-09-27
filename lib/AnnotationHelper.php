<?php

class AnnotationHelper
{
    static public function getViewModelType($file)
    {
        $line = fgets(fopen($file, 'r'));

        $startIndex = strpos($line, ":");
        $endIndex = strpos($line, "-->");

        if ($startIndex === false || $endIndex === false) {
            return null;
        }

        $line = substr($line, $startIndex, ($endIndex - ($startIndex + 1)));

        return trim($line);
    }
}