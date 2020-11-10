<?php

namespace MulkiAqi192\TagShop;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

use onebone\economyapi\EconomyAPI;

class main extends PluginBase implements Listener {

	public function onEnable(){

	}

	public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool {

		switch($cmd->getName()){
			case "tags":
			 if($sender instanceof Player){
			 	$this->tagui($sender);
			 }
		}
	return true;
	}

	public function tagui($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $player, int $data = null){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
					if($player->hasPermission("canopy.tags")){
						$player->setDisplayName("§7[§aCanopy§7] §e" . $player->getName());
						$player->sendMessage("§aCanopy tag has been applied!");
					} else {
						$this->canopyshop($player);
						return true;
					}
				break;

				case 1:
					if($player->hasPermission("killer.tags")){
						$player->setDisplayName("§7[§cKiller§7] §e" . $player->getName());
						$player->sendMessage("§aKiller tag has been applied!");
					} else {
						$this->killershop($player);
						return true;
					}
				break;
			}
		});
		$form->setTitle("§aTags§6Shop");
		$form->setContent("§9>> §aSelect tag you want to apply");
		$form->addButton("§7[§aCanopy§7]");
		$form->addButton("§7[§aKiller§7]");
		$form->sendToPlayer($player);
		return $form;
	}

	public function canopyshop($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $player, int $data = null){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
					$money = EconomyAPI::getInstance()->myMoney($player);
					if($money >= 4000){
						$player->addAttachment($this, "canopy.tags", true);
					} else {
						$player->sendMessage("§cYou dont have enough money to buy this!");
					}
				break;

				case 1:
					
				break;
			}
		});
		$form->setTitle("§aTags§6Shop");
		$form->setContent("§9>> §cYou dont have this tag! Want to buy it?"); // rip grammer
		$form->addButton("§aYes");
		$form->addButton("§cNo");
		$form->sendToPlayer($player);
		return $form;
	}

	public function killershop($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $player, int $data = null){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
					$money = EconomyAPI::getInstance()->myMoney($player);
					if($money >= 10000){
						$player->addAttachment($this, "killer.tags", true);
					} else {
						$player->sendMessage("§cYou dont have enough money to buy this!");
					}
				break;

				case 1:
					
				break;
			}
		});
		$form->setTitle("§aTags§6Shop");
		$form->setContent("§9>> §cYou dont have this tag! Want to buy it?"); // rip grammer
		$form->addButton("§aYes");
		$form->addButton("§cNo");
		$form->sendToPlayer($player);
		return $form;
	}

}