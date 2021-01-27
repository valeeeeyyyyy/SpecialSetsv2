<?php

namespace vale;
use pocketmine\entity\Entity;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Color;
use vale\entity\manager\IEManager;
use vale\entity\SpecialGurdian;
use vale\entity\TextEntity;
use vale\items\LeatherBoots;
use vale\items\LeatherChestPlate;
use vale\items\LeatherHelm;
use vale\items\LeatherLeggins;
use vale\task\SpecialSetUpdateTask;

class Loader extends PluginBase
{
	private static $instance;

	public function onEnable(): void
	{
		self::$instance = $this;
		$this->getScheduler()->scheduleRepeatingTask(new SpecialSetUpdateTask($this), 20);
		new SpecialSetsListener($this);
		self::initEntitys();
		self::initItems();
	}

	public static function getInstance(): Loader{
		return self::$instance;
	}

	public function giveSpecialSet(Player $player, string $type)
	{

		switch ($type) {

			case "phantom":
				$phantomhelm = Item::get(Item::LEATHER_HELMET, 0, 1);
			    $phantomhelm->setCustomName("§r§c§lPhantom Hood");
			    $phantomhelm->setCustomColor(new Color(255,0,0));
				$phantomhelm->setLore([
					"§r§cThe fabled hood of the phantom",
					"§r§c§lPHANTOM SET BONUS",
					"§r§c§l* §r§cDeal +35% more damage to outgoing enemies",
					"§r§c§l* §r§c20% chance to spawn in Minions",
					"§r§7((REQUIRES ALL PHANTOM SET PIECES))",
				]);
				$phantomchest = Item::get(Item::LEATHER_CHESTPLATE, 0, 1);
				$phantomchest->setCustomColor(new Color(255,0,0));
				$phantomchest->setCustomName("§r§c§lPhantom Plate");
				$phantomchest->setLore([
					"§r§cThe fabled plate of the phantom",
					"§r§c§lPHANTOM SET BONUS",
					"§r§c§l* §r§cDeal +35% more damage to outgoing enemies",
					"§r§c§l* §r§c20% chance to spawn in Minions",
					"§r§7((REQUIRES ALL PHANTOM SET PIECES))",
				]);
				$phantomleg = Item::get(Item::LEATHER_LEGGINGS, 0, 1);
				$phantomleg->setCustomColor(new Color(255,0,0));
				$phantomleg->setCustomName("§r§c§lPhantom Robes");
				$phantomleg->setLore([
					"§r§cThe fabled robes of the phantom",
					"§r§c§lPHANTOM SET BONUS",
					"§r§c§l* §r§cDeal +35% more damage to outgoing enemies",
					"§r§c§l* §r§c20% chance to spawn in Minions",
					"§r§7((REQUIRES ALL PHANTOM SET PIECES))",

				]);
				$phantomboot = Item::get(Item::LEATHER_BOOTS, 0, 1);
				$phantomboot->setCustomColor(new Color(255,0,0));
				$phantomboot->setCustomName("§r§c§lPhantom Boots");
				$phantomboot->setLore([
					"§r§cThe fabled robes of the phantom",
					"§r§c§lPHANTOM SET BONUS",
					"§r§c§l* §r§cDeal +35% more damage to outgoing enemies",
					"§r§c§l* §r§c20% chance to spawn in Minions",
					"§r§7((REQUIRES ALL PHANTOM SET PIECES))",

				]);

				$sword = Item::get(Item::DIAMOND_SWORD);
				$sword->setCustomName("§r§c§lPhantom Sword");
				$sword->setLore([
					"§r§c§lPHANTOM SWORD",
					"§r§c§l* §r§cDeal +35% more damage to outgoing enemies",
					"§r§c§l* §r§c20% chance to spawn in Minions",
					"§r§7((REQUIRES ALL PHANTOM SET PIECES))",

				]);
				$player->getInventory()->addItem($sword);
				$player->getInventory()->addItem($phantomhelm);
				$player->getInventory()->addItem($phantomchest);
				$player->getInventory()->addItem($phantomleg);
				$player->getInventory()->addItem($phantomboot);

				break;
		}
	}

	/**
	 * @param Player $player
	 * @param string $lore
	 * @return bool
	 */
	public function hasFullSetLore(Player $player, string $lore)
	{
		#shoutout to OntheVergeYt
		$inv = $player->getArmorInventory();
		$h = $inv->getHelmet();
		$c = $inv->getChestplate();
		$l = $inv->getLeggings();
		$b = $inv->getBoots();
		if (in_array($lore, $h->getLore()) && in_array($lore, $c->getLore()) && in_array($lore, $l->getLore()) && in_array($lore, $b->getLore())) {
			return true;
		} else {
			return false;
		}
	}
	public static function initItems(): void{
		ItemFactory::registerItem(new LeatherBoots(), true);
		ItemFactory::registerItem(new LeatherLeggins(), true);
		ItemFactory::registerItem(new LeatherChestPlate(), true);
		ItemFactory::registerItem(new LeatherHelm(), true);
	}
	public static function initEntitys(){
		Entity::registerEntity(SpecialGurdian::class, true);
		Entity::registerEntity(TextEntity::class, true);
	}
}

