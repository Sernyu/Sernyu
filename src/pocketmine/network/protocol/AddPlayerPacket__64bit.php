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











class AddPlayerPacket extends DataPacket{
	const NETWORK_ID = Info::ADD_PLAYER_PACKET;

	public $uuid;
	public $username;
	public $eid;
	public $x;
	public $y;
	public $z;
	public $speedX;
	public $speedY;
	public $speedZ;
	public $pitch;
	public $yaw;
	public $item;
	public $metadata;

	public function decode(){

	}

	public function encode(){
		$this->buffer = \chr(self::NETWORK_ID); $this->offset = 0;;
		$this->putUUID($this->uuid);
		$this->putString($this->username);
		$this->buffer .= \pack("NN", $this->eid >> 32, $this->eid & 0xFFFFFFFF);
		$this->buffer .= (\ENDIANNESS === 0 ? \pack("f", $this->x) : \strrev(\pack("f", $this->x)));
		$this->buffer .= (\ENDIANNESS === 0 ? \pack("f", $this->y) : \strrev(\pack("f", $this->y)));
		$this->buffer .= (\ENDIANNESS === 0 ? \pack("f", $this->z) : \strrev(\pack("f", $this->z)));
		$this->buffer .= (\ENDIANNESS === 0 ? \pack("f", $this->speedX) : \strrev(\pack("f", $this->speedX)));
		$this->buffer .= (\ENDIANNESS === 0 ? \pack("f", $this->speedY) : \strrev(\pack("f", $this->speedY)));
		$this->buffer .= (\ENDIANNESS === 0 ? \pack("f", $this->speedZ) : \strrev(\pack("f", $this->speedZ)));
		$this->buffer .= (\ENDIANNESS === 0 ? \pack("f", $this->yaw) : \strrev(\pack("f", $this->yaw)));
		$this->buffer .= (\ENDIANNESS === 0 ? \pack("f", $this->yaw) : \strrev(\pack("f", $this->yaw))); //TODO headrot
		$this->buffer .= (\ENDIANNESS === 0 ? \pack("f", $this->pitch) : \strrev(\pack("f", $this->pitch)));
		$this->putSlot($this->item);

		$meta = Binary::writeMetadata($this->metadata);
		$this->buffer .= $meta;
	}

}
