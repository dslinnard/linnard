// http://mickweb.com/javascript/tutorials/breadcrumbs/explanation.html

function spawn(expr,qty)
{
   var spawnee=[expr];

   for(s=1;s<qty;s++)
   {
	  spawnee[s]=expr+spawnee[s-1];
   }
   return spawnee.reverse();
}

function sentenceCase(dirs)
{
	for(i=1;i<dirs.length-1;i++)
	{
		dirs[i] = dirs[i].replace(/_/g, " "); // replace underscores with spaces
		dirs[i] = dirs[i].replace("jetset", "Jet set"); 
		dirs[i] = dirs[i].replace("radioset", "Radio set"); 
		//dirs[i] = dirs[i].replace("su", "Radio set"); 
		dirs[i] = dirs[i].substr(0, 1).toUpperCase() +dirs[i].substr(1);
		//alert(dirs[i]);
	}
}


function mw_crumbs(divider,default_page,root)
{
 //  if(!divider) {divider=" &#187; "}
	if(!divider) {divider=" <span style='font-size:smaller;'>&gt;</span> "}
	if(!default_page){default_page="./index.php"}
   
	var path=location.toString();
   var h="";
   
	url=path.split("?");
	path=url[0];
	
	// remove any http://, wwww. stuff
	//path=path.replace("http://", "");
	//path=path.replace("www.", "");
	path = path.substring(path.indexOf("/")+2); 
	//alert(path);
	 
	dirs = path.split("/");
	//document.write(dirs);
	sentenceCase(dirs);
	var howmany=spawn("../",dirs.length);
	howmany[dirs.length]=default_page;
	//document.write(howmany);
	//document.write("<br>"+dirs);

	for(i=0; i<dirs.length-1; i++)
	  {
		//document.write("<br>"+dirs[i] + "&nbsp;&nbsp&nbsp"+howmany[i+2]+"<br>");
		// ignore used by footnoteLinks.js
		 
		h+=("<a class='ignore' href='"+howmany[i+2]+"'>"+unescape( dirs[i]+"</a>"+divider));
	  
	  //alert(h);
   }
	
   h += "<span style='color:#666666;'>" + document.title + "</span>";
	
	//alert(h);
   if(root)
   {
	  h=h.replace(eval("/"+location.host+"/"),root);
   }
	
	return "<div id='breadcrumbs'><span class='offScreen'>You are here: </span>"+h+"</div>";
	//return "<map title='breadcrumbs' id='breadcrumbs'>"+h+"</map>";
}

// JavaScript Document