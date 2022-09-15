var page_source = '';


/*

This function makes ajax request to the serverside
others - object, additional data pass
*/
function form_request(url, formData, callback, others) {
	
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function () {
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			var res = xmlHttp.responseText;
			
			// callback function
			callback(res, others);
		}
	}
	xmlHttp.open("post", url);
	xmlHttp.send(formData);
}




/*
	Function to Signup in
	
*/
function sign_in(event) {
	
	event.preventDefault(); // prevent natural form submission
	var formData = new FormData(document.getElementById('form')); //Get the form data
	
	document.getElementById("report").innerHTML = '';
	var bfr_cont = document.getElementById("process_div").innerHTML;
	document.getElementById("process_div").innerHTML = '<img src="../images/spinner.gif" style="width:1.8rem">';
	
	// Callback function from Ajax request.
	function this_callback(data, others){
		
		if (data == 'success') {
			
			// Redirect home
			window.location.href = '../recent-activities.php';
			
		}
		else {

			document.getElementById("report").innerHTML = data;
			document.getElementById("process_div").innerHTML = bfr_cont;

		}
	}
   
   // Make a request to the sign_up.php to signup user
   form_request('../connections/admin_sign_in.php', formData, this_callback, {})
}



/* Function to Delete Book */

function delete_book(bid, ch){
	
	
	if(ch == 0){
		document.getElementById('delete_modal').style.display = 'flex';
		document.getElementById('delete_modal_msg').innerHTML = '<div style="font-size:18px; color:#C00;">Please Confirm you want to delete this Book.</div>';
		document.getElementById('delete_modal_delete').style.display = 'block';
		document.getElementById('delete_modal_cancel').style.display = 'inline-block';
		document.getElementById('delete_modal_cancel').innerHTML = '<span class="fa fa-times"></span> Cancel';
		document.getElementById('delete_modal_delete').setAttribute('onclick', 'delete_book('+bid+', 1)');
		return;
	}
	
	var formData = new FormData(); 
	formData.append('id', bid);
	formData.append('ch', 'delete_book');
	
	var bfr_cont = document.getElementById("process_ediv").innerHTML;
	document.getElementById("process_ediv").innerHTML = '<img src="../images/spinner.gif" style="width:1.8rem">';
	
	// Callback function from Ajax request.
	function this_callback(data, others){
		document.getElementById("process_ediv").innerHTML = bfr_cont;
		if(data == 'success'){
		   document.getElementById('book_' + others['bid']).remove();
		   document.getElementById('delete_modal_msg').innerHTML = '<div style="font-size:18px; color:#0C0;"><span class="fa fa-check fa-2x"></span> Book deleted successfully.</div>';
		document.getElementById('delete_modal_cancel').innerHTML = '<span class="fa fa-times"></span> Close';
		document.getElementById('delete_modal_delete').style.display = 'none';
		
		
		}else{
			
			alert(data);
		}
		
	}
   // Make a request to the sign_up.php to signup user
   form_request('../connections/admin.php', formData, this_callback, {bid})	
}



/* Function to Delete User */

function delete_user(uid, ch){
	
	
	if(ch == 0){
		document.getElementById('delete_modal').style.display = 'flex';
		document.getElementById('delete_modal_msg').innerHTML = '<div style="font-size:18px; color:#C00;">Please Confirm you want to delete this User.</div>';
		document.getElementById('delete_modal_delete').style.display = 'block';
		document.getElementById('delete_modal_cancel').style.display = 'inline-block';
		document.getElementById('delete_modal_cancel').innerHTML = '<span class="fa fa-times"></span> Cancel';
		document.getElementById('delete_modal_delete').setAttribute('onclick', 'delete_user('+uid+', 1)');
		return;
	}
	
	var formData = new FormData(); 
	formData.append('id', uid);
	formData.append('ch', 'delete_user');
	
	var bfr_cont = document.getElementById("process_ediv").innerHTML;
	document.getElementById("process_ediv").innerHTML = '<img src="../images/spinner.gif" style="width:1.8rem">';
	
	// Callback function from Ajax request.
	function this_callback(data, others){
		document.getElementById("process_ediv").innerHTML = bfr_cont;
		if(data == 'success'){
		   document.getElementById('user_' + others['uid']).remove();
		   document.getElementById('delete_modal_msg').innerHTML = '<div style="font-size:18px; color:#0C0;"><span class="fa fa-check fa-2x"></span> User deleted successfully.</div>';
		document.getElementById('delete_modal_cancel').innerHTML = '<span class="fa fa-times"></span> Close';
		document.getElementById('delete_modal_delete').style.display = 'none';
		
		
		}else{
			
			alert(data);
		}
		
	}
   // Make a request to the sign_up.php to signup user
   form_request('../connections/admin.php', formData, this_callback, {uid})	
}



