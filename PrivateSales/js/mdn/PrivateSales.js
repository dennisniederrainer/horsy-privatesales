//*************************************************************************
//init counter for time limit
function initPrivateSalesTimeLimit(endTime, spanName)
{
    var t = endTime.split(' ');
    var ps_date = t[0];
    var ps_hour = t[1];
    var t_date = ps_date.split('-');
    var t_hour = ps_hour.split(':');
	
    //init vars
    var year = t_date[0] - 2000;
    var month = t_date[1];
    var day = t_date[2];
    var hour = t_hour[0];
    var minute = t_hour[1];
    var second = t_hour[2];
    var format = 2;
	
    countdown(year, month, day, hour, minute, format, spanName);
}

//*************************************************************************
//countdown function
function countdown(year, month, day, hour, minute, format, divId)
{
    Today = new Date();
    Todays_Year = Today.getFullYear() - 2000;
    Todays_Month = Today.getMonth();
         
    //Convert both today's date and the target date into miliseconds.
    Todays_Date = (new Date(Todays_Year, Todays_Month, Today.getDate(),
        Today.getHours(), Today.getMinutes(), Today.getSeconds())).getTime();
    Todays_Date += timeZoneOffsetInSeconds * 1000;
    Target_Date = (new Date(year, month - 1, day, hour, minute, 00)).getTime();
         
    //Find their difference, and convert that into seconds.
    Time_Left = Math.round((Target_Date - Todays_Date) / 1000);
         
    var savTime_Left = Time_Left;
    if(Time_Left < 0)
    {
        Time_Left = 0;
    }
         
    switch(format)
    {
        case 0:
            //The simplest way to display the time left.
            document.getElementById(divId).innerHTML = Time_Left + ' seconds';
            break;
        case 1:
        case 2:
            //More datailed.
            days = Math.floor(Time_Left / (60 * 60 * 24));
            Time_Left %= (60 * 60 * 24);
            hours = Math.floor(Time_Left / (60 * 60));
            Time_Left %= (60 * 60);
            minutes = Math.floor(Time_Left / 60);
            Time_Left %= 60;
            seconds = Time_Left;
                    
            dps = 's';
            hps = 's';
            mps = 's';
            sps = 's';
            //ps is short for plural suffix.
            if(days == 1) dps ='';
            if(hours == 1) hps ='';
            if(minutes == 1) mps ='';
            if(seconds == 1) sps ='';

            document.getElementById(divId).innerHTML = days + labelDay + ' ' + ' ';
            document.getElementById(divId).innerHTML += hours + labelHour + ' ' ;
            document.getElementById(divId).innerHTML += minutes + labelMinute + ' ' ;
            document.getElementById(divId).innerHTML += seconds + labelSecond + ' ';
                    
            break;
        default:
            document.getElementById(divId).innerHTML = Time_Left + ' seconds';
    }
               
    //Recursive call, keeps the clock ticking.
    if (savTime_Left == 0)
    {
        eval(zeroCounterCallback);
    }

    setTimeout('countdown(' + year + ',' + month + ',' + day + ',' + hour + ',' + minute + ',' + format + ',\'' + divId +'\');', 1000);
}

//******************************************************************************************************************************************************************
//
function displayCartDiv()
{
    document.getElementById('div_addtocart').style.display = '';
}

//******************************************************************************************************************************************************************
//
function hideCartDiv()
{
    document.getElementById('div_addtocart').style.display = 'none';
}

//******************************************************************************************************************************************************************
//
// TIMER
new Event.observe(window, "load", function (event) {
    timer = new PeriodicalExecuter(slider, 5);
});

// CHANGEMENT IMAGE
function slider() {

    var tabLi = $("flash_sales_pictures").childElements();

    if(tabLi.length > 1){

        $$("li.active_flash").each(function(elt) {

            elt.hide();
            elt.removeClassName('active_flash');

            for(var i=0; i < tabLi.length; i++){

                if (elt == tabLi[i]){

                    if (i + 1 < tabLi.length ){
                        tabLi[i+1].addClassName('active_flash');
                    }
                    else{
                        tabLi[0].addClassName('active_flash');
                    }

                }
            }

            $$(".active_flash").each(function(elt2) {
                new Effect.toggle(elt2, 'appear');
            });

        });
    }

}