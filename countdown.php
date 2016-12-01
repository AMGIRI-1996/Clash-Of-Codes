<HEAD>

<SCRIPT LANGUAGE="JavaScript">

//change event date event here.
var eventdate = new Date("November 16, 2016 23:59:59");

function toSt(n) {
 s=""
 if(n<10) s+="0"
 return s+n.toString();
}

function countdown() {
 cl=document.clock;
 d=new Date();
 count=Math.floor((eventdate.getTime()-d.getTime())/1000);
 if(count<=0)
   {cl.days.value ="----";
    cl.hours.value="--";
    cl.mins.value="--";
    cl.secs.value="--";
    return;
  }
 cl.secs.value=toSt(count%60);
 count=Math.floor(count/60);
 cl.mins.value=toSt(count%60);
 count=Math.floor(count/60);
 cl.hours.value=toSt(count%24);
 count=Math.floor(count/24);
 cl.days.value=count;    
 
 setTimeout("countdown()",500);
}

</SCRIPT>
</HEAD>
<body onLoad="countdown()">
<div style="position:fixed; left:0; top:20">
<FORM name="clock" style="position: relative;">
<TABLE>
	<TR>
         <TD ALIGN=CENTER><INPUT name="days" size=2 style="text-align:center; font-size:1.5em; font-weight:600;color:white;border:none; background-color:transparent" readonly></TD>
         <TD ALIGN=CENTER><INPUT name="hours" size=2 style="text-align:center; font-size:1.5em; font-weight:600; color: white;border:none;background-color:transparent" readonly></TD>
         <TD ALIGN=CENTER><INPUT name="mins" size=2 style="text-align:center; font-size:1.5em; font-weight:600; color: white; border:none;background-color:transparent" readonly></TD>
         <TD ALIGN=CENTER><INPUT name="secs" size=2 style="text-align:center; font-size:1.5em; font-weight:600; color: white;border:none;background-color:transparent" readonly></TD>
    </TR>
    <TR style="color: white">
         <TD ALIGN=CENTER WIDTH="31%"  ><FONT><B>Days</B></FONT></TD>
         <TD ALIGN=CENTER WIDTH="23%"  ><FONT><B>Hours</B></FONT></TD>
         <TD ALIGN=CENTER WIDTH="23%"  ><FONT><B>Mins</B></FONT></TD>
         <TD ALIGN=CENTER WIDTH="23%"  ><FONT><B>Secs</B></FONT></TD>
    </TR>
    </TR>
</TABLE>
</FORM>
</div>