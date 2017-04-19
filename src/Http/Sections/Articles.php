<?php

namespace App\Http\Sections;

use App\Models\Article\Articlescategory;
use App\Models\Article\ArticlesHasCategory;
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
class Articles extends Section implements Initializable
{
    /**
     * @var \App\Models\Article\Article
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
        return 'fa fa-book';
    }

    /**
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getTitle()
    {
        return trans('Статьи');
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
                AdminColumn::link('title', 'Title'),
                AdminColumn::text('h1', 'H1'),
                AdminColumn::lists('articlescategories.title', 'Категории')->setWidth('200px')

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
                ->addColumn([AdminFormElement::text('title', 'Title')->required()])
          ->addColumn([AdminFormElement::text('h1', 'H1')->required(),])
          ->addColumn([AdminFormElement::text('url', 'Ссылка')->addValidationRule('regex:/^[a-zA-Z0-9-]+$/')->required()->unique()]),

            AdminFormElement::wysiwyg('body', 'Текс')->disableFilter()->required(),

            AdminFormElement::select('article_author_id')->setLabel('Страна')
                ->setModelForOptions(\App\Models\Article\ArticleAuthor::class)
                ->setHtmlAttribute('placeholder', 'Выберите автора')
                ->setDisplay('name')
                ->required(),



            AdminFormElement::multiselect('articlescategories', 'Категории', Articlescategory::class)->setDisplay('title'),

              AdminFormElement::columns()
                  ->addColumn([AdminFormElement::textarea('meta_description', 'Мета description')->required()], 3)
                  ->addColumn([AdminFormElement::textarea('meta_keywords', 'Мета keywords')->required()], 3)
                  ->addColumn([AdminFormElement::textarea('meta_title', 'Мета title')->required()])
                  ->addColumn([AdminFormElement::textarea('anons', 'Анонс')->required()->addValidationRule('max:500'),])
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
        return 'Добавить статью';
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
