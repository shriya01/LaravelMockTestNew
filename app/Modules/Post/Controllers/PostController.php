<?php
namespace App\Modules\Post\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Crypt;

/**
 * PostController Controller
 * @package                LaravelMockTest
 * @subpackage             QuestionSetsController
 * @category               Controller
 * @DateOfCreation         10 Dec 2018
 * @ShortDescription       This class handles post related operations 
 */
class PostController extends Controller
{
    /**
     * @DateOfCreation      24 Jan 2019
     * @ShortDescription    This function displays post list.
     * @param               $id [Section Id]
     * @return              View
     */
    public function index($id = null)
    {
        $id = Crypt::decrypt($id);
        $this->postObj = new Post;
        $data['posts']= $this->postObj->getPosts()->where('category_id',$id);
        return view("Post::index",$data);
    }
}
