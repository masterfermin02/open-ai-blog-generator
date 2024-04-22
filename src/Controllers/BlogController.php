<?php

namespace App\Controllers;

use App\File\MarkdownFileReader;
use App\Page\InvalidPageException;
use App\Page\FilePostReader;
use App\Parse\MarkDownToHtmlParser;
use App\Template\FrontendRenderer;
use Http\Request;
use Http\Response;

readonly class BlogController
{
    public function __construct(
        public Request $request,
        public Response $response,
        public FrontendRenderer $renderer,
        public MarkdownFileReader $fileReader,
        public FilePostReader $pageReader,
        public MarkDownToHtmlParser $markdownParser,
    )
    {
    }

    public function show()
    {
        $data = [
            'posts' => $this->fileReader->getMarkdownFiles('blogs/'),
        ];
        $html = $this->renderer->render('Blogpage', $data);
        $this->response->setContent($html);
    }

    public function post($params)
    {
        $slug = $params['slug'];

        try {
            $data['content'] = $this->pageReader->readBySlug($slug);
        } catch (InvalidPageException $e) {
            $this->response->setStatusCode(404);
            return $this->response->setContent('404 - Page not found');
        }

        $html = $this->renderer->render('Page', $data);
        $this->response->setContent($html);
    }
}
