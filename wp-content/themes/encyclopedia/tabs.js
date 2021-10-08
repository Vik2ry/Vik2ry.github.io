function scriptolTabs()
{
 var element = location;
 var tabs=document.getElementById('tabs').getElementsByTagName("a");
 for (var i=0; i < tabs.length; i++)
 {
  if(tabs[i].href == element.href) 
   tabs[i].className="selected";
  else
   tabs[i].className="";
 }
}