function update_search_selection(event){
	
	document.getElementById('subject').style.display = 'block';
	document.getElementById('subject').value = "";
	document.getElementById('search').style.display = 'block';
	document.getElementById('search_btn').style.display = 'block';
	
   	var search_ch = document.getElementById('search_ch').value;
	if(search_ch == 'all'){
			document.getElementById('subject').style.display = 'none';
			document.getElementById('search').style.display = 'none';
			document.getElementById('search_btn').style.display = 'none';
			
			if(loadstarted == "all_books"){
				search_books(event);
			}
			else{
				search_users(event);
			}
	}
	if(search_ch == 'subject'){
			document.getElementById('search').style.display = 'none';
	}
	else{
			document.getElementById('subject').style.display = 'none';
			document.getElementById('search').value = "";
			document.getElementById('search').setAttribute("placeholder", search_ch + " search");
			
	}
	
	
}

/*  Function to Search Users */
function search_books(event){
	
	var search_ch = document.getElementById('search_ch').value;
	
	if(!(search_ch == 'all' || search_ch == 'subject')){
		event.preventDefault();
		var searchn = document.getElementById('search').value;
		if(searchn.length < 2) return;
	}
	else{
	   var searchn = "";
	}
	if(search_ch == 'subject'){
		event.preventDefault();
		var subject = document.getElementById('subject').value;
		if(subject ==  '') return;
	}
	else{
	   var subject = "";
	}	
	
	var formData = new FormData(); 
	formData.append('search', searchn);
	formData.append('subject', subject);
	formData.append('search_ch', search_ch);
	
	var bfr_cont = document.getElementById("search_btn").innerHTML;
	document.getElementById("search_btn").setAttribute('disabled', true);
	document.getElementById("search_btn").innerHTML = '<img src="'+glob_site_url+'/images/spinner.gif" style="width:1.3rem; vertical-align:middle"> searching...';
	
	document.getElementById('main_search_body').innerHTML = '<div style="text-align:center; width:100%; margin-top:30px"><img src="'+glob_site_url+'/images/spinner.gif" style="width:3.8rem; vertical-align:middle"> loading...</div>';
	
	// Callback function from Ajax request.
	function this_callback(data, others){
		
		document.getElementById("search_btn").innerHTML = bfr_cont;
		document.getElementById("search_btn").removeAttribute('disabled');
		
		document.getElementById('main_search_body').innerHTML = '';
		
		// If error, then a an error was in our response
		
		try{
		   var response =  JSON.parse(data);
		   
		    if(response.length == 0){
			  document.getElementById('main_search_body').innerHTML = '<div style="text-align:center; width:100%; background-color: #EFEFEF; padding:20px; margin-top:30px"> No matching result for your search</div>';
		   }
		  else{
			  document.getElementById('main_search_body').innerHTML =  '<div style="overflow-x:auto; width:100%"><table  class="table"><thead><tr><th></th><th>Book Title</th><th>Author Name</th><th>Joint Authors</th><th>Publisher</th><th>Subject Area</th><th>Published Year</th></tr></thead><tbody id="main_search_body_table"></tbody></table></div>';
			 }
		   response.forEach(function(book){
		   
			   var elm = get_book_html(book); // Get the user html markup
			   document.getElementById('main_search_body_table').append(elm);
		
		  });
		 
		  
		  
		   
		}catch(exception){
			alert(data);
			console.log(exception);
		}
		
		
	}
   
   // Make a request to the sign_up.php to signup user
   form_request('../connections/search.php', formData, this_callback, {search_ch})
	
}



