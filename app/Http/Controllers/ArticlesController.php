<?php

namespace App\Http\Controllers;

use App\Articles;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ArticlesController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $data = Articles::where('type', '=', 'about')->first();
            if(count($data)>0)
            {
                return response()->json(array(
                    'error' => false,
                    'details'=>$data,
                    'Message' => "Success"),
                    200
                );
            }
            else
            {
                return response()->json(array(
                    'error' => false,
                    'Message' => "No data found"),
                    200
                );
            }
        }
        catch (\Exception $e) {
            return response()->json(array(
                'error' => true,
                'error_details' => "Something wrong,try again"),
                500
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     * GET /articles/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($type)
    {
        $data['page_title']='Article';
        try {
            $data = DB::table('articles')->where('type', $type)->first();
            if(!empty($type))
            {
                return View::make('admin.articles.edit')->with('data', $data);
            }
            else
            {
                return Redirect::to('admin/');
            }
        }
        catch (\Exception $e) {
            return Redirect::to('admin/');

        }
    }

    /**
     * Update the specified resource in storage.
     * PUT /articles/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$type)
    {
        $id = $request->id;
        $title = $request->title;
        $details = $request->article_details;
        try {
            $article = DB::table('articles')
                ->where('id', $id)
                ->update(['title' => $title,'details' => $details]);

            try {
                $data = DB::table('articles')->where('type', $type)->first();
                if(!empty($type))
                {
                    return Redirect::to('admin/articles/'.$type.'/edit')->with('data', $data);
                }
                else
                {
                    return Redirect::to('admin/');
                }
            }
            catch (\Exception $e) {
                return Redirect::to('admin/');
            }

        }
        catch (\Exception $e) {
            try {
                $data = DB::table('articles')->where('type', $type)->first();
                if($type=='about')
                {
                    return Redirect::to('admin/articles/about/edit')->with('data', $data);
                }
                elseif($type=='terms')
                {
                    return Redirect::to('admin/');
                }
            }
            catch (\Exception $e) {
                return Redirect::to('admin/');
            }
        }
    }
}
