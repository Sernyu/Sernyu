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











class SetEntityMotionPacket extends DataPacket{
	const NETWORK_ID = Info::SET_ENTITY_MOTION_PACKET;


	// eid, motX, motY, motZ
	/** @var array[] */
	public $entities = [];

	public function clean(){
		$this->entities = [];
		return parent::clean();
	}

	public function decode(){

	}

	public function encode(){
		$this->buffer = \chr(self::NETWORK_ID); $this->offset = 0;;
		$this->buffer .= \pack("N", \count($this->entities));
		foreach($this->entities as $d){
			$this->buffer .= \pack("NN", $d[0] >> 32, $d[0] & 0xFFFFFFFF); //eid
			$this->buffer .= (\ENDIANNESS === 0 ? \pack("f", $d[1]) : \strrev(\pack("f", $d[1]))); //motX
			$this->buffer .= (\ENDIANNESS === 0 ? \pack("f", $d[2]) : \strrev(\pack("f", $d[2]))); //motY
			$this->buffer .= (\ENDIANNESS === 0 ? \pack("f", $d[3]) : \strrev(\pack("f", $d[3]))); //motZ
		}
	}

}
