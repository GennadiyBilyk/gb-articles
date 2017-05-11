<?php
/**
 * Created by PhpStorm.
 * User: gennadiy
 * Date: 18.04.2017
 * Time: 23:48
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
class Articlescategories extends Section implements Initializable
{
    /**
     * @var \App\Models\Article\Articlescategory
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
        return 'fa fa-folder-open';
    }

    /**
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getTitle()
    {
        return trans('Категории');
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::tree()->setValue('title');
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
                ->addColumn([AdminFormElement::text('title', 'Заголовок')->required()],6)
                ->addColumn([AdminFormElement::text('url', 'Ссылка')->addValidationRule('regex:/^[a-zA-Z0-9-]+$/')->required()->unique()],6),
            AdminFormElement::columns()
            ->addColumn([AdminFormElement::textarea('meta_description', 'Мета description')->required()], 4)
            ->addColumn([AdminFormElement::textarea('meta_keywords', 'Мета keywords')->required()], 4)
            ->addColumn([AdminFormElement::textarea('meta_title', 'Мета title')->required()],4),
            AdminFormElement::text('image', 'Картинка')->required()

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
        return 'Добавить категорию';
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
