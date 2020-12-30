<?php
namespace App\Services\Backend;

use App\Repository as Repo;
use Illuminate\Http\Request;
use App\Presenter\MessagePresenter;

class FunctionService
{
    //Function Repository
    protected $function;

    /**
     * 建構子
     *
     * @param Repo\Backend\FunctionRepository $function
     */
    public function __construct(Repo\Backend\FunctionRepository $function)
    {
        $this->function = $function;
    }

    /**
     * 依選單取得功能
     *
     * @param integer $menuId
     * @return void
     */
    public function getAllFunctions($menuId = 0)
    {
        return $this->function->getAllFunctions($menuId);
    }

    /**
     * 取得功能
     *
     * @param integer $id
     * @return void
     */
    public function getFunction($id = 0)
    {
        return $this->function->getFunction($id);   
    }

    /**
     * 新增功能
     *
     * @param Request $request
     * @return void
     */
    public function insertFunction(Request $request)
    {
        $validateRules = [
            'name' => 'required|max:100',
            'link' => 'required|max:200',
            'description' => 'max:200',
            'order' => 'required|integer',
        ];

        $validateMessage = [
            'name.required' => MessagePresenter::getRequired('名稱'),
            'name.max' => MessagePresenter::getMax('名稱', 100),
            'link.required' => MessagePresenter::getRequired('連結'),
            'link.max' => MessagePresenter::getMax('連結', 200),
            'description.max' => MessagePresenter::getMax('敘述', 200),
            'order.required' => MessagePresenter::getRequired('排序'),
            'order.integer' => MessagePresenter::getInteger('排序')
        ];

        $request->validate($validateRules, $validateMessage);

        $userId = $this->function->insertFunction($request);

        return $userId;
    }

    /**
     * 修改功能
     *
     * @param Request $request
     * @param integer $functionId
     * @return void
     */
    public function modifyFunction(Request $request, $functionId = 0)
    {
        $validateRules = [
            'name' => 'required|max:100',
            'link' => 'required|max:200',
            'description' => 'max:200',
            'order' => 'required|integer',
        ];

        $validateMessage = [
            'name.required' => MessagePresenter::getRequired('名稱'),
            'name.max' => MessagePresenter::getMax('名稱', 100),
            'link.required' => MessagePresenter::getRequired('連結'),
            'link.max' => MessagePresenter::getMax('連結', 200),
            'description.max' => MessagePresenter::getMax('敘述', 200),
            'order.required' => MessagePresenter::getRequired('排序'),
            'order.integer' => MessagePresenter::getInteger('排序')
        ];

        $request->validate($validateRules, $validateMessage);

        $isSuccessful = $this->function->modifyFunction($request, $functionId);

        return $isSuccessful;
    }

    /**
     * 刪除功能
     *
     * @param integer $functionId
     * @return void
     */
    public function deleteFunction($functionId = 0)
    {
        $isSuccessful = $this->function->deleteFunction($functionId);

        return $isSuccessful;
    }

    /**
     * 取得群組功能
     *
     * @param [type] $functionIds
     * @param boolean $assign
     * @return void
     */
    public function getGroupFunctions($functionIds = null, $assign = true)
    {
        $functionIds = array_values(array_filter(explode(',', $functionIds)));

        if ($assign)
        {
            $functions = $this->function->getFunctions($functionIds);
        }
        else
        {
            $functions = $this->function->getFunctionsNotIn($functionIds);
        }

        return $functions;
    }
}