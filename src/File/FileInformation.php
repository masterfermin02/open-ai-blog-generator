<?php

namespace App\File;

readonly class FileInformation
{
    public function __construct(
        public string $name,
        public string $path,
        public string $size,
        public string $lastModified,
        public string $title,
    )
    {}
}
