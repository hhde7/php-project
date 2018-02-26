function goTo() {
	if (window.matchMedia("(max-width: 991px)").matches) {
  		window.onload = function () {
    		document.getElementById("post-link").scrollIntoView({
      			behavior: 'smooth'
    		});
  		}
	}
}

goTo();
