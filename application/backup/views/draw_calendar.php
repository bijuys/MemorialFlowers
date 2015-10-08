<?php

function draw_calendar($month,$year,$method=0){
    
    $ci =& get_instance();
    
    $ddays = array();
    $delay = 0;
    $stoppage = '23:59:59';
    
    if($method>0)
    {
	$dmethod = $ci->db->get_where('delivery_methods',array('delivery_method_id'=>$method));
	
	foreach($dmethod->result() as $row)
	{
	    $ddays = explode(',',$row->delivery_days);
	    $delay = $row->delivery_within;
	    $stoppage = $row->stoppage_time;
	}
    }
    
    list($stophour,$stopminute,$stopsecond) = explode(':',$stoppage);
    
    $stoppage = mktime($stophour,$stopminute,$stopsecond,date('m',time()),date('d',time()),date('Y',time()));
    
    $holidays = array();
    
    $hdays = $ci->db->query("SELECT * FROM occasions WHERE occasion_type!='occasion'");
    
    foreach($hdays->result() as $row)
    {
	$holidays[] = date('d-m-Y',mktime(0,0,0,$row->occasion_month,$row->occasion_day,$year));
    }
    
    

  /* draw table */
  $calendar = '<table cellpadding="0" cellspacing="0" class="calendar" border="1">';

  /* table headings */
  $headings = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
  $calendar.= '<tr class="calendar-row"><th class="calendar-day-head">'.implode('</th><th class="calendar-day-head">',$headings).'</th></tr>';

  /* days and weeks vars now ... */
  
  if(mktime(0,0,0,$month,1,$year)>=mktime(0,0,0,date('m',time()),date('d',time()),date('Y',time())))
  {
    $startday = '1';
  }
  else
  {
    $startday = date('d',time());
  }  
  
  $running_day = date('w',mktime(0,0,0,$month,$startday,$year));
  $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
  $days_in_this_week = 1;
  $day_counter = 0;
  $dates_array = array();

  /* row for week one */
  $calendar.= '<tr class="calendar-row">';

  /* print "blank" days until the first of the current week */
  for($x = 0; $x < $running_day; $x++):
    $calendar.= '<td class="calendar-day-np"><div class="disabled">&nbsp;</div></td>';
    $days_in_this_week++;
  endfor;
  
  $dcount = 0;

  /* keep going with days.... */
  for($list_day = $startday; $list_day <= $days_in_month; $list_day++):
  
    $datediff =  mktime(0,0,0,$month,$list_day,$year) - mktime(0,0,0,date('m',time()),date('d',time()),date('Y',time()));
    $dcount = $datediff/(60*60*24);
  
    $now = mktime(0,0,0,$month,$list_day,$year);
    
    $calendar.= '<td class="calendar-day">';
    $nday = mktime(date('H',time()),date('i',time()),date('s',time()),$month,$list_day,$year);
    

    if(!in_array(date('w',$now)+1,$ddays) || in_array(date('d-m-Y',$now),$holidays))
    {
	$calendar.= '<div class="disabled"><div class="day-number">'.$list_day.'</div><p></p></div>';
    }
    else
    {
	
	if($delay<$dcount)
	{
	    $calendar.= '<a href="#" class="daypick" id="'.date('d-m-Y',mktime(0,0,0,$month,$list_day,$year)).'" name="'.date('l d F',mktime(0,0,0,$month,$list_day,$year)).'" >';
	    /* add in the day number */
	    $calendar.= '<div class="day-number">'.$list_day.'</div>';
      
	    /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
	    $calendar.= '<p>std. shipping</p>';
	    $calendar.= '</a>';	    
	}
	else
	{
	    if($delay==$dcount)
	    {
		if($dcount=='0' && $stoppage < time())
		{
		    $calendar.= '<div class="disabled"><div class="day-number">'.$list_day.'</div><p>'.$delay.'|'.$dcount.'</p></div>';	
		}
		else
		{
		    $calendar.= '<a href="#" class="daypick" id="'.date('d-m-Y',mktime(0,0,0,$month,$list_day,$year)).'" name="'.date('l d F',mktime(0,0,0,$month,$list_day,$year)).'" >';
		    /* add in the day number */
		    $calendar.= '<div class="day-number">'.$list_day.'</div>';
	      
		    /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
		    $calendar.= '<p>std. shipping</p>';
		    $calendar.= '</a>';			    
	
		}
	    }
	    else
	    {
		if($method==2 && $stoppage > time())
		{
		    $calendar.= '<a href="#" class="daypick special" id="'.date('d-m-Y',mktime(0,0,0,$month,$list_day,$year)).'" name="'.date('l d F',mktime(0,0,0,$month,$list_day,$year)).'" >';
		    /* add in the day number */
		    $calendar.= '<div class="day-number">'.$list_day.'</div>';
	      
		    /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
		    $calendar.= '<p>std. shipping +$10</p>';
		    $calendar.= '</a>';			    
		}
		else
		{
		    $calendar.= '<div class="disabled"><div class="day-number">'.$list_day.'</div><p></p></div>';
		}
			 
	    }
	}
	

    }
    
    $calendar.= '</td>';

    if($running_day == 6):
      $calendar.= '</tr>';
      if(($day_counter+1) != $days_in_month):
        $calendar.= '<tr class="calendar-row">';
      endif;
      $running_day = -1;
      $days_in_this_week = 0;
    endif;
    $days_in_this_week++; $running_day++; $day_counter++;
    
    $dcount++;
    
  endfor;

  /* finish the rest of the days in the week */
  if($days_in_this_week < 8):
    for($x = 1; $x <= (8 - $days_in_this_week); $x++):
      $calendar.= '<td class="calendar-day-np"><div class="disabled">&nbsp;</div></td>';
    endfor;
  endif;

  /* final row */
  $calendar.= '</tr>';

  /* end the table */
  $calendar.= '</table>';
  
  /* all done, return result */
  return $calendar;
}


/* ###################################################################################################### */




  

  

