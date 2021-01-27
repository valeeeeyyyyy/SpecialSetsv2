<?php


namespace vale\task;


use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\Player;
use pocketmine\scheduler\Task;
use vale\entity\SpecialGurdian;

class GuardianAttackTask extends Task
{
	/**
	 * @var SpecialGurdian
	 */
	private  $guard;
	/**
	 * @var Entity|Player
	 */
	private $entity;
	/**
	 * @var Entity|Player
	 */
	private $damager;


	public $seconds = 30;
	/**
	 * @var EntityDamageByEntityEvent
	 */
	private $ev;

	/**
	 * GuardianAttackTask constructor.
	 * @param SpecialGurdian $gaurd
	 * @param Entity|Player $entity
	 * @param EntityDamageByEntityEvent $ev
	 * @param Entity|Player $damager
	 */
	public function __construct(SpecialGurdian $gaurd, Player $entity, EntityDamageEvent $ev, Player $damager)
	{
		$this->guard = $gaurd;
		$this->entity = $entity;
		$this->ev = $ev;
		$this->damager = $damager;
	}

	public function onRun(int $currentTick)
	{
		--$this->seconds;
		if ($this->seconds === 29) {
			$guard = $this->guard;
			$entity = $this->entity;
			$damager = $this->damager;
			$ev = $this->ev;
			if ($guard->getTarget() != $entity->getName()) {
				if ($guard->getTarget() === $damager->getName()) {
					if ($ev instanceof EntityDamageByEntityEvent) {
						$damager = $ev->getDamager();
						$guard->getTarget()->getName() === $damager->getNameTag();
						$target = $guard->getTarget();
						$target = $damager->getNameTag();
						$guard->lookAt($damager);
						$guard->attackspecifictARg($damager);
					}
				}
			}
		}

		if ($this->seconds === 28) {
			$guard = $this->guard;
			$entity = $this->entity;
			$damager = $this->damager;
			$ev = $this->ev;
			if ($guard->getTarget() != $entity->getName()) {
				if ($guard->getTarget() === $damager->getName()) {
					if ($ev instanceof EntityDamageByEntityEvent) {
						$damager = $ev->getDamager();
						$guard->getTarget()->getName() === $damager->getNameTag();
						$target = $guard->getTarget();
						$target = $damager->getNameTag();
						$guard->attackspecifictARg($damager);
						$guard->lookAt($damager);
					}
				}
			}
		}
		if ($this->seconds === 27) {
			$guard = $this->guard;
			$entity = $this->entity;
			$damager = $this->damager;
			$ev = $this->ev;
			if ($guard->getTarget() != $entity->getName()) {
				if ($guard->getTarget() === $damager->getName()) {
					if ($ev instanceof EntityDamageByEntityEvent) {
						$damager = $ev->getDamager();
						$guard->getTarget()->getName() === $damager->getNameTag();
						$target = $guard->getTarget();
						$target = $damager->getNameTag();
						$guard->lookAt($damager);
						$guard->attackspecifictARg($damager);
					}
				}
			}
		}

		if ($this->seconds === 10) {
			$entity = $this->entity;
				$guard = $this->guard;
			if ($guard->isAlive()) {
				
				$guard->kill();
				$entity->sendMessage("§r§7Your §r§cMinions §r§7Died!");

			}

		}
	}
}
