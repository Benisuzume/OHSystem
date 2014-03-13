<?php
if (!isset($website) ) { header('HTTP/1.1 404 Not Found'); die; }
?>
<div id="content" class="s-c-x">
<div class="wrapper">   
    <div id="main-column">
     <div class="padding">
      <div class="inner">
  
  <table class="tableBig">
  <tr>
    <td class="padLeft">
	  <div align="center">
	     <h1><a href="<?=OS_HOME?>?game=<?=(int) $_GET["game"]?>"><?=$GameData[0]["gamename"]?></a></h1>
	  </div>
	</td>
  </tr>
  <tr>
	<td class="padTop">
	<div align="center">
	<b><?=$lang["date"]?>:</b> <?=$GameData[0]["datetime"]?>,
	<b><?=$lang["duration"]?>:</b> <?=$GameData[0]["duration"]?>
	<?=OS_EditGame( $_GET["game"] )?>
    </div>
   </td>
  </tr>
  </table>

<?php if (isset($GameData[0]["replay"]) AND !empty($GameData[0]["replay"]) ) { ?>
<table class="tableBig">
  <tr class="h32">
    <td class="padLeft padTop padBottom">
	   <div align="center">
	   <a class="menuButtons" target="_blank" href="<?=$GameData[0]["replay"]?>"><?=$lang["download_replay"]?></a>
	   <a class="menuButtons" target="_blank" href="http://ohsystem.net/force_download.php?file=<?=OS_HOME?><?=$GameData[0]["replay"]?>">Force Download (IE)</a>
	   <a onclick="showhide('game_log');" class="menuButtons" href="#gamelog"><?=$lang["view_gamelog"] ?></a>
	   </div>
	</td>
  </tr>
  </table>
<?php } ?>
  
  <div class="padTop"></div>
  
  <div style="margin-top: 16px; margin-bottom: 10px; display: none;">
  <h2>
    <?=$GameData[0]["gamename"]?>, 
    <b><?=$lang["duration"]?>:</b> <?=$GameData[0]["duration"]?>, 
    <b><?=$lang["date"]?>:</b> <?=$GameData[0]["datetime"]?>
  </h2>
  </div>
  <?php
  foreach ($GameData as $Game) { ?>
  
<?php if ( $Game["side"] == "sentinel" ) { //SENTINEL ROW ?>
<table>
  <tr class="sentinelRow">
  <td width="850" class="aligncenter" align="center">
	 <?=$Game["display_winner"]?>
	 </td>
    </tr>
</table>
	
<table>
  <tr class="<?=$Game["hideElement"]?>">
    <th width="90" class="padLeft"><?=$lang["hero"]?></th>
    <th width="235"><?=$lang["player"]?></th>
    <th width="80" ><?=$lang["kda"]?></th>
	<th width="80" ><?=$lang["cdn"]?></th>
	<th width="80" ><?=$lang["trc"]?></th>
	<th width="84" ><?=$lang["gold"]?></th>
	<th><?=$lang["left"]?></th>
  </tr>
</table>
  <?php } ?>
  
  <?php if ( $Game["side"] == "scourge" ) { //SCOURGE ROW  ?>
<table>
  <tr class="scourgeRow">
  <td width="850" class="aligncenter" align="center">
	 <?=$Game["display_loser"]?>
	 </td>
    </tr>
</table>
	
<table>
  <tr class="<?=$Game["hideElement"]?>">
    <th width="90" class="padLeft"><?=$lang["hero"]?></th>
    <th width="235"><?=$lang["player"]?></th>
    <th width="80" class="<?=$Game["hideElement"]?>"><?=$lang["kda"]?></th>
	<th width="80" class="<?=$Game["hideElement"]?>"><?=$lang["cdn"]?></th>
	<th width="80" class="<?=$Game["hideElement"]?>"><?=$lang["trc"]?></th>
	<th width="84" class="<?=$Game["hideElement"]?>"><?=$lang["gold"]?></th>
	<th><?=$lang["left"]?></th>
  </tr>
</table>
<?php }?>

<table>
  <tr class="row SingleGameRow <?=$Game["hideslot"]?> ">
 <td width="80" class="padLeft slot<?=$Game["counter"]?>">
 <a name="<?=strtolower($Game["name"])?>"></a>
 <?=OS_ShowHero( $Game["heroid"], $Game["description"], $Game["hero"], 100, 64,64, $Game["hero_link"] )?>
 </td>
 <td width="260">
 <div class="SingleGamePlayerName">
    <?=OS_ShowUserFlag( $Game["letter"], $Game["country"] )?>
    <?=OS_SingleGameUser($Game["userid"], $Game["full_name"], $Game["name"], $BestPlayer, $Game["level"])?>
	<?=OS_IsUserGameAdmin( $Game["admin"])?>
	<?=OS_IsUserGameBanned( $Game["banned"], $lang["banned"] ) ?>
	<span class="player_scores<?=$Game["class"]?>"><?=$Game["score_points"]?></span>
 </div>

<?php
OS_RatePlayer($Game["name"], $Game["counter"], $PlayersList, $Game["player_rate"], $Game["voted"], $Game["totalvotes"] );
?>
 
 <div class="<?=$Game["hideElement"]?>">
 <?=OS_ShowItem( $Game["item1"], $Game["itemname1"], $Game["itemicon1"] )?>
 <?=OS_ShowItem( $Game["item2"], $Game["itemname2"], $Game["itemicon2"] )?>
 <?=OS_ShowItem( $Game["item3"], $Game["itemname3"], $Game["itemicon3"] )?>
 <?=OS_ShowItem( $Game["item4"], $Game["itemname4"], $Game["itemicon4"] )?>
 <?=OS_ShowItem( $Game["item5"], $Game["itemname5"], $Game["itemicon5"] )?>
 <?=OS_ShowItem( $Game["item6"], $Game["itemname6"], $Game["itemicon6"] )?>
 </div>
 </td>
 <td width="90" class="statsscore <?=$Game["hideElement"]?>">
 	  <span class="won"><?=($Game["kills"])?></span> / 
	  <span class="lost"><?=$Game["deaths"]?></span> / 
	  <span class="assists"><?=$Game["assists"]?></span>
 </td>
 <td width="90" class="statsscore <?=$Game["hideElement"]?>" <?=$Game["hideElement"]?>>
  	  <span class="won"><?=($Game["creepkills"])?></span> / 
	  <span class="lost"><?=$Game["creepdenies"]?></span> / 
	  <span class="assists"><?=$Game["neutralkills"]?></span>
 </td>
 <td width="90" class="statsscore <?=$Game["hideElement"]?>" <?=$Game["hideElement"]?>>
   	  <span class="won"><?=($Game["towerkills"])?></span> / 
	  <span class="lost"><?=$Game["raxkills"]?></span> / 
	  <span class="assists"><?=$Game["courierkills"]?></span>
 </td>
 <td width="90" class="statsscore <?=$Game["hideElement"]?>" <?=$Game["hideElement"]?>><?=$Game["gold"]?></td>
 <td class="statsscore<?=$Game["leaver"]?>">
 <?=$Game["left"]?>
 <div class="left_reason overflow_hidden"><?=$Game["leftreason"]?></div>
 <?=OS_IsUserGameLeaver( $Game["leaver"], $lang["leaver"])?>
 </td>
   </tr>
  </table>
  <?php
  }
  ?>
  <div class="padTop"></div>
  <table class="tableBig">
