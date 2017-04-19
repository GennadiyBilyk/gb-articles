<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Roles
 *
 * @property \App\Role $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Roles extends Section
{

    /**
     * @var string
     */
    protected $alias;



    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-warning';
    }

    /**
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getTitle()
    {
        return trans('Роли');
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()
            ->with('users')
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns([
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::link('label', 'Label')->setWidth('100px'),
                AdminColumn::text('name', 'Name')
            ])->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Key')->required(),
            AdminFormElement::text('label', 'Label')->required()
        ]);
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }
}
