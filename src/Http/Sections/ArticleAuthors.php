<?php
/**
 * Created by PhpStorm.
 * User: gennadiy
 * Date: 18.04.2017
 * Time: 23:25
 */

namespace App\Http\Sections;

use KodiComponents\Support\Contracts\Initializable;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;
use AdminColumn;
use AdminDisplay;
use AdminDisplayFilter;
use AdminForm;
use AdminFormElement;

/**
 * Class Sentences
 *
 * @property \App\Models\Article\Article $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class ArticleAuthors extends Section implements Initializable
{
    /**
     * @var \App\Role
     */
    protected $model;

    /**
     * Initialize class.
     */
    public function initialize()
    {

    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-group';
    }

    /**
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getTitle()
    {
        return trans('Авторы');
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {

        return AdminDisplay::table()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#'),
                AdminColumn::text('name', 'Имя')

            )->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {


        $form = AdminForm::panel()->addBody(

            AdminFormElement::columns()
                ->addColumn([AdminFormElement::text('name', 'Имя')->required()])
                ->addColumn([AdminFormElement::text('signature', 'Подпись')->required()])

        );


        return $form;


    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        // Создание и редактирование записи идентичны, поэтому перенаправляем на метод редактирования
        return $this->onEdit(null);
    }

    /**
     * Переопределение метода содержащего заголовок создания записи
     *
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getCreateTitle()
    {
        return 'Добавить Автора';
    }

    /**
     * Переопределение метода для запрета удаления записи
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return bool
     */
    public function isDeletable(\Illuminate\Database\Eloquent\Model $model)
    {
        return false;
    }


}