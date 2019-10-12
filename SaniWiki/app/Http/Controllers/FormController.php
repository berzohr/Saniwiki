<?php

namespace App\Http\Controllers;

use App\Category;
use App\Section;
use App\SectionsPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->get('name');
        $category->iconFontAw = $request->get('categoryIcon');
        $category->type = $request->get('type');


//        dd($request->file('bgImage'));
//        $bgImage= $request->file('bgImage')->store(
//            'images/post/cat', 'public'
//        );
//
//        dd($bgImage);

        $category->bgImage = 'cat001-bg.jpg';  //TODO: dovrebbe essere passata dal modale con il caricamento di un'immagine
        $category->save();

        //ottengo l'ultimo ID della categoria appena creata
        $id = DB::table('categories')->orderBy('id', 'desc')->first()->id;

        //dd($request->all()); //comando per fare debug

        foreach ($request->get('sections') as $section){
            $newSection = new Section();
            $newSection->name = $section['name'];
            $newSection->iconFontAw = $section['icon'];
            $newSection->category = $id;
            $newSection->save();
        }

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category $categoryId
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $category = Category::find($request->get('categoryID'));
        $category->name = $request->get('name');
        $category->type = $request->get('type');
        $category->bgImage = 'cat001-bg.jpg';   //TODO: dovrebbe essere passata dal modale
        if($request->get('categoryIcon') != ''){
            $category->iconFontAw = $request->get('categoryIcon');
            $category->isIconURL = 0;
        }
        $category->save();
        foreach ($request->get('sections') as $section) {
            $sectionDB = Section::find($section['id']);
            $sectionDB->name = $section['name'];
            $sectionDB->iconFontAw = $section['icon'];
            $sectionDB->save();
        }

        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // return null
    }
}
