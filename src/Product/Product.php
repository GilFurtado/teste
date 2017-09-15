<?php
namespace GFF\Application\Product;

use GGF\Application\Entity\Entity;
use GGF\Application\Entity\EntityInterface;

class Product implements EntityInterface
{
	private $entity;

	public function __construct(Entity $entity)
	{
		$this->entity = $entity;
        
		$this->entity->setTable('products');
	}

	public function getEntity()
	{
		return $this->entity;
	}
}