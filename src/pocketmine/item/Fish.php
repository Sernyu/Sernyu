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

namespace pocketmine\item;


class Fish extends Item{
	public function __construct($meta = 0, $count = 1){
		parent::__construct(self::RAW_FISH, $meta, $count, "Raw Fish");
		if($this->meta === 1){
			$this->name = "Raw Salmon";
		}elseif($this->meta === 2){
			$this->name = "Clownfish";
		}elseif($this->meta === 3){
			$this->name = "Pufferfish";
		}
	}

}