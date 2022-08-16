<?php 
//http://corma.site/Products/lista/10?param1=1&pag=8&param2=2
$num_pages = ceil($total / $limit);

if ($total > $limit) {

	echo "<div class='paginacio'><ul>";

	$class = ($actual_page == 1) ? 'disabled' : 'enabled';
	$prev = ($actual_page == 1) ? 1 : $actual_page - 1;


	/*if ($type=='private') {

		if (substr($link, count($link)-1)!='/') {$link .= '/';}

		$arrLink = explode('/', $link);
		$i = 1;
		$sLink = '';
		$last = count($arrLink);
		foreach ($arrLink as $partLink) {
			if (($i <= $last)&&(!is_numeric($partLink))) {
				$sLink .= DS.$partLink;
			}
			$i++;
		}
		$sLink = (!is_numeric($partLink)) ? $sLink : $sLink.DS;
		$sLink = str_replace('/http', 'http', $sLink);
	}
	$link = ($type=='public') ? $link.'&pag=' : $sLink;


	$strfilter = '';

	if ($type=='private') {
		if (!empty($filterid)) {
			$strfilter = '/'.$filterid;
		}
	}*/



	echo "<li class='".$class."'><a href='javascript:changePage(1);'><i class='fa fa-angle-double-left'></i></a></li>";
	echo "<li class='".$class."'><a href='javascript:changePage(".$prev.");'><span><i class='fa fa-angle-left'></i></span></a></li>";
	
	

	$total_pages = ($num_pages < 5) ? $num_pages : 5;


	if (($actual_page - 2) < 1) {

		for($currentPage = 1;$currentPage<=  $total_pages;$currentPage++) {

			$isActive = ($currentPage == $actual_page) ? 'active' : '';
			echo "<li class='".$isActive."''><a href='javascript:changePage(".$currentPage.");'><span>".$currentPage."</span></a></li>";
		}
	} else {
		if ($num_pages >= 5) {
			if ($actual_page+1 > $num_pages) {
				//$link1 = $link.($actual_page-4).$strfilter;
				echo "<li><a href='javascript:changePage(".($actual_page-4).");'><span>".($actual_page-4)."</span></a></li>";
			}
		}
		if ($num_pages >= 4) {
			if ($actual_page+2 > $num_pages) {
				//$link2 = $link.($actual_page-3).$strfilter;
				echo "<li><a href='javascript:changePage(".($actual_page-3).");'><span>".($actual_page-3)."</span></a></li>";
			}
		}
		if ($num_pages >= 3) {
			//$link3 = $link.($actual_page-2).$strfilter;
			echo "<li><a href='javascript:changePage(".($actual_page-2).");'><span>".($actual_page-2)."</span></a></li>";
		}
		if ($num_pages >= 2) {
			//$link4 = $link.($actual_page-1).$strfilter;
			echo "<li><a href='javascript:changePage(".($actual_page-1).");'><span>".($actual_page-1)."</span></a></li>";
		}
		//$link5 = $link.$actual_page.$strfilter;
		echo "<li class='active'><a href='javascript:changePage(".($actual_page).");'><span>".($actual_page)."</span></a></li>";

		if ($actual_page+1 <= $num_pages) {
			//$link6 = $link.($actual_page+1).$strfilter;
			echo "<li><a href='javascript:changePage(".($actual_page+1).");'><span>".($actual_page+1)."</span></a></li>";
		}
		if ($actual_page+2 <= $num_pages) {
			//$link7 = $link.($actual_page+2).$strfilter;
			echo "<li><a href='javascript:changePage(".($actual_page+2).");'><span>".($actual_page+2)."</span></a></li>";
		}
		
	}

	$class = ($actual_page == $num_pages) ? 'disabled' : 'enabled';
	$next = ($actual_page == $num_pages) ? $num_pages : $actual_page + 1;

	echo "<li class='".$class."'><a href='javascript:changePage(".($actual_page+1).");'><span><i class='fa fa-angle-right'></i></span></a></li>";

	//$link9 = $link.$num_pages.$strfilter;
	//echo '<li class="'.$class.'"><a href="'.$link9.'"><i class="fa fa-angle-double-right"></i></a></li>';
	echo "<li class='".$class."'><a href='javascript:changePage(".($num_pages).");'><span><i class='fa fa-angle-double-right'></i></span></a></li>";


	echo "</ul></div>";
}