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

namespace pocketmine\scheduler;

use pocketmine\Server;

/**
 * Class used to run async tasks in other threads.
 *
 * WARNING: Do not call PocketMine-MP API methods, or save objects from/on other Threads!!
 */
abstract class AsyncTask extends \Collectable{

	/** @var AsyncWorker $worker */
	public $worker = \null;

	private $result = \null;
	private $serialized = \false;
	private $cancelRun = \false;
	/** @var int */
	private $taskId = \null;

	public function run(){
		$this->result = \null;

		if($this->cancelRun !== \true){
			$this->onRun();
		}

		$this->setGarbage();
	}

	/**
	 * @deprecated
	 *
	 * @return bool
	 */
	public function isFinished(){
		return $this->isGarbage();
	}

	/**
	 * @return mixed
	 */
	public function getResult(){
		return $this->serialized ? \unserialize($this->result) : $this->result;
	}

	public function cancelRun(){
		$this->cancelRun = \true;
	}

	public function hasCancelledRun(){
		return $this->cancelRun === \true;
	}

	/**
	 * @return bool
	 */
	public function hasResult(){
		return $this->result !== \null;
	}

	/**
	 * @param mixed $result
	 * @param bool  $serialize
	 */
	public function setResult($result, $serialize = \true){
		$this->result = $serialize ? \serialize($result) : $result;
		$this->serialized = $serialize;
	}

	public function setTaskId($taskId){
		$this->taskId = $taskId;
	}

	public function getTaskId(){
		return $this->taskId;
	}

	/**
	 * Gets something into the local thread store.
	 * You have to initialize this in some way from the task on run
	 *
	 * @param string $identifier
	 * @return mixed
	 */
	public function getFromThreadStore($identifier){
		global $store;
		return $this->isGarbage() ? \null : $store[$identifier];
	}

	/**
	 * Saves something into the local thread store.
	 * This might get deleted at any moment.
	 *
	 * @param string $identifier
	 * @param mixed  $value
	 */
	public function saveToThreadStore($identifier, $value){
		global $store;
		if(!$this->isGarbage()){
			$store[$identifier] = $value;
		}
	}

	/**
	 * Actions to execute when run
	 *
	 * @return void
	 */
	public abstract function onRun();

	/**
	 * Actions to execute when completed (on main thread)
	 * Implement this if you want to handle the data in your AsyncTask after it has been processed
	 *
	 * @param Server $server
	 *
	 * @return void
	 */
	public function onCompletion(Server $server){

	}

	public function cleanObject(){
		foreach($this as $p => $v){
			$this->{$p} = \null;
		}
	}

}
