<?php declare(strict_types = 1);

namespace App\Page;

use App\File\FileReader;

class FilePostReader implements PageReader
{
	protected $fileReader;

	public function __construct(FileReader $fileReader)
	{
		$this->fileReader = $fileReader;
	}

	public function readBySlug(string $slug) : string
	{
		$path = "blogs/$slug.md";

		if (!$this->fileReader->fileExists($path)) {
			throw new InvalidPageException($slug);
		}

		return $this->fileReader->read($path);
	}
}