/*  Function to Search Users */
function search_users(event){
	
	var search_ch = document.getElementById('search_ch').value;
	
	if(search_ch == 'search'){
		event.preventDefault();
		var searchn = document.getElementById('search').value;
		if(searchn.length < 2) return;
	}
	else{
	   var searchn = "";
	}
	
	
	var formData = new FormData(); 
	formData.append('search', searchn);
	formData.append('ch', 'users');
	formData.append('search_ch', search_ch);
	
	var bfr_cont = document.getElementById("search_btn").innerHTML;
	document.getElementById("search_btn").setAttribute('disabled', true);
	document.getElementById("search_btn").innerHTML = '<img src="'+glob_site_url+'/images/spinner.gif" style="width:1.3rem; vertical-align:middle"> searching...';
	
	document.getElementById('main_search_body').innerHTML = '<div style="text-align:center; width:100%; margin-top:30px"><img src="'+glob_site_url+'/images/spinner.gif" style="width:3.8rem; vertical-align:middle"> loading...</div>';
	
	// Callback function from Ajax request.
	function this_callback(data, others){
		
		document.getElementById("search_btn").innerHTML = bfr_cont;
		document.getElementById("search_btn").removeAttribute('disabled');
		
		document.getElementById('main_search_body').innerHTML = '';
		
		// If error, then a an error was in our response
		
		try{
		   var response =  JSON.parse(data);
		   
		    if(response.length == 0){
			  document.getElementById('main_search_body').innerHTML = '<div style="text-align:center; width:100%; background-color: #EFEFEF; padding:20px; margin-top:30px"> No matching result for your search</div>';
		   }
		  else{
			  document.getElementById('main_search_body').innerHTML =  '<div style="overflow-x:auto; width:100%"><table  class="table"><thead><tr><th></th><th>Username</th><th>Full Name</th><th>Email</th><th>Phone</th><th>Address</th><th>City</th><th>Date Registered</th></tr></thead><tbody id="main_search_body_table"></tbody></table></div>';
			 }
		   response.forEach(function(user){
		   
			   var elm = get_user_html(user); // Get the user html markup
			   document.getElementById('main_search_body_table').append(elm);
		
		  });
		 
		}catch(exception){
			alert(data);
			console.log(exception);
		}
		
		
	}
   
   // Make a request to the sign_up.php to signup user
   form_request('../connections/search.php', formData, this_callback, {search_ch})
	
}



function  get_book_html(book){
	
	var author = book['author_name'];
	var jauthors = book['joint_authors'];
	var subject = book['subject'];
	var title = book['title'];
	var publisher = book['publisher'];
	var pub_year = book['pub_year'];
	
	var picture = '../uploads/books/'+get_cleaned_title(book['title']) + book['picture'];
	
	var added_by =  '<div class="added_by"><span>Added by:</span><a target="_blank" href="'+glob_site_url+'/profile.php?u=' + book['username'] + '">' + book['fname'] + '</a></div>';
	
	var elm = document.createElement('tr');
	elm.id = 'book_'+book['id'];
	
	elm.innerHTML = '<td>'+added_by+'<img src="'+picture+'"><br><button onclick="delete_book('+book['id']+', 0)"><span class="fa fa-trash-o"></span> Delete</button></td><td>'+title+'</td><td>'+author+'</td><td>'+jauthors+'</td><td>'+publisher+'</td><td>'+subject+'</td><td>'+pub_year+'</td>';
	
	return elm;	
		
}

function  get_user_html(user){
	
	var username = user['username'];
	var fname = user['fname'];
	var email = user['email'];
	var phone = user['phone'];
	var city = user['city'];
	var address = user['address'];
	var reg_date = user['reg_date'];
	
	var picture = '../uploads/profiles/'+ ((user['username'] == 'avatar.jpg')? 'avatar.jpg' :  user['username'] + '_'+ user['picture']);
	
	var elm = document.createElement('tr');
	elm.id = 'user_'+user['id'];
	
	elm.innerHTML = '<td><img src="'+picture+'"><br><button onclick="delete_user('+user['id']+', 0)"><span class="fa fa-trash-o"></span> Delete</button></td><td>'+username+'</td><td><a target="_blank" href="../profile.php?u='+username+'">'+fname+'</a></td><td>'+email+'</td><td>'+phone+'</td><td>'+address+'</td><td>'+city+'</td><td>'+reg_date+'</td>';
	
	return elm;	
		
}


function get_cleaned_title(str){ 
   str = str.replace(/[^A-Za-z0-9]+/gi, '_');
   str = str.replace(/_{2,}/gi, '_');
   return str;	
}


//  Show all page. try and catch 
try{
     if(loadstarted == 'all_books'){
		 search_books('');
	}
	else if(loadstarted == 'all_users'){
		 search_users('');
	}	
}
catch(exception){
	
}

/*  Set the current page menu nav  active */

var current_page = document.getElementById('navigator_hdvnk').getAttribute('data-active');
if(current_page != ''){
 
  document.getElementById(current_page+'_link').className = 'active';	
	
}