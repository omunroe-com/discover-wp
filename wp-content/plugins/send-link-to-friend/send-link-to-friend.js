/**
 *     Send link to friend
 *     Copyright (C) 2011 - 2013 www.gopiplus.com
 *     http://www.gopiplus.com/work/2010/07/18/send-link-to-friend/
 * 
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 * 
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 * 
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

var http_request = false;
function makePOSTRequest(url, parameters) {
  http_request = false;
  if (window.XMLHttpRequest) { // Mozilla, Safari,...
	 http_request = new XMLHttpRequest();
	 if (http_request.overrideMimeType) {
		// set type accordingly to anticipated content type
		//http_request.overrideMimeType('text/xml');
		http_request.overrideMimeType('text/html');
	 }
  } else if (window.ActiveXObject) { // IE
	 try {
		http_request = new ActiveXObject("Msxml2.XMLHTTP");
	 } catch (e) {
		try {
		   http_request = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {}
	 }
  }
  if (!http_request) {
	 alert('Cannot create XMLHTTP instance');
	 return false;
  }
  //alert(parameters);
  http_request.onreadystatechange = alertContents;
  http_request.open('POST', url, true);
  http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http_request.setRequestHeader("Content-length", parameters.length);
  http_request.setRequestHeader("Connection", "close");
  http_request.send(parameters);
}

String.prototype.trim = function () 
{
    return this.replace(/^\s*/, "").replace(/\s*$/, "");
}


function alertContents() 
{
	//alert(http_request.responseText);
  if (http_request.readyState == 4) 
  {
	 if (http_request.status == 200) 
	 {
		result = http_request.responseText;
		result = result.trim();
		if(result == "Invalid security code.")
		{
			alert(http_request.responseText);
			result = http_request.responseText;
			document.getElementById('send-link-to-friend-result').innerHTML = result;   
		}
		else
		{
			alert(http_request.responseText);
			result = http_request.responseText;
			document.getElementById('send-link-to-friend-result').innerHTML = result;   
			document.getElementById("txt_friendemail").value = "";
			document.getElementById("txt_friendmessage").value = "";	
			document.getElementById("txt_captcha").value = "";
		}
	 } 
	 else 
	 {
		alert('There was a problem with the request.');
	 }
  }
}

function get(obj,url) 
{
	_e=document.getElementById("txt_friendemail");
	_c=document.getElementById("txt_captcha");
	
	var get_friends_email=_e.value;
	var friends_email_array=get_friends_email.split(",");
	var part_num=0;
	
	if(_e.value=="")
	{
		alert("Please enter the email address.");
		_e.focus();
		return false;    
	}
	if(_e.value!="" && (_e.value.indexOf("@",0)==-1 || _e.value.indexOf(".",0)==-1))
	{
		alert("Please enter valid email.");
		_e.focus();
		_e.select();
		return false;
	} 
	while (part_num < friends_email_array.length)
	{
	   if(part_num > 0)
	   {
			alert("Maximum 1 email address only.");
			return false;
	   }
	   part_num+=1;
	}
	if(_c.value=="")
	{
		alert("Please enter the security code.");
		_c.focus();
		return false;    
	}
	
	document.getElementById('send-link-to-friend-result').innerHTML = "Sending...";   
	var poststr = "txt_friendemail=" + document.getElementById("txt_friendemail").value +
					"&txt_friendmessage=" + encodeURI( document.getElementById("txt_friendmessage").value ) +
					"&txt_captcha=" + encodeURI( document.getElementById("txt_captcha").value ) +
					 "&sendlink=" + encodeURI( document.getElementById("sendlink").value );
		
	makePOSTRequest(url+'send-mail.php', poststr);
}
