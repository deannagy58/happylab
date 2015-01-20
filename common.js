

/* start support func for layout  */

var words=new Array("filler","text","silly","very","fill","make","short","long","column","test");


/*
function AddFillerLink(){

if(!document.getElementById || !document.createElement) return;

var i,l;

for(i=0;i<arguments.length;i++){

    l=document.createElement("a");

    l.href="#";

    l.appendChild(document.createTextNode("Add Text to this section"));

    l.onclick=function(){AddText(this);return(false)};

    document.getElementById(arguments[i]).appendChild(l);

    }

}

*/

function AddText(el){

var s="",n,i;

n=RandomNumber(20,80);

for(i=0;i<n;i++)

    s+=words[RandomNumber(0,words.length-1)]+" ";

var t=document.createElement("p");

t.appendChild(document.createTextNode(s));

el.parentNode.insertBefore(t,el);

}



function RandomNumber(n1,n2){

return(Math.floor(Math.random()*(n2-n1))+n1);

}



/* end  support func for layout  */



function mClick(rowCol)
{
	var splited = rowCol.split("_",2)
	var tmp = document.getElementById('t'+splited[0]); 
	tmp.className='trSelected';
	tmp = document.getElementById(splited[0]+'_'+splited[1]);
	tmp.checked=true;

}

function mOver(row)
{
	
//	alert("mouse over:" + row);
//	var splited = rowCol.split("_",2)
	var tmp = document.getElementById(row);
	if ("trSelected" != tmp.className){ 
		tmp.className='trOver';
	}
//	tmp = document.getElementById(splited[0]+'_'+splited[1]);
//	tmp.checked=true;

}

function mOut(row, prev_class)
{
	
//	alert("mouse over:" + row);
//	var splited = rowCol.split("_",2)
	var tmp = document.getElementById(row); 
	if ("trSelected" != tmp.className){ 
		tmp.className=prev_class;
	}
//	tmp = document.getElementById(splited[0]+'_'+splited[1]);
//	tmp.checked=true;

}



function toggleDiv(id) {  
	var state = document.getElementById(id).style.display;  
	if (state == 'block') {  
		document.getElementById(id).style.display = 'none';  
	} else {  
		document.getElementById(id).style.display = 'block';  
	}  
} // end of toggleDiv()


function contactInfo() {
	newwindow=window.open('contact.html','name','height=400,width=750');
	if (window.focus) {newwindow.focus()}
	return false;
}
