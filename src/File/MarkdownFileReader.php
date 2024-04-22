<?php

namespace App\File;

readonly class MarkdownFileReader implements Reader
{
    public function __construct(
        public string $directory
    ){}

    /**
     * @return FileInformation[]
     */
    public function getMarkdownFiles(string $folder): array {
        // Initialize an empty array to store the file paths
        $markdownFiles = [];
        $fullPath = $this->directory . $folder;

        // Open the directory
        $dir = opendir($fullPath);

        // Loop through each file in the directory
        while (($file = readdir($dir)) !== false) {
            // Check if the file has a .md extension
            if (pathinfo($file, PATHINFO_EXTENSION) === 'md') {
                // If yes, add its path to the array
                $path = $fullPath . '/' . $file;
                $markdownFiles[] = new FileInformation(
                    str_replace('.md', '', $file),
                    $path,
                    filesize($path),
                    filemtime($path),
                    str_replace('_', ' ', str_replace('.md', '', $file))
                );
            }
        }

        // Close the directory handle
        closedir($dir);

        // Return the array of Markdown file paths
        return $markdownFiles;
    }

    public function read(string $name) : string
    {
        return file_get_contents("$this->directory/$name");
    }
}
