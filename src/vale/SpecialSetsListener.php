<?php


namespace vale;


use pocketmine\block\Block;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityArmorChangeEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\item\Item;
use pocketmine\level\particle\DestroyBlockParticle;
use pocketmine\Player;
use vale\entity\TextEntity;
use vale\task\GuardianAttackTask;
use vale\entity\SpecialGurdian;

class SpecialSetsListener implements Listener
{
	public $plugin;
	/** @var array $hide */
	public  $hide = [];

	public function __construct(Loader $plugin)
	{
		$this->plugin = $plugin;
		$this->plugin->getServer()->getPluginManager()->registerEvents($this, $plugin);
	}

	public function onJoin(PlayerJoinEvent $event)
	{
		$Player = $event->getPlayer();
		$Player->sendMessage("TEST123");
		Loader::getInstance()->giveSpecialSet($Player, "phantom");
	}

	public function attack(EntityDamageByEntityEvent $event)
	{

		$entity = $event->getEntity();
		$damager = $event->getDamager();
		$damage = $event->getBaseDamage();
		$proc = rand(1, 180);
		if ($damager instanceof Player && $entity instanceof Player) {
			if (Loader::getInstance()->hasFullSetLore($damager, "§r§c§lPHANTOM SET BONUS")) {
				if (in_array("§r§c§lPHANTOM SWORD", $damager->getInventory()->getItemInHand()->getLore())) {

					switch ($proc) {

						case 22:
							$damager->sendMessage("§r§c§l+25% DAMAGE");
							$event->setBaseDamage($event->getBaseDamage() + mt_rand(1, 5));
							$damager->getLevel()->addParticle(new DestroyBlockParticle($damager->asVector3()->add(0, 1), Block::get(Block::REDSTONE_BLOCK)));
							TextEntity::spawnText($entity->asPosition(), "§r§l§c25% DAMAGE");
							break;

						case 34:
							$damager->sendMessage("§r§c§l+25% DAMAGE");
							$event->setBaseDamage($event->getBaseDamage() + mt_rand(1, 5));
							$damager->getLevel()->addParticle(new DestroyBlockParticle($damager->asVector3()->add(0, 1), Block::get(Block::REDSTONE_BLOCK)));
							TextEntity::spawnText($entity->asPosition(), "§r§l§c25% DAMAGE");
							break;

						case 47:
							$damager->sendMessage("§r§c§l+25% DAMAGE");
							$event->setBaseDamage($event->getBaseDamage() + mt_rand(1, 5));
							$damager->getLevel()->addParticle(new DestroyBlockParticle($damager->asVector3()->add(0, 1), Block::get(Block::REDSTONE_BLOCK)));
							TextEntity::spawnText($entity->asPosition(), "§r§l§c25% DAMAGE");
							break;

						case 12:
							$damager->sendMessage("§r§c§l+25% DAMAGE");
							$event->setBaseDamage($event->getBaseDamage() + mt_rand(1, 5));
							$damager->getLevel()->addParticle(new DestroyBlockParticle($damager->asVector3()->add(0, 1), Block::get(Block::REDSTONE_BLOCK)));
							TextEntity::spawnText($entity->asPosition(), "§r§l§c25% DAMAGE");
							break;

						case 116:
							$damager->sendMessage("§r§c§l+25% DAMAGE");
							$event->setBaseDamage($event->getBaseDamage() + mt_rand(1, 5));
							$damager->getLevel()->addParticle(new DestroyBlockParticle($damager->asVector3()->add(0, 1), Block::get(Block::REDSTONE_BLOCK)));
							TextEntity::spawnText($entity->asPosition(), "§r§l§c25% DAMAGE");
							break;

						case 179:
							$damager->sendMessage("§r§c§l+25% DAMAGE");
							$event->setBaseDamage($event->getBaseDamage() + mt_rand(1, 5));
							$damager->getLevel()->addParticle(new DestroyBlockParticle($damager->asVector3()->add(0, 1), Block::get(Block::REDSTONE_BLOCK)));
							TextEntity::spawnText($entity->asPosition(), "§r§l§c25% DAMAGE");
							break;

						case 54:
							$damager->sendMessage("§r§c§l+25% DAMAGE");
							$event->setBaseDamage($event->getBaseDamage() + mt_rand(1, 5));
							$damager->getLevel()->addParticle(new DestroyBlockParticle($damager->asVector3()->add(0, 1), Block::get(Block::REDSTONE_BLOCK)));
							TextEntity::spawnText($entity->asPosition(), "§r§l§c25% DAMAGE");
							break;

					}
				}
			}
		}
	}
	public function PROTECT(EntityDamageByEntityEvent $event)
	{
		$entity = $event->getEntity();
		$damager = $event->getDamager();
		$proc = rand(1, 150);
		if ($damager instanceof Player && $entity instanceof Player) {
			if (Loader::getInstance()->hasFullSetLore($entity, "§r§c§lPHANTOM SET BONUS")) {

				switch ($proc){

					case 32:
                   $entity->sendMessage("§r§7✗✗✗§c§lMINIONS SPAWNED§r§7✗✗✗");
                    $damager->sendMessage("§r§7✗✗✗§c§lFEEL THE WRATH!!!!§r§7✗✗✗");
                    $gaurd = new SpecialGurdian($entity->getLevel(), Entity::createBaseNBT($entity->asVector3()));
                    $gaurd->spawnToAll();
                    $ev = new EntityDamageByEntityEvent($gaurd, $damager, EntityDamageByEntityEvent::CAUSE_ENTITY_ATTACK, 1);
                    $gaurd->attack($ev);
                    $gaurd->attackspecifictARg($damager);
                    TextEntity::spawnText($entity->asPosition(), "§r§7✗✗✗§c§lMINIONS SPAWNED§r§7✗✗✗");
                    $this->plugin->getScheduler()->scheduleRepeatingTask(new GuardianAttackTask($gaurd, $entity, $ev, $damager), 20);
						break;

					case 11:
						$entity->sendMessage("§r§7✗✗✗§c§lMINIONS SPAWNED§r§7✗✗✗");
						$damager->sendMessage("§r§7✗✗✗§c§lFEEL THE WRATH!!!!§r§7✗✗✗");
						$gaurd = new SpecialGurdian($entity->getLevel(), Entity::createBaseNBT($entity->asVector3()));
						$gaurd->spawnToAll();
						$ev = new EntityDamageByEntityEvent($gaurd, $damager, EntityDamageByEntityEvent::CAUSE_ENTITY_ATTACK, 1);
						$gaurd->attack($ev);
						$gaurd->attackspecifictARg($damager);
						TextEntity::spawnText($entity->asPosition(), "§r§7✗✗✗§c§lMINIONS SPAWNED§r§7✗✗✗");
						$this->plugin->getScheduler()->scheduleRepeatingTask(new GuardianAttackTask($gaurd, $entity, $ev, $damager), 20);
						break;

					case 98:
						$entity->sendMessage("§r§7✗✗✗§c§lMINIONS SPAWNED§r§7✗✗✗");
						$damager->sendMessage("§r§7✗✗✗§c§lFEEL THE WRATH!!!!§r§7✗✗✗");
						$gaurd = new SpecialGurdian($entity->getLevel(), Entity::createBaseNBT($entity->asVector3()));
						$gaurd->spawnToAll();
						$ev = new EntityDamageByEntityEvent($gaurd, $damager, EntityDamageByEntityEvent::CAUSE_ENTITY_ATTACK, 1);
						$gaurd->attack($ev);
						$gaurd->attackspecifictARg($damager);
						TextEntity::spawnText($entity->asPosition(), "§r§7✗✗✗§c§lMINIONS SPAWNED§r§7✗✗✗");
						$this->plugin->getScheduler()->scheduleRepeatingTask(new GuardianAttackTask($gaurd, $entity, $ev, $damager), 20);
						break;
				}
			}
		}
	}


	public function getBaseAttackDamage(): int{

		return  1;
	}
}
