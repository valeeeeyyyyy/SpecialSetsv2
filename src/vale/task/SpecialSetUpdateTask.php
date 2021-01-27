<?php


namespace vale\task;

use pocketmine\block\Block;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\level\particle\DestroyBlockParticle;
use pocketmine\Player;
use pocketmine\scheduler\Task;
use pocketmine\Server;
use vale\Loader;

class SpecialSetUpdateTask  extends Task
{

	//ty verge for refrence
	/** @var array $phantomSet */
	public static  $phantomSet = [];
	/** @var Loader $plugin */
	public  $plugin;
	const PHANTOM_ABILITY_MSG = "§r§7((§r§c§lWHILE §r§cThe Phantom Set is Active you §r§c§lDEAL 25% §r§coutgoing damage§r§7)) \n §r§c§lPHANTOM SET ACTIVATED";

	public function __construct(Loader $plugin)
	{
		$this->plugin = $plugin;
	}

	public function onRun(int $currentTick)
	{
		foreach (Server::getInstance()->getOnlinePlayers() as $player) {
			self::checksets($player);
		}
	}

	public static function checksets(Player $player): void
	{
		if (Loader::getInstance()->hasFullSetLore($player, "§r§c§lPHANTOM SET BONUS")) {

			$player->sendMessage("§r§7((§r§c§lWHILE §r§cThe Phantom Set is Active you §r§c§lDEAL 25% §r§coutgoing damage§r§7)) \n §r§c§lPHANTOM SET ACTIVATED");
			$player->getLevel()->addParticle(new DestroyBlockParticle($player->asVector3()->add(0, 1), Block::get(Block::REDSTONE_BLOCK)));
			array_push(self::$phantomSet, $player->getName());
		}
			if (!in_array($player->getName(), self::$phantomSet)) {
				unset(self::$phantomSet[array_search($player->getName(), self::$phantomSet)]);
				$player->sendMessage("§r§c§lPHANTOM SET DISABLED");
				if ($player->getHealth() > 10) {
					$player->addEffect(new EffectInstance(Effect::getEffect(Effect::INSTANT_DAMAGE), 1, 0));
					$player->setHealth($player->getHealth() + mt_rand(3, 7));
				}
			}
		}
}
