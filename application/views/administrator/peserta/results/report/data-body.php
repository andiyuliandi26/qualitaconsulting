<?php
    $index = 0;
    $color = ["#d911ac", "#dde222", "#e29f22", "#2269e2", "#19d911"];
    $colorLight = ["#f085dc", "#eef085", "#f0d485", "#85b6f0", "#85f09a"];
    $colorBg = ["linear-gradient(270deg, rgba(240,0,0,1) 0%, rgba(252,57,57,1) 20%, rgba(245,93,93,1) 40%, rgba(255,137,137,1) 60%, rgba(203,108,108,1) 80%, rgba(255,175,175,1) 100%)",
                 "yellow", "blue", "green", "brown"];
    $linearGradient = ["#F40009", "#dde222", "#f0d485", "green", "brown"];
    $domainStyle = [
        "border: 1px solid {$color[0]}; background-color:{$color[0]}; color:#FFFFFF;",
        "border: 1px solid {$color[1]}; background-color:{$color[1]}; color:#FFFFFF;",
        "border: 1px solid {$color[2]}; background-color:{$color[2]}; color:#FFFFFF;",
        "border: 1px solid {$color[3]}; background-color:{$color[3]}; color:#FFFFFF;",
        "border: 1px solid {$color[4]}; background-color:{$color[4]}; color:#FFFFFF;",
    ];

    $rowStyle = [
        "border: 1px solid {$color[0]};",
        "border: 1px solid {$color[1]};",
        "border: 1px solid {$color[2]};",
        "border: 1px solid {$color[3]};",
        "border: 1px solid {$color[4]};",
    ];
