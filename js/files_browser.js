$(function(){

	var filemanager = $('.filemanager'),
		breadcrumbs = $('.breadcrumb'),
		fileList = filemanager.find('.data'),
		breadcrumbsUrls = [];
		
		
		

		function generateBreadcrumbs(nextDir){
			var path = nextDir.split('/').slice(0);
			for(var i=1;i<path.length;i++){
				path[i] = path[i-1]+ '/' +path[i];
			}
			return path;
			
			
		}
		
		function searchByPath(dir, response) {

			return response[0].items;
		}		
		
		function goto(hash, response) {
			hash = decodeURIComponent(hash).slice(1).split('=');
			if (hash.length) {
				var rendered = '';

				if (hash[0].trim().length) {
					
					rendered = searchByPath(hash[0], response);
		
					//if (rendered.length) {

						currentPath = hash[0];
						//breadcrumbsUrls = generateBreadcrumbs(hash[0]);
						render(rendered);

					//}	
				}
			}
		}
			
		function bytesToSize(bytes) {
			var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
			if (bytes == 0) return '0 Bytes';
			var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
			return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
		}

		function escapeHTML(text) {
			return text.replace(/\&/g,'&amp;').replace(/\</g,'&lt;').replace(/\>/g,'&gt;');
		}
		
		function render(data) {

			var scannedFolders = [],
				scannedFiles = [];

			if(Array.isArray(data)) {

				data.forEach(function (d) {

					if (d.type === 'folder') {
						scannedFolders.push(d);
					}
					else if (d.type === 'file') {
						scannedFiles.push(d);
					}

				});

			}
			else if(typeof data === 'object') {

				scannedFolders = data.folders;
				scannedFiles = data.files;

			}

			fileList.empty().hide();
			
			var table_headers = $('<tr><th>Name</th><th>Kind</th><th>Size</th><th>Modified</th></tr>');
					
			table_headers.appendTo(fileList);
					

			if(!scannedFolders.length && !scannedFiles.length) {
				filemanager.find('.nothingfound').show();
			}
			else {
				filemanager.find('.nothingfound').hide();
			}

			if(scannedFolders.length) {

				scannedFolders.forEach(function(f) {

					var itemsLength = f.items.length,
						name = escapeHTML(f.name),
						icon = '<span class="icon folder"></span>';

					if(itemsLength) {
						icon = '<span class="icon folder full"></span>';
					}

					if(itemsLength == 1) {
						itemsLength += ' item';
					}
					else if(itemsLength > 1) {
						itemsLength += ' items';
					}
					else {
						itemsLength = 'Empty';
					}
				
		
					var folder = $('<tr class="folders" >' + '<td containing-folder="' + f.folder_id + '" class="folders" ondrop="drop(event)" ondragover="allowDrop(event)" draggable="true" ondragstart="drag(event)"><a class="name nounderline folders glyphicon glyphicon-folder-close" containing-folder="' +f.folder_id + '" href="' + f.path + '">&emsp;' + name + '</a></td><td>Folder</td><td></td><td></td></tr>');
					
					folder.appendTo(fileList);
					
				});

			}

			if(scannedFiles.length) {

				scannedFiles.forEach(function(f) {

					var fileSize = bytesToSize(f.size),
						name = escapeHTML(f.name),
						fileType = name.split('.'),
						last_modified = f.modified;
						vfile_id = f.vfile_id;

					fileType = fileType[fileType.length-1];
					var is_image_lightbox = "";
					if (name.match(/\.(jpg|jpeg|png|gif)$/))
					{
						is_image_lightbox = 'data-toggle="lightbox"';
					}
					//is_image_lightbox = ""; //delete this line to enable lightbox
					var download_path = "get.php?file=" + vfile_id;
					
					var file = $('<tr class="files">' + '<td draggable="true" ondragstart="drag(event)" data-attr="' + vfile_id + '" class="files"><a containing-folder="' +f.folder_id + '" data-attr="' + vfile_id + '" href="' + download_path + '"' + is_image_lightbox + ' class="files nounderline name glyphicon glyphicon-file jiffysquad">&emsp;' + name +  '</a></td><td>' + fileType + '</td><td>'+fileSize+'</td><td>' + last_modified + '</td></tr>');
					
					file.appendTo(fileList);
				});

			}


			// Generate the breadcrumbs

			var url = '';

			if(filemanager.hasClass('searching')){

				url = '<span>Search results: </span>';
				fileList.removeClass('animated');

			}
			else {

				fileList.addClass('animated');

				breadcrumbsUrls.forEach(function (u, i) {

					var name = u.split('/');

					if (i !== breadcrumbsUrls.length - 1) {
						url += '<li><a href="'+u+'"><span class="folderName">' + name[name.length-1] + '</span></a></li> ';
					}
					else {
						url += '<li class="folderName active">' + name[name.length-1] + '</li>';
					}

				});

			}

			breadcrumbs.text('').append(url);


			// Show the generated elements

			fileList.animate({'display':'inline-block'});

		}

		function navigate_dir(dir){

			var unescaped = decodeURIComponent(dir.substring(1));
			$('#loading-indicator').show();
			//$('#dimmerModal').modal('show');
			
			$.get('control/scan.php', {directory:unescaped}, function(data) {
			$('#loading-indicator').hide();
			//$('#dimmerModal').modal('hide');
			var response = [data],
				currentPath = '';			

			var folders = [],
				files = [];			
			
	
			goto(dir, response);
			});
			
			$.post("control/get_full_dir_index_formatted.php", {
			 dir_id: dir.substr(1)
		 }
		 , function( data ) {
		  		
			var url = data;
			breadcrumbs.text('').append(url);

			});
		}
		
		fileList.on('click', 'td.folders', function(e){
			e.preventDefault();

			var nextDir = $(this).find('a.folders').attr('containing-folder');
			currentDir = nextDir;
			//alert(currentDir);
			var dir_title = $(this).find('a.folders').attr('href');
			//breadcrumbsUrls.push(dir_title);

			window.location.hash = encodeURIComponent(nextDir);
			currentPath = nextDir;
		});
		
		fileList.on('click', 'td.files', function(e){
			//alert("Herro");
		});
		
		
		$(window).on('hashchange', function(){
			
			if(window.location.hash == '')
			{
				window.location.hash = $("#default-dir").attr('data-attr');
			}
			new_dir = window.location.hash;
			currentDir = new_dir.substr(1);
			
			navigate_dir(new_dir);
			// We are triggering the event. This will execute 
			// this function on page load, so that we show the correct folder:

		}).trigger('hashchange');

});