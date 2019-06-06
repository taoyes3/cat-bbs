<?php

namespace App\Admin\Controllers;

use App\Models\Role;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class RolesController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('列表')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑角色')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Role);

        $grid->id('Id');
        $grid->name('名称');
        $grid->guard_name('Guard name');
        $grid->permissions('权限')->display(function ($roles) {
            $roles = array_map(function ($role) {
                return "<span class='label label-success'>{$role['name']}</span>";
            }, $roles);

            return join('&nbsp;', $roles);
        });
        $grid->created_at('创建时间');
        // 自定义按钮
        $grid->actions(function ($actions) {
            $actions->disableView(); // 禁用查看
            $actions->append('<a href=""><i class="fa fa-cog"></i></a>'); // 设置权限
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Role::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->guard_name('Guard name');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Role);

        $form->text('name', 'Name');
        $form->text('guard_name', 'Guard name');
        $form->multipleSelect('权限1', '权限')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);
        // $form->text(permissions(), 'test');


        return $form;
    }
}
