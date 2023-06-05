<?php

namespace Modules\Course\Http\Controllers;

use Cart;
use Modules\Course\Entities\Course;
use Illuminate\Support\Facades\Auth;
use Modules\Course\Entities\Language;
use function PHPUnit\Framework\returnValue;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Course\Http\Requests\LanguageRequest;
use Modules\Course\Repositories\Interfaces\LanguageInterface;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    protected $langinterface;
    public function __construct(LanguageInterface $langinterface)
    {
      $this->langinterface=$langinterface;
    }
    public function index()
    {
        $paginate=request()->paginate??10;
        $languages=$this->langinterface->index([], ['courses as courses'], ['*'], $paginate);
        $info=$this->langinterface->getScopes(["count"]);
        return view('course::admin.language.index', ['languages'=>$languages,"info"=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('course::admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(LanguageRequest $request)
    {
        $this->langinterface->store($request);
        return redirect()->back()->with('success', 'تم إنشاء اللغة بنجاح ');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $lang=$this->langinterface->find($id, ['*']);
        return view('course::admin.language.edit', ['lang'=>$lang]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(LanguageRequest $request, $id)
    {
        $lang=$this->langinterface->update($id, $request);
        return redirect()->back()->with('success', 'تم تعديل اللغة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $lang=$this->langinterface->delete($id);
        return redirect()->back()->with('success', 'تم حذف اللغة بنجاح');
    }

    public function showAllLanguages()
    {
        $languageLists = $this->langinterface->showAllLanguages();
        return view('course::User.Course.coursePackage', [
         'languageLists' =>$languageLists
    ]);
    }
}
