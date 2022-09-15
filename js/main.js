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
	Function to Signup a new account
	
*/
function sign_up(event) {
	
	event.preventDefault(); // prevent natural form submission
	var formData = new FormData(document.getElementById('form')); //Get the form data
	
	var password = document.getElementById('password').value;
	var password2 = document.getElementById('password2').value;
	
	// Check if password match or less than 6
	if(password.length < 6){
		alert('Password less than six characters');
		return;
	}
	// Check if password match or less than 6
	if(password != password2){
		alert('Password not match.');
		return;
	}
	document.getElementById("report").innerHTML = '';
	var bfr_cont = document.getElementById("process_div").innerHTML;
	document.getElementById("process_div").innerHTML = '<img src="./images/spinner.gif" style="width:1.8rem">';
	
	// Callback function from Ajax request.
	function this_callback(data, others){
		
		if (data == 'success') {
			//document.getElementById("form").innerHTML = '<div style="padding:10px; text-align:center; background-color:#E6F5E0; font-size:24px; padding:100px 10px;"><span class="fa fa-check-circle-o"></span><br><br> You have successfully Register <br><br> <a href="login.php"><small>Login</small></a>.</div>';
			//document.getElementById("form").scrollIntoView();
			document.getElementById("form").reset();
			window.location.href = 'profile.php';
		}
		else {

			document.getElementById("report").innerHTML = data;
			document.getElementById("process_div").innerHTML = bfr_cont;

		}
	}
   
   // Make a request to the sign_up.php to signup user
   form_request('connections/sign_up.php', formData, this_callback, {})
	
}



/*
	Function to Signup in
	
*/
function sign_in(event) {
	
	event.preventDefault(); // prevent natural form submission
	var formData = new FormData(document.getElementById('form')); //Get the form data
	
	document.getElementById("report").innerHTML = '';
	var bfr_cont = document.getElementById("process_div").innerHTML;
	document.getElementById("process_div").innerHTML = '<img src="./images/spinner.gif" style="width:1.8rem">';
	
	// Callback function from Ajax request.
	function this_callback(data, others){
		
		if (data == 'success') {
			
			// Redirect home
			window.location.href = './';
			
		}
		else {

			document.getElementById("report").innerHTML = data;
			document.getElementById("process_div").innerHTML = bfr_cont;

		}
	}
   
   // Make a request to the sign_up.php to signup user
   form_request('connections/sign_in.php', formData, this_callback, {})
}


function profile_mode(ch){
	
	if(ch == 0){
		document.getElementById("fname").removeAttribute('readonly');
		document.getElementById("email").removeAttribute('readonly');
		document.getElementById("phone").removeAttribute('readonly');
		document.getElementById("city").removeAttribute('readonly');
		document.getElementById("address").removeAttribute('readonly');
		document.getElementById("process_div").style.display = "block";
		document.getElementById("pedite_c").style.display = "block";
		document.getElementById("pedite_o").style.display = "none";
		document.getElementById("report").innerHTML = "";
	}
	else{
		
		document.getElementById("fname").readOnly = true;
		document.getElementById("email").readOnly = true;
		document.getElementById("phone").readOnly = true;
		document.getElementById("city").readOnly = true;
		document.getElementById("address").readOnly = true;
		document.getElementById("process_div").style.display = "none";
		document.getElementById("pedite_c").style.display = "none";
		document.getElementById("pedite_o").style.display = "block";
		
		
		}
	
}


/*
	Update User settings, password and Profile
	
*/
function update_settings(ch, event) {
	
	event.preventDefault(); // prevent natural form submission
	var formData = new FormData(document.getElementById('form')); //Get the form data
	formData.append('ch', ch)
	document.getElementById("report").innerHTML = '';
	var bfr_cont = document.getElementById("process_div").innerHTML;
	document.getElementById("process_div").innerHTML = '<img src="./images/spinner.gif" style="width:1.8rem">';
	
	// Callback function from Ajax request.
	function this_callback(data, others){
		
		if (data == 'success') {
			document.getElementById("report").innerHTML = '<div style="padding:10px; text-align:center; color:#0C0;  font-size:18px; margin-top:20px;"><span class="fa fa-check-circle-o"></span> Updated successfully</div>';
		   document.getElementById("process_div").innerHTML = bfr_cont;
		   if(others.ch == 'update_profile'){
		  		profile_mode(1);
				
				var needu = document.getElementById("profile_need_update");
				var needu_a = document.getElementById("profile_need_update_a");
				var needu_b = document.getElementById("profile_need_update_b");
				if(needu_a != null)
					needu_a.remove();
				if(needu_b == null && needu_a != null)
					needu.remove();
				
		   }
				
		 
		}
		else {

			document.getElementById("report").innerHTML = data;
			document.getElementById("process_div").innerHTML = bfr_cont;

		}
	}
   
   // Make a request to the sign_up.php to signup user
   form_request('./connections/main.php', formData, this_callback, {ch})
	
}


