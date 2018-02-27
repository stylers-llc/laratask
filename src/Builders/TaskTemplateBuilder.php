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


    public function __construct(array $nameTxArray)
    {
        $this->nameTxArray = $nameTxArray;
        $this->taskTemplate = new TaskTemplate();
    }

    public function setSubject(TaskableInterface $taskable)
    {
        $this->taskTemplate->taskable()->associate($taskable);
    }

    public function setDelegator(DelegatableInterface $delegatable)
    {
        $this->taskTemplate->delegatable()->associate($delegatable);
    }

    public function setAssigned(AssignableInterface $assignable)
    {
        $this->taskTemplate->assignable()->associate($assignable);
    }

    public function setDescription(array $descriptionArray)
    {
        $this->descriptionArray = $descriptionArray;
    }

    public function build()
    {
//        $this->validator->validate();

        DB::transaction(function () {
            $this->storeName();
            $this->storeDescription();
            $this->taskTemplate->save();
        });
    }

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

    public function get(): TaskTemplate
    {
        return $this->taskTemplate;
    }
}