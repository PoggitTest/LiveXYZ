<?php

/*
 *  LiveXYZ - a PocketMine-MP plugin to show your coordinates real-time as you move
 *  Copyright (C) 2016 Dylan K. Taylor
 *  
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
 
namespace LiveXYZ;

use pocketmine\Player;
use pocketmine\scheduler\PluginTask;
use pocketmine\utils\TextFormat;
 
class ShowDisplayTask extends PluginTask{

	/** @var Player */
	private $player;
	
	public function __construct(LiveXYZ $plugin, Player $player){
		parent::__construct($plugin);
		$this->player = $player;
	}
	
	public function onRun($currentTick){
		$location = "Location: " . TextFormat::GREEN . "(" . Utils::getFormattedCoords($this->player->getX(), $this->player->getY(), $this->player->getZ()) . ")" . TextFormat::WHITE . "\n";
		$world = "World: " . TextFormat::GREEN . $this->player->getLevel()->getName() . TextFormat::WHITE . "\n";
		$direction = "Direction: " . TextFormat::GREEN . Utils::getCompassDirection($this->player->getYaw()) . " (" . $this->player->getYaw() . ")" . TextFormat::WHITE ."\n";
		
		$this->player->sendPopup($location . $world . $direction);		
	}

}