function update_photo(ch){
	
	var formData = new FormData(document.getElementById('form2')); //Get the form data
	formData.append('ch', ch);
	
	var bfr_cont = document.getElementById("upload_btn").innerHTML;
	document.getElementById("upload_btn").setAttribute('disabled', true);
	document.getElementById("upload_btn").innerHTML = '<img src="'+glob_site_url+'/images/spinner.gif" style="width:1.3rem; vertical-align:middle"> uploading...';
	
	// Callback function from Ajax request.
	function this_callback(data, others){
		
		document.getElementById("upload_btn").innerHTML = bfr_cont;
		document.getElementById("upload_btn").removeAttribute('disabled');
			
		if (data.substr(0,7) == 'success') {
			
			// Update the user Avatar  photo
			document.getElementById('photo_avatar').src = data.substr(7);
			
			var needu = document.getElementById("profile_need_update");
			var needu_a = document.getElementById("profile_need_update_a");
			var needu_b = document.getElementById("profile_need_update_b");
			if(needu_b != null)
				needu_b.remove();
			if(needu_a == null && needu_b != null)
				needu.remove();
	
		}
		else {

			alert(data);
	
		}
	}
   
   // Make a request to the sign_up.php to signup user
   form_request('./connections/main.php', formData, this_callback, {})
	
}


/*
	Function to Signup a new account
	
*/
function add_book(event) {
	
	event.preventDefault(); // prevent natural form submission
	var formData = new FormData(document.getElementById('form')); //Get the form data
	formData.append('ch', 'add_book')
	
	document.getElementById("report").innerHTML = '';
	var bfr_cont = document.getElementById("process_div").innerHTML;
	document.getElementById("process_div").innerHTML = '<img src="./images/spinner.gif" style="width:1.8rem">';
	
	// Callback function from Ajax request.
	function this_callback(data, others){
		document.getElementById("process_div").innerHTML = bfr_cont;
		if (data == 'success') {
			document.getElementById("report").innerHTML = '<div style="padding:10px; text-align:center; color:#090; background-color:#E6F5E0; font-size:24px; padding:5px 10px;"><span class="fa fa-check-circle-o fa-2x"></span><br><br> Book added  successfully</div>';
			document.getElementById("form").reset();
		}
		else {
		document.getElementById("report").innerHTML = data;
		}
	}
   
   // Make a request to the sign_up.php to signup user
   form_request('connections/main.php', formData, this_callback, {})
	
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
	document.getElementById("process_ediv").innerHTML = '<img src="./images/spinner.gif" style="width:1.8rem">';
	
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
   form_request('./connections/main.php', formData, this_callback, {bid})	
}




/* Function to Delete Account */

function delete_account(id, ch){
	
	
	if(ch == 0){
		document.getElementById('delete_modal').style.display = 'flex';
		document.getElementById('delete_modal_msg').innerHTML = '<div style="font-size:18px; color:#C00;">You are about deleting your account. This will also delete books you have added too.<br><br>Please Confirm you want to delete this account.</div>';
		document.getElementById('delete_modal_delete').style.display = 'block';
		document.getElementById('delete_modal_cancel').style.display = 'inline-block';
		document.getElementById('delete_modal_cancel').innerHTML = '<span class="fa fa-times"></span> Cancel';
		document.getElementById('delete_modal_delete').setAttribute('onclick', 'delete_account('+id+', 1)');
		return;
	}
	
	var formData = new FormData(); 
	formData.append('id', id);
	formData.append('ch', 'delete_account');
	
	var bfr_cont = document.getElementById("process_ediv").innerHTML;
	document.getElementById("process_ediv").innerHTML = '<img src="./images/spinner.gif" style="width:1.8rem">';
	
	// Callback function from Ajax request.
	function this_callback(data, others){
		document.getElementById("process_ediv").innerHTML = bfr_cont;
		if(data == 'success'){
		   document.getElementById('delete_modal').remove();
		   document.querySelector('.profile_side').remove();
		   document.querySelector('.profile_cmain').innerHTML =  '<div style="font-size:24px; color:#0C0; padding:50px 20px;  padding-bottom:150px"><span class="fa fa-check fa-2x"></span><br> Account Deleted Successfully</div>';
		
		}else{
			alert(data);
		}
		
	}
   // Make a request to the sign_up.php to signup user
   form_request('./connections/main.php', formData, this_callback, {id})	
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
			
			search_books(event);
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
		   
		   if(others.search_ch == 'openlibrary'){
			   
			   
			  response['docs'].forEach(function(rawbook){
			   	   var book = normalize_structure(rawbook);
				   if(book != null){
					   var elm = get_book_html(book); // Get the user html markup
					   document.getElementById('main_search_body').append(elm);
				   }
			
			  });
			   
			  if(response['docs'].length == 0){
				  document.getElementById('main_search_body').innerHTML = '<div style="text-align:center; width:100%; background-color: #EFEFEF; padding:20px; margin-top:30px"> No matching result for your search</div>';
				  
			  }
			   
		   }
		   else{
			   
			   response.forEach(function(book){
			   
				   var elm = get_book_html(book); // Get the user html markup
				   document.getElementById('main_search_body').append(elm);
			
			  });
			  
			  if(response.length == 0){
				  
				  document.getElementById('main_search_body').innerHTML = '<div style="text-align:center; width:100%; background-color: #EFEFEF; padding:20px; margin-top:30px"> No matching result for your search</div>';
				  
			  }
		   }
		  
		   
		}catch(exception){
			alert(data);
			console.log(exception);
		}
		
		
	}
	
  // Make a request to the sign_up.php to signup user
   form_request('connections/search.php', formData, this_callback, {search_ch})

	
}


