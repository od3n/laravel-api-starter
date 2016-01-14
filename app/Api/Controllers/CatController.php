<?php

namespace Api\Controllers;

use App\Cat;
use App\Http\Requests;
use Illuminate\Http\Request;
use Api\Requests\CatRequest;
use Api\Transformers\CatTransformer;
use ApiHandler;

/**
 * @Resource('Cats', uri='/cats')
 */
class CatController extends BaseController
{

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * Show all cats
     *
     * Get a JSON representation of all the cats
     *
     * @Get('/')
     */
    public function index()
    {
        if (request('deleted_at-not') == 'null') {
            $query = Cat::onlyTrashed();
        } else if (request('deleted_at') == 'null') {
            $query = new Cat();
        } else {
            $query = Cat::withTrashed();
        }

        $result = ApiHandler::parseMultiple($query, ['name', 'age']);
        return $this->collection($result->getResult(), new CatTransformer)->setMeta($result->getHeaders());
    }

    /**
     * Store a new cat in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatRequest $request)
    {
        return Cat::create($request->only(['name', 'age']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->item(Cat::findOrFail($id), new CatTransformer);
    }

    /**
     * Update the cat in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CatRequest $request, $id)
    {
        $cat = Cat::findOrFail($id);
        $cat->update($request->only(['name', 'age']));
        return $cat;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Cat::destroy($id);
    }
}
