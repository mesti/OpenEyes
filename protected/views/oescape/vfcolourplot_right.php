    <svg viewBox="0 0 580 490" width="260" height="260">
       <path d="m 408.93015,489.6437 -185.82778,0.57962 c 0,0 -18.93787,-0.57962 -30.18223,-11.59251 C 181.67578,467.61793 13.602246,309.38019 13.602246,309.38019 c 0,0 -11.2443598,-14.49065 -11.8361698,-22.02578 -0.5918,-7.53512 -0.5918,-77.09018 -0.5918,-77.09018 0,0 7.10169,-22.60538 15.3870198,-27.82202 8.28531,-5.21663 175.767044,-165.19326 175.767044,-165.19326 0,0 13.61158,-11.5924904 28.4068,-13.9110004 14.7952,-2.3185 194.1131,-1.15925 194.1131,-1.15925 0,0 27.81499,9.8536404 30.77403,17.3887704 2.95904,7.53512 119.54526,109.5492 119.54526,109.5492 0,0 15.97882,14.49063 14.2034,35.93678 -1.77543,21.44613 -1.18362,179.10426 -1.18362,179.10426 0,0 -4.14266,21.44614 -22.48871,30.14052 -18.34606,8.69438 -128.42239,106.65108 -128.42239,106.65108 0,0 -2.95904,5.79626 -18.34606,8.69439 z" fill="#b3b3b3"/>
       <line x1="210" y1="8" x2="210" y2="482" style="stroke:rgb(0,0,0);stroke-width:1" />
       <line x1="0" y1="247" x2="578" y2="247" style="stroke:rgb(0,0,0);stroke-width:1" />
       <circle cx="388" cy="245" r="59" fill="#515252" />

        <?php
            $pointIds = array();
            $row = 1;
            $id=0;
            for($cy=38; $cy<460; $cy+=60){
                if($row==1 || $row== 8){
                    $cx_start = 240;
                    $cx_max = 420;
                }elseif($row==2 || $row==7){
                    $cx_start = 180;
                    $cx_max = 480;
                }elseif($row==3 || $row==6){
                    $cx_start = 120;
                    $cx_max = 540;
                }elseif($row==4 || $row==5){
                    $cx_start = 60;
                    $cx_max = 540;
                }
                for($cx=$cx_start; $cx<=$cx_max; $cx+=60){
                    if(($row != 4 && $row != 5) || !($cx>300 && $cx<480)){
                        ?>
                            <circle id="vfcp_right_<?php echo $id ?>" cx="<?php echo $cx;?>" cy="<?php echo $cy;?>" r="29" fill="white" />
                        <?php
                    }
                    $id++;
                }
                $row++;
            }
        ?>
       Sorry, your browser does not support inline SVG.
    </svg>
