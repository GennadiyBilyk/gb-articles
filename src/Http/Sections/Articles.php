<?php

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
class Articles extends Section implements Initializable
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
                AdminColumn::text('h1', 'H1')

            )->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {

        $formPrimary = AdminForm::form()->addElement(
            new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::text('title', 'Title')->required(),
                AdminFormElement::text('h1', 'H1')->required(),
                AdminFormElement::textarea('body', 'Текс')
            ])
        );
        $formMeta = AdminForm::form()->addElement(
            new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::text('meta_description', 'Мета description')->required(),
                AdminFormElement::text('meta_keywords', 'Мета keywords')->required(),
                AdminFormElement::text('meta_title', 'Мета title')->required(),
                AdminFormElement::textarea('body', 'Текс')
            ])
        );

        $tabs = AdminDisplay::tabbed();
        $tabs->appendTab($formPrimary, 'Главная');
        $tabs->appendTab($formMeta, 'МетаТеги');
        return $tabs;

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
        return 'Добавить предложение';
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
