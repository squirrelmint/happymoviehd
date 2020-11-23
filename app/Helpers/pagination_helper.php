<?php
    function get_pagination($sql,$page,$perpage,$total){

        $db = \Config\Database::connect();
        $start = ((int)$page - 1) * (int)$perpage;

        $sql .= " LIMIT ?, ?";
        $query = $db->query($sql,[$start,$perpage]);
        $result = $query->getResultArray();
        $total_page = ceil((int)$total/(int)$perpage);

        $data = [
            'list' => $result,
            'start_row' => $start+1,
            'total_record' => $total,
            'page' => $page,
            'total_page' => $total_page,
            'perpage' => $perpage
        ];

        return $data;

    }

    function pagination($page, $total_page){

        $html = "";
        $link = explode('?',$_SERVER['REQUEST_URI']);
        $link = $link[0];
        $pre = $page; $pagepre = $page; $predisable = '';
        $pagenext = $page+1; $nextdisable = '';
        $totals = $total_page;

        if($page <= 1 ){
            $page = 1;
            $pre = 1;
            $pagepre = 1;
            $pagenext = $page+1;

            //$predisable = 'disabled';
            if($total_page>5){
                $total_page = 5;
            }
            

        }else if( $page >= $total_page ){

            $pagepre = $total_page - 4;
            $page = $pagenext = $total_page;
            //$nextdisable = 'disabled';

            if($total_page<=5){
                $pagepre = 1;
                $pre = $page-1; 
            }

        }else if(($page%5)==0){

            $pre = $page-1;
            $pagepre = $page;
            $pagenext = $page+1;

            if($total_page>=($pagepre+4) && $total_page <= ($pagepre+4) ){
                $total_page = $pagepre + 4;
            }

        }else{

            $pre = $page-1;
            $pagepre = $page;
            $pagenext = $page+1;

            if( $total_page >= '5' && $total_page >= ($page+4) ){
                $total_page = $page+4;
            }else if( $total_page < 5 ){
                $pagepre = 1;
            }

        }



        

        $html .= '<ul class="pagination dropshd">';



            $html .= '<li class="'.$predisable.'"><a href="'.$link.'?page=1" >หน้าแรก</a></li>';

            if(empty($predisable)){

                $html .= '<li><a href="'.$link.'?page='.$pre.'" >&lsaquo;</a></li>';

            }else{

                $html .= '<li class="'.$predisable.'"><a href="#" >&lsaquo;</a></li>';

            }



            for($i=$pagepre; $i<=$total_page; $i++){

                $active='';

                if($page==$i){

                    $active='class="active"';

                }

                $html .= '<li '.$active.'><a href="'.$link.'?page='.$i.'">'.$i.'</a></li>';



                // $check = $page+5;

                // if($total_page>=10 && $i == $check){

                //     $html .= '<li class="disabled"><span class="legitRipple">...</span></li>';

                //     $i = $total_page - 3; 

                // }



            }



            if(empty($nextdisable)){

                $html .= '<li><a href="'.$link.'?page='.$pagenext.'" >&rsaquo;</a></li>';

            }else{

                $html .= '<li class="'.$nextdisable.'"><a href="#" >&rsaquo;</a></li>';

            }



            $html .= '<li class="'.$nextdisable.'"><a href="'.$link.'?page='.$totals.'" >หน้าสุดท้าย</a></li>';

        $html .= '</ul>';

        

        return $html;

    }



?>