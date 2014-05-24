<?php
include_once 'inc/header.php';
?>

			<div class="cover-2"></div>
			
			<div class="container">

				<h2>Deviens membre de la communauté Trendy !</h2>
				<div class="become-member">
					<p class="big"></p>
					<p> Si ajouter des astuces en favoris ou proposer tes astuces t'intéresse alors <a href="inscription.php">inscris-toi !</a></p>
					<p>Mais si tu es déja inscrite, alors <a href="connexion.php">connecte-toi</a> et accède à ton profil !</p>
				</div>
			</div><!-- end container -->

			<footer class="sticky">

				<p class="copyright">&copy; Fait avec amour par Amandine Clerc</a></p>

				<div id="social" class="social">
						<a class="instagram" href="http://instagram.com/trendy_mode0/" target="_blank">Instagram</a>
						<a class="twitter" href="https://twitter.com/Trendy__mode" target="_blank">twitter</a>
						<a class="facebook" href="https://www.facebook.com/trendymode0" target="_blank">facebook</a>
				</div>

				<p><a class="footer-about" href="about.php">A propos de Trendy</a></p>

			</footer>

		</div><!-- end content -->


	<script>

		var navBut = document.getElementById("navBut");
		var header = document.getElementById("header");
		var menu = document.getElementById("menu");
		var logo = document.getElementsByClassName("logo")[0];
		var content = document.getElementsByClassName("content")[0];
		var social = document.getElementsByClassName("social")[0];
		var show = true;

		function showMenu(){

			if(show == true){

				show = false;

				header.className = "";
				menu.className = "";
				social.className = "";
				logo.classList.remove("hide");
				content.classList.add("move");
				social.classList.remove("hide");
			}

			else{

				show = true;

				header.className = "hide";
				menu.className = "hide";
				social.className = "hide";
				logo.classList.add("hide");
				social.classList.add("hide");
				content.classList.remove("move");

			}

		};

		function showMenu(){

			if(show == true){

				show = false;

				header.className = "";
				menu.className = "";
				social.className = "";
				logo.classList.remove("hide");
				content.classList.add("onmousehover");
				social.classList.remove("hide");
			}

			else{

				show = true;

				header.className = "hide";
				menu.className = "hide";
				social.className = "hide";
				logo.classList.add("hide");
				social.classList.add("hide");
				content.classList.remove("onmousehover");

			}

		};

		header.addEventListener("mouseover",showMenu,false);
		header.addEventListener("mouseout",showMenu,true);

		header.addEventListener("click",showMenu,false);



		//http://codepen.io/Metty/pen/dglwH CREDITER 
		// Dropdown Menu
		var dropdown = document.querySelectorAll('.dropdown');
		var dropdownArray = Array.prototype.slice.call(dropdown,0);
		dropdownArray.forEach(function(el){
			var button = el.querySelector('a[data-toggle="dropdown"]'),
					menu = el.querySelector('.dropdown-menu'),
					arrow = button.querySelector('i.icon-arrow');

			button.onclick = function(event) {
				if(!menu.hasClass('show')) {
					menu.classList.add('show');
					menu.classList.remove('hide');
					arrow.classList.add('open');
					arrow.classList.remove('close');
					event.preventDefault();
				}
				else {
					menu.classList.remove('show');
					menu.classList.add('hide');
					arrow.classList.remove('open');
					arrow.classList.add('close');
					event.preventDefault();
				}
			};
		})

		Element.prototype.hasClass = function(className) {
		    return this.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(this.className);
		};


	</script>
</body>
</html>