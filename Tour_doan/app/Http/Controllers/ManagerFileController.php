<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\FileManager;
use App\Http\Requests\RequestValidator;

class ManagerFileController extends Controller
{
    /**
     * @var FileManager
     */
    public $fm;

    /**
     * FileManagerController constructor.
     *
     * @param FileManager $fm
     */
    public function __construct(FileManager $fm)
    {
        $this->fm = $fm;
    }


    public function index(RequestValidator $request)
    {

        $content =
            response()->json(
                $this->fm->content(
                    $request->input('disk'),
                    $request->input('path')
                )
            );
        return $content;
    }
}
