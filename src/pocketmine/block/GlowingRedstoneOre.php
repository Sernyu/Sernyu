<?php

/*
 *  ____ 
 * / ___|  ___ _ __ _ __  _   _ _   _ 
 * \___ \ / _ \ '__| '_ \| | | | | | |
 *  ___) |  __/ |  | | | | |_| | |_| |
 * |____/ \___|_|  |_| |_|\__, |\__,_|
 *                        |___/       
 * 
*/

namespace pocketmine\block;

use pocketmine\item\Item;
use pocketmine\item\Tool;
use pocketmine\level\Level;

class GlowingRedstoneOre extends Solid{

	protected $id = self::GLOWING_REDSTONE_ORE;

	public function __construct(){

	}

	public function getHardness(){
		return 15;
	}

	public function getName(){
		return "Glowing Redstone Ore";
	}

	public function getToolType(){
		return Tool::TYPE_PICKAXE;
	}

	public function getLightLevel(){
		return 9;
	}

	public function onUpdate($type){
		if($type === Level::BLOCK_UPDATE_SCHEDULED or $type === Level::BLOCK_UPDATE_RANDOM){
			$this->getLevel()->setBlock($this, Block::get(Item::REDSTONE_ORE, $this->meta), \false, \false, \true);

			return Level::BLOCK_UPDATE_WEAK;
		}

		return \false;
	}

	public function getDrops(Item $item){
		if($item->isPickaxe() >= Tool::TIER_IRON){
			return [
				[Item::REDSTONE_DUST, 0, \mt_rand(4, 5)],
			];
		}else{
			return [];
		}
	}

}