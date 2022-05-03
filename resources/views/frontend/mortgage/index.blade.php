<!--
TERMS OF USE
BY USING THE CODE, YOU AGREE:
1. THAT THE MATERIALS ARE PROVIDED "AS IS" AND WITHOUT WARRANTIES OF ANY KIND
2. NOT TO CHANGE ANY OF THE JAVASCRIPT CODE, INCLUDING THE LICENSE TEXT
3. NOT TO REMOVE THE LINE OF TEXT "powered by calculator.net"
4. THAT THE COPYRIGHT BELONGS TO calculator.net
5. NOT TO REMOVE THE TERMS OF USE
-->
<!--BEGIN OF MORTGAGE CALCULATOR CODE-->
<script>
/*****************************************
(C) https://www.calculator.net all right reserved.
*****************************************/
function gObj(t){
	return document.all?"string"==typeof t?document.all(t):t.style:document.getElementById?"string"==typeof t?document.getElementById(t):t.style:null}function trimAll(t){for(;" "==t.substring(0,1);)t=t.substring(1,t.length);for(;" "==t.substring(t.length-1,t.length);)t=t.substring(0,t.length-1);return t}function isNumber(t){return!((t+="").length<1)&&!isNaN(t)}function formatAsMoney(t){t=t.toString().replace(/\$|\,/g,""),isNaN(t)&&(t="0"),sign=t==(t=Math.abs(t)),t=Math.floor(100*t+.50000000001),cents=t%100,t=Math.floor(t/100).toString(),cents<10&&(cents="0"+cents);for(var e=0;e<Math.floor((t.length-(1+e))/3);e++)t=t.substring(0,t.length-(4*e+3))+","+t.substring(t.length-(4*e+3));return(sign?"":"-")+"$"+t+"."+cents}function formatNum(t){if(outStr=""+t,t=parseFloat(outStr),10<outStr.length&&(outStr=""+t.toPrecision(10)),-1<outStr.indexOf(".")){for(;"0"==outStr.charAt(outStr.length-1);)outStr=outStr.substr(0,outStr.length-1);return"."==outStr.charAt(outStr.length-1)&&(outStr=outStr.substr(0,outStr.length-1)),outStr}return outStr}function showquickmsg(t,e){e&&(t="<font color=red>"+t+"</font>"),gObj("coutput").innerHTML=t}var dataArray=new Array,theLoanTerm=0,delayShow=!0;function calc(){showquickmsg("calculating...",!0),gObj("resulttable").innerHTML="",setTimeout("process()",2)}function process(){if(Bv=gObj("cloanamount").value,fv=gObj("cloanterm").value,vs=gObj("cinterestrate").value,Xd=gObj("cpropertytaxes").value,KA=gObj("cpmi").value,Ti=gObj("cothercost").value,isNumber(Bv))if(isNumber(fv))if(fv<1||50<fv)showquickmsg("loan term need to be a number between 0 and 50",!0);else if(isNumber(vs))if(vs<-200||200<vs)showquickmsg("interest rate needs to be between -200 and 200",!0);else if(isNumber(Xd))if(isNumber(KA))if(isNumber(Ti)){for(Ph=vs/100/12,0==Ph?ud=Bv/fv/12:ud=Ph/(1-Math.pow(1+Ph,12*-fv))*Bv,NB=parseInt(12*fv),fG=12*fv-NB,HG=new Array,i=1;i<=12*fv;i++)HG[i-1]=new Array,QK=Math.pow(1+Ph,i),0==Ph?Kp=Bv-i*ud:Kp=QK*Bv-(QK-1)/Ph*ud,1==i?HG[i-1][0]=Bv:HG[i-1][0]=HG[i-2][1],HG[i-1][1]=Kp,HG[i-1][2]=ud,HG[i-1][3]=ud-(HG[i-1][0]-HG[i-1][1]),1==i?HG[i-1][4]=HG[i-1][3]:HG[i-1][4]=HG[i-1][3]+HG[i-2][4];"undefined"==typeof cc&&(1e-4<fG?(HG[NB]=new Array,HG[NB][0]=HG[NB-1][1],HG[NB][1]=0,HG[NB][2]=fG*ud,HG[NB][3]=HG[NB][2]-(HG[NB][0]-HG[NB][1]),HG[NB][4]=HG[NB-1][4]+HG[NB][3]):NB--,dataArray=HG,theLoanTerm=fv,Xd=parseFloat(Xd),KA=parseFloat(KA),Ti=parseFloat(Ti),Mb=Xd+KA+Ti,MV="<table cellpadding='3' width='100%'>",MV+="<tr><td><b>Monthly Pay</b></td><td align=right>"+formatAsMoney(ud)+"</td></tr>",0<Mb&&(0<Xd&&(MV+="<tr><td>Monthly Property Tax</td><td align=right>"+formatAsMoney(Xd/12)+"</td></tr>"),0<KA&&(MV+="<tr><td>Monthly PMI (Private Mortgage Insurance)</td><td align=right>"+formatAsMoney(KA/12)+"</td></tr>"),0<Ti&&(MV+="<tr><td>Monthly Other Costs</td><td align=right>"+formatAsMoney(Ti/12)+"</td></tr>"),MV+="<tr><td><b>Monthly Total Out of Pocket</b></td><td align=right>"+formatAsMoney(ud+Mb/12)+"</td></tr>"),MV+="<tr><td>Total of "+(12*fv).toFixed(2)+" Monthly Payments</td><td align=right>"+formatAsMoney(12*ud*fv)+"</td></tr>",MV+="<tr><td>Total Interest Paid</td><td align=right>"+formatAsMoney(12*ud*fv-Bv)+"</td></tr>",MV+="</table>",showquickmsg(MV,!1))}else showquickmsg("other insurance and costs need to be numeric",!0);else showquickmsg("Private mortgage insurance need to be numeric",!0);else showquickmsg("Property taxes need to be numeric",!0);else showquickmsg("Interest rate need to be numeric",!0);else showquickmsg("loan term need to be numeric",!0);else showquickmsg("Loan amount need to be numeric",!0)}
