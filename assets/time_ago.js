        function time_ago(predate){
            
            var out='';
            var msecPerMinute = 1000 * 60;  
            var msecPerHour = msecPerMinute * 60;  
            var msecPerDay = msecPerHour * 24;  
            var date_n = new Date();  
            var date = new Date(predate);  
            var dateMsec = date_n.getTime();    
            var mnth=date.getMonth();
            var dat=date.getDate();
            var hr=date.getHours();
            var mi=date.getMinutes();
            var sc=date.getSeconds();
            var misc=date.getMilliseconds();    
            date_n.setMonth(mnth);  
            date_n.setDate(dat);  
            date_n.setHours(hr, mi, sc, misc);    
            var interval =  dateMsec - date_n.getTime();    
            var days = Math.floor(interval / msecPerDay );  
            interval = interval - (days * msecPerDay );   
            var hours = Math.floor(interval / msecPerHour) ;  
            interval = interval - (hours * msecPerHour );  
            var minutes = Math.floor(interval / msecPerMinute );  
            interval = interval - (minutes * msecPerMinute );  
            var seconds = Math.floor(interval / 1000 );  
            if(days!=0)
                out+=days + "d:";
            if(hours!=0)
                out+=hours+ "h:";
            if(minutes!=0)
                out+=minutes+ "m:";
            if(seconds!=0)
                out+=seconds+ "s.";
            
            return(out);            
        }
// function generateRandomString(id) {
//   var text = "";
//   var text_n = "";
//   var possible = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

//   for (var i = 0; i < 10; i++)
//     text += possible.charAt(Math.floor(Math.random() * possible.length));
// for (var i = 0; i < 10; i++)
//     text_n += possible.charAt(Math.floor(Math.random() * possible.length));
// var out = text+id+text_n;
//  return(out);
// }