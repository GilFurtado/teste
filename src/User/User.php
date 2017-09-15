<?php
namespace GGF\Application\User;

use GGF\Application\Entity\Entity; 
use GGF\Application\Entity\EntityInterface; 

class User implements EntityInterface
{
	private $entity;

	public function __construct(Entity $entity)
	{
		$this->entity = $entity;
        
		$this->entity->setTable('users');
	}

	public function getEntity()
	{
		return $this->entity;
	}
}