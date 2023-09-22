<?php
use App\PaginationController;
$paginationSideCount = 2;

$pageCount = PaginationController::getPagesAmount();
$currentItem = $_GET['page_num'];
if(empty($currentItem) || $currentItem < 1) {
    $currentItem = 1;
}
$currentItem = min($currentItem, $pageCount);

$maxLeftItems = $currentItem - 1;
$maxRightItems = $pageCount - $currentItem;
$leftCount = min($paginationSideCount, $maxLeftItems);
$rightCount = min($paginationSideCount, $maxRightItems);
$realLeftCount = min($leftCount + $paginationSideCount - $rightCount, $maxLeftItems);
$realRightCount = min($rightCount + $paginationSideCount - $leftCount, $maxRightItems);
$result = [];
for($i = $currentItem - $realLeftCount; $i <= $currentItem + $realRightCount; $i++) {
    array_push($result, $i);
}

$isFirstPage = $currentItem == 1;
$isLastPage = $currentItem == $pageCount;
    ?>
<div class="pagination">
    <?php if($isFirstPage) { ?>
        <a class="pagination_button btn-primary">Previous</a>
    <?php }
    else { ?>
        <a href="?page_num=<?php echo $currentItem - 1?>" class="pagination_button btn-primary">Previous</a>
        <?php
    }?>
        <?php foreach ($result as $page) {
            if($page == $currentItem) { ?>
                <a class="pagination_button btn-primary"><?php echo $page?></a>
          <?php  }
            else { ?>
                <a href="?page_num=<?php echo $page?>" class="pagination_button btn-primary"><?php echo $page?></a>
            <?php   }
                 }
            ?>
    <?php

        if($isLastPage) {?>
            <a class="pagination_button btn-primary">Next</a>
        <?php   }
        else { ?>
            <a href="?page_num=<?php echo $currentItem + 1 ?>" class="pagination_button btn-primary">Next</a>
            <?php
    }
    ?>
</div>
