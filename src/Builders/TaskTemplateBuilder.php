<?php

namespace Stylers\Laratask\Builders;

use Illuminate\Support\Facades\DB;
use Stylers\Laratask\Interfaces\AssignableInterface;
use Stylers\Laratask\Interfaces\DelegatableInterface;
use Stylers\Laratask\Interfaces\TaskableInterface;
use Stylers\Laratask\Interfaces\TaskTemplateBuilderInterface;
use Stylers\Laratask\Models\TaskTemplate;
use Stylers\Taxonomy\Manipulators\DescriptionSetter;
use Stylers\Taxonomy\Manipulators\TaxonomySetter;

/**
 * Class TaskTemplateBuilder
 * @package Stylers\Laratask\Builders
 */
class TaskTemplateBuilder implements TaskTemplateBuilderInterface
{
    /**
     * @var TaskTemplate
     */
    private $taskTemplate;

    /**
     * @var array
     */
    private $nameTxArray;

    /**
     * @var array
     */
    private $descriptionArray;


    /**
     * TaskTemplateBuilder constructor.
     * @param array $nameTxArray
     */
    public function __construct(array $nameTxArray)
    {
        $this->nameTxArray = $nameTxArray;
        $this->taskTemplate = new TaskTemplate();
    }

    /**
     * @param TaskTemplate $taskTemplate
     */
    public function setTaskTemplate(TaskTemplate $taskTemplate)
    {
        $this->taskTemplate = $taskTemplate;
    }

    /**
     * @param TaskableInterface $taskable
     */
    public function setSubject(TaskableInterface $taskable)
    {
        $this->taskTemplate->taskable()->associate($taskable);
    }

    /**
     * @param DelegatableInterface $delegatable
     */
    public function setDelegator(DelegatableInterface $delegatable)
    {
        $this->taskTemplate->delegatable()->associate($delegatable);
    }

    /**
     * @param AssignableInterface $assignable
     */
    public function setAssigned(AssignableInterface $assignable)
    {
        $this->taskTemplate->assignable()->associate($assignable);
    }

    /**
     * @param array $descriptionArray
     */
    public function setDescription(array $descriptionArray)
    {
        $this->descriptionArray = $descriptionArray;
    }

    /**
     * Build TaskTemplate
     */
    public function build()
    {
        DB::transaction(function () {
            $this->storeName();
            if ($this->descriptionArray) $this->storeDescription();
            $this->taskTemplate->save();
        });
    }

    /**
     * @throws \Exception
     */
    private function storeName()
    {
        $setter = new TaxonomySetter(
            $this->nameTxArray['translations'],
            $this->taskTemplate->name_tx_id,
            config("laratask.taxonomy.task_template_names")
        );
        $nameTx = $setter->set();

//        TODO 
//        $this->taskTemplate->name()->associate($nameTx);
        $this->taskTemplate->name_tx_id = $nameTx->id;
    }

    /**
     * @throws \Exception
     */
    private function storeDescription()
    {
        $setter = new DescriptionSetter(
            $this->descriptionArray,
            $this->taskTemplate->description_id
        );
        $description = $setter->set();

//        TODO
//        $this->taskTemplate->description()->associate(description);
        $this->taskTemplate->description_id = $description->id;
    }

    /**
     * @return TaskTemplate
     */
    public function get(): TaskTemplate
    {
        return $this->taskTemplate;
    }
}