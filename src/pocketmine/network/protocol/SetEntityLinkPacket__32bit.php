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

namespace pocketmine\network\protocol;

use pocketmine\utils\Binary;











class SetEntityLinkPacket extends DataPacket{
	const NETWORK_ID = Info::SET_ENTITY_LINK_PACKET;

	public $from;
	public $to;
	public $type;

	public function decode(){

	}

	public function encode(){
		$this->buffer = \chr(self::NETWORK_ID); $this->offset = 0;;
		$this->buffer .= Binary::writeLong($this->from);
		$this->buffer .= Binary::writeLong($this->to);
		$this->buffer .= \chr($this->type);
	}

}