<?php if ($PlayerKills>0) { ?> 
    <tr class="row"  height="26" >
	  <td width="180"class="padLeft imgvalign"><div class="best_player_title"><?=$lang["best_player"] ?></span></div>
	  <td width="180" class="padLeft" style="text-align:left;"><h4 class="best_player">
	   <a href="<?=OS_HOME?>?u=<?=($BestPlayerID)?>"><?=$BestPlayer?></a> <img src="<?=OS_HOME?>img/best.png" class="imgvalign" width="24" height="24" /> 
	   </h4></td>
	  <td></td>
	</tr>  
    <tr class="row">
	  <td width="180" class="padLeft imgvalign"><b><?=$lang["most_kills"]?></b></td>
	  <td width="180" class="padLeft"> <h4><a href="<?=OS_HOME?>?u=<?=($MostKillsID)?>"><?=$MostKills?></a></h4></td>
	  <td class="padLeft"><?=$PlayerKills?></td>
	</tr> 
<?php } ?>
<?php if ($PlayerAssists>0) { ?> 
    <tr class="row">
	  <td width="180" class="padLeft imgvalign"><b><?=$lang["most_assists"]?></b></td>
	  <td width="180" class="padLeft"> <h4><a href="<?=OS_HOME?>?u=<?=($MostAssistsID)?>"><?=$MostAssists?></a></h4></td>
	  <td class="padLeft"><?=$PlayerAssists?></td>
<?php } ?>
	</tr> 
<?php if ($PlayerDeaths>0) { ?> 
    <tr class="row">
	  <td width="180" class="padLeft imgvalign"><b><?=$lang["most_deaths"] ?></b></td>
	  <td width="180" class="padLeft"> <h4><a href="<?=OS_HOME?>?u=<?=($MostDeathsID)?>"><?=$MostDeaths?></a></h4></td>
	  <td class="padLeft"><?=$PlayerDeaths?></td>
	</tr> 
<?php } ?>
<?php if ($PlayerCK>0) { ?>
	<tr class="row">
	  <td width="180" class="padLeft imgvalign"><b><?=$lang["top_ck"]?></b></td>
	  <td width="180" class="padLeft"> <h4><a href="<?=OS_HOME?>?u=<?=($MostCKID)?>"><?=$MostCK?></a></h4></td>
	  <td class="padLeft"><?=$PlayerCK?></td>
	</tr> 
<?php } ?>
<?php if ($PlayerCD>0) { ?>
	<tr class="row">
	  <td width="180" class="padLeft imgvalign"><b><?=$lang["top_cd"]?></b></td>
	  <td width="180" class="padLeft"> <h4><a href="<?=OS_HOME?>?u=<?=($MostCDID)?>"><?=$MostCD?></a></h4></td>
	  <td class="padLeft"><?=$PlayerCD?></td>
	</tr> 
<?php } ?>
   </table>

<?=os_display_custom_fields()?> 
   
     </div>
    </div>
   </div>
  </div>
</div>

<div id="rate_notify"></div>

<div class="s-c-x">
  <div class="wrapper">   
    <div id="main-column">
     <div class="padding">
      <div class="inner" style="height:390px;">
<?php include("inc/show_gamelog3.php"); ?>
      </div>
    </div>
   </div>
  </div>
</div>
