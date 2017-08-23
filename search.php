<?php

//写出三种方法快速定位点（57，89）在下面九宫格的区域（即程序输出7区），并标明你认为最优的方案。

//第一种算法：



function searchDot1($x, $y)
{
  $maxX= 100000;
  
  if($x > 0 && $y > 0)
	{
  
       if($x >0 && $x <= 10)  // x(0,10]
		{
			if($x == 10){
				if($y > 0 && $y < 40)
				{
				   echo "3,6";
				}
				else if($y == 40)
				{
					echo "2,3,5,6";
				
				}else if($y > 40 && $y < 65)
				{
					echo "2,5";
				}else if($y == 65)
				{
					echo "1,2,4,5";
				
				}else{
					echo "1,4";
				}
			
			}else{
			
				if($y > 0 && $y < 40)
				{
				   echo 3;
				}else if($y == 40)
				{
					echo "2,3";
				
				}else if($y > 40 && $y < 65)
				{
					echo 2;
				}else if($y == 65)
				{
					echo "1,2";
				
				}else{
					echo 1;
				}

			}



		}else if($x > 10 && $x <= 25)    // x(10,25]
		{
			if($x == 25)
			{
			 
				if($y > 0 && $y < 40)
				{
				   echo "6,9";
				}
				else if($y == 40)
				{
					echo "5,6,8,9";
				
				}else if($y > 40 && $y < 65)
				{
					echo "5,8";
				}else if($y == 65)
				{
					echo "4,5,7,8";
				
				}else{
					echo "4,7";
				}
			 
			}else{
			   
			   if($y > 0 && $y < 40)
				{
				   echo "6";
				}
				else if($y == 40)
				{
					echo "5,6";
				
				}else if($y > 40 && $y < 65)
				{
					echo "5";
				}else if($y == 65)
				{
					echo "4,5";
				
				}else{
					echo "4";
				}
			}
		}else
		{
	        if($y > 0 && $y < 40)
				{
				   echo "9";
				}
				else if($y == 40)
				{
					echo "8,9";
				
				}else if($y > 40 && $y < 65)
				{
					echo "8";
				}else if($y == 65)
				{
					echo "7,8";
				
				}else{
					echo "7";
				}
		}
     
	}

}


searchDot1(57, 89);




?>