<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"  lang="es-MX">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Menús </title>
		<script type="text/javascript"></script>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link href="{{asset('menu/style.css')}}" rel="stylesheet">

		<script type="text/javascript">
			var menus = {
				"oneThemeLocationNoMenus" : "",
				"moveUp" : "Move up",
				"moveDown" : "Mover down",
				"moveToTop" : "Move top",
				"moveUnder" : "Move under of %s",
				"moveOutFrom" : "Out from under  %s",
				"under" : "Under %s",
				"outFrom" : "Out from %s",
				"menuFocus" : "%1$s. Element menu %2$d of %3$d.",
				"subMenuFocus" : "%1$s. Menu of subelement %2$d of %3$s."
			};
		</script>

	</head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<body class="wp-admin wp-core-ui js   menu-max-depth-0 nav-menus-php auto-fold admin-bar ">

		<div id="wpwrap">
			<div id="wpcontent">
				<div id="wpbody">
					<div id="wpbody-content">

						<div class="wrap">
							<h2 class="nav-tab-wrapper"><a href="{{route('menuw')}}" class="nav-tab nav-tab-active">Edit Menu</a><!---<a href="{{route('menuw')}}?action=locations" class="nav-tab">Gestionar lugares</a>--></h2>
							<div class="manage-menus">
								<form method="get" action="{{route('menuw')}}">
									<label for="menu" class="selected-menu">Select the menu you want to edit:</label>

									{{ Form::select('menu', $menulist,0) }}

									<span class="submit-btn">
										<input type="submit" class="button-secondary" value="Choose">
									</span>
									<span class="add-new-menu-action"> or <a href="{{route('menuw')}}?action=edit&menu=0">Create new menu</a>. </span>
								</form>
							</div>
							<div id="nav-menus-frame">

								@if(Input::has('menu'))
								<div id="menu-settings-column" class="metabox-holder">

									<div class="clear"></div>

									<form id="nav-menu-meta" action="" class="nav-menu-meta" method="post" enctype="multipart/form-data">
										<div id="side-sortables" class="accordion-container">
											<ul class="outer-border">
												<li class="control-section accordion-section  open add-page" id="add-page">
													<h3 class="accordion-section-title hndle" tabindex="0"> Custom Link <span class="screen-reader-text">Press return or enter to expand</span></h3>
													<div class="accordion-section-content ">
														<div class="inside">
															<div class="customlinkdiv" id="customlinkdiv">
																<p id="menu-item-url-wrap">
																	<label class="howto" for="custom-menu-item-url"> <span>URL</span>
																		<input id="custom-menu-item-url" name="url" type="text" class="code menu-item-textbox" value="http://">
																	</label>
																</p>

																<p id="menu-item-name-wrap">
																	<label class="howto" for="custom-menu-item-name"> <span>Label</span>
																		<input id="custom-menu-item-name" name="label" type="text" class="regular-text menu-item-textbox input-with-default-title" title="Label menu">
																	</label>
																</p>

																<p class="button-controls">

																	<a  href="#" onclick="addcustommenu()"  class="button-secondary submit-add-to-menu right"  >Add menu item</a>
																	<span class="spinner" id="spincustomu"></span>
																</p>

															</div>
														</div>
													</div>
												</li>

											</ul>
										</div>
									</form>

								</div>
								@endif
								<div id="menu-management-liquid">
									<div id="menu-management">
										<form id="update-nav-menu" action="" method="post" enctype="multipart/form-data">
											<div class="menu-edit ">
												<div id="nav-menu-header">
													<div class="major-publishing-actions">
														<label class="menu-name-label howto open-label" for="menu-name"> <span>Name</span>
															<input name="menu-name" id="menu-name" type="text" class="menu-name regular-text menu-item-textbox" title="Enter menu name" value="@if(isset($indmenu)){{$indmenu->name}}@endif">
															<input type="hidden" id="idmenu" value="@if(isset($indmenu)){{$indmenu->id}}@endif" />
														</label>

														@if(Input::has('action'))
														<div class="publishing-action">
															<a onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Create menu</a>
														</div>
														@elseif(Input::has("menu"))
														<div class="publishing-action">
															<a onclick="getmenus()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Save menu</a>
														</div>

														@else
														<div class="publishing-action">
															<a onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Create menu</a>
														</div>
														@endif
													</div>
												</div>
												<div id="post-body">
													<div id="post-body-content">

														@if(Input::has("menu"))
														<h3>Menu Structure</h3>
														<div class="drag-instructions post-body-plain" style="">
															<p>
																Place each item in the order you prefer. Click on the arrow to the right of the item to display more configuration options.
															</p>
														</div>

														@else
														<h3>Menu Creation</h3>
														<div class="drag-instructions post-body-plain" style="">
															<p>
																Please enter the name and select "Create menu" button
															</p>
														</div>
														@endif

														<ul class="menu ui-sortable" id="menu-to-edit">
															@if(isset($menus))
															@foreach($menus as $m)
															<li id="menu-item-{{$m->id}}" class="menu-item menu-item-depth-{{$m->depth}} menu-item-page menu-item-edit-inactive pending" style="display: list-item;">
																<dl class="menu-item-bar">
																	<dt class="menu-item-handle">
																		<span class="item-title"> <span class="menu-item-title"> <span id="menutitletemp_{{$m->id}}">{{$m->label}}</span> <span style="color: transparent;">|{{$m->id}}|</span> </span> <span class="is-submenu" style="@if($m->depth==0)display: none;@endif">Subelement</span> </span>
																		<span class="item-controls"> <span class="item-type">Link</span> <span class="item-order hide-if-js"> <a href="{{route('menuw')}}?action=move-up-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44" class="item-move-up"><abbr title="Move Up">↑</abbr></a> | <a href="{{route('menuw')}}?action=move-down-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44" class="item-move-down"><abbr title="Move Down">↓</abbr></a> </span> <a class="item-edit" id="edit-{{$m->id}}" title=" " href="{{route('menuw')}}?edit-menu-item={{$m->id}}#menu-item-settings-{{$m->id}}"> </a> </span>
																	</dt>
																</dl>

																<div class="menu-item-settings" id="menu-item-settings-{{$m->id}}">
																	<p class="description description-thin">
																		<label for="edit-menu-item-title-{{$m->id}}"> Label
																			<br>
																			<input type="text" id="idlabelmenu_{{$m->id}}" class="widefat edit-menu-item-title" name="idlabelmenu_{{$m->id}}" value="{{$m->label}}">
																		</label>
																	</p>

																	<p class="field-css-classes description description-thin">
																		<label for="edit-menu-item-classes-{{$m->id}}"> Class CSS (optional)
																			<br>
																			<input type="text" id="clases_menu_{{$m->id}}" class="widefat code edit-menu-item-classes" name="clases_menu_{{$m->id}}" value="{{$m->class}}">
																		</label>
																	</p>

																	<p class="field-css-classes description description-wide">
																		<label for="edit-menu-item-classes-{{$m->id}}"> Url
																			<br>
																			<input type="text" id="url_menu_{{$m->id}}" class="widefat code edit-menu-item-classes" id="url_menu_{{$m->id}}" value="{{$m->link}}">
																		</label>
																	</p>

																	<p class="field-move hide-if-no-js description description-wide">
																		<label> <span>Move</span> <a href="{{route('menuw')}}?action=edit&menu=26#" class="menus-move-up" style="display: none;">Move up</a> <a href="{{route('menuw')}}?action=edit&menu=26#" class="menus-move-down" title="Mover uno abajo" style="display: inline;">Move Down</a> <a href="{{route('menuw')}}?action=edit&menu=26#" class="menus-move-left" style="display: none;"></a> <a href="{{route('menuw')}}?action=edit&menu=26#" class="menus-move-right" style="display: none;"></a> <a href="{{route('menuw')}}?action=edit&menu=26#" class="menus-move-top" style="display: none;">Top</a> </label>
																	</p>

																	<div class="menu-item-actions description-wide submitbox">

																		<a class="item-delete submitdelete deletion" id="delete-{{$m->id}}" href="{{route('menuw')}}?action=delete-menu-item&menu-item={{$m->id}}&_wpnonce=2844002501">Delete</a>
																		<span class="meta-sep hide-if-no-js"> | </span>
																		<a class="item-cancel submitcancel hide-if-no-js button-secondary" id="cancel-{{$m->id}}" href="{{route('menuw')}}?edit-menu-item={{$m->id}}&cancel=1424297719#menu-item-settings-{{$m->id}}">Cancel</a>
																		<span class="meta-sep hide-if-no-js"> | </span>
																		<a onclick="updateitem({{$m->id}})" class="button button-primary updatemenu" id="update-{{$m->id}}" href="javascript:void(0)">Update item</a>

																	</div>

																</div>
																<ul class="menu-item-transport"></ul>
															</li>
															@endforeach
															@endif
														</ul>
														<div class="menu-settings">

														</div>
													</div>
												</div>
												<div id="nav-menu-footer">
													<div class="major-publishing-actions">

														@if(Input::has('action'))
														<div class="publishing-action">
															<a onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Create menu</a>
														</div>
														@elseif(Input::has("menu"))
														<span class="delete-action"> <a class="submitdelete deletion menu-delete" onclick="deletemenu()" href="javascript:void(9)">Delete menu</a> </span>
														<div class="publishing-action">
															<a onclick="getmenus()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Save menu</a>
														</div>

														@else
														<div class="publishing-action">
															<a onclick="createnewmenu()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Create menu</a>
														</div>
														@endif
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

						<div class="clear"></div>
					</div>

					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<script type="text/javascript" src="{{asset('menu/scripts.js')}}"></script>

			<script type="text/javascript" src="{{asset('menu/scripts2.js')}}"></script>
			<script>
				var arraydata = [];
				function getmenus() {
					$("#spinsavemenu").show()

					var cont = 0;
					$("#menu-to-edit li").each(function(index) {
						var dept = 0;
						for (var i = 0; i < $("#menu-to-edit li").length; i++) {

							var n = $(this).attr("class").indexOf("menu-item-depth-" + i);
							if (n != -1) {
								dept = i;
							}
						};

						var textoiner = $(this).find(".item-edit").context.outerText;

						var textoexplotado = textoiner.split("|");
						var padre = 0;
						if (textoexplotado.length == 7) {
							padre = textoexplotado[5]
						}

						var id = this.id.split("-");

						arraydata.push({
							depth : dept,
							id : id[2],
							parent : padre,
							sort : cont
						})
						cont++;
					});
					actualizarmenu();
				}

				function addcustommenu() {
					$("#spincustomu").show();

					$.ajax({
						data : {
							labelmenu : $("#custom-menu-item-name").val(),
							linkmenu : $("#custom-menu-item-url").val(),
							idmenu : $("#idmenu").val()
						},

						url : "{{route('addcustommenu')}}",
						type : 'POST',
						success : function(response) {
							$("#spincustomu").hide();
							window.location = "";

						}
					});
				}

				function updateitem(id) {

					var label = $("#idlabelmenu_" + id).val()
					var clases = $("#clases_menu_" + id).val()
					var url = $("#url_menu_" + id).val()
					$.ajax({
						data : {
							label : label,
							clases : clases,
							url : url,
							id : id
						},

						url : "{{route('updateitem')}}",
						type : 'POST',
						success : function(response) {

							$("#menutitletemp_" + id).val(label)

							console.log("aqu llega")
							//$("#spinsavemenu").hide();
						}
					});
				}

				function actualizarmenu() {

					$.ajax({
						dataType : "json",
						data : {
							arraydata : arraydata,
							menuname : $("#menu-name").val(),
							idmenu : $("#idmenu").val()
						},

						url : "{{route('generatemenucontrol')}}",
						type : 'POST',
						success : function(response) {

							console.log("aqu llega")
							$("#spinsavemenu").hide();
						}
					});
				}

				function deleteitem(id) {
					$.ajax({
						dataType : "json",
						data : {

							id : id
						},

						url : "{{route('deleteitemmenu')}}",
						type : 'POST',
						success : function(response) {

						}
					});
				}

				function deletemenu() {

					var r = confirm("Do you want to delete this menu ?");
					if (r == true) {
						$.ajax({
							dataType : "json",

							data : {

								id : $("#idmenu").val()
							},

							url : "{{route('deletemenug')}}",
							type : 'POST',
							success : function(response) {

								if (!!response.error) {
									alert(response.resp)
								}

							}
						});

					} else {
						return false;
					}

				}

				function createnewmenu() {

					if (!!$("#menu-name").val()) {
						$.ajax({
							dataType : "json",

							data : {
								menuname : $("#menu-name").val(),
							},

							url : "{{route('createnewmenu')}}",
							type : 'POST',
							success : function(response) {

								window.location = "{{route('menuw')}}?menu=" + response.resp

							}
						});
					} else {
						alert("Enter menu name!")
						$("#menu-name").focus();
						return false;
					}

				}
			</script>
			<div class="clear"></div>
		</div>

	</body>

</html>