</script>
<!--YOU CAN CHANGE THE FOLLOWING CODE-->
<div class="" id="mortgagecalc">
	<form class="bg-main-ash p-3">
		<div class="form-group">
			<label class="text-main-dark">Loan Amount</label>
			<div class="input-group">
				<input class="form-control" required type="number" name="cloanamount" id="cloanamount" value="0">
				<div class="input-group-prepend">
				    <span class="input-group-text">$</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Loan Term (Years)</label>
			<input class="form-control" required type="number" name="cloanterm" id="cloanterm" value="10">
		</div>
		<div class="form-group">
			<label>Rate (%)</label>
			<div class="input-group">
				<input class="form-control" required type="number" name="cinterestrate" id="cinterestrate" value="0">
				<div class="input-group-prepend">
				    <span class="input-group-text">$</span>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="text-main-dark">Property Tax (Per year)</label>
			<input class="form-control" required type="number" name="cpropertytaxes" id="cpropertytaxes" value="0">
		</div>
		<div class="form-group">
			<label class="text-main-dark">PMI Insurance (Per year)</label>
			<input class="form-control" required type="text" name="cpmi" id="cpmi" value="0">
		</div>
		<div class="form-group">
			<label class="text-main-dark">Other Cost (Per year)</label>
			<input class="form-control" required type="text" name="" id="cothercost" value="0">
		</div>
		<button type="button" class="btn btn-lg bg-main-dark btn-block text-white" value="" onclick="calc()">Calculate</button>
	</form>
	<div class="p-3 bg-main-dark text-white border-bottom-dark-500" id="coutput"></div>
	<div id="resulttable"></div>
	<div class="bg-main-dark text-white p-3" id="calfootnote">Powered by <a href="https://www.calculator.net" rel="nofollow">calculator.net</a></div>
	<script>calc();</script>
</div>
<!--END OF MORTGAGE CALCULATOR CODE-->