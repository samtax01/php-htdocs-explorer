<html>
	<head>
		<meta charset="utf-8">
		<title>DotSnippet &raquo; Xamtax</title>
		<link rel="icon" href="icon-128.png">

		<style>
			/* Critically acclaimed CSS */
			.saved-items-pane {
				position: fixed;
				right: 0;
				top: 0;
				bottom: 0;
				width: 450px;
				transform: translateX(100%);
			}
			.modal {
				visibility: hidden;
			}
		</style>

		<link rel="stylesheet" href="vendor.css">

		<link rel="stylesheet" id="editorThemeLinkTag" href="lib/codemirror/theme/monokai.css"></link>

		<link rel="stylesheet" href="style.css">

		<style id="fontStyleTemplate" type="template">
			@font-face {
				font-family: 'fontname';
				font-style: normal;
				font-weight: 400;
				src: url(fontname.ttf) format('truetype');
				unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
			}
			.Codemirror pre {
				font-family: 'fontname', monospace;
			}
		</style>
		<style type="text/css" id="fontStyleTag">
			@font-face {
				font-family: 'FiraCode';
				font-style: normal;
				font-weight: 400;
				src: url(FiraCode.ttf) format('truetype');
				unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
			}
			.Codemirror pre {
				font-family: 'FiraCode', monospace;
			}
		</style>
	</head>

	<body>
		<div class="main-container">
			<div class="main-header">
				<input type="text" id="js-title-input" title="Click to edit" class="item-title-input" value="Untitled Work">
				<div class="main-header__btn-wrap  flex  flex-v-center">
					<a id="runBtn" class="hide flex flex-v-center hint--rounded hint--bottom-left" aria-label="Run preview (Ctrl/⌘ + Shift + 5)" d-click="setPreviewContent">
						<svg style="width: 14px; height: 14px;">
						  <use xlink:href="#play-icon"></use>
						</svg>Run
					</a>

					<a d-open-modal="addLibraryModal" data-event-category="ui" data-event-action="addLibraryButtonClick" class="flex-v-center hint--rounded hint--bottom-left" aria-label="Add a JS/CSS library">
						Add library <span id="js-external-lib-count" style="display:none;" class="count-label"></span>
					</a>

					<a class="flex  flex-v-center hint--rounded hint--bottom-left" aria-label="Start a new creation" d-click="onNewBtnClick">
						<svg style="vertical-align:middle;width:14px;height:14px" viewBox="0 0 24 24">
    						<path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" />
						</svg>New
					</a>
					<a id="saveBtn" class="flex  flex-v-center hint--rounded hint--bottom-left" aria-label="Save current creation (Ctrl/⌘ + S)" d-click="onSaveBtnClick">
						<svg style="vertical-align:middle;width:14px;height:14px" viewBox="0 0 24 24">
    						<path d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
						</svg>
						<svg class="btn-loader" width="15" height="15" stroke="#fff">
							<use xlink:href="#loader-icon"></use>
						</svg>
						Save
					</a>
					<a id="openItemsBtn" class="flex  flex-v-center hint--rounded hint--bottom-left" aria-label="Open a saved creation (Ctrl/⌘ + O)" d-click="onOpenBtnClick">
						<svg style="width:14px;height:14px;vertical-align:middle;" viewBox="0 0 24 24">
						    <path d="M13,9V3.5L18.5,9M6,2C4.89,2 4,2.89 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2H6Z" />
						</svg>
						<svg class="btn-loader" width="15" height="15" stroke="#fff">
							<use xlink:href="#loader-icon"></use>
						</svg>
						Open
					</a>
					<a d-open-modal="loginModal" data-event-category="ui" data-event-action="loginButtonClick" class="show-when-app hide-on-login flex  flex-v-center  hint--rounded  hint--bottom-left" aria-label="Login/Signup">
						Login/Signup
					</a>
					<a d-open-modal="profileModal" data-event-category="ui" data-event-action="headerAvatarClick" aria-label="See profile or Logout" class="hide-on-logout hint--rounded  hint--bottom-left">
						<img id="headerAvatarImg" width="20" src="" class="main-header__avatar-img"/>
					</a>
				</div>
			</div>
			<div class="content-wrap  flex  flex-grow">
				<div class="code-side" id="js-code-side">
					<div data-code-wrap-id="0" id="js-html-code" data-type="html" class="code-wrap">
						<div class="js-code-wrap__header  code-wrap__header" title="Double click to toggle code pane">
							<label class="btn-group" dropdow title="Click to change">
								<span id="js-html-mode-label" class="code-wrap__header-label">HTML</span><span class="caret"></span>
								<select data-type="html" class="js-mode-select  hidden-select" name="">
									<option value="html">HTML</option>
									<option value="markdown">Markdown</option>
									<option value="jade">Pug</option>
								</select>
							</label>
							<div class="code-wrap__header-right-options">
								<a class="js-code-collapse-btn  code-wrap__header-btn  code-wrap__collapse-btn" title="Toggle code pane">
								</a>
							</div>
						</div>
					</div>
					<div data-code-wrap-id="1" id="js-css-code" data-type="css" class="code-wrap">
						<div class="js-code-wrap__header  code-wrap__header" title="Double click to toggle code pane">
							<label class="btn-group" title="Click to change">
								<span id="js-css-mode-label" class="code-wrap__header-label">CSS</span><span class="caret"></span>
								<select data-type="css" class="js-mode-select  hidden-select" name="">
									<option value="css">CSS</option>
									<option value="scss">SCSS</option>
									<option value="sass">SASS</option>
									<option value="less">LESS</option>
									<option value="stylus">Stylus</option>
									<option value="acss">Atomic CSS</option>
								</select>
							</label>
							<div class="code-wrap__header-right-options">
								<a href="#" id="cssSettingsBtn" title="Atomic CSS configuration" d-click="openCssSettingsModal" class="code-wrap__header-btn hide">
									<svg>
										<use xlink:href="#settings-icon"></use>
									</svg>
								</a>
								<a class="js-code-collapse-btn  code-wrap__header-btn  code-wrap__collapse-btn" title="Toggle code pane">
								</a>
							</div>
						</div>
					</div>
					<div data-code-wrap-id="2" id="js-js-code" data-type="js" class="code-wrap">
						<div class="js-code-wrap__header  code-wrap__header" title="Double click to toggle code pane">
							<label class="btn-group" title="Click to change">
								<span id="js-js-mode-label" class="code-wrap__header-label">JS</span><span class="caret"></span>
								<select data-type="js" class="js-mode-select  hidden-select">
									<option value="js">JS</option>
									<option value="coffee">CoffeeScript</option>
									<option value="es6">ES6 (Babel)</option>
									<option value="typescript">TypeScript</option>
								</select>
							</label>
							<div class="code-wrap__header-right-options">
								<a class="js-code-collapse-btn  code-wrap__header-btn  code-wrap__collapse-btn" title="Toggle code pane">
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="demo-side" id="js-demo-side">
					<iframe src="about://blank" frameborder="0" id="demo-frame" allowfullscreen></iframe>
					<div id="consoleEl" class="console is-minimized">
						<div id="consoleLogEl" class="console__log" class="code">
							<div class="js-console__header  code-wrap__header" title="Double click to toggle console">
								<span class="code-wrap__header-label">Console (<span id="logCountEl">0</span>)</span>
								<div class="code-wrap__header-right-options">
									<a class="code-wrap__header-btn" title="Clear console (CTRL + L)" d-click="onClearConsoleBtnClick">
										<svg>
						  					<use xlink:href="#cancel-icon"></use>
										</svg>
									</a>
									<a class="code-wrap__header-btn  code-wrap__collapse-btn" title="Toggle console" d-click="toggleConsole">
									</a>
								</div>
							</div>
						</div>
						<div id="consolePromptEl" class="console__prompt flex flex-v-center">
							<svg width="18" height="18" fill="#346fd2">
		  						<use xlink:href="#chevron-icon"></use>
		  					</svg>
							<input d-keyup="evalConsoleExpr" class="console-exec-input">
						</div>
					</div>
				</div>
			</div>
			<div class="global-console-container" id="globalConsoleContainerEl"></div>
			<div id="footer" class="footer">
				<div class="footer__right  fr">
					<a id="saveHtmlBtn" class="mode-btn  hint--rounded  hint--top-left" data-hint="Save as HTML file">
						<svg viewBox="0 0 24 24">
							<path d="M5,20H19V18H5M19,9H15V3H9V9H5L12,16L19,9Z" />
						</svg>
					</a>
					<svg style="display: none;" xmlns="http://www.w3.org/2000/svg">
						<symbol id="codepen-logo" viewBox="0 0 120 120"><path class="outer-ring" d="M60.048 0C26.884 0 0 26.9 0 60.048s26.884 60 60 60.047c33.163 0 60.047-26.883 60.047-60.047 S93.211 0 60 0z M60.048 110.233c-27.673 0-50.186-22.514-50.186-50.186S32.375 9.9 60 9.9 c27.672 0 50.2 22.5 50.2 50.186S87.72 110.2 60 110.233z"/><path class="inner-box" d="M97.147 48.319c-0.007-0.047-0.019-0.092-0.026-0.139c-0.016-0.09-0.032-0.18-0.056-0.268 c-0.014-0.053-0.033-0.104-0.05-0.154c-0.025-0.078-0.051-0.156-0.082-0.232c-0.021-0.053-0.047-0.105-0.071-0.156 c-0.033-0.072-0.068-0.143-0.108-0.211c-0.029-0.051-0.061-0.1-0.091-0.148c-0.043-0.066-0.087-0.131-0.135-0.193 c-0.035-0.047-0.072-0.094-0.109-0.139c-0.051-0.059-0.104-0.117-0.159-0.172c-0.042-0.043-0.083-0.086-0.127-0.125 c-0.059-0.053-0.119-0.104-0.181-0.152c-0.048-0.037-0.095-0.074-0.145-0.109c-0.019-0.012-0.035-0.027-0.053-0.039L61.817 23.5 c-1.072-0.715-2.468-0.715-3.54 0L24.34 46.081c-0.018 0.012-0.034 0.027-0.053 0.039c-0.05 0.035-0.097 0.072-0.144 0.1 c-0.062 0.049-0.123 0.1-0.181 0.152c-0.045 0.039-0.086 0.082-0.128 0.125c-0.056 0.055-0.108 0.113-0.158 0.2 c-0.038 0.045-0.075 0.092-0.11 0.139c-0.047 0.062-0.092 0.127-0.134 0.193c-0.032 0.049-0.062 0.098-0.092 0.1 c-0.039 0.068-0.074 0.139-0.108 0.211c-0.024 0.051-0.05 0.104-0.071 0.156c-0.031 0.076-0.057 0.154-0.082 0.2 c-0.017 0.051-0.035 0.102-0.05 0.154c-0.023 0.088-0.039 0.178-0.056 0.268c-0.008 0.047-0.02 0.092-0.025 0.1 c-0.019 0.137-0.029 0.275-0.029 0.416V71.36c0 0.1 0 0.3 0 0.418c0.006 0 0 0.1 0 0.1 c0.017 0.1 0 0.2 0.1 0.268c0.015 0.1 0 0.1 0.1 0.154c0.025 0.1 0.1 0.2 0.1 0.2 c0.021 0.1 0 0.1 0.1 0.154c0.034 0.1 0.1 0.1 0.1 0.213c0.029 0 0.1 0.1 0.1 0.1 c0.042 0.1 0.1 0.1 0.1 0.193c0.035 0 0.1 0.1 0.1 0.139c0.05 0.1 0.1 0.1 0.2 0.2 c0.042 0 0.1 0.1 0.1 0.125c0.058 0.1 0.1 0.1 0.2 0.152c0.047 0 0.1 0.1 0.1 0.1 c0.019 0 0 0 0.1 0.039L58.277 96.64c0.536 0.4 1.2 0.5 1.8 0.537c0.616 0 1.233-0.18 1.77-0.537 l33.938-22.625c0.018-0.012 0.034-0.027 0.053-0.039c0.05-0.035 0.097-0.072 0.145-0.109c0.062-0.049 0.122-0.1 0.181-0.152 c0.044-0.039 0.085-0.082 0.127-0.125c0.056-0.055 0.108-0.113 0.159-0.172c0.037-0.045 0.074-0.09 0.109-0.139 c0.048-0.062 0.092-0.127 0.135-0.193c0.03-0.049 0.062-0.098 0.091-0.146c0.04-0.07 0.075-0.141 0.108-0.213 c0.024-0.051 0.05-0.102 0.071-0.154c0.031-0.078 0.057-0.156 0.082-0.234c0.017-0.051 0.036-0.102 0.05-0.154 c0.023-0.088 0.04-0.178 0.056-0.268c0.008-0.045 0.02-0.092 0.026-0.137c0.018-0.139 0.028-0.277 0.028-0.418V48.735 C97.176 48.6 97.2 48.5 97.1 48.319z M63.238 32.073l25.001 16.666L77.072 56.21l-13.834-9.254V32.073z M56.856 32.1 v14.883L43.023 56.21l-11.168-7.471L56.856 32.073z M29.301 54.708l7.983 5.34l-7.983 5.34V54.708z M56.856 88.022L31.855 71.4 l11.168-7.469l13.833 9.252V88.022z M60.048 67.597l-11.286-7.549l11.286-7.549l11.285 7.549L60.048 67.597z M63.238 88.022V73.14 l13.834-9.252l11.167 7.469L63.238 88.022z M90.794 65.388l-7.982-5.34l7.982-5.34V65.388z"/></symbol>
					</svg>

					<a href="" id="codepenBtn" class="mode-btn  hint--rounded  hint--top-left" aria-label="Edit on CodePen">
						<svg>
						  <use xlink:href="#codepen-logo"></use>
						</svg>
					</a>

					<a href="" id="screenshotBtn" class="mode-btn  hint--rounded  hint--top-left show-when-extension" d-click="takeScreenshot" aria-label="Take screenshot of preview">
						<svg style="width:24px;height:24px" viewBox="0 0 24 24">
							<path d="M4,4H7L9,2H15L17,4H20A2,2 0 0,1 22,6V18A2,2 0 0,1 20,20H4A2,2 0 0,1 2,18V6A2,2 0 0,1 4,4M12,7A5,5 0 0,0 7,12A5,5 0 0,0 12,17A5,5 0 0,0 17,12A5,5 0 0,0 12,7M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9Z" />
						</svg>
					</a>

					<div class="footer__separator"></div>

					<a id="layoutBtn1" class="mode-btn">
						<svg viewBox="0 0 100 100" style="transform:rotate(-90deg)">
							<use xlink:href="#mode-icon" />
						</svg>
					</a>
					<a id="layoutBtn2" class="mode-btn">
						<svg viewBox="0 0 100 100">
							<use xlink:href="#mode-icon" />
						</svg>
					</a>
					<a id="layoutBtn3" class="mode-btn">
						<svg viewBox="0 0 100 100" style="transform:rotate(90deg)">
							<use xlink:href="#mode-icon" />
						</svg>
					</a>
					<a id="layoutBtn5" class="mode-btn">
						<svg viewBox="0 0 100 100">
							<use xlink:href="#vertical-mode-icon" />
						</svg>
					</a>
					<a id="layoutBtn4" class="mode-btn hint--top-left hint--rounded" aria-label="Full Screen">
						<svg viewBox="0 0 100 100">
							<rect x="0" y="0" width="100" height="100" />
						</svg>
					</a>
					<a class="mode-btn hint--top-left hint--rounded" aria-label="Detach Preview" d-click="openDetachedPreview">
						<svg viewBox="0 0 24 24">
							<path d="M22,17V7H6V17H22M22,5A2,2 0 0,1 24,7V17C24,18.11 23.1,19 22,19H16V21H18V23H10V21H12V19H6C4.89,19 4,18.11 4,17V7A2,2 0 0,1 6,5H22M2,3V15H0V3A2,2 0 0,1 2,1H20V3H2Z" />
						</svg>
					</a>


					<div class="footer__separator"></div>

					<a id="notificationsBtn" class="notifications-btn  mode-btn  hint--top-left  hint--rounded" aria-label="Notifications">
						<svg viewBox="0 0 24 24">
							<path d="M14,20A2,2 0 0,1 12,22A2,2 0 0,1 10,20H14M12,2A1,1 0 0,1 13,3V4.08C15.84,4.56 18,7.03 18,10V16L21,19H3L6,16V10C6,7.03 8.16,4.56 11,4.08V3A1,1 0 0,1 12,2Z" />
						</svg>
						<span class="notifications-btn__dot"></span>
					</a>
					<a d-open-modal="settingsModal" data-event-category="ui" data-event-action="settingsBtnClick" class="mode-btn  hint--top-left  hint--rounded" aria-label="Settings">
						<svg>
							<use xlink:href="#settings-icon"></use>
						</svg>
					</a>

				</div>

				<!-- https://webmakerapp.com/     
				<a href="#" target="_blank"><div class="logo"></div></a>
			&copy;<span class="web-maker-with-tag">Web Maker</span> &nbsp;&nbsp;
		-->
				
				<a d-open-modal="helpModal" data-event-category="ui" data-event-action="helpButtonClick" class="footer__link  hint--rounded  hint--top-right" aria-label="Help">
					<svg style="width:20px; height:20px; vertical-align:text-bottom" viewBox="0 0 24 24">
						<path d="M15.07,11.25L14.17,12.17C13.45,12.89 13,13.5 13,15H11V14.5C11,13.39 11.45,12.39 12.17,11.67L13.41,10.41C13.78,10.05 14,9.55 14,9C14,7.89 13.1,7 12,7A2,2 0 0,0 10,9H8A4,4 0 0,1 12,5A4,4 0 0,1 16,9C16,9.88 15.64,10.67 15.07,11.25M13,19H11V17H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z" />
					</svg>
				</a>

				<a d-open-modal="keyboardShortcutsModal" data-event-category="ui" data-event-action="keyboardShortcutButtonClick" class="footer__link  hint--rounded  hint--top-right" aria-label="Keyboard shortcuts">
					<svg style="width:20px; height:20px; vertical-align:text-bottom">
						<use xlink:href="#keyboard-icon"></use>
					</svg>
				</a>

			</div>
		</div>





		<div class="modal" id="addLibraryModal">
			<div class="modal__content"  style="width:100%  !important;height:100% !important;">




				<div style="width:100% !important;">
					<div style="width:70% !important; float:left">

						<a d-click="onModalCloseBtnClick" href="" aria-label="Close add library modal" title="Close" class="js-modal__close-btn  modal__close-btn">
							<svg>
								<use xlink:href="#cross-icon"></use>
							</svg>
						</a>
						<h1>Add Library
							<small style="font-size: 0.5em;">
								<select name="" id="js-add-library-select">
									<option value="">-------</option>
									<optgroup label="JavaScript Libraries">

									</optgroup>
									<optgroup label="CSS Libraries">

									</optgroup>
								</select>
							</small>
						</h1>


						<input type="text" id="externalLibrarySearchInput" class="full-width" placeholder="Search from cdnjs libraries">

						<h3>JavaScript</h3>
						<p style="font-size: 0.8em;" class="show-when-extension opacity--70">Note: You can load external scripts from following domains: localhost, https://ajax.googleapis.com, https://code.jquery.com, https://cdnjs.cloudflare.com, https://unpkg.com, https://maxcdn.com, https://cdn77.com, https://maxcdn.bootstrapcdn.com, https://cdn.jsdelivr.net/, https://rawgit.com, https://wzrd.in</p>
						<textarea ondrop="drop(event)" ondragover="allowDrop(event)" id="js-external-js" class="full-width" cols="30" rows="15" placeholder="Start typing name of a library. Put each library in new line"></textarea>

						<h3>CSS</h3>
						<textarea ondrop="drop(event)" ondragover="allowDrop(event)" id="js-external-css" class="full-width" cols="30" rows="15" placeholder="Start typing name of a library. Put each library in new line"></textarea>
					</div>

					<div style="width:28% !important; float:right">
						<h1>Local Assets</h1>

						<div class="form-group">
							<label for="exampleInputFile">Load Library Links  | <input type="button" class="form-control" onclick="clearLibrary()" value="Clear"></label>
							<input type="file" class="form-control" id="exampleInputFile" onchange="convertStringToArrayAndRender(this)">
						</div>


						<style>
							#localLibrary{ max-height:85% !important; overflow:auto; border-left:2px solid #a7a7a7; border-right:2px solid #a7a7a7; border-radius:10px; margin-top:10px;}
							#localLibrary ul{ list-style-type:none; padding:5px; }
							#localLibrary ul li{ border-bottom: 2px silver; padding:5px; !important; }
							#localLibrary ul li:hover{ background: dodgerblue; color:white; }
						</style>
						<div id="localLibrary">

						</div>


						<script src="custom-js/list.min.js"></script>
						<script>
							var LIBRARY_NAME = 'lastLoadedLibrary';
							if(window.localStorage.getItem(LIBRARY_NAME) !== null){
                                renderLibrary(window.localStorage.getItem(LIBRARY_NAME));
							}


							// clear library
							function clearLibrary(){
                                window.localStorage.removeItem(LIBRARY_NAME);
                                document.getElementById('libDragColumn').innerHTML = '';
                            }

                            // make unigue id
                            function getRandomNumber(){
                                return Math.random();
                            }

                            // load and read local file
                            function readFile(element, callBack) {
                                var reader = new FileReader();
                                reader.onload = function (evt) { 
                                	callBack(evt.target.result);  
                                }
                                reader.readAsText(element.files[0]);
                            }

                            // convert to array and show
                            function convertStringToArrayAndRender(obj) {
								readFile(obj, function(data){
									var dataArray = JSON.parse(data); //data.split(/\r?\n/);
									// loop true list
									var allData = '' +
									'<input class="search" placeholder="Search" style="width:100%;padding:10px;" />' +
									'<ul id="libDragColumn" class="list">';
									for(var i = 0; i < dataArray.length; i++){
										var filename = dataArray[i].replace(/^.*[\\\/]/, '');
										var linkId = getRandomNumber();
										allData += '<li ondblclick="getLinkAndPaste(this)" class="libDragColumn"  draggable="true" ondragstart="drag(event)" data-lnkid="link_' + linkId + '"><p><strong>' + filename + '</strong></p><small  class="lib_item" id="link_' + linkId + '" style="color:silver">' + dataArray[i] + '</small><hr/></li>'
									}
									allData += '</ul>';
									renderLibrary(allData);
									// // save to storage
									window.localStorage.setItem(LIBRARY_NAME, allData);
								})
                            }

                            // display html data
                            function renderLibrary(htmlData){
                                // add list
                                var localLibrary = document.getElementById('localLibrary');
                                localLibrary.innerHTML = (htmlData);

                                // search
                                var options = { valueNames: [ 'lib_item' ]  };
                                var libList = new List('localLibrary', options);

							}


							function getLinkAndPaste(object){
                                pasteWise(document.getElementById(object.dataset.lnkid).innerHTML);
							}


							function pasteWise(path){
                                var containner = null;

                                if(path.toLocaleLowerCase().endsWith('.js')) containner = document.getElementById('js-external-js');
                                else if(path.toLocaleLowerCase().endsWith('.css')) containner = document.getElementById('js-external-css');


                                if(containner !== null){
                                    if(containner.value.indexOf(path) === -1) containner.value = path +  '\n' + containner.value;
                                    else console.log(": EXISTS : " + path);
								}
							}








							// drag and drop
							/**
							 *  <ul>
							 *      <li draggable="true" ondragstart="drag(event)" data-lnkid="id_of_text_to_paste"> data text to drag </li>
							 *  </ul>
							 *
							 *  <textArea ondrop="drop(event)" ondragover="allowDrop(event)"> drop item here </textArea>
							 */
                            function allowDrop(ev) {
                                ev.preventDefault();
                            }
                            function drag(ev) {
                                ev.dataTransfer.setData("text", document.getElementById(ev.target.dataset.lnkid).innerHTML );
                            }
                            function drop(ev) {
                                ev.preventDefault();
                                var path = ev.dataTransfer.getData("text");

                                if(ev.target.value.indexOf(path) === -1) ev.target.value = path +  '\n' + ev.target.value;
                                else console.log(": EXISTS : " + path);
                            }
						</script>
					</div>
				</div>



			</div>
		</div>








		<div class="modal" id="cssSettingsModal">
			<div class="modal__content">
				<a d-click="onModalCloseBtnClick" href="" aria-label="Close CSS settings modal" title="Close" class="js-modal__close-btn  modal__close-btn">
					<svg>
						<use xlink:href="#cross-icon"></use>
					</svg>
				</a>
				<h1>Atomic CSS Settings</h1>
				<h3>Configure Atomizer settings. <a href="https://github.com/acss-io/atomizer#api" target="_blank">Read more</a> about available settings.</h3>
				<div style="height: calc(100vh - 350px);">
					<textarea id="acssSettingsTextarea" cols="30" rows="10"></textarea>
				</div>
			</div>
		</div>

		<div class="modal" id="helpModal">
			<div class="modal__content" d-html="partials/help-modal.html"></div>
		</div>

		<div class="modal" id="keyboardShortcutsModal">
			<div class="modal__content" d-html="partials/keyboard-shortcuts.html"></div>
		</div>

		<div class="modal" id="onboardModal">
			<div class="modal__content" d-html="partials/onboard-modal.html"></div>
		</div>

		<div class="modal" id="loginModal">
			<div class="modal__content" d-html="partials/login-modal.html"></div>
		</div>

		<div class="modal" id="profileModal">
			<div class="modal__content">
				<a d-click="onModalCloseBtnClick" href="" aria-label="Close logout modal" title="Close" class="js-modal__close-btn  modal__close-btn">
					<svg>
						<use xlink:href="#cross-icon"></use>
					</svg>
				</a>
				<div class="tac">
					<img height="80" class="profile-modal__avatar-img" src="" id="profileAvatarImg" alt="Profile image">
					<h3 id="profileUserName" class="mb-2"></h3>
					<p>
						<button class="btn" aria-label="Logout from your account" d-click="logout">Logout</button>
					</p>
				</div>
			</div>
		</div>

		<div class="modal pledge-modal" id="pledgeModal">
			<div class="modal__content" d-html="partials/pledge-modal.html"></div>
		</div>

		<div class="modal modal--settings" id="settingsModal">
			<div class="modal__content">
				<a d-click="onModalCloseBtnClick" href="" aria-label="Close Settings" title="Close" class="js-modal__close-btn  modal__close-btn">
					<svg>
						<use xlink:href="#cross-icon"></use>
					</svg>
				</a>
				<h1>Settings</h1>

				<h3>Indentation</h3>
				<div class="line" title="I know this is tough, but you have to decide one!">
					<label>
						<input type="radio" checked="true" name="indentation" value="spaces" d-change="updateSetting" data-setting="indentWith"> Spaces
					</label>
					<label class="ml-1">
						<input type="radio" name="indentation" value="tabs" d-change="updateSetting" data-setting="indentWith"> Tabs
					</label>
				</div>
				<label class="line" title="">
					Indentation Size <input type="range" class="va-m ml-1" value="2" min="1" max="7" list="indentationSizeList" data-setting="indentSize" d-change="updateSetting">
					<span id="indentationSizeValueEl"></span>
					<datalist id="indentationSizeList">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
					</datalist>
				</label>
				<hr>

				<h3>Editor</h3>
				<div class="flex">

					<div>
						<label class="line">
							Default Preprocessors
						</label>
						<div class="flex line">
							<select style="flex:1;margin-left:20px" data-setting="htmlMode" d-change="updateSetting">
								<option value="html">HTML</option>
								<option value="markdown">Markdown</option>
								<option value="jade">Pug</option>
							</select>
							<select style="flex:1;margin-left:20px" data-setting="cssMode" d-change="updateSetting">
								<option value="css">CSS</option>
								<option value="scss">SCSS</option>
								<option value="sass">SASS</option>
								<option value="less">LESS</option>
								<option value="stylus">Stylus</option>
								<option value="acss">Atomic CSS</option>
							</select>
							<select style="flex:1;margin-left:20px" data-setting="jsMode" d-change="updateSetting">
								<option value="js">JS</option>
								<option value="coffee">CoffeeScript</option>
								<option value="es6">ES6 (Babel)</option>
								<option value="typescript">TypeScript</option>
							</select>
						</div>
						<label class="line">
							Theme
							<select style="flex:1;margin:0 20px" data-setting="editorTheme" d-change="updateSetting"></select>
						</label>
						<label class="line">
							Font
							<select style="flex:1;margin:0 20px" data-setting="editorFont" d-change="updateSetting">
								<option value="FiraCode">Fira Code</option>
								<option value="Inconsolata">Inconsolata</option>
								<option value="Monoid">Monoid</option>
								<option value="FixedSys">FixedSys</option>
								<option disabled="disabled">----</option>
								<option value="other">Other font from system</option>
							</select>
							<input id="customEditorFontInput" type="text" value="" placeholder="Custom font name here" data-setting="editorCustomFont" d-change="updateSetting">
						</label>
						<label class="line">
							Font Size <input type="number" value="16" data-setting="fontSize" d-change="updateSetting"> px

						</label>
						<div class="line">
							Key bindings
							<label class="ml-1">
								<input type="radio" checked="true" name="keymap" value="sublime" d-change="updateSetting" data-setting="keymap"> Sublime
							</label>
							<label class="ml-1">
								<input type="radio" name="keymap" value="vim" d-change="updateSetting" data-setting="keymap"> Vim
							</label>
						</div>
					</div>
          			<div class="ml-2">
						<label class="line" title="Toggle wrapping of long sentences onto new line">
							<input type="checkbox" d-change="updateSetting" data-setting="lineWrap"> Line wrap
						</label>
						<label class="line" title="Your Preview will refresh when you resize the preview split">
							<input type="checkbox" d-change="updateSetting" data-setting="refreshOnResize"> Refresh preview on resize
						</label>
						<label class="line" title="Turns on the auto-completion suggestions as you type">
							<input type="checkbox" d-change="updateSetting" data-setting="autoComplete"> Auto-complete suggestions
						</label>
						<label class="line" title="Refreshes the preview as you code. Otherwise use the Run button">
							<input type="checkbox" d-change="updateSetting" data-setting="autoPreview"> Auto-preview
						</label>
						<label class="line" title="Auto-save keeps saving your code at regular intervals after you hit the first save manually">
							<input type="checkbox" d-change="updateSetting" data-setting="autoSave"> Auto-save
						</label>
						<label class="line" title="Loads the last open creation when app starts">
							<input type="checkbox" d-change="updateSetting" data-setting="preserveLastCode"> Preserve last written code
						</label>
						<label class="line show-when-extension" title="Turning this on will start showing Web Maker in every new tab you open">
							<input type="checkbox" d-change="updateSetting" data-setting="replaceNewTab"> Replace new tab page
						</label>
						<label class="line" title="Preserves the console logs across your preview refreshes">
							<input type="checkbox" d-change="updateSetting" data-setting="preserveConsoleLogs"> Preserve console logs
						</label>
						<label class="line" title="Switch to lighter version for better performance. Removes things like blur etc.">
						  <input type="checkbox" d-change="updateSetting" data-setting="lightVersion"> Fast/light version
						</label>
					</div>
				</div>

				<hr>

				<h3>Fun</h3>
				<p>
					<label class="line" title="Enjoy wonderful particle blasts while you type">
						<input type="checkbox" d-change="updateSetting" data-setting="isCodeBlastOn"> Code blast!
					</label>
				</p>
			</div>
		</div>

		<div class="modal" id="notificationsModal">
			<div class="modal__content" d-html="partials/changelog.html"></div>
		</div>

		<div id="js-saved-items-pane" class="saved-items-pane">
			<button class="btn  saved-items-pane__close-btn" id="js-saved-items-pane-close-btn">X</button>
			<div class="flex flex-v-center" style="justify-content: space-between;">
				<h3>My Library <span id="savedItemCountEl"></span></h3>

				<div class="main-header__btn-wrap">
					<a d-click="exportItems" href="" class="btn btn-icon hint--bottom-left hint--rounded hint--medium" aria-label="Export all your creations into a single importable file.">Export
					</a>
					<a d-click="onImportBtnClicked" href="" class="btn btn-icon hint--bottom-left hint--rounded hint--medium" aria-label="Only the file that you export through the 'Export' button can be imported.">Import
					</a>
				</div>
			</div>
			<input type="" id="searchInput" class="search-input" d-input="onSearchInputChange" placeholder="Search your creations here...">

			<div id="js-saved-items-wrap" class="saved-items-pane__container">
			</div>
		</div>

		<div class="modal-overlay"></div>

		<div class="alerts-container" id="js-alerts-container"></div>
		<form style="display:none;" action="https://codepen.io/pen/define" method="POST" target="_blank" id="js-codepen-form">
		  <input type="hidden" name="data" value='{"title": "New Pen!", "html": "<div>Hello, World!</div>"}'>
		</form>

		<svg version="1.1" xmlns="http://www.w3.org/2000/svg" style="display:none">
			<symbol id="logo" viewBox="-145 -2 372 175">
			    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(-145.000000, -1.000000)">
			        <polygon id="Path-1" fill="#FF4600" points="31 0 232 0 132 173.310547"></polygon>
			        <polygon id="Path-1" fill="#FF6C00" points="0 0 201 0 101 173.310547"></polygon>
			        <polygon id="Path-1" fill="#FF6C00" transform="translate(271.500000, 86.500000) scale(1, -1) translate(-271.500000, -86.500000) " points="171 0 372 0 272 173.310547"></polygon>
			        <polygon id="Path-1" fill="#FF4600" transform="translate(241.500000, 86.500000) scale(1, -1) translate(-241.500000, -86.500000) " points="141 0 342 0 242 173.310547"></polygon>
			    </g>
			</symbol>
			<symbol id="bug-icon" viewBox="0 0 24 24">
    			<path d="M14,12H10V10H14M14,16H10V14H14M20,8H17.19C16.74,7.22 16.12,6.55 15.37,6.04L17,4.41L15.59,3L13.42,5.17C12.96,5.06 12.5,5 12,5C11.5,5 11.04,5.06 10.59,5.17L8.41,3L7,4.41L8.62,6.04C7.88,6.55 7.26,7.22 6.81,8H4V10H6.09C6.04,10.33 6,10.66 6,11V12H4V14H6V15C6,15.34 6.04,15.67 6.09,16H4V18H6.81C7.85,19.79 9.78,21 12,21C14.22,21 16.15,19.79 17.19,18H20V16H17.91C17.96,15.67 18,15.34 18,15V14H20V12H18V11C18,10.66 17.96,10.33 17.91,10H20V8Z" />
			</symbol>
			<symbol id="google-icon" viewBox="0 0 24 24">
				<path d="M21.35,11.1H12.18V13.83H18.69C18.36,17.64 15.19,19.27 12.19,19.27C8.36,19.27 5,16.25 5,12C5,7.9 8.2,4.73 12.2,4.73C15.29,4.73 17.1,6.7 17.1,6.7L19,4.72C19,4.72 16.56,2 12.1,2C6.42,2 2.03,6.8 2.03,12C2.03,17.05 6.16,22 12.25,22C17.6,22 21.5,18.33 21.5,12.91C21.5,11.76 21.35,11.1 21.35,11.1V11.1Z" />
			</symbol>
			<symbol id="fb-icon" viewBox="0 0 24 24">
				<path d="M17,2V2H17V6H15C14.31,6 14,6.81 14,7.5V10H14L17,10V14H14V22H10V14H7V10H10V6A4,4 0 0,1 14,2H17Z" />
			</symbol>
			<symbol id="github-icon" viewBox="0 0 24 24">
			    <path d="M12,2A10,10 0 0,0 2,12C2,16.42 4.87,20.17 8.84,21.5C9.34,21.58 9.5,21.27 9.5,21C9.5,20.77 9.5,20.14 9.5,19.31C6.73,19.91 6.14,17.97 6.14,17.97C5.68,16.81 5.03,16.5 5.03,16.5C4.12,15.88 5.1,15.9 5.1,15.9C6.1,15.97 6.63,16.93 6.63,16.93C7.5,18.45 8.97,18 9.54,17.76C9.63,17.11 9.89,16.67 10.17,16.42C7.95,16.17 5.62,15.31 5.62,11.5C5.62,10.39 6,9.5 6.65,8.79C6.55,8.54 6.2,7.5 6.75,6.15C6.75,6.15 7.59,5.88 9.5,7.17C10.29,6.95 11.15,6.84 12,6.84C12.85,6.84 13.71,6.95 14.5,7.17C16.41,5.88 17.25,6.15 17.25,6.15C17.8,7.5 17.45,8.54 17.35,8.79C18,9.5 18.38,10.39 18.38,11.5C18.38,15.32 16.04,16.16 13.81,16.41C14.17,16.72 14.5,17.33 14.5,18.26C14.5,19.6 14.5,20.68 14.5,21C14.5,21.27 14.66,21.59 15.17,21.5C19.14,20.16 22,16.42 22,12A10,10 0 0,0 12,2Z" />
			</symbol>
			<symbol id="settings-icon" viewBox="0 0 24 24">
				<path d="M12,15.5A3.5,3.5 0 0,1 8.5,12A3.5,3.5 0 0,1 12,8.5A3.5,3.5 0 0,1 15.5,12A3.5,3.5 0 0,1 12,15.5M19.43,12.97C19.47,12.65 19.5,12.33 19.5,12C19.5,11.67 19.47,11.34 19.43,11L21.54,9.37C21.73,9.22 21.78,8.95 21.66,8.73L19.66,5.27C19.54,5.05 19.27,4.96 19.05,5.05L16.56,6.05C16.04,5.66 15.5,5.32 14.87,5.07L14.5,2.42C14.46,2.18 14.25,2 14,2H10C9.75,2 9.54,2.18 9.5,2.42L9.13,5.07C8.5,5.32 7.96,5.66 7.44,6.05L4.95,5.05C4.73,4.96 4.46,5.05 4.34,5.27L2.34,8.73C2.21,8.95 2.27,9.22 2.46,9.37L4.57,11C4.53,11.34 4.5,11.67 4.5,12C4.5,12.33 4.53,12.65 4.57,12.97L2.46,14.63C2.27,14.78 2.21,15.05 2.34,15.27L4.34,18.73C4.46,18.95 4.73,19.03 4.95,18.95L7.44,17.94C7.96,18.34 8.5,18.68 9.13,18.93L9.5,21.58C9.54,21.82 9.75,22 10,22H14C14.25,22 14.46,21.82 14.5,21.58L14.87,18.93C15.5,18.67 16.04,18.34 16.56,17.94L19.05,18.95C19.27,19.03 19.54,18.95 19.66,18.73L21.66,15.27C21.78,15.05 21.73,14.78 21.54,14.63L19.43,12.97Z"></path>
			</symbol>
			<symbol	id="twitter-icon" viewBox="0 0 16 16">
				<path d="M15.969,3.058c-0.586,0.26-1.217,0.436-1.878,0.515c0.675-0.405,1.194-1.045,1.438-1.809
			c-0.632,0.375-1.332,0.647-2.076,0.793c-0.596-0.636-1.446-1.033-2.387-1.033c-1.806,0-3.27,1.464-3.27,3.27 c0,0.256,0.029,0.506,0.085,0.745C5.163,5.404,2.753,4.102,1.14,2.124C0.859,2.607,0.698,3.168,0.698,3.767 c0,1.134,0.577,2.135,1.455,2.722C1.616,6.472,1.112,6.325,0.671,6.08c0,0.014,0,0.027,0,0.041c0,1.584,1.127,2.906,2.623,3.206 C3.02,9.402,2.731,9.442,2.433,9.442c-0.211,0-0.416-0.021-0.615-0.059c0.416,1.299,1.624,2.245,3.055,2.271 c-1.119,0.877-2.529,1.4-4.061,1.4c-0.264,0-0.524-0.015-0.78-0.046c1.447,0.928,3.166,1.469,5.013,1.469 c6.015,0,9.304-4.983,9.304-9.304c0-0.142-0.003-0.283-0.009-0.423C14.976,4.29,15.531,3.714,15.969,3.058z"/>
			</symbol>
			<symbol id="heart-icon" viewBox="0 0 24 24">
				<path d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z" />
			</symbol>
			<symbol id="play-icon" viewBox="0 0 24 24">
				<svg>
					<path d="M8,5.14V19.14L19,12.14L8,5.14Z" />
				</svg>
			</symbol>
			<symbol id="cancel-icon" viewBox="0 0 24 24">
				<svg>
					<path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12C4,13.85 4.63,15.55 5.68,16.91L16.91,5.68C15.55,4.63 13.85,4 12,4M12,20A8,8 0 0,0 20,12C20,10.15 19.37,8.45 18.32,7.09L7.09,18.32C8.45,19.37 10.15,20 12,20Z" />
				</svg>
			</symbol>
			<symbol id="chevron-icon" viewBox="0 0 24 24">
				<svg>
				<path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
				</svg>
			</symbol>
			<symbol id="chat-icon" viewBox="0 0 24 24">
					<path d="M20,2H4A2,2 0 0,0 2,4V22L6,18H20A2,2 0 0,0 22,16V4A2,2 0 0,0 20,2M8,14H6V12H8V14M8,11H6V9H8V11M8,8H6V6H8V8M15,14H10V12H15V14M18,11H10V9H18V11M18,8H10V6H18V8Z" />
			</symbol>
			<symbol id="gift-icon" viewBox="0 0 24 24">
				<path d="M22,12V20A2,2 0 0,1 20,22H4A2,2 0 0,1 2,20V12A1,1 0 0,1 1,11V8A2,2 0 0,1 3,6H6.17C6.06,5.69 6,5.35 6,5A3,3 0 0,1 9,2C10,2 10.88,2.5 11.43,3.24V3.23L12,4L12.57,3.23V3.24C13.12,2.5 14,2 15,2A3,3 0 0,1 18,5C18,5.35 17.94,5.69 17.83,6H21A2,2 0 0,1 23,8V11A1,1 0 0,1 22,12M4,20H11V12H4V20M20,20V12H13V20H20M9,4A1,1 0 0,0 8,5A1,1 0 0,0 9,6A1,1 0 0,0 10,5A1,1 0 0,0 9,4M15,4A1,1 0 0,0 14,5A1,1 0 0,0 15,6A1,1 0 0,0 16,5A1,1 0 0,0 15,4M3,8V10H11V8H3M13,8V10H21V8H13Z" />
			<symbol id="gift-icon" viewBox="0 0 24 24">
			</symbol>
			<symbol id="cross-icon" viewBox="0 0 24 24">
				<path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
			</symbol>
			<symbol id="keyboard-icon" viewBox="0 0 24 24">
				<path d="M19,10H17V8H19M19,13H17V11H19M16,10H14V8H16M16,13H14V11H16M16,17H8V15H16M7,10H5V8H7M7,13H5V11H7M8,11H10V13H8M8,8H10V10H8M11,11H13V13H11M11,8H13V10H11M20,5H4C2.89,5 2,5.89 2,7V17A2,2 0 0,0 4,19H20A2,2 0 0,0 22,17V7C22,5.89 21.1,5 20,5Z" />
			</symbol>
			<symbol id="mode-icon" viewBox="0 0 100 100">
				<g>
					<rect x="0" y="0" width="28" height="47" />
					<rect x="36" y="0" width="28" height="47"/>
					<rect x="72" y="0" width="28" height="47"/>
					<rect x="0" y="53" width="100" height="47"/>
				</g>
			</symbol>
			<symbol id="vertical-mode-icon" viewBox="0 0 100 100">
				<g>
					<rect x="0" y="0" width="20" height="100" />
					<rect x="23" y="0" width="20" height="100"/>
					<rect x="46" y="0" width="20" height="100"/>
					<rect x="69" y="0" width="32" height="100"/>
				</g>
			</symbol>
			<symbol id="loader-icon" viewBox="0 0 44 44">
				<!-- By Sam Herbert (@sherb), for everyone. More @ http://goo.gl/7AJzbL -->
				<g fill="none" fill-rule="evenodd" stroke-width="10">
					<circle cx="22" cy="22" r="1">
						<animate attributeName="r"
							begin="0s" dur="1.8s"
							values="1; 20"
							calcMode="spline"
							keyTimes="0; 1"
							keySplines="0.165, 0.84, 0.44, 1"
							repeatCount="indefinite" />
						<animate attributeName="stroke-opacity"
							begin="0s" dur="1.8s"
							values="1; 0"
							calcMode="spline"
							keyTimes="0; 1"
							keySplines="0.3, 0.61, 0.355, 1"
							repeatCount="indefinite" />
					</circle>
					<circle cx="22" cy="22" r="1">
						<animate attributeName="r"
							begin="-0.9s" dur="1.8s"
							values="1; 20"
							calcMode="spline"
							keyTimes="0; 1"
							keySplines="0.165, 0.84, 0.44, 1"
							repeatCount="indefinite" />
						<animate attributeName="stroke-opacity"
							begin="-0.9s" dur="1.8s"
							values="1; 0"
							calcMode="spline"
							keyTimes="0; 1"
							keySplines="0.3, 0.61, 0.355, 1"
							repeatCount="indefinite" />
					</circle>
				</g>
			</symbol>
		</svg>





		<script src="vendor.js"></script>

		<script src="script.js"></script>
	</body>
</html>