?>
<?php foreach($md_domain as $items): ?>
    
    <?php 
        $getDomainResultIndex = array_search($items->ID, array_column($domainResult, "Big5ID"));
        $getDomainResult = $domainResult[$getDomainResultIndex];
        $domainValueLow = "";
        $domainBlockLow = "";
        $domainValueAverage = "";
        $domainBlockAverage = "";
        $domainValueHigh = "";
        $domainBlockHigh = "";

        switch($getDomainResult->LfsResult){
            case "Very Low":
                $domainValueLow = "<p class='score-marker'>{$getDomainResult->TotalScore}</p>";
                $domainBlockLow = "style='background-color:{$colorLight[$index]}'";
                break;
            case "Low":
                $domainValueLow = "<p class='score-marker'>{$getDomainResult->TotalScore}</p>";
                $domainBlockLow = "style='background-color:{$colorLight[$index]}'";
                break;
            case "Average":
                $domainValueAverage = "<p class='score-marker'>{$getDomainResult->TotalScore}</p>";
                $domainBlockAverage = "style='background-color:{$colorLight[$index]}'";
                break;
            case "High":
                $domainValueHigh = "<p class='score-marker'>{$getDomainResult->TotalScore}</p>";
                $domainBlockHigh = "style='background-color:{$colorLight[$index]}'";
                break;
            case "Very High":
                $domainValueHigh = "<p class='score-marker'>{$getDomainResult->TotalScore}</p>";
                $domainBlockHigh = "style='background-color:{$colorLight[$index]}'";
                break;            
        }
    ?>
    <table class="table-domain">
        <tr style="<?php echo $domainStyle[$index]; ?>">
            <td colspan="3" class="domain-title">
                <?php echo "{$items->Kode} : {$items->Nama} "; ?>
            </td>
        </tr>
        
        <tr style="<?php echo $rowStyle[$index]; ?>">
            <td class="score-lable">
                <?php 
                    echo $domainValueLow;
                ?>
            </td>
            <td class="score-lable">
                <?php 
                    echo $domainValueAverage;
                ?></td>
            <td class="score-lable">
                <?php 
                    echo $domainValueHigh;
                ?>
            </td>
        </tr>
        <tr style="<?php echo $rowStyle[$index]; ?>">
            <td width="33%" class="domain-desc" <?php echo $domainBlockLow; ?>><?php echo "<strong>{$items->DefinisiLow} ({$items->MatriksLow})</strong> {$items->RedaksiLow}" ?></td>
            <td width="33%" class="domain-desc" <?php echo $domainBlockAverage; ?>><?php echo "<strong>{$items->DefinisiAverage} ({$items->MatriksAverage})</strong> {$items->RedaksiAverage}" ?></td>
            <td width="33%" class="domain-desc" <?php echo $domainBlockHigh; ?>><?php echo "<strong>{$items->DefinisiHigh} ({$items->MatriksHigh})</strong> {$items->RedaksiHigh}" ?></td>
        </tr>
    </table>
            
    <table width="100%" class="table-facet">
		<?php
            foreach($md_facet as $itemsFacet):
                $getFacetResultIndex = array_search($itemsFacet->ID, array_column($facetResult, "FacetID"));
                $getFacetResult = $facetResult[$getFacetResultIndex];
                $facetValueVeryLow = "";
                $facetBlockVeryLowScore = FALSE;
                $facetValueLow = "";
                $facetBlockLow = "";
                $facetBlockLowScore = FALSE;
                $facetValueAverage = "";
                $facetBlockAverage = "";
                $facetValueHigh = "";
                $facetBlockHigh = "";
                $facetValueVeryHigh = "";
                $facetBlockVeryHigh = "";

                switch($getFacetResult['LfsResult']){
					case "Very Low":
						$facetValueVeryLow = "<p class='score-marker'>{$getFacetResult['TotalScore']}</p>";
						$facetBlockLow = "background-color:{$colorLight[$index]};";
						break;
					case "Low":
						$facetValueLow = "<p class='score-marker'>{$getFacetResult['TotalScore']}</p>";
						$facetBlockLow = "background-color:{$colorLight[$index]};";
						break;
					case "Average":
						$facetValueAverage = "<p class='score-marker'>{$getFacetResult['TotalScore']}</p>";
						$facetBlockAverage = "background-color:{$colorLight[$index]};";
						break;
					case "High":
						$facetValueHigh = "<p class='score-marker'>{$getFacetResult['TotalScore']}</p>";
						$facetBlockHigh = "background-color:{$colorLight[$index]};";
						break;
					case "Very High":
						$facetValueVeryHigh = "<p class='score-marker'>{$getFacetResult['TotalScore']}</p>";
						$facetBlockHigh = "background-color:{$colorLight[$index]};";
						break;
				}

				if($itemsFacet->Big5ID == $items->ID):
		?>
                    <tr style="<?php echo "{$rowStyle[$index]}"; ?>">
            
                        <td rowspan="3" width="25%" style="padding-left:10px;font-weight:bold;">
                            <?php echo "{$itemsFacet->Nama}"; ?>
                        </td>
                        <td class="score-lable">
					        <?php
					            echo $facetValueVeryLow;
                            ?>
                        </td>
                        <td class="score-lable">
					        <?php
                                echo $facetValueLow;
                            ?>
                        </td>
                        <td class="score-lable">
					        <?php
                                echo $facetValueAverage;
                            ?></td>
                        <td class="score-lable">
					        <?php
                                echo $facetValueHigh;
                            ?>
                        </td>
                        <td class="score-lable">
                            <?php
                                echo $facetValueVeryHigh;
                            ?>
                        </td>
                    </tr>
                    <tr style="<?php echo $rowStyle[$index]; ?>">
                        <?php 
                            foreach($md_normafacet as $items2){
                                if($items2->FacetID == $itemsFacet->ID){
                                    echo "<td width='15%' style='text-align:center;{$rowStyle[$index]}; padding: 10px 0px;'>{$items2->BatasBawah} - {$items2->BatasAtas}</td>";
                                }
                            } 
                        ?>
                    </tr>
                    <tr style="<?php echo $rowStyle[$index]; ?>">
						<td width="40%" class="facet-desc" colspan="2" style="<?php echo "{$rowStyle[$index]}; {$facetBlockLow};"; ?>">
							<?php echo "{$itemsFacet->DefinisiLow}" ?>
						</td>
						<td width="20%" class="facet-desc" style="<?php echo "{$rowStyle[$index]}; {$facetBlockAverage};"; ?>">
							<?php echo "{$itemsFacet->DefinisiAverage}" ?>
						</td>
						<td width="40%" class="facet-desc" colspan="2" style="<?php echo "{$rowStyle[$index]}; {$facetBlockHigh};"; ?>">
							<?php echo "{$itemsFacet->DefinisiHigh}" ?>
						</td>
                    </tr>
            <?php
                endif; 
                endforeach; 
            ?>
    </table>


<?php
    if($index < 4){
	    echo "<pagebreak/>";
	}
    $index++;
    endforeach;
?>
