<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\ModeleModuleRepository")
 * @ORM\Table(name="ModelModule")
 */
class ModelModule
{
    /**
     * @ORM\Column(name="Id", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Model", cascade={"persist"})
     * @ORM\JoinColumn(name="ModelId", referencedColumnName="ModelId")
     */
    protected $model;

    /**
     * @ORM\ManyToOne(targetEntity="Module", cascade={"persist"})
     * @ORM\JoinColumn(name="ModuleId", referencedColumnName="ModuleId")
     */
    protected $module;

    function getId() {
        return $this->id;
    }

    function getModel() {
        return $this->model;
    }

    function getModule() {
        return $this->module;
    }

    function setModel($model) {
        $this->model = $model;
    }

    function setModule($module) {
        $this->module = $module;
    }
}
