$(document).ready(function(){
    
    $.getJSON("../data/quotes.json",function(data){
         // $.each(data, function(key, val){
         //     items = val;
         // });
         items = data.quotes;
         var dayNum = getNumberofDays();
         displayQuote(dayNum); 
    })
    
     $('.previous-quote-btn').click(function(){
         if(dayNum !=0)    
            dayNum-=1;
         else
            dayNum = 237;
          
         displayQuote(dayNum);
 
     })

     $('.next-quote-btn').click(function(){
     
         dayNum+=1;
         displayQuote(dayNum);
     })
    

     function getNumberofDays(){
         //Creates a new date object that store's todays date
         var today = new Date();
         //New date object for first day of this year
         var first = new Date(today.getFullYear(), 0, 0);
         var difference = today - first;
         //Difference needs to be divided by 86,400,000 as that's how many milliseconds there are in a day.
         dayNum = Math.floor(difference / (1000 * 60 * 60 * 24));
         return dayNum;
     }
     
     function displayQuote(dayNum){
         var currentIndex= dayNum % items.length;
         var quoteOb = items[currentIndex];
         //Replaces the HTML inside the blockquote with actual quote.
         $("p:nth-child(1)").html(quoteOb.quote);
         $('p:nth-child(2)').html("-" + quoteOb.author);  
     }
 });