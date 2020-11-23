<?php

function balance($str1, $str2)
{
	$left = str_split(str_replace(['!','?'], [2,3], $str1));
	$right = str_split(str_replace(['!','?'], [2,3], $str2));
	$dif = array_sum($left) - array_sum($right);
	if ($dif < 0) {
		return 'Right';
	}
	if ($dif > 0) {
		return 'Left';
	}
	return 'Balance';
}

echo balance("!!","??") === "Right";
echo balance("!??","?!!") === "Left";
echo balance("!?!!","?!?") === "Left";
echo balance("!!???!????","??!!?!!!!!!!") === "Balance";