function  get_book_html(book){
	
	var author = book['author_name'];
	var jauthors = book['joint_authors'];
	var subject = book['subject'];
	var title = book['title'];
	var publisher = book['publisher'];
	var pub_year = book['pub_year'];
	
	if('cover_i' in book){
		var picture = book['cover_i'];
		var added_by = "";
	}
	else{
		var picture = glob_site_url +'/uploads/books/'+ get_cleaned_title(book['title']) + book['picture'];
		var added_by =  '<div class="added_by"><span>Added by:</span><a href="'+glob_site_url+'/profile.php?u=' + book['username'] + '">' + book['fname'] + '</a></div>';
	}
	var elm = document.createElement('div');
	elm.id = 'book_'+book['id'];
	elm.className = 'book';
	
	elm.innerHTML = '<div class="main_content"><div class="cover" style="background-image:url('+picture+');"></div><div class="title">'+title+'</div><div class="author"><span>Author:</span> '+author+'</div></div><div class="side_content">'+added_by+'<table><tr><th>Author:</th><td>'+author+' </td></tr><tr><th>Joint Authors:</th><td>'+jauthors+'</td></tr><tr><th>Subject Area:</th><td>'+subject+'</td></tr><tr><th>Publisher:</th><td>'+publisher+'</td></tr><tr><th>Year of Publication:</th><td>'+pub_year+'</td></tr></table></div>';
	
	return elm;	
		
}

function get_cleaned_title(str){ 
   str = str.replace(/[^A-Za-z0-9]+/gi, '_');
   str = str.replace(/_{2,}/gi, '_');
   return str;	
}


// This function is used to restructure the openlibrary array to our own format
function normalize_structure(rawbook){
	
	var book = null;
	if('title' in rawbook){
		book = {};	
		book['title'] = rawbook['title'];
		
		if('first_publish_year' in rawbook)
			book['pub_year'] = rawbook['first_publish_year'];
		else
			book['pub_year'] = 'N/A';
			
		if('publisher' in rawbook){
			var publisher = rawbook['publisher'].join(', ');
			if(publisher.length > 100)
				publisher = publisher.substr(0, 100)+ '...';
			book['publisher'] = publisher;
		}
		else
			book['publisher'] = 'N/A';
			
		if('author_name' in rawbook){
			var author_name = rawbook['author_name'].join(', ');
			if(author_name.length > 50)
				author_name = author_name.substr(0, 50)+ '...';
			book['author_name'] = author_name;
			
			if(rawbook['author_name'].length > 2){
			   var jauthors =  rawbook['author_name'];
			   jauthors.shift();
			   jauthors = jauthors.join(', ');
				if(jauthors.length > 100)
					jauthors = jauthors.substr(0, 50)+ '...';
				book['joint_authors'] = jauthors;
			   
				
			}
			else
				book['joint_authors'] = '';
		}
		else{
			book['author_name'] = 'N/A';
			book['joint_authors'] = '';
		}
		
		if('subject' in rawbook){
			var subject = rawbook['subject'].join(', ');
			if(subject.length > 100)
				subject = subject.substr(0, 100) + '...';
			book['subject'] = subject;
		}
		else
			book['subject'] = 'N/A';
			
			
		if('isbn' in rawbook){
			
			book['cover_i'] = "http://covers.openlibrary.org/b/isbn/"+rawbook['isbn'][0]+"-M.jpg";
		}
		else
			book['cover_id'] = "http://covers.openlibrary.org/b/oclc/98766-M.jpg";
			
			
		
	}
	
	return book;
	
	
}

//  Show all page. try and catch 
try{
     if(loadstarted == 'all_books'){
		 search_books('');
	}	
}
catch(exception){
	
}




/*  Set the current page menu nav  active */

var current_page = document.getElementById('navigator_hdvnk').getAttribute('data-active');
if(current_page != ''){
 
  document.getElementById(current_page+'_link').className = 'active';	
